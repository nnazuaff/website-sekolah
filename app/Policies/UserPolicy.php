<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, User $record): bool
    {
        return $user->isSuperAdmin() && ! $user->is($record);
    }

    public function deleteAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }
}
