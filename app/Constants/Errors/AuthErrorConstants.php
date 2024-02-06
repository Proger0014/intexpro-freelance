<?php

namespace App\Constants\Errors;

use App\Constants\Errors\CommonErrorConstants;

class AuthErrorConstants
{
    public const TYPE_INVALID_LOGIN_OR_PASSWORD = CommonErrorConstants::TYPE . '/invalid-login-or-password';
    public const TITLE_INVALID_LOGIN_OR_PASSWORD = 'Неверный логин или пароль';
    public const DETAIL_INVALID_LOGIN_OR_PASSWORD = 'Попробуйте изменить параметры';

    public const TYPE_FORBIDDEN = CommonErrorConstants::TYPE . '/forbidden';
    public const TITLE_FORBIDDEN = 'Недостаточно прав';
    public const DETAIL_FORBIDDEN = 'Попробуйте обратиться к более вышестоящему для данного действия';

    public const TYPE_UNAUTHORIZED = CommonErrorConstants::TYPE . '/unauthorized';
    public const TITLE_UNAUTHORIZED = 'Не аутентифицированны';
    public const DETAIL_UNAUTHORIZED = 'Попробуйте войти ещё раз';
}