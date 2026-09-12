<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

abstract class StaffManagementPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->canManage($user);
    }

    public function view(User $user): bool
    {
        return $this->canManage($user);
    }

    public function create(User $user): bool
    {
        return $this->canManage($user);
    }

    public function update(User $user): bool
    {
        return $this->canManage($user);
    }

    public function delete(User $user): bool
    {
        return $this->canManage($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->canManage($user);
    }

    public function restore(User $user): bool
    {
        return $this->canManage($user);
    }

    public function forceDelete(User $user): bool
    {
        return false;
    }

    protected function canManage(User $user): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::OperatorTu], true);
    }
}
