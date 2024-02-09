<?php

namespace App\Abstractions;

use App\Http\Resources\Order\OrderRequestCollectionResource;
use App\Http\Resources\Order\OrderRequestResource;
use App\Utils\Result;

interface OrderRequestService
{
    /**
     * @param $orderRequestId
     *
     * @return Result<OrderRequestResource|null>
     */
    function getById(int $orderRequestId): Result;

    /***
     * @param int $orderId
     * @param int $userId
     *
     * @return Result<OrderRequestResource|null>
     */
    function getByOrderIdInUser(int $orderId, int $userId): Result;

    /**
     * @param int $userId
     * @param int $orderId
     *
     * @return Result<bool|null>
     */
    function request(int $userId, int $orderId): Result;

    /**
     * @param int $userId
     *
     * @return Result<OrderRequestCollectionResource|null>
     */
    function getAllOfUser(int $userId): Result;

    /**
     * @param int $page
     * @param int $ownerId
     *
     * @return Result<OrderRequestCollectionResource|null>
     */
    function getAllInPageOfOwner(int $page, int $ownerId): Result;

    /**
     * @param int $page
     * @param int $ownerId
     * @param int $fromUserId
     *
     * @return Result<OrderRequestCollectionResource|null>
     */
    function getAllInPageOfOwnerFromUser(int $page, int $ownerId, int $fromUserId): Result;

    /**
     * @param int $requestId
     * @param int $status
     *
     * @return Result<bool>
     */
    function updateStatusRequest(int $requestId, int $status): Result;
}
