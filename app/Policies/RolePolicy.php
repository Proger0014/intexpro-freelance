<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function attachUserToRole(User $user, Role $role): bool {
        if (!Gate::allows('role.assign-to-user.' . $role->name)) {
            return false;
        }

        return true;
    }
}
