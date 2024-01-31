<?php

namespace App\Http\Resources\Role;

use App\Dto\Role\RoleDto;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @mixin Collection<int, Role>
 */
class RoleCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'count' => $this->collection->count(),
            'data' => RoleResource::collection($this->collection)
        ];
    }

    /**
     * @return array<RoleDto>
     */
    public function toDtoArray(): array {
        return $this->map(fn (Role $role) =>
            (new RoleResource($role))->toDto()
           )->values()->toArray();
    }
}
