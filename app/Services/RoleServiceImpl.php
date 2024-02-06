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
use App\Constants\Errors\AuthErrorConstants;
use App\Constants\Errors\RolesErrorConstants;
use App\Constants\Errors\CommonErrorConstants;
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
                type: CommonErrorConstants::TYPE_NOT_FOUND,
                title: RolesErrorConstants::TITLE_EXISTS,
                status: Response::HTTP_NOT_FOUND,
                detail: CommonErrorConstants::DETAIL_NOT_FOUND
            ));
        }

        return Result::fromOk(
            new RoleResource($existsRole)
        );
    }

    public function attachUserToRoles(int $userId, array $rolesId): Result
    {
        $existsUserResult = $this->userService->getById($userId);

        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }

        foreach ($rolesId as $roleId) {
            $existsRoleResult = $this->getById($roleId);

            if ($existsRoleResult->isError()) {
                return Result::fromError($existsRoleResult->getError());
            }
        }

        foreach ($rolesId as $roleId) {
            $existsRoleResult = $this->getById($roleId);

            $existsRole = Role::whereId($roleId)->first();

            if (!Gate::allows('attachUserToRole', $existsRole)) {
                return Result::fromError(new ResultError(
                    type: AuthErrorConstants::TYPE_FORBIDDEN,
                    title: AuthErrorConstants::TITLE_FORBIDDEN,
                    status: Response::HTTP_FORBIDDEN,
                    detail: AuthErrorConstants::DETAIL_FORBIDDEN
                ));
            }

            User::whereId($userId)->first()->assignRole($existsRole->name);
        }

        return Result::fromOk(true);
    }
}
