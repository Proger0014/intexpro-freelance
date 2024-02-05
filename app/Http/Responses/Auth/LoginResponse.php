<?php

namespace App\Http\Responses\Auth;

final class LoginResponse {
    public function __construct(
        public readonly int $authenticatedUserId,
    ) { }
}