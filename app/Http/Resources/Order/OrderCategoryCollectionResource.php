<?php

namespace App\Http\Resources\Order;

use App\Models\OrdersCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @mixin Collection<int, OrdersCategory>
 */
class OrderCategoryCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'count' => $this->collection->count(),
            'data' => OrderCategoryResource::collection($this->collection)
        ];
    }
}
