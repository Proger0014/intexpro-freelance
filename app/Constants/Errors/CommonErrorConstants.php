<?php

namespace App\Constants\Errors;

class CommonErrorConstants
{
    public const TYPE = '/errors';
    
    public const TYPE_INTERNAL_SERVER = CommonErrorConstants::TYPE . '/internal-server-error';
    public const TITLE__INTERNAL_SERVER = 'Неизвестная ошибка';
    public const DETAILS__INTERNAL_SERVER = 'Произошла какая-то ошибка';
}