<?php

namespace Swagger\Schemas\Error;

use OpenApi\Attributes as OA;

#[OA\Schema]
class ValidationErrorResponse extends ErrorResponseBase
{
    #[OA\Property(
        type: 'object',
        example: '{
            "FieldError1": [ "error1", "error2" ]
        }'
    )]
    public $errors;
}
