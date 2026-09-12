<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\TeacherAssignment;
use App\Models\User;

abstract class AcademicTransactionPolicy
{
    protected function isManager(User $user): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::OperatorTu], true);
    }

    protected function canViewAssignment(User $user, TeacherAssignment $assignment): bool
    {
        if ($this->isManager($user)) {
            return true;
        }
        if ($user->role === UserRole::Guru) {
            return $assignment->teacher_id === $user->teacher_id;
        }

        return $user->role === UserRole::WaliKelas && $assignment->classroom->homeroom_teacher_id === $user->teacher_id;
    }

    protected function canTeachAssignment(User $user, TeacherAssignment $assignment): bool
    {
        return $user->role === UserRole::SuperAdmin || ($user->role === UserRole::Guru && $assignment->teacher_id === $user->teacher_id);
    }
}
