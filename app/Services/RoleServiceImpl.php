<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Utils\Result;
use App\Dto\Role\RoleDto;
use App\Utils\ResultError;
use App\Abstractions\RoleService;
use App\Abstractions\UserService;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Role\RoleResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Role\RoleCollectionResource;

class RoleServiceImpl implements RoleService
{
    public function __construct(
        public readonly UserService $userService
    ) { }

    public function add(RoleDto $newRole): Result
    {
        Role::create([
            'name' => $newRole->name
        ]);

        return Result::fromOk(true);
    }

    public function getAll(): Result
    {
        return Result::fromOk(
            new RoleCollectionResource(Role::all())
        );
    }

    public function getAllInPage(int $page): Result
    {
        return Result::fromOk(
            new RoleCollectionResource(Role::paginate(
                perPage: 15,
                page: $page
            ))
        );
    }

    public function getById(int $roleId): Result
    {
        $existsRole = Role::whereId($roleId)->first();

        if (! $existsRole) {
            return Result::fromError(new ResultError(
                type: '/error/not-found',
                title: 'Роль с таким id не найдена',
                status: Response::HTTP_NOT_FOUND,
                detail: 'Попробуйте изменить параметры'
            ));
        }

        return Result::fromOk(
            new RoleResource($existsRole)
        );
    }

    public function attachUserToRole(int $userId, int $roleId): Result
    {
        $existsUserResult = $this->userService->getById($userId);
        
        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }
        
        $existsRoleResult = $this->getById($roleId);
        
        if ($existsRoleResult->isError()) {
            return Result::fromError($existsRoleResult->getError());
        }
        
        $existsRole = Role::whereId($roleId)->first();

        if (!Gate::allows('attachUserToRole', $existsRole)) {
            return Result::fromError(new ResultError(
                type: '/errors/forbidden',
                title: 'Недостаточно прав',
                status: Response::HTTP_FORBIDDEN,
                detail: 'Попробуйте обратиться к более вышестоящему для данного действия'
            ));
        }

        User::whereId($userId)->first()->assignRole($existsRole->name);

        return Result::fromOk(true);
    }
}
