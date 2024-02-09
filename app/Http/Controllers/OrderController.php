<?php

namespace App\Http\Controllers;

use App\Abstractions\OrderService;
use App\Http\Requests\Order\GetAllInPageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct(
        public OrderService $orderService
    ) { }

    public function getAllInPage(GetAllInPageRequest $request): JsonResponse {
        $pageResult = $this->orderService->getAllInPage($request->input('page'));

        return response()->json($pageResult->getData(), JsonResponse::HTTP_OK);
    }

    public function getById(int $id): JsonResponse {
        $orderResult = $this->orderService->getById($id);

        if ($orderResult->isError()) {
            $error = $orderResult->getError();

            return response()->json($error, $error->status);
        }

        return response()->json($orderResult->getData(), Response::HTTP_OK);
    }
}
