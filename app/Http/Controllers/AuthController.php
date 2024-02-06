<?php

namespace App\Http\Controllers;

use DateTimeImmutable;
use App\Dto\User\UserDto;
use App\Abstractions\RoleService;
use App\Abstractions\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\Auth\LoginResponse;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\Error\ErrorResponse;
use App\Constants\Errors\AuthErrorConstants;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly RoleService $roleService
    ) { }

    public function login(LoginRequest $loginRequest): JsonResponse {
        if (!Auth::attempt($loginRequest->only(['login', 'password']))) {
            return response()->json(new ErrorResponse(
                type:  AuthErrorConstants::TYPE_INVALID_LOGIN_OR_PASSWORD,
                title: AuthErrorConstants::TITLE_INVALID_LOGIN_OR_PASSWORD,
                status: Response::HTTP_BAD_REQUEST,
                detail: AuthErrorConstants::DETAIL_INVALID_LOGIN_OR_PASSWORD
            ), Response::HTTP_BAD_REQUEST);
        }

        $loginRequest->session()->regenerate();

        $response = new LoginResponse(
            authenticatedUserId: Auth::user()->id
        );

        return response()->json($response, Response::HTTP_OK);
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
