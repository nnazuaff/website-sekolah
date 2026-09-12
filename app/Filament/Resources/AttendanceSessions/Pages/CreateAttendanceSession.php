<?php

namespace App\Filament\Resources\AttendanceSessions\Pages;

use App\Filament\Resources\AttendanceSessions\AttendanceSessionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAttendanceSession extends CreateRecord
{
    protected static string $resource = AttendanceSessionResource::class;

    protected function afterCreate(): void
    {
        foreach ($this->data['attendance_entries'] ?? [] as $attendance) {
            $this->record->attendances()->updateOrCreate(
                ['student_id' => $attendance['student_id']],
                [
                    'status' => $attendance['status'],
                    'note' => $attendance['note'] ?? null,
                ],
            );
        }
    }
}
