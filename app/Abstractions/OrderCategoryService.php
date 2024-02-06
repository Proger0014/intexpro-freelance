<?php

namespace App\Abstractions;

use App\Http\Resources\Order\CategoryCollectionResource;
use App\Http\Resources\Order\CategoryResource;
use App\Utils\Result;

interface OrderCategoryService
{
    /**
     * @param int $id
     *
     * @return Result<CategoryResource|null>
     */
    function getById(int $id): Result;

    /**
     * @return Result<CategoryCollectionResource|null>
     */
    function getAll(): Result;
}
