<?php

namespace Swagger\Controllers;

use OpenApi\Attributes as OA;
use Swagger\Schemas\Auth\LoginRequest;

const AUTH = API . '/auth';

interface AuthController {
    #[OA\Post(
        path: AUTH .'/login',
        operationId: 'login',
        description: 'Устанавливает сессионную куку',
        summary: 'Вход в систему',
        tags: ['Auth']
    )]
    #[OA\Response(response: 204, description: 'No Content')]
    function login(
        #[OA\RequestBody(
            content: new OA\JsonContent(ref: LoginRequest::class)
        )] $loginRequest);
}
