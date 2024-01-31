<?php

namespace App\Http\Controllers;

use App\Abstractions\RoleService;
use App\Abstractions\UserService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\Error\ErrorResponse;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Dto\User\UserDto;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly RoleService $roleService
    ) { }

    public function login(LoginRequest $loginRequest): JsonResponse {
        if (!Auth::attempt($loginRequest->only(['login', 'password']))) {
            return response()->json(new ErrorResponse(
                type: '/errors/invalid-login-or-password',
                title: 'Неверный логин или пароль',
                status: Response::HTTP_BAD_REQUEST,
                detail: 'Попробуйте изменить параметры'
            ), Response::HTTP_BAD_REQUEST);
        }

        $loginRequest->session()->regenerate();

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }

    public function logout(): JsonResponse {
        Auth::logout();

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }

    public function register(RegisterRequest $registerRequest): JsonResponse {
        $registerNewUserResult = $this->userService->addNewUser(new UserDto(
            id: null,
            firstName: 'Не определено',
            lastName: 'Не определено',
            surname: 'Не определено',
            login: $registerRequest->input('login'),
            dateOfBirth: new DateTimeImmutable('2000-01-01'),
            rating: null,
            createdAt: null,
            updatedAt: null
        ), $registerRequest->input('password'));

        if ($registerNewUserResult->isError()) {
            $error = $registerNewUserResult->getError();
            return response()->json($error, $error->status);
        }

        $attachUserToRolesResult = $this->roleService->attachUserToRoles(
            userId: $registerNewUserResult->getData(),
            rolesId: $registerRequest->input('roles')
        );

        if ($attachUserToRolesResult->isError()) {
            $error = $attachUserToRolesResult->getError();
            return response()->json($error, $error->status);
        }

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }
}
