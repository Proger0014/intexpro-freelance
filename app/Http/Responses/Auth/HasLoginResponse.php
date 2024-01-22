<?php

namespace App\Http\Responses\Auth;

use DateTime;

trait HasLoginResponse
{
    /**
     * @return array{
     *  accessToken: string,
     *  expiresAt: DateTime
     * }
     */
    public function getLoginResponse(string $accessToken, DateTime $expiresAt): array {
        return [
            'accessToken' => $accessToken,
            'expiresAt' => $expiresAt
        ];
    }
}
