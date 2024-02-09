<?php

namespace App\Http\Resources\Order;

use App\Models\OrdersRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @mixin Collection<int, OrdersRequest>
 */
class OrderRequestCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'count' => $this->collection->count(),
            'data' => OrderRequestResource::collection($this->collection)
        ];
    }
}
