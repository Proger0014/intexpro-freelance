<?php

namespace Tests\Utils;

use App\Models\Role;

class RoleUtils
{
    public static function getRoleIdWithName(string $roleName): int {
        return Role::whereName($roleName)->first()->id;
    }
}
