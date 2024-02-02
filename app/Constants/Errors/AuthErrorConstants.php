<?php

namespace App\Constants\Errors;

use App\Constants\Errors\CommonErrorConstants;

class AuthErrorConstants
{
    public const TYPE = CommonErrorConstants::TYPE . '/invalid-login-or-password';
    public const TITLE = 'Неверный логин или пароль';
}