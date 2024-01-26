<?php

namespace App\Http\Responses\Error;

use Symfony\Component\HttpFoundation\Response;

final class ValidationErrorResponse {
    public readonly string $type;
    public readonly string $title;
    public readonly int $status;

    /**
     * @var array<string, array<string>>
     */
    public readonly array $errors;

    /**
     * @param array<string, array<string>> $errors
     */
    public function __construct(
        array $errors,
        int $status = Response::HTTP_BAD_REQUEST
    ) {
        $this->type = '/errors/validation';
        $this->title = 'Ошибка валидации';
        $this->status = $status;
        $this->errors = $errors;
    }
}
