<?php

namespace App\Http\Resources\Order;

use App\Models\OrdersRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin OrdersRequest
 */
class OrderRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'orderId' => $this->order_id,
            'userId' => $this->user_id,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'status' => $this->status
        ];
    }
}
