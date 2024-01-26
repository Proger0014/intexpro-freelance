<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

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

    public function roles(): BelongsToMany {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id')
            ->withPivot('created_at')
            ->using(UserRolePivot::class);
    }
}
