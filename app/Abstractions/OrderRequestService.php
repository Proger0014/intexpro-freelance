<?php

namespace App\Abstractions;

use App\Http\Resources\Order\OrderRequestCollectionResource;
use App\Utils\Result;

interface OrderRequestService
{
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
