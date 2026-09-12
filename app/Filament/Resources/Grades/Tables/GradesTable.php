<?php

namespace App\Filament\Resources\Grades\Tables;

use App\Models\Grade;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GradesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('student.name')->label('Siswa')->searchable()->sortable(),
            TextColumn::make('teacherAssignment.subject.name')->label('Mapel')->searchable(),
            TextColumn::make('teacherAssignment.classroom.name')->label('Rombel')->searchable(),
            TextColumn::make('assignment_score')->label('Tugas'),
            TextColumn::make('midterm_score')->label('UTS'),
            TextColumn::make('final_exam_score')->label('UAS'),
            TextColumn::make('final_score')->label('Akhir')->badge()->color(fn ($state, Grade $record) => $state >= $record->teacherAssignment->subject->minimum_passing_grade ? 'success' : 'danger'),
            TextColumn::make('published_at')->label('Status')->badge()->formatStateUsing(fn ($state) => $state ? 'Terbit' : 'Draf')->color(fn ($state) => $state ? 'success' : 'gray'),
        ])->filters([
            SelectFilter::make('teacher_assignment_id')->label('Penugasan')->relationship('teacherAssignment', 'id'),
            SelectFilter::make('published')->label('Publikasi')->options(['draft' => 'Draf', 'published' => 'Terbit'])->query(fn ($query, array $data) => match ($data['value'] ?? null) {
                'draft' => $query->whereNull('published_at'), 'published' => $query->whereNotNull('published_at'), default => $query
            }),
        ])->recordActions([
            EditAction::make(),
            Action::make('publish')->label('Publikasikan')->icon('heroicon-o-paper-airplane')->requiresConfirmation()->visible(fn (Grade $record) => auth()->user()?->can('publish', $record) ?? false)->action(function (Grade $record): void {
                $record->update(['published_at' => now()]);
                Notification::make()->title('Nilai dipublikasikan')->success()->send();
            }),
            Action::make('reopen')->label('Buka Kembali')->visible(fn (Grade $record) => $record->published_at && (auth()->user()?->can('reopen', $record) ?? false))->action(fn (Grade $record) => $record->update(['published_at' => null])),
        ])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
