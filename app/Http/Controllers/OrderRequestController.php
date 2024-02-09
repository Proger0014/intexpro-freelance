<?php

namespace App\Http\Controllers;

use App\Abstractions\OrderRequestService;
use App\Http\Responses\Order\OrderRequestExistsResponse;
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

    public function requestExists(int $orderId): JsonResponse {
        $requestExistsResult = $this->orderRequestService->getByOrderIdInUser($orderId, Auth::user()->id);

        $response = null;

        if ($requestExistsResult->isSuccess()) {
            $response = new OrderRequestExistsResponse(true);
        } else {
            $response = new OrderRequestExistsResponse(false);
        }

        return response()->json($response);
    }

    public function getRequestByOrderId(int $orderId): JsonResponse {
        $requestResult = $this->orderRequestService->getByOrderIdInUser($orderId, Auth::user()->id);

        if ($requestResult->isError()) {
            $error = $requestResult->getError();
            
            return response()->json($error, $error->status);
        }

        return response()->json($requestResult->getData());
    }
}
