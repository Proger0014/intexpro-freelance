<?php

namespace Swagger\Controllers;

use OpenApi\Attributes as OA;
use Swagger\Schemas\Auth\LoginRequest;
use Swagger\Schemas\Error\ErrorResponse;
use Swagger\Schemas\Error\ValidationErrorResponse;
use Symfony\Component\HttpFoundation\Response;

const AUTH = API . '/auth';

interface AuthController {
    #[OA\Post(
        path: AUTH .'/login',
        operationId: 'login',
        description: 'Устанавливает сессионную куку',
        summary: 'Вход в систему',
        tags: ['Auth']
    )]
    #[OA\Response(response: Response::HTTP_NO_CONTENT, description: 'No Content')]
    #[OA\Response(
        response: Response::HTTP_BAD_REQUEST,
        description: 'Ошибка',
        content: new OA\JsonContent(
            oneOf: [
                new OA\Schema(ref: ErrorResponse::class),
                new OA\Schema(ref: ValidationErrorResponse::class, description: 'Ошибка валидации')
            ]
        )
    )]
    function login(
        #[OA\RequestBody(
            content: new OA\JsonContent(ref: LoginRequest::class)
        )] $loginRequest);
}
