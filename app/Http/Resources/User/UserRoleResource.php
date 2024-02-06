<?php

namespace App\Http\Resources\User;

use App\Models\Role;
use App\Models\User;
use DateTimeImmutable;
use Illuminate\Http\Request;
use App\Dto\User\UserRoleDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $user_id
 *
 * @mixin Role
 */
class UserRoleResource extends JsonResource
{
    private function getGivenAtRole(): string {
        return Role::whereId($this->id)->first()->created_at;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'givenAt' => $this->getGivenAtRole()
        ];
    }

    public function toDto(): UserRoleDto {
        return new UserRoleDto(
            (int)$this->id,
            $this->name,
            new DateTimeImmutable($this->getGivenAtRole()));
    }
}
