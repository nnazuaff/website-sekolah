<?php

namespace App\Filament\Resources\TeacherAssignments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TeacherAssignmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('teacher_id')->label('Guru')->relationship('teacher', 'name')->searchable()->preload()->required(),
            Select::make('subject_id')->label('Mata Pelajaran')->relationship('subject', 'name')->searchable()->preload()->required(),
            Select::make('classroom_id')->label('Rombel')->relationship('classroom', 'name')->searchable()->preload()->required(),
            Select::make('semester_id')->label('Semester')->relationship('semester', 'name')->searchable()->preload()->required(),
        ]);
    }
}
