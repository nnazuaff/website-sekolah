<?php

namespace App\Filament\Resources\Semesters\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SemestersTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('academicYear.name')->label('Tahun Ajaran')->sortable(),
            TextColumn::make('name')->label('Semester')->searchable(),
            TextColumn::make('number')->label('Urutan')->sortable(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->filters([SelectFilter::make('academic_year_id')->label('Tahun Ajaran')->relationship('academicYear', 'name')])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
