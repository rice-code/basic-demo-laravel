<?php

namespace App\Exceptions;

use Rice\Basic\Components\Exception\BaseException;

class ClientException extends BaseException
{
    public static function getLangName(): string
    {
        return 'client';
    }
}
