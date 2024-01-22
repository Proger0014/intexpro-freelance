<?php

namespace App\Abstractions;

use App\Utils\Result;
use DateTime;

interface UserService {
    /**
     * @param array{
     *  first_name: string,
     *  last_name: string,
     *  surname: string,
     *  login: string,
     *  date_of_birth: DateTime,
     *  rating: float
     * } $newUser
     *
     * @param string $password
     *
     *
     * @return Result
     */
    function addNewUser(array $newUser, string $password): Result;

    function getById(int $id): Result;

    function getAll(): Result;

    function getAllInPage(int $page): Result;

    function getRolesOfUser(int $userId): Result;

    function deleteByUserId(int $userId): Result;

    /**
     * @param array{
     *  id: int,
     *  first_name: string|null,
     *  last_name: string|null,
     *  surname: string|null,
     *  login: string|null,
     *  date_of_birth: DateTime|null,
     *  rating: float|null
     * } $updatedUser
     *
     * @return Result
     */
    function updateUser(array $updatedUser): Result;

    function getByLogin(string $login): Result;

    function updatePasswordForUser(int $userId, string $newPassword): Result;
}
