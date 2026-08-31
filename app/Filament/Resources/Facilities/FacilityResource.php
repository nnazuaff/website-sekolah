<?php

namespace App\Filament\Resources\Facilities;

use App\Filament\Resources\Facilities\Pages\CreateFacility;
use App\Filament\Resources\Facilities\Pages\EditFacility;
use App\Filament\Resources\Facilities\Pages\ListFacilities;
use App\Filament\Resources\Facilities\Schemas\FacilityForm;
use App\Filament\Resources\Facilities\Tables\FacilitiesTable;
use App\Models\Facility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|UnitEnum|null $navigationGroup = 'Sarana & Media';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return 'Fasilitas';
    }

    public static function getModelLabel(): string
    {
        return 'Fasilitas';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Fasilitas';
    }

    public static function form(Schema $schema): Schema
    {
        return FacilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FacilitiesTable::configure($table);
    }

    public static function getPages(): array
    {
        return ['index' => ListFacilities::route('/'), 'create' => CreateFacility::route('/create'), 'edit' => EditFacility::route('/{record}/edit')];
    }
}
