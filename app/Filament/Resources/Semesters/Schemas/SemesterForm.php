<?php

namespace App\Filament\Resources\Semesters\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SemesterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Semester')->required()->maxLength(255),
            Select::make('academic_year_id')->label('Tahun Ajaran')->relationship('academicYear', 'name')->searchable()->preload()->required(),
            Select::make('number')->label('Urutan Semester')->options([1 => '1 - Ganjil', 2 => '2 - Genap'])->required(),
            Toggle::make('is_active')->label('Semester Aktif')->helperText('Mengaktifkan ini akan menonaktifkan semester lain.')->default(false),
        ]);
    }
}
