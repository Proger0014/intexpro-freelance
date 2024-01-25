<?php

namespace Swagger\Controllers;

use OpenApi\Attributes as OA;
use Swagger\Schemas\Auth\LoginRequest;
use Swagger\Schemas\Error\ErrorResponse;
use Swagger\Schemas\Error\ValidationErrorResponse;
use Symfony\Component\HttpFoundation\Response;

CONST AUTH_TAG = 'Auth';
const AUTH = API . '/auth';

interface AuthController {
    #[OA\Post(
        path: AUTH .'/login',
        operationId: 'login',
        description: 'Устанавливает сессионную куку или обновляет сессию',
        summary: 'Вход в систему',
        tags: [AUTH_TAG]
    )]
    #[OA\Response(response: Response::HTTP_NO_CONTENT, description: 'Успешно')]
    #[OA\Response(
        response: Response::HTTP_BAD_REQUEST,
        description: 'Ошибка',
        content: new OA\JsonContent(
            oneOf: [
                new OA\Schema(ref: ErrorResponse::class),
                new OA\Schema(ref: ValidationErrorResponse::class)
            ]
        )
    )]
    function login(
        #[OA\RequestBody(
            content: new OA\JsonContent(ref: LoginRequest::class)
        )] $loginRequest);

    #[OA\Post(
        path: AUTH . '/logout',
        operationId: 'logout',
        summary: 'Выйти из системы',
        tags: [AUTH_TAG]
    )]
    #[OA\Response(response: Response::HTTP_NO_CONTENT, description: 'Успешно')]
    #[OA\Response(
        response: Response::HTTP_UNAUTHORIZED,
        description: 'Неавторизованный пользователь',
        content: new OA\JsonContent(ref: ErrorResponse::class)
    )]
    function logout();
}
