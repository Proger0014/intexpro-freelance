<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest): JsonResponse {
        return response()->json();
    }
}
