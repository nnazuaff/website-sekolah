<?php

namespace App\Filament\Resources\Extracurriculars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ExtracurricularForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nama Ekstrakurikuler')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(function (Set $set, Get $get, ?string $state): void {
                    if (blank($get('slug'))) {
                        $set('slug', Str::slug($state ?? ''));
                    }
                }),
            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->helperText('URL ramah mesin pencari. Kosongkan saat membuat agar dibuat otomatis dari nama.'),
            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(4),
            TextInput::make('coach')->label('Pembina')->maxLength(255),
            TextInput::make('schedule')->label('Jadwal')->maxLength(255),
            FileUpload::make('photo')
                ->label('Foto')
                ->image()
                ->disk('public')
                ->directory('extracurriculars')
                ->maxSize(2048),
            Toggle::make('is_active')->label('Aktif')->default(true),
        ]);
    }
}
