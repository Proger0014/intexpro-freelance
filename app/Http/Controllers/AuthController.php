<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\Auth\HasLoginResponse;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use HasLoginResponse;

    public function login(LoginRequest $loginRequest): JsonResponse {
        return response()->json();
    }
}
