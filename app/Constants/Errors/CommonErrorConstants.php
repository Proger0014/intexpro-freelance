<?php

namespace App\Constants\Errors;

class CommonErrorConstants
{
    public const TYPE = '/errors';
    
    public const TYPE_INTERNAL_SERVER = CommonErrorConstants::TYPE . '/internal-server-error';
    public const TITLE_INTERNAL_SERVER = 'Неизвестная ошибка';
    public const DETAILS_INTERNAL_SERVER = 'Произошла какая-то ошибка';
}