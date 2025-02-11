<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Dto\User\UserRoleDto;
use App\Models\Role;
use App\Http\Resources\User\UserRoleResource;

/**
 * @mixin User
 */
class UserRolesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userId = $this->id;

        return [
            'userId' => $this->id,
            'roles' => UserRoleResource::collection($this->roles()->get())
                ->additional(['user_id' => $this->id])
        ];
    }

    /**
     * @return array<UserRoleDto>
     */
    public function toDtoArray(): array {
        return $this->roles()->chunkMap(fn (Role $role) => (new UserRoleResource($role))
            ->additional(['user_id'=> $this->id])->toDto())
            ->values()
            ->toArray();
    }
}
