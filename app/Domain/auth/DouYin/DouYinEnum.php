<?php

namespace App\Domain\auth\DouYin;

use Rice\Basic\components\Enum\BaseEnum;

class DouYinEnum extends BaseEnum
{
    public const APP_ID = 0;

    public const SECRET    = '';
    public const AUTH_CODE = '';

    public const CACHE_KEY = 'douyin_access_token';

    public const DOMAIN_URL = 'https://ad.oceanengine.com';

    /**
     * 获取token路由.
     */
    public const ACCESS_TOKEN_URL = '/open_api/oauth2/access_token/';

    /**
     * 刷新token.
     */
    public const REFRESH_TOKEN_URL = '/open_api/oauth2/refresh_token/';

    public const GRANT_TYPE = [
        self::ACCESS_TOKEN_URL  => 'auth_code',
        self::REFRESH_TOKEN_URL => 'refresh_token',
    ];

    public static function getGrantType($url): string
    {
        return self::GRANT_TYPE[$url];
    }
}
