<?php

namespace App\Constants\Errors;

use App\Constants\Errors\CommonErrorConstants;

class AuthErrorConstants
{
    public const TYPE_INVALID_LOGIN_OR_PASSWORD = CommonErrorConstants::TYPE . '/invalid-login-or-password';
    public const TITLE_INVALID_LOGIN_OR_PASSWORD = 'Неверный логин или пароль';
    public const DETAIL_INVALID_LOGIN_OR_PASSWORD = 'Попробуйте изменить параметры';
}