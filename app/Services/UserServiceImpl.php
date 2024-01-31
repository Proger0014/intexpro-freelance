<?php

namespace App\Services;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Abstractions\UserService;
use App\Dto\User\UserDto;
use App\Http\Resources\User\UserCollectionResource;
use App\Http\Resources\User\UserRolesResource;
use App\Utils\Result;
use App\Utils\ResultError;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserServiceImpl implements UserService {
    public function addNewUser(UserDto $newUser, string $password): Result {
        $existsUserResult = $this->getByLogin($newUser->login);

        if ($existsUserResult->isSuccess()) {
            return Result::fromError(new ResultError(
                type: '/errors/exists',
                title: 'Юзер с таким логином уже существует',
                status: Response::HTTP_BAD_REQUEST,
                detail: 'Попробуйте изменить логин или войти в существующий аккаунт'
            ));
        }

        User::create([
            'first_name' => $newUser->firstName,
            'last_name' => $newUser->lastName,
            'surname' => $newUser->surname,
            'login' => $newUser->login,
            'password_hash' => Hash::make($password),
            'date_of_birth' => $newUser->dateOfBirth,
            'rating' => 0.0
        ]);

        return Result::fromOk(true);
    }

    public function getById(int $id): Result {
        $user = User::whereId($id)->first();

        if (! $user) {
            return Result::fromError(new ResultError(
                type: '/errors/not-found',
                title: 'Юзер с таким id не найден',
                status: Response::HTTP_NOT_FOUND,
                detail: 'Попробуйте использовать верные параметры'
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
                type: '/errors/not-found',
                title: 'Юзера с таким логином не существует',
                status: Response::HTTP_NOT_FOUND,
                detail: 'Попробуйте указать верные параметры или создать нового юзера'
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
