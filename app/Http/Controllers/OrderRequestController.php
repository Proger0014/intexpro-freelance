<?php

namespace App\Http\Controllers;

use App\Abstractions\OrderRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OrderRequestController extends Controller
{
    public function __construct(
        private readonly OrderRequestService $orderRequestService
    ) { }

    public function orderRequest(int $orderId): JsonResponse {
        $requestResult = $this->orderRequestService->request(Auth::user()->id, $orderId);

        if ($requestResult->isError()) {
            $error = $requestResult->getError();

            return response()->json($error, $error->status);
        }

        return response()->json(data: null, status: Response::HTTP_NO_CONTENT);
    }
}
