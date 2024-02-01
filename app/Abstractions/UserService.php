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
     * @return Result<int|null> int - id created user
     */
    function addNewUser(UserDto $newUser, string $password): Result;

    /**
     * @param int $id
     *
     * @return Result<UserResource|null>
     */
    function getById(int $id): Result;

    /**
     * @return Result<UserCollectionResource|null>
     */
    function getAll(): Result;

    /**
     * @param int $page
     *
     * @return Result<UserCollectionResource|null>
     */
    function getAllInPage(int $page): Result;

    /**
     * @param int $userId
     *
     * @return Result<UserRolesResource|null>
     */
    function getRolesOfUser(int $userId): Result;

    /**
     * @param int $userId
     *
     * @return Result<bool|null>
     */
    function deleteByUserId(int $userId): Result;

    /**
     * @param UserDto $updatedUser
     *
     * @return Result<bool|null>
     */
    function updateUser(UserDto $updatedUser): Result;

    /**
     * @param string $login
     *
     * @return Result<UserResource|null>
     */
    function getByLogin(string $login): Result;

    /**
     * @param int $userId
     * @param string $newPassword
     *
     * @return Result<bool|null>
     */
    function updatePasswordForUser(int $userId, string $newPassword): Result;
}
