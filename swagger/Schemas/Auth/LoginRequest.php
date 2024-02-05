<?php

namespace Swagger\Schemas\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ['login', 'password']
)]
class LoginRequest
{
    #[OA\Property]
    public string $login;

    #[OA\Property]
    public string $password;
}
