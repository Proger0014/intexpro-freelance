<?php

namespace Swagger\Schemas\Error;

use OpenApi\Attributes as OA;

#[OA\Schema]
class ErrorResponse extends ErrorResponseBase
{
    #[OA\Property]
    public string $detail;
}
