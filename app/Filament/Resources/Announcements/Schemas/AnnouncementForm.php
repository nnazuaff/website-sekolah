<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([TextInput::make('title')->label('Judul')->required()->maxLength(255), TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true)->maxLength(255), RichEditor::make('content')->label('Isi Pengumuman')->required()->columnSpanFull(), DateTimePicker::make('published_at')->label('Terbit Pada'), DateTimePicker::make('expired_at')->label('Berakhir Pada')->after('published_at'), Toggle::make('is_active')->label('Aktif')->default(true)]);
    }
}
