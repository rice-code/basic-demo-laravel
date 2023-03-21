<?php

namespace App\Domain\auth\KuaiShou;

use Rice\Basic\Components\Enum\BaseEnum;

class KuaiShouEnum extends BaseEnum
{
    public const APP_ID = 0;

    public const SECRET    = '';
    public const AUTH_CODE = '';

    public const CACHE_KEY = 'kuaishou_access_token';

    public const DOMAIN_URL = 'https://ad.e.kuaishou.com';

    /**
     * 授权路由.
     */
    public const AUTHORIZE_URL = '/rest/openapi/oauth2/authorize';
    /**
     * 获取token路由.
     */
    public const ACCESS_TOKEN_URL = '/rest/openapi/oauth2/authorize/access_token';

    /**
     * 刷新token.
     */
    public const REFRESH_TOKEN_URL = '/rest/openapi/oauth2/authorize/refresh_token';
}
