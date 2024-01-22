<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

class UserRolePivot extends Pivot
{
    public $table = 'users_roles';

    public $timestamps = false;

    public function setCreatedAt($value): UserRolePivot|static
    {
        $this->attributes['created_at'] = Carbon::now();

        return $this;
    }

    public function setUpdatedAt($value): UserRolePivot|static
    {
        return $this;
    }
}
