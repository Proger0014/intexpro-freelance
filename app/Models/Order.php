<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 'created_at', 'user_id'
    ];

    protected $casts = [
        'result_is_link' => 'bool'
    ];

    /**
     * @return HasOne<OrdersCategory>
     */
    public function category(): HasOne {
        return $this->hasOne(OrdersCategory::class);
    }

    /**
     * @return HasOne<User>
     */
    public function user(): HasOne {
        return $this->hasOne(User::class);
    }
}
