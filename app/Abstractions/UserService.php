<?php

namespace App\Abstractions;

use App\Http\Resources\User\UserRolesResource;
use App\Utils\Result;
use App\Dto\User\UserDto;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollectionResource;

interface UserService {

    /**
     * @param UserDto $newUser
     * @param string $password
     *
     * @return Result<bool>
     */
    function addNewUser(UserDto $newUser, string $password): Result;

    /**
     * @param int $id
     *
     * @return Result<UserResource>
     */
    function getById(int $id): Result;

    /**
     * @return Result<UserCollectionResource>
     */
    function getAll(): Result;

    /**
     * @param int $page
     *
     * @return Result<UserCollectionResource>
     */
    function getAllInPage(int $page): Result;

    /**
     * @param int $userId
     *
     * @return Result<UserRolesResource>
     */
    function getRolesOfUser(int $userId): Result;

    /**
     * @param int $userId
     *
     * @return Result<bool>
     */
    function deleteByUserId(int $userId): Result;

    /**
     * @param UserDto $updatedUser
     *
     * @return Result<bool>
     */
    function updateUser(UserDto $updatedUser): Result;

    /**
     * @param string $login
     *
     * @return Result<UserResource>
     */
    function getByLogin(string $login): Result;

    /**
     * @param int $userId
     * @param string $newPassword
     *
     * @return Result<bool>
     */
    function updatePasswordForUser(int $userId, string $newPassword): Result;
}
