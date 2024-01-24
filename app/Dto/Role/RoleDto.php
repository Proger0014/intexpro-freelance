<?php

namespace App\Dto\Role;

use DateTimeImmutable;

class RoleDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?DateTimeImmutable $createdAt,
        public readonly ?DateTimeImmutable $updatedAt
    ) { }
}
