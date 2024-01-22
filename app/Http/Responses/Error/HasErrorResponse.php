<?php

namespace App\Http\Responses\Error;

trait HasErrorResponse
{
    /**
     * @template T
     *
     * @return array{
     *  type: string,
     *  title: string,
     *  status: int,
     *  detail: T
     * }
     */
    public function getErrorResponse(
        string $type,
        string $title,
        int $status,
        mixed $detail): array {
        return [
            'type' => $type,
            'title' => $title,
            'status' => $status,
            'detail' => $detail
        ];
    }
}
