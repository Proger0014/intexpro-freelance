<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;

final class ResultError {
    public function __construct(
        public readonly string $type = '/errors/internal-server-error',
        public readonly string $title = 'Неизвестная ошибка',
        public readonly int $status = Response::HTTP_INTERNAL_SERVER_ERROR,
        public readonly string $detail = 'Произошла какая-то ошибка'
    ) { }
}