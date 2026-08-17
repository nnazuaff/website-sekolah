<?php

namespace App\Filament\Resources\Majors\Pages;

use App\Filament\Resources\Majors\MajorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMajors extends ListRecords
{
    protected static string $resource = MajorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
