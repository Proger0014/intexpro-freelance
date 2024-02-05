<?php

namespace Swagger\Schemas\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema]
class LoginResponse {
    #[OA\Property]
    public int $authenticatedUserId;
}