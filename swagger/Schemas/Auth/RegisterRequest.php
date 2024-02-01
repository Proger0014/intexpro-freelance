<?php

namespace Swagger\Schemas\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema]
class RegisterRequest
{
    #[OA\Property]
    public string $login;

    #[OA\Property]
    public string $password;

    /**
     * @var array<int> $roles
     */
    #[OA\Property(
        items: new OA\Items(
            type: 'integer'
        )
    )]
    public array $roles;
}
