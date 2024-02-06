<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdersCategory extends Model
{
    use HasFactory;

    protected $table = 'orders_categories';

    /**
     * @return HasMany<Order>
     */
    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }
}
