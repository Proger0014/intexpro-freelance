<?php

namespace App\Http\Resources\User;

use App\Dto\User\UserDto;
use App\Models\User;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * 
 * @mixin User
 */
class UserResource extends JsonResource
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
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'surname' => $this->surname,
            'login' => $this->login,
            'dateOfBirth' => $this->date_of_birth,
            'rating' => $this->rating,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function toDto(): UserDto {
        return new UserDto(
            $this->id,
            $this->first_name,
            $this->last_name,
            $this->surname,
            $this->login,
            new DateTimeImmutable($this->date_of_birth),
            $this->rating,
            new DateTimeImmutable($this->created_at),
            new DateTimeImmutable($this->updated_at)
        );
    }
}
