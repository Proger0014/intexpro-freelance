<?php

namespace App\Http\Responses\Error;

final class ErrorResponse {
    public function __construct(
        public readonly string $type,
        public readonly string $title,
        public readonly int $status,
        public readonly string $detail
    ) { }
}