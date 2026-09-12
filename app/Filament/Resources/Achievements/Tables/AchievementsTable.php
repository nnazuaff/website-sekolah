<?php

namespace App\Filament\Resources\Achievements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AchievementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->label('Foto')->circular(),
                TextColumn::make('title')->label('Judul Prestasi')->searchable()->sortable(),
                TextColumn::make('level')->label('Tingkat')->searchable()->sortable(),
                TextColumn::make('year')->label('Tahun')->sortable(),
                TextColumn::make('achievement_date')->label('Tanggal Prestasi')->date('d M Y')->sortable(),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
