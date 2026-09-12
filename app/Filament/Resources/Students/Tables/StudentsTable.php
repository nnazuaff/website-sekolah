<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('nis')->label('NIS')->searchable()->sortable(),
            TextColumn::make('nisn')->label('NISN')->searchable()->placeholder('-'),
            TextColumn::make('name')->label('Nama Siswa')->searchable()->sortable(),
            TextColumn::make('classroom.name')->label('Rombel')->searchable(),
            TextColumn::make('gender')->label('L/P')->badge()->formatStateUsing(fn (string $state) => $state === 'L' ? 'Laki-laki' : 'Perempuan'),
            TextColumn::make('status')->label('Status')->badge()->formatStateUsing(fn (string $state) => match ($state) {
                'active' => 'Aktif', 'graduated' => 'Lulus', 'transferred' => 'Pindah', default => 'Tidak Aktif'
            }),
        ])->filters([
            SelectFilter::make('classroom_id')->label('Rombel')->relationship('classroom', 'name'),
            SelectFilter::make('status')->label('Status')->options(['active' => 'Aktif', 'graduated' => 'Lulus', 'transferred' => 'Pindah', 'inactive' => 'Tidak Aktif']),
        ])->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
