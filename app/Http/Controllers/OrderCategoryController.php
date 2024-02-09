<?php

namespace App\Http\Controllers;

use App\Abstractions\OrderCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderCategoryController extends Controller
{
    public function __construct(
        private readonly OrderCategoryService $orderCategoryService
    ) { }

    public function getById(int $id): JsonResponse {
        $categoryResult = $this->orderCategoryService->getById($id);

        if ($categoryResult->isError()) {
            $error = $categoryResult->getError();

            return response()->json($error, $error->status);
        }

        return response()->json($categoryResult->getData());
    }
}
