<?php

namespace App\Filament\Resources\Majors\Pages;

use App\Filament\Resources\Majors\MajorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMajor extends EditRecord
{
    protected static string $resource = MajorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
