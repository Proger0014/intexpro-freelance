<?php

namespace App\Exceptions;

use Exception;

class ErrorException extends Exception
{
    public function __construct(
        public readonly string $type,
        public readonly string $title,
        public readonly int $status,
        public readonly string $detail)
    {
        parent::__construct($this->title , $this->status, null);
    }
}
