<?php

namespace App\Filament\Resources\AttendanceSessions\Pages;

use App\Filament\Resources\AttendanceSessions\AttendanceSessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAttendanceSession extends EditRecord
{
    protected static string $resource = AttendanceSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
