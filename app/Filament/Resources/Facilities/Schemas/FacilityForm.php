<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([TextInput::make('name')->label('Nama Fasilitas')->required()->maxLength(255), TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true)->maxLength(255), Textarea::make('description')->label('Deskripsi')->rows(4), FileUpload::make('photo')->label('Foto')->image()->disk('public')->directory('facilities')->maxSize(4096), Toggle::make('is_active')->label('Aktif')->default(true)]);
    }
}
