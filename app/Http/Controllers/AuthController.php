<?php

namespace App\Http\Controllers;

use App\Abstractions\UserService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\Error\ErrorResponse;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Dto\User\UserDto;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) { }

    public function login(LoginRequest $loginRequest): JsonResponse {
        if (!Auth::attempt($loginRequest->only(['login', 'password']))) {
            return response()->json(new ErrorResponse(
                type: '/errors/invalid-login-or-password',
                title: 'Неверный логин или пароль',
                status: Response::HTTP_BAD_REQUEST,
                detail: 'Попробуйте изменить параметры'
            ));
        }
        
        $loginRequest->session()->regenerate();

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }

    public function logout(Request $request): JsonResponse {
        Auth::guard('web')->logout();

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }

    public function register(RegisterRequest $registerRequest): JsonResponse {
        $result = $this->userService->addNewUser(new UserDto(
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

        if ($result->isError()) {
            $error = $result->getError();
            return response()->json($error, $error->status);
        }

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }
}
