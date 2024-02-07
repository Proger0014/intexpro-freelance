<?php

namespace App\Http\Responses\Order;

class OrderRequestExistsResponse
{
    public function __construct(
        public bool $isExists
    ) { }
}
