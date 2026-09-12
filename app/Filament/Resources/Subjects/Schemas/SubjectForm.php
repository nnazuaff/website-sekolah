<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Mata Pelajaran')->required()->maxLength(255),
            TextInput::make('code')->label('Kode Mapel')->required()->maxLength(30)->unique(ignoreRecord: true),
            TextInput::make('group')->label('Kelompok')->maxLength(100),
            TextInput::make('minimum_passing_grade')->label('KKM')->numeric()->minValue(0)->maxValue(100)->default(75)->required(),
            Toggle::make('is_active')->label('Aktif')->default(true),
        ]);
    }
}
