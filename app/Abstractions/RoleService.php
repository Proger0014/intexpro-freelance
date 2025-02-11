<?php

namespace App\Abstractions;

use App\Dto\Role\RoleDto;
use App\Http\Resources\Role\RoleCollectionResource;
use App\Http\Resources\Role\RoleResource;
use App\Utils\Result;

interface RoleService
{
    /**
     * @param RoleDto $newRole
     *
     * @return Result<bool|null>
     */
    function add(RoleDto $newRole): Result;

    /**
     * @return Result<RoleCollectionResource|null>
     */
    function getAll(): Result;

    /**
     * @param int $page
     *
     * @return Result<RoleCollectionResource|null>
     */
    function getAllInPage(int $page): Result;

    /**
     * @param int $roleId
     *
     * @return Result<RoleResource|null>
     */
    function getById(int $roleId): Result;

    /**
     * @param int $userId
     * @param array<int> $rolesId
     *
     * @return Result<bool|null>
     */
    function attachUserToRoles(int $userId, array $rolesId): Result;
}
