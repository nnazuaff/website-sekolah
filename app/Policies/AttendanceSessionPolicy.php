<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\AttendanceSession;
use App\Models\User;

class AttendanceSessionPolicy extends AcademicTransactionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role !== null;
    }

    public function view(User $user, AttendanceSession $record): bool
    {
        return $this->canViewAssignment($user, $record->teacherAssignment);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Guru], true);
    }

    public function update(User $user, AttendanceSession $record): bool
    {
        return $this->canTeachAssignment($user, $record->teacherAssignment);
    }

    public function delete(User $user, AttendanceSession $record): bool
    {
        return $this->canTeachAssignment($user, $record->teacherAssignment);
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === UserRole::SuperAdmin;
    }
}
