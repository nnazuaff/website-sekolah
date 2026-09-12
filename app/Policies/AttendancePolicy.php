<?php

namespace App\Policies;

use App\Models\Attendance;
use App\Models\User;

class AttendancePolicy extends AcademicTransactionPolicy
{
    public function view(User $user, Attendance $record): bool
    {
        return $this->canViewAssignment($user, $record->attendanceSession->teacherAssignment);
    }

    public function update(User $user, Attendance $record): bool
    {
        return $this->canTeachAssignment($user, $record->attendanceSession->teacherAssignment);
    }
}
