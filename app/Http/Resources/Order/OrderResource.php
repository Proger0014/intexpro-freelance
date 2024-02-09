<?php

namespace App\Http\Resources\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order
 */
class OrderResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'userId' => $this->user_id,
            'categoryId' => $this->category_id,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'expiresAt' => $this->expires_at,
            'resultIsLink' => $this->result_is_link
        ];
    }
}
