<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail')->label('Thumbnail')->disk('public'),
            TextColumn::make('title')->label('Judul')->searchable()->sortable()->limit(45),
            TextColumn::make('status')->label('Status')->badge()->formatStateUsing(fn (string $state) => match ($state) {
                'draft' => 'Draf', 'published' => 'Terbit', 'archived' => 'Diarsipkan', default => $state,
            })->color(fn (string $state) => match ($state) {
                'published' => 'success', 'archived' => 'danger', default => 'gray',
            }),
            TextColumn::make('published_at')->label('Waktu Terbit')->dateTime('d M Y H:i')->sortable(),
        ])->recordActions([EditAction::make()])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
