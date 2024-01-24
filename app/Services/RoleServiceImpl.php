<?php

namespace App\Services;

use App\Abstractions\RoleService;
use App\Abstractions\UserService;
use App\Dto\Role\RoleDto;
use App\Http\Resources\Role\RoleCollectionResource;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role;
use App\Utils\Result;
use App\Utils\ResultError;
use Symfony\Component\HttpFoundation\Response;

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

        Role::whereId($roleId)->first()->users()->attach($userId);

        return Result::fromOk(true);
    }
}
