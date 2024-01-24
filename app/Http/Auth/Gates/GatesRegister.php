<?php

namespace App\Http\Auth\Gates;

use App\Abstractions\UserService;

final class GatesRegister {
    public function __construct(
        public UserService $userService
    ) { }

    /**
     * TODO
     */
    public function defineGatesForRole(): void {
    }
}