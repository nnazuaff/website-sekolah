<?php

namespace App\Filament\Resources\AcademicYears\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AcademicYearsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Tahun Ajaran')->searchable()->sortable(),
            TextColumn::make('start_date')->label('Mulai')->date('d M Y')->sortable(),
            TextColumn::make('end_date')->label('Selesai')->date('d M Y')->sortable(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->filters([TernaryFilter::make('is_active')->label('Status aktif')])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
