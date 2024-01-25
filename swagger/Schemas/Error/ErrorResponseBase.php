<?php

namespace Swagger\Schemas\Error;

use OpenApi\Attributes as OA;

class ErrorResponseBase
{
    #[OA\Property]
    public string $type;

    #[OA\Property]
    public string $title;

    #[OA\Property]
    public int $status;
}
