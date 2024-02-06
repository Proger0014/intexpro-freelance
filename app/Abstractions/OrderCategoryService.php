<?php

namespace App\Abstractions;

use App\Http\Resources\Order\OrderCategoryCollectionResource;
use App\Http\Resources\Order\OrderCategoryResource;
use App\Utils\Result;

interface OrderCategoryService
{
    /**
     * @param int $id
     *
     * @return Result<OrderCategoryResource|null>
     */
    function getById(int $id): Result;

    /**
     * @return Result<OrderCategoryCollectionResource|null>
     */
    function getAll(): Result;
}
