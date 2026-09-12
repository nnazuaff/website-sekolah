<?php

namespace App\Filament\Resources\AttendanceSessions\Pages;

use App\Filament\Resources\AttendanceSessions\AttendanceSessionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAttendanceSessions extends ListRecords
{
    protected static string $resource = AttendanceSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->label('Tambah Presensi')];
    }
}
