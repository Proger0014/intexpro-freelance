<?php

namespace App\Constants\Errors;

class CommonErrorConstants
{
    public const TYPE = '/errors';

    public const TYPE_NOT_FOUND = CommonErrorConstants::TYPE . '/not-found';
    public const DETAIL_NOT_FOUND = 'Попробуйте использовать верные параметры';

    public const TYPE_FORBIDDEN = CommonErrorConstants::TYPE . '/forbidden';
    public const TITLE_FORBIDDEN = 'Недостаточно прав';
    public const DETAIL_FORBIDDEN = 'Попробуйте обратиться к более вышестоящему для данного действия';
    
    public const TYPE_INTERNAL_SERVER = CommonErrorConstants::TYPE . '/internal-server-error';
    public const TITLE_INTERNAL_SERVER = 'Неизвестная ошибка';
    public const DETAILS_INTERNAL_SERVER = 'Произошла какая-то ошибка';
}