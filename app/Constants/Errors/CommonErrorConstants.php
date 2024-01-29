<?php

namespace App\Constants\Errors;

class CommonErrorConstants
{
    public const TYPE = '/errors';
    public const TYPE_INTERNAL_SERVER = CommonErrorConstants::TYPE . '/internal-server-error';
    public const TITLE = 'Неизвестная ошибка';
    public const DETAILS = 'Произошла какая-то ошибка';
}