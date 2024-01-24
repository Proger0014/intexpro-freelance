<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest): JsonResponse {
        if (!Auth::attempt($loginRequest->only(['login', 'password']))) {
            return response()->json(['status' => 'invalid login and password']);
        }

        $loginRequest->session()->regenerate();

        return response()->json(['status' => 'ok']);
    }

    public function test(Request $request): JsonResponse {
        if (Gate::allows('customer')) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'forbidden']);
    }
}
