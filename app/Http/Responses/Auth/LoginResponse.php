<?php

namespace App\Http\Responses\Auth;

use DateTime;

final class LoginResponse {
    public function __construct(
        public readonly string $accessToken,
        public readonly DateTime $expiresAt
    ) { }
}