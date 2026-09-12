<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('day_of_week')->label('Hari')->formatStateUsing(fn (int $state) => [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'][$state] ?? '-')->sortable(),
            TextColumn::make('start_time')->label('Mulai')->time('H:i'),
            TextColumn::make('end_time')->label('Selesai')->time('H:i'),
            TextColumn::make('teacherAssignment.teacher.name')->label('Guru')->searchable(),
            TextColumn::make('teacherAssignment.subject.name')->label('Mapel')->searchable(),
            TextColumn::make('teacherAssignment.classroom.name')->label('Rombel')->searchable(),
            TextColumn::make('room')->label('Ruangan')->placeholder('-'),
        ])->filters([SelectFilter::make('day_of_week')->label('Hari')->options([1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'])])
            ->recordActions([EditAction::make()])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
