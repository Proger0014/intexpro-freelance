<?php

namespace App\Http\Auth\Gates;

use App\Abstractions\RoleService;
use App\Abstractions\UserService;
use App\Exceptions\ErrorException;

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
    }
}
