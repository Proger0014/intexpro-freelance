<?php

namespace App\Constants\Errors;

use App\Constants\Errors\CommonErrorConstants;

class ValidationErrorConstants
{
    public const TYPE = CommonErrorConstants::TYPE . '/validation';
    public const TITLE = 'Ошибка валидации';
}
