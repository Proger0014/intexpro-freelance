<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;
use App\Constants\Errors\CommonErrorConstants;

final class ResultError {
    public function __construct(
        public readonly string $type = CommonErrorConstants::TYPE,
        public readonly string $title = CommonErrorConstants::TITLE,
        public readonly int $status = Response::HTTP_INTERNAL_SERVER_ERROR,
        public readonly string $detail = CommonErrorConstants::DETAILS
    ) { }
}