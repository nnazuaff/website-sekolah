<?php

namespace App\Filament\Resources\Majors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MajorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Jurusan')->required()->maxLength(255)->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
            TextInput::make('slug')->label('Slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            TextInput::make('short_name')->label('Singkatan')->required()->maxLength(50),
            Textarea::make('description')->label('Deskripsi')->rows(5)->columnSpanFull(),
            FileUpload::make('image')->label('Gambar')->image()->disk('public')->directory('majors')->maxSize(2048),
            Toggle::make('is_active')->label('Aktif')->default(true),
        ]);
    }
}
