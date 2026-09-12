<?php

namespace App\Policies;

use App\Models\TeacherAssignment;
use App\Models\User;

class TeacherAssignmentPolicy extends AcademicTransactionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role !== null;
    }

    public function view(User $user, TeacherAssignment $record): bool
    {
        return $this->canViewAssignment($user, $record);
    }

    public function create(User $user): bool
    {
        return $this->isManager($user);
    }

    public function update(User $user): bool
    {
        return $this->isManager($user);
    }

    public function delete(User $user): bool
    {
        return $this->isManager($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isManager($user);
    }
}
