<?php

namespace App\Abstractions;

use App\Utils\Result;
use App\Dto\User\UserDto;

interface UserService {

    /**
     * @param UserDto $newUser
     * @param string $password
     * 
     * @return Result
     */
    function addNewUser(UserDto $newUser, string $password): Result;

    function getById(int $id): Result;

    function getAll(): Result;

    function getAllInPage(int $page): Result;

    function getRolesOfUser(int $userId): Result;

    function deleteByUserId(int $userId): Result;

    /**
     * @param UserDto $updatedUser
     * 
     * @return Result
     */
    function updateUser(UserDto $updatedUser): Result;

    function getByLogin(string $login): Result;

    function updatePasswordForUser(int $userId, string $newPassword): Result;
}
