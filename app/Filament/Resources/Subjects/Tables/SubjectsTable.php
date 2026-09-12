<?php

namespace App\Filament\Resources\Subjects\Tables;

use App\Models\Subject;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SubjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('code')->label('Kode')->searchable()->sortable(),
            TextColumn::make('name')->label('Mata Pelajaran')->searchable()->sortable(),
            TextColumn::make('group')->label('Kelompok')->searchable(),
            TextColumn::make('minimum_passing_grade')->label('KKM')->sortable(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->filters([SelectFilter::make('group')->label('Kelompok')->options(fn () => Subject::query()->whereNotNull('group')->distinct()->pluck('group', 'group')->all())])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
