<?

namespace App\Dto\User;

use DateTime;

final class UserDto {
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $firstName,
        public readonly ?string $lastName,
        public readonly ?string $surname,
        public readonly ?string $login,
        public readonly DateTime $dateOfBirth,
        public readonly float $rating
    ) { }
}