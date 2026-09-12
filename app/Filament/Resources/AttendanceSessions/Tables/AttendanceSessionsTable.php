<?php

namespace App\Filament\Resources\AttendanceSessions\Tables;

use App\Models\TeacherAssignment;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AttendanceSessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('date')->label('Tanggal')->date('d M Y')->sortable(),
            TextColumn::make('meeting_number')->label('Pertemuan')->sortable(),
            TextColumn::make('teacherAssignment.subject.name')->label('Mapel')->searchable(),
            TextColumn::make('teacherAssignment.classroom.name')->label('Rombel')->searchable(),
            TextColumn::make('teacherAssignment.teacher.name')->label('Guru')->searchable(),
            TextColumn::make('attendances_count')->label('Terdata')->counts('attendances'),
            TextColumn::make('topic')->label('Topik')->limit(35)->placeholder('-'),
        ])->filters([
            SelectFilter::make('teacher_assignment_id')
                ->label('Penugasan')
                ->options(fn (): array => self::assignmentFilterOptions(auth()->user()))
                ->searchable(),
        ])->recordActions([EditAction::make()->label('Isi Presensi')])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    /**
     * @return array<int, string>
     */
    public static function assignmentFilterOptions(?User $user): array
    {
        if (! $user) {
            return [];
        }

        return TeacherAssignment::query()
            ->visibleTo($user)
            ->with(['teacher', 'subject', 'classroom', 'semester'])
            ->get()
            ->mapWithKeys(fn (TeacherAssignment $assignment): array => [$assignment->id => $assignment->display_name])
            ->all();
    }
}
