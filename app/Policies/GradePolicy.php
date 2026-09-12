<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Grade;
use App\Models\User;

class GradePolicy extends AcademicTransactionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role !== null;
    }

    public function view(User $user, Grade $record): bool
    {
        return $this->canViewAssignment($user, $record->teacherAssignment);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Guru], true);
    }

    public function update(User $user, Grade $record): bool
    {
        return $record->published_at === null && $this->canTeachAssignment($user, $record->teacherAssignment) || $user->role === UserRole::SuperAdmin;
    }

    public function delete(User $user, Grade $record): bool
    {
        return $record->published_at === null && $this->canTeachAssignment($user, $record->teacherAssignment) || $user->role === UserRole::SuperAdmin;
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === UserRole::SuperAdmin;
    }

    public function publish(User $user, Grade $record): bool
    {
        return $record->published_at === null && $this->canTeachAssignment($user, $record->teacherAssignment);
    }

    public function reopen(User $user): bool
    {
        return $user->role === UserRole::SuperAdmin;
    }
}
