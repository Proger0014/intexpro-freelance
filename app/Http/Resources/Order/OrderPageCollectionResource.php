<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Order;

/**
 * @mixin LengthAwarePaginator<Order>
 */
class OrderPageCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'page' => $this->currentPage(),
            'total' => $this->collection->count(),
            'data' => OrderResource::collection($this->collection),
            'lastPage' => $this->lastPage(),
        ];
    }
}
