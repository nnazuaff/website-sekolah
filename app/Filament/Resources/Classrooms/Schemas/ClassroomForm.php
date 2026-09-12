<?php

namespace App\Filament\Resources\Classrooms\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ClassroomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Rombel')->required()->maxLength(255),
            Select::make('academic_year_id')->label('Tahun Ajaran')->relationship('academicYear', 'name')->searchable()->preload()->required(),
            Select::make('major_id')->label('Jurusan')->relationship('major', 'name')->searchable()->preload(),
            Select::make('homeroom_teacher_id')->label('Wali Kelas')->relationship('homeroomTeacher', 'name')->searchable()->preload(),
            Select::make('grade_level')->label('Tingkat')->options([10 => 'X', 11 => 'XI', 12 => 'XII'])->required(),
            Toggle::make('is_active')->label('Aktif')->default(true),
        ]);
    }
}
