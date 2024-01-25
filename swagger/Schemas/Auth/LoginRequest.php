<?php

namespace Swagger\Schemas\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ['login', 'password']
)]
class LoginRequest
{
    #[OA\Property(
        type: 'string',
    )]
    public $login;

    #[OA\Property(
        type: 'string'
    )]
    public $password;
}
