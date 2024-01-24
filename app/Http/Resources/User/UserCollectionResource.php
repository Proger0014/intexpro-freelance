<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Dto\User\UserDto;
use DateTimeImmutable;

/**
 * @mixin Collection<int, User>
 */
class UserCollectionResource extends ResourceCollection
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
            'data' => UserResource::collection($this->collection)
        ];
    }

    /**
     * @return array<UserDto>
     */
    public function toDtoArray(): array {
        return $this->map(fn (User $user) =>
            new UserDto(
                $user->id,
                $user->first_name,
                $user->last_name,
                $user->surname,
                $user->login,
                new DateTimeImmutable($user->date_of_birth),
                $user->rating
            ))->values()->toArray();
    }
}
