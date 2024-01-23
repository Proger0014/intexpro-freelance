<?php

namespace App\Http\Resources\User;

use App\Models\Role;
use App\Models\UserRolePivot;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $user_id
 *
 * @mixin Role
 */
class UserRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $givenAtRole = UserRolePivot::where('user_id', '=', $this->user_id)
            ->where('role_id', '=', $this->id)->first()
            ->created_at;

        return [
            'role_id' => $this->id,
            'role_name' => $this->name,
            'given_at' => $givenAtRole
        ];
    }
}
