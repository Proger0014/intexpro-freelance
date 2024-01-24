<?php

namespace App\Http\Resources\User;

use App\Dto\User\UserRoleDto;
use App\Models\Role;
use App\Models\UserRolePivot;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $user_id
 *
 * @mixin Role
 */
class UserRoleResource extends JsonResource
{
    private function getGivenAtRole(): string {
        return UserRolePivot::where('user_id', $this->user_id)
            ->where('role_id', $this->id)
            ->first()
            ->created_at;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'role_id' => $this->id,
            'role_name' => $this->name,
            'given_at' => $this->getGivenAtRole()
        ];
    }

    public function toDto(): UserRoleDto {
        return new UserRoleDto(
            $this->id,
            $this->name,
            new DateTimeImmutable($this->getGivenAtRole()));
    }
}
