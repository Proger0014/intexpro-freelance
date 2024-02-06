<?php

namespace App\Http\Resources\Role;

use App\Dto\Role\RoleDto;
use App\Models\Role;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Role
 */
class RoleResource extends JsonResource
{
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
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }

    public function toDto(): RoleDto {
        return new RoleDto(
            (int)$this->id,
            $this->name,
            new DateTimeImmutable($this->created_at),
            new DateTimeImmutable($this->updated_at)
        );
    }
}
