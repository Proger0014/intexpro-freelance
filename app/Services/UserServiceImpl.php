<?php

namespace App\Services;

use App\Models\User;
use App\Utils\Result;
use App\Dto\User\UserDto;
use App\Utils\ResultError;
use App\Abstractions\UserService;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserResource;
use App\Constants\Errors\UsersErrorConstants;
use App\Constants\Errors\CommonErrorConstants;
use App\Http\Resources\User\UserRolesResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\User\UserCollectionResource;

class UserServiceImpl implements UserService {
    public function addNewUser(UserDto $newUser, string $password): Result {
        $existsUserResult = $this->getByLogin($newUser->login);

        if ($existsUserResult->isSuccess()) {
            return Result::fromError(new ResultError(
                type: CommonErrorConstants::TYPE_EXISTS,
                title: UsersErrorConstants::TITLE_EXISTS,
                status: Response::HTTP_BAD_REQUEST,
                detail: UsersErrorConstants::DETAIL_EXISTS
            ));
        }

        $id = User::create([
            'first_name' => $newUser->firstName,
            'last_name' => $newUser->lastName,
            'surname' => $newUser->surname,
            'login' => $newUser->login,
            'password_hash' => Hash::make($password),
            'date_of_birth' => $newUser->dateOfBirth,
            'rating' => 0.0
        ])->id;

        return Result::fromOk($id);
    }

    public function getById(int $id): Result {
        $user = User::whereId($id)->first();

        if (! $user) {
            return Result::fromError(new ResultError(
                type: CommonErrorConstants::TYPE_NOT_FOUND,
                title: UsersErrorConstants::TITLE_NOT_FOUND_BY_ID,
                status: Response::HTTP_NOT_FOUND,
                detail: CommonErrorConstants::DETAIL_NOT_FOUND
            ));
        }

        return Result::fromOk(new UserResource($user));
    }

    public function getAll(): Result {
        return Result::fromOk(new UserCollectionResource(User::all()));
    }

    function getAllInPage(int $page): Result {
        return Result::fromOk(
            new UserCollectionResource(User::paginate(15, [], 'page', $page)));
    }

    public function getRolesOfUser(int $userId): Result {
        $existsUserResult = $this->getById($userId);

        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }

        return Result::fromOk(
            new UserRolesResource(User::whereId($userId)->first()));
    }

    public function deleteByUserId(int $userId): Result {
        $existsUserResult = $this->getById($userId);

        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }

        User::whereId($userId)->first()->delete();

        return Result::fromOk(true);
    }

    /**
     * TODO: проверка, если логин уже существует, то на такой же логин поменять нельзя
     * TODO: Подумать над rating
     */
    public function updateUser(UserDto $updatedUser): Result {
        $existsUserResult = $this->getById($updatedUser->id);

        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }

        $existsUser = $existsUserResult->getData()->toDto();

        User::whereId($updatedUser->id)->update([
            'first_name' => $updatedUser->firstName ?? $existsUser->firstName,
            'last_name' => $updatedUser->lastName ?? $existsUser->lastName,
            'surname' => $updatedUser->surname ?? $existsUser->surname,
            'login' => $updatedUser->login ?? $existsUser->login,
            'date_of_birth' => $updatedUser->dateOfBirth ?? $existsUser->dateOfBirth,
            'rating' => $updatedUser->rating ?? $existsUser->rating
        ]);

        return Result::fromOk(true);
    }

    public function getByLogin(string $login): Result {
        $existsUser = User::whereLogin($login)->first();

        if (! $existsUser) {
            return Result::fromError(new ResultError(
                type: CommonErrorConstants::TYPE_NOT_FOUND,
                title: UsersErrorConstants::TITLE_NOT_FOUND_BY_LOGIN,
                status: Response::HTTP_NOT_FOUND,
                detail: UsersErrorConstants::DETAIL_NOT_FOUND_BY_LOGIN
            ));
        }

        return Result::fromOk(new UserResource($existsUser));
    }

    public function updatePasswordForUser(int $userId, string $newPassword): Result {
        $existsUserResult = $this->getById($userId);

        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }

        User::whereLogin($userId)->first()->update([
            'password_hash' => Hash::make($newPassword)
        ]);

        return Result::fromOk(true);
    }
}
