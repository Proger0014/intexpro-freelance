<?php

namespace App\Dto\User;

use DateTimeImmutable;
use DateTimeInterface;

final class UserDto {
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $firstName,
        public readonly ?string $lastName,
        public readonly ?string $surname,
        public readonly ?string $login,
        public readonly ?DateTimeImmutable $dateOfBirth,
        public readonly ?float $rating,
        public readonly ?DateTimeImmutable $createdAt,
        public readonly ?DateTimeInterface $updatedAt
    ) { }
}