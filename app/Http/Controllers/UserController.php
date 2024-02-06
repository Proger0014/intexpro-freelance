<?php

namespace App\Http\Controllers;

use App\Abstractions\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {
    public function __construct(
        private readonly UserService $userService
    ) { }

    public function getById(int $id): JsonResponse {
        $userResult = $this->userService->getById($id);

        if ($userResult->isError()) {
            $error = $userResult->getError();
            return response()->json($error, $error->status);
        }

        return response()->json($userResult, Response::HTTP_OK);
    }
}