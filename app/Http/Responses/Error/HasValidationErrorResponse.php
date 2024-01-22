<?php

namespace App\Http\Responses\Error;

use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

trait HasValidationErrorResponse
{
    private int $VALIDATION_ERROR_RESPONSE_CODE = Response::HTTP_BAD_REQUEST;

    /**
     * @param array<string, string> $errors
     *
     * @return array{
     *  type: string,
     *  title: string,
     *  status: int,
     *  errors: array<string, string>
     * }
     */
    protected function getValidationErrorResponse(array $errors): array {
        return [
            'type' => '/errors/validation',
            'title' => 'Ошибка валидации',
            'status' => $this->VALIDATION_ERROR_RESPONSE_CODE,
            'errors' => $errors
        ];
    }
}
