<?php

namespace App\Filament\Resources\Majors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MajorsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')->label('Gambar')->disk('public'),
            TextColumn::make('name')->label('Nama Jurusan')->searchable()->sortable(),
            TextColumn::make('short_name')->label('Singkatan')->searchable(),
            TextColumn::make('slug')->label('Slug')->searchable(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->recordActions([EditAction::make()])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
