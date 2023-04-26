<?php

namespace App\Domain\auth;

use Rice\Basic\Components\DTO\BaseDTO;
use Rice\Basic\Support\Traits\AutoFillProperties;
use Rice\Basic\Support\Traits\AutoRegisterSingleton;

/**
 * @method self setState(string $value)
 * @method string getState()
 * @method static string getState()
 * @method self setAuthCode(string $value)
 * @method string getAuthCode()
 * @method static string getAuthCode()
 */
class CallBackDTO extends BaseDTO
{
    use AutoFillProperties;
    use AutoRegisterSingleton;
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
