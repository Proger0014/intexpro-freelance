<?php

namespace Tests\Utils;

use App\Models\Role;
use App\Models\User;

class UserUtils
{
    public static function getUserWithRole(string $roleName): User {
        return Role::where('name', $roleName)->first()->users()->first();
    }
}
