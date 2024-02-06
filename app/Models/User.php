<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public const DEFAULT_MIN_LENGTH = 8;
    public const DEFAULT_MAX_LENGTH = 255;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id', 'created_at'
    ];

    protected $fillable = [
        'id', 'first_name', 'last_name', 'surname', 'login', 'date_of_birth', 'rating', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'datetime'
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function getAuthIdentifierName()
    {
        return 'login';
    }

    public function getAuthIdentifier()
    {
        return $this->login;
    }


    /**
     * @return HasMany<Order>
     */
    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany<OrdersRequest>
     */
    public function requests(): HasMany {
        return $this->hasMany(OrdersRequest::class);
    }
}
