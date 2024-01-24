<?php

namespace App\Http\Auth\Gates;

use App\Abstractions\UserService;
use Illuminate\Support\Facades\Auth;

final class GatesRegister {
    public function __construct(
        public UserService $userService
    ) { }

    public function defineGatesForRole(): void {
        $authenticatedUserId = Auth::user()->id;

        $rolesResult = $this->userService->getRolesOfUser($authenticatedUserId);
    }
}