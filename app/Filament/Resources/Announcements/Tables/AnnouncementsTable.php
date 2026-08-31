<?php

namespace App\Filament\Resources\Announcements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AnnouncementsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([TextColumn::make('title')->label('Judul')->searchable()->sortable(), TextColumn::make('published_at')->label('Terbit')->dateTime('d M Y H:i')->sortable(), TextColumn::make('expired_at')->label('Berakhir')->dateTime('d M Y H:i'), ToggleColumn::make('is_active')->label('Aktif')])->recordActions([EditAction::make()])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
