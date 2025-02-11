<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class OrdersRequest extends Model
{
    use HasFactory;

    protected $table = 'orders_requests';

    protected $guarded = [
        'id', 'created_at, user_id, order_id'
    ];

    /**
     * @return HasOne<User>
     */
    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    /**
     * @return HasOne<Order>
     */
    public function order(): HasOne {
        return $this->hasOne(Order::class);
    }

    /**
     * @return HasOneThrough<User>
     */
    public function ownerOfOrder(): HasOneThrough {
        return $this->hasOneThrough(User::class, Order::class);
    }
}
