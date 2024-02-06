<?php

namespace App\Services;

use App\Abstractions\OrderCategoryService;
use App\Constants\Errors\CommonErrorConstants;
use App\Http\Resources\Order\OrderCategoryCollectionResource;
use App\Http\Resources\Order\OrderCategoryResource;
use App\Models\OrdersCategory;
use App\Utils\Result;
use App\Utils\ResultError;
use Symfony\Component\HttpFoundation\Response;

class OrderCategoryServiceImpl implements OrderCategoryService
{
    function getById(int $id): Result
    {
        $existsCategory = OrdersCategory::whereId($id)->first();

        if (! $existsCategory) {
            return Result::fromError(new ResultError(
                type: CommonErrorConstants::TYPE_NOT_FOUND,
                title: CommonErrorConstants::TITLE_NOT_FOUND,
                status: Response::HTTP_NOT_FOUND,
                detail: CommonErrorConstants::DETAIL_NOT_FOUND
            ));
        }

        return Result::fromOk(new OrderCategoryResource($existsCategory));
    }

    function getAll(): Result
    {
        return Result::fromOk(new OrderCategoryCollectionResource(OrdersCategory::all()));
    }
}
