<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Judul')->required()->maxLength(255),
            Textarea::make('description')->label('Deskripsi')->rows(4),
            FileUpload::make('image')->label('Gambar')->image()->disk('public')->directory('galleries')->maxSize(4096),
            DatePicker::make('taken_at')->label('Tanggal Pengambilan'),
        ]);
    }
}
