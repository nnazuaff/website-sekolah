<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Judul Prestasi')
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->label('Deskripsi')
                ->required()
                ->rows(4),
            TextInput::make('level')
                ->label('Tingkat')
                ->required()
                ->maxLength(255),
            DatePicker::make('achievement_date')
                ->label('Tanggal Prestasi')
                ->native(false),
            TextInput::make('year')
                ->label('Tahun')
                ->numeric()
                ->minValue(1900)
                ->maxValue(2100),
            FileUpload::make('photo')
                ->label('Foto')
                ->image()
                ->disk('public')
                ->directory('achievements')
                ->maxSize(2048),
        ]);
    }
}
