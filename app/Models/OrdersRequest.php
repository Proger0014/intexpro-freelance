<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrdersRequest extends Model
{
    use HasFactory;

    protected $table = 'orders_requests';

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
}
