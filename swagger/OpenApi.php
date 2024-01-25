<?php

namespace Swagger;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '0.0.1',
    description: 'Документация по api',
    title: 'Intexpro Freelance Api',

)]
#[OA\Server(
    url: L5_SWAGGER_CONST_HOST,
    description: 'Целевое api'
)]
class OpenApi { }
