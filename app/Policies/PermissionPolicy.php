<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(Role::SUPER_ADMIN);
    }
}
