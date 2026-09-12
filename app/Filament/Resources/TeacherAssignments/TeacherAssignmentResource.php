<?php

namespace App\Filament\Resources\TeacherAssignments;

use App\Filament\Resources\TeacherAssignments\Pages\CreateTeacherAssignment;
use App\Filament\Resources\TeacherAssignments\Pages\EditTeacherAssignment;
use App\Filament\Resources\TeacherAssignments\Pages\ListTeacherAssignments;
use App\Filament\Resources\TeacherAssignments\Schemas\TeacherAssignmentForm;
use App\Filament\Resources\TeacherAssignments\Tables\TeacherAssignmentsTable;
use App\Models\TeacherAssignment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class TeacherAssignmentResource extends Resource
{
    protected static ?string $model = TeacherAssignment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserPlus;

    protected static string|UnitEnum|null $navigationGroup = 'Akademik';

    protected static ?int $navigationSort = 8;

    public static function getNavigationLabel(): string
    {
        return 'Penugasan Guru';
    }

    public static function getModelLabel(): string
    {
        return 'Penugasan Guru';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Penugasan Guru';
    }

    public static function form(Schema $schema): Schema
    {
        return TeacherAssignmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeacherAssignmentsTable::configure($table);
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

        return $query->visibleTo($user);
    }

    public static function getPages(): array
    {
        return ['index' => ListTeacherAssignments::route('/'), 'create' => CreateTeacherAssignment::route('/create'), 'edit' => EditTeacherAssignment::route('/{record}/edit')];
    }
}
