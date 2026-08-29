<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
    return $schema
        ->components([
            TextInput::make('name')
                ->label('Nama Guru')
                ->required()
                ->maxLength(255),

            TextInput::make('nip')
                ->label('NIP')
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('position')
                ->label('Jabatan')
                ->required(),

            TextInput::make('subject')
                ->label('Mata Pelajaran')
                ->required(),

            FileUpload::make('photo')
                ->label('Foto')
                ->image()
                ->disk('public')
                ->directory('teachers'),

            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(4),

            Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
    }
}
