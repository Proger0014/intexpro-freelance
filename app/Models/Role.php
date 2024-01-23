<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 'created_at'
    ];

    /**
     * @return BelongsToMany<User>
     */
    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id')
            ->withPivot('created_at')
            ->using(UserRolePivot::class);
    }
}
