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

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'roles_users', 'role_id', 'user_id');
    }
}
