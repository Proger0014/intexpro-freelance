<?php

namespace App\Abstractions;

use App\Utils\Result;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderPageCollectionResource;

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
     * @return Result<OrderPageCollectionResource|null>
     */
    function getAllInPage(int $page): Result;
}
