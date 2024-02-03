<?php

namespace App\Constants;

class ValidationConstants
{
    public const REQUIRED = ':attribute не указан';
    public const MIN = ':attribute должен быть не меньше %d символов';
    public const MAX = ':attribute должен быть не больше %d символов';
}