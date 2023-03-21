<?php

namespace App\Domain\auth;

use Rice\Basic\Components\Entity\BaseEntity;
use Rice\Basic\Support\Traits\AutoFillProperties;

/**
 * @method self setAccessToken(string $value)
 * @method string getAccessToken()
 * @method self setRefreshTokenExpiresIn(int $value)
 * @method int getRefreshTokenExpiresIn()
 * @method self setRefreshToken(string $value)
 * @method string getRefreshToken()
 * @method self setAccessTokenExpiresIn(int $value)
 * @method int getAccessTokenExpiresIn()
 * @method self setAdvertiserId(int $value)
 * @method int getAdvertiserId()
 * @method self setAdvertiserIds(int[] $value)
 * @method int[] getAdvertiserIds()
 * @method self setTime(int $value)
 * @method int getTime()
 */
class Token extends BaseEntity
{
    use AutoFillProperties;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var int
     */
    protected $refreshTokenExpiresIn;

    /**
     * @var string
     */
    protected $refreshToken;
    /**
     * @var int
     */
    protected $accessTokenExpiresIn;
    /**
     * @var int
     */
    protected $advertiserId;

    /**
     * @var int[]
     */
    protected $advertiserIds;
    /**
     * @var int
     */
    protected $time;
}
