<?php

namespace App\Filament\Resources\TeacherAssignments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TeacherAssignmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('teacher.name')->label('Guru')->searchable()->sortable(),
            TextColumn::make('subject.name')->label('Mata Pelajaran')->searchable(),
            TextColumn::make('classroom.name')->label('Rombel')->searchable(),
            TextColumn::make('semester.name')->label('Semester'),
            TextColumn::make('semester.academicYear.name')->label('Tahun Ajaran'),
        ])->filters([
            SelectFilter::make('teacher_id')->label('Guru')->relationship('teacher', 'name'),
            SelectFilter::make('classroom_id')->label('Rombel')->relationship('classroom', 'name'),
            SelectFilter::make('semester_id')->label('Semester')->relationship('semester', 'name'),
        ])->recordActions([EditAction::make()])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
