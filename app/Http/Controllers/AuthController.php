<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\Error\ErrorResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest): JsonResponse {
        if (!Auth::attempt($loginRequest->only(['login', 'password']))) {
            return response()->json(new ErrorResponse(
                type: '/errors/invalid-login-or-password',
                title: 'Неверный логин или пароль',
                status: Response::HTTP_BAD_REQUEST,
                detail: 'Попробуйте изменить параметры'
            ));
        }
        
        $loginRequest->session()->regenerate();

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }

    public function logout(Request $request): JsonResponse {
        Auth::guard('web')->logout();

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }

    public function test(Request $request): JsonResponse {
        if (Gate::allows('customer')) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'forbidden']);
    }
}
