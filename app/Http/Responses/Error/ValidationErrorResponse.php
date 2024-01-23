<?php

namespace App\Http\Responses\Error;

use Symfony\Component\HttpFoundation\Response;

final class ValidationErrorResponse {
    public readonly string $type;
    public readonly string $title;

    /**
     * @param array<string, string> $errors
     */
    public function __construct(
        public readonly array $errors,
        public readonly int $status = Response::HTTP_BAD_REQUEST
    ) {
        $this->type = '/errors/validation';
        $this->title = 'Ошибка валидации';
    }
}