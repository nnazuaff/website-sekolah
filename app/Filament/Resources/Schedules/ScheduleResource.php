<?php

namespace App\Filament\Resources\Schedules;

use App\Filament\Resources\Schedules\Pages\CreateSchedule;
use App\Filament\Resources\Schedules\Pages\EditSchedule;
use App\Filament\Resources\Schedules\Pages\ListSchedules;
use App\Filament\Resources\Schedules\Schemas\ScheduleForm;
use App\Filament\Resources\Schedules\Tables\SchedulesTable;
use App\Models\Schedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static string|UnitEnum|null $navigationGroup = 'Akademik';

    protected static ?int $navigationSort = 9;

    public static function getNavigationLabel(): string
    {
        return 'Jadwal Pelajaran';
    }

    public static function getModelLabel(): string
    {
        return 'Jadwal Pelajaran';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Jadwal Pelajaran';
    }

    public static function form(Schema $schema): Schema
    {
        return ScheduleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchedulesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();
        if (! $user) {
            return $query->whereRaw('1 = 0');
        }

        return $query->whereHas('teacherAssignment', fn (Builder $assignment) => $assignment->visibleTo($user));
    }

    public static function getPages(): array
    {
        return ['index' => ListSchedules::route('/'), 'create' => CreateSchedule::route('/create'), 'edit' => EditSchedule::route('/{record}/edit')];
    }
}
