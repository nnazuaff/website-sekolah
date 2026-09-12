<?php

namespace App\Filament\Resources\TeacherAssignments\Pages;

use App\Filament\Resources\TeacherAssignments\TeacherAssignmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTeacherAssignments extends ListRecords
{
    protected static string $resource = TeacherAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->label('Tambah Penugasan Guru')];
    }
}
