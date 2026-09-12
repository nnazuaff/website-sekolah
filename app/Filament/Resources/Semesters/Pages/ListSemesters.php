<?php

namespace App\Filament\Resources\Semesters\Pages;

use App\Filament\Resources\Semesters\SemesterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSemesters extends ListRecords
{
    protected static string $resource = SemesterResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->label('Tambah Semester')];
    }
}
