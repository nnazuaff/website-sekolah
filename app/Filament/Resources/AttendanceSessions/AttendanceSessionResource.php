<?php

namespace App\Filament\Resources\AttendanceSessions;

use App\Filament\Resources\AttendanceSessions\Pages\CreateAttendanceSession;
use App\Filament\Resources\AttendanceSessions\Pages\EditAttendanceSession;
use App\Filament\Resources\AttendanceSessions\Pages\ListAttendanceSessions;
use App\Filament\Resources\AttendanceSessions\Schemas\AttendanceSessionForm;
use App\Filament\Resources\AttendanceSessions\Tables\AttendanceSessionsTable;
use App\Models\AttendanceSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class AttendanceSessionResource extends Resource
{
    protected static ?string $model = AttendanceSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Akademik';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return 'Presensi';
    }

    public static function getModelLabel(): string
    {
        return 'Presensi';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Presensi';
    }

    public static function form(Schema $schema): Schema
    {
        return AttendanceSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AttendanceSessionsTable::configure($table);
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
        return ['index' => ListAttendanceSessions::route('/'), 'create' => CreateAttendanceSession::route('/create'), 'edit' => EditAttendanceSession::route('/{record}/edit')];
    }
}
