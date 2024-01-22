<?php

namespace App\Abstractions;

use App\Utils\Result;

interface UserService {
    function addNewUser(): Result;
}