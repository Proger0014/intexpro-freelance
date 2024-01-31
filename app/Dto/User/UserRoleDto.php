<?php

namespace App\Dto\User;

use DateTimeImmutable;

final class UserRoleDto {
    public function __construct(
        public readonly int $roleId,
        public readonly string $roleName,
        public readonly DateTimeImmutable $givenAt
    ) { }
}