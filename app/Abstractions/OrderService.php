<?php

namespace App\Abstractions;

use App\Http\Resources\Order\OrderCollectionResource;
use App\Http\Resources\Order\OrderResource;
use App\Utils\Result;

interface OrderService
{
    /**
     * @param int $id
     *
     * @return Result<OrderResource|null>
     */
    function getById(int $id): Result;

    /**
     * @param int $page
     *
     * @return Result<OrderCollectionResource|null>
     */
    function getAllInPage(int $page): Result;
}
