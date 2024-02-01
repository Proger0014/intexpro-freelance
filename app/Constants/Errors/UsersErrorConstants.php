<?php

namespace App\Constants\Errors;

use App\Constants\Errors\CommonErrorConstants;

class UsersErrorConstants
{
    public const TYPE_EXISTS = CommonErrorConstants::TYPE . '/exists';
    public const TITLE_EXISTS = 'Юзер с таким логином уже существует';
    public const DETAIL_EXISTS = 'Попробуйте изменить логин или войти в существующий аккаунт';

    public const TITLE_NOT_FOUND_BY_ID = 'Юзер с таким id не найден';

    public const TITLE_NOT_FOUND_BY_LOGIN = 'Юзера с таким логином не существует';
    public const DETAIL_NOT_FOUND_BY_LOGIN = CommonErrorConstants::DETAIL_NOT_FOUND . ' или создать нового юзера';
}

