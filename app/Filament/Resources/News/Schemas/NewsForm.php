<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Judul')->required()->maxLength(255)->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
            TextInput::make('slug')->label('Slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            Textarea::make('excerpt')->label('Ringkasan')->rows(3)->columnSpanFull(),
            RichEditor::make('content')->label('Konten')->required()->columnSpanFull(),
            FileUpload::make('thumbnail')->label('Thumbnail')->image()->disk('public')->directory('news')->maxSize(2048),
            Select::make('status')->label('Status')->options([
                'draft' => 'Draf', 'published' => 'Terbit', 'archived' => 'Diarsipkan',
            ])->in(['draft', 'published', 'archived'])->required()->default('draft'),
            DateTimePicker::make('published_at')->label('Waktu Terbit')->native(false),
        ]);
    }
}
