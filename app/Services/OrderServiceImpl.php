<?php

namespace App\Services;

use App\Abstractions\OrderService;
use App\Constants\Errors\CommonErrorConstants;
use App\Http\Resources\Order\OrderCollectionResource;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Utils\Result;
use App\Utils\ResultError;
use Symfony\Component\HttpFoundation\Response;

class OrderServiceImpl implements OrderService
{

    function getById(int $id): Result
    {
        $existsOrder = Order::whereId($id)->first();

        if (! $existsOrder) {
            return Result::fromError(new ResultError(
                type: CommonErrorConstants::TYPE_NOT_FOUND,
                title: CommonErrorConstants::TITLE_NOT_FOUND,
                status: Response::HTTP_NOT_FOUND,
                detail: CommonErrorConstants::DETAIL_NOT_FOUND
            ));
        }

        return Result::fromOk(new OrderResource($existsOrder));
    }

    function getAllInPage(int $page): Result
    {
        return Result::fromOk(
            new OrderCollectionResource(Order::paginate(15, [], 'page', $page)));
    }
}
