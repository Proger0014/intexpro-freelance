<?php

namespace App\Services;

use App\Abstractions\OrderRequestService;
use App\Abstractions\OrderService;
use App\Abstractions\UserService;
use App\Constants\Errors\CommonErrorConstants;
use App\Http\Resources\Order\OrderRequestCollectionResource;
use App\Models\OrdersRequest;
use App\Models\User;
use App\Utils\Result;
use App\Utils\ResultError;
use Symfony\Component\HttpFoundation\Response;

class OrderRequestServiceImpl implements OrderRequestService
{
    public function __construct(
        private readonly UserService $userService,
        private readonly OrderService $orderService
    ) { }

    function request(int $userId, int $orderId): Result
    {
        $existsUserResult = $this->userService->getById($userId);

        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }

        $existsOrderResult = $this->orderService->getById($orderId);

        if ($existsOrderResult->isError()) {
            return Result::fromError($existsOrderResult->getError());
        }

        $existsRequest = OrdersRequest::whereUserId($userId)
            ->where('order_id', $orderId)
            ->first();

        if ($existsRequest) {
            return Result::fromError(new ResultError(
                // из UsersErrors перенести в Common
                type: CommonErrorConstants::TYPE . '/exists',
                title: 'Запрос уже существует и ожидает ответа',
                status: Response::HTTP_BAD_REQUEST,
                detail: 'Вы уже делали запрос, дождитесь ответа'
            ));
        }

        OrdersRequest::create([
            'order_id' => $orderId,
            'user_id' => $userId
        ]);

        return Result::fromOk(true);
    }

    function getAllOfUser(int $userId): Result
    {
        $existsUserResult = $this->userService->getById($userId);

        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }

        return Result::fromOk(
            new OrderRequestCollectionResource(OrdersRequest::whereUserId($userId)->get()));
    }

    function getAllInPageOfOwner(int $page, int $ownerId): Result
    {
        $existsUserResult = $this->userService->getById($ownerId);

        if ($existsUserResult->isError()) {
            return Result::fromError($existsUserResult->getError());
        }

        return Result::fromOk(
            new OrderRequestCollectionResource(User::whereId($ownerId)->requestsThrough()
                ->paginate(15, [], 'page', $page)));
    }

    function getAllInPageOfOwnerFromUser(int $page, int $ownerId, int $fromUserId): Result
    {
        $existsOwnerResult = $this->userService->getById($ownerId);

        if ($existsOwnerResult->isError()) {
            return Result::fromError($existsOwnerResult->getError());
        }

        $existsFromUserResult = $this->userService->getById($fromUserId);

        if ($existsFromUserResult->isError()) {
            return Result::fromError($existsFromUserResult->getError());
        }

        return Result::fromOk(
            new OrderRequestCollectionResource(User::whereId($ownerId)->requestsThrough()
                ->where('user_id', $fromUserId)
                ->paginate(15, [], 'page', $page)));
    }

    function updateStatusRequest(int $requestId, int $status): Result
    {
        $existsOrderResult = $this->getById($requestId);

        if ($existsOrderResult->isError()) {
            return Result::fromError($existsOrderResult->getError());
        }

        OrdersRequest::whereId($requestId)->update([
            'status' => $status
        ]);

        return Result::fromOk(true);
    }

    function getById($orderRequestId): Result
    {
        $existsOrderRequest = OrdersRequest::whereId($orderRequestId)->first();

        if (! $existsOrderRequest) {
            return Result::fromError(new ResultError(
                type: CommonErrorConstants::TYPE_NOT_FOUND,
                title: CommonErrorConstants::TITLE_NOT_FOUND,
                status: Response::HTTP_NOT_FOUND,
                detail: CommonErrorConstants::DETAIL_NOT_FOUND
            ));
        }

        return Result::fromOk($existsOrderRequest);
    }
}
