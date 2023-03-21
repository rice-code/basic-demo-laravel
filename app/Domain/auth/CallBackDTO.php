<?php

namespace App\Domain\auth;

use Rice\Basic\Components\DTO\BaseDTO;
use Rice\Basic\Support\Traits\AutoFillProperties;

/**
 * @method self setState(string $value)
 * @method string getState()
 * @method self setAuthCode(string $value)
 * @method string getAuthCode()
 */
class CallBackDTO extends BaseDTO
{
    use AutoFillProperties;
    /**
     * 自定义参数.
     * @var string
     */
    protected $state;

    /**
     * 鉴权code.
     * @var string
     */
    protected $authCode;
}
