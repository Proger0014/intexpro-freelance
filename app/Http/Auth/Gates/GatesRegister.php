<?php

namespace App\Http\Auth\Gates;

use App\Abstractions\RoleService;
use App\Abstractions\UserService;
use App\Exceptions\ErrorException;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class GatesRegister {
    public function __construct(
        public readonly UserService $userService,
        public readonly RoleService $roleService
    ) { }

    /**
     * @throws ErrorException
     */
    public function defineGatesForRole(): void {
        $rolesResult = $this->roleService->getAll();

        if ($rolesResult->isError()) {
            $error = $rolesResult->getError();

            throw new ErrorException(
                type: $error->type,
                title: $error->title,
                status: $error->status,
                detail: $error->detail
            );
        }

        $roles = $rolesResult->getData()->toDtoArray();

        foreach ($roles as $role) {
            Gate::define($role->name, function (User $user) use ($role) {
                 return $user->roles()->wherePivot('role_id', $role->id)->first() != null;
            });
        }
    }
}
