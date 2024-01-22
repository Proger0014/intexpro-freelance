<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\Auth\HasLoginResponse;
use Illuminate\Http\JsonResponse;

#[OA\Info(
    version: '0.0.1',
    description: 'Отвечает за авторизацию',
    title: 'Auth'
)]
class AuthController extends Controller
{
    use HasLoginResponse;

    #[OA\Post(
        path: '/api/auth/login',
        operationId: 'login',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Войти в систему или получить токены')
        ]
    )]
    public function login(LoginRequest $loginRequest): JsonResponse {
        return response()->json();
    }
}
