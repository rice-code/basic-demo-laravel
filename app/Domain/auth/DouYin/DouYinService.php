<?php

namespace App\Domain\auth\DouYin;

use App\Domain\auth\Token;
use App\Exceptions\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class DouYinService
{
    /**
     * @throws GuzzleException
     * @throws \JsonException
     * @throws ClientException
     */
    public function accessToken(): Token
    {
        $data  = DouYinClient::build()->accessToken();
        $token = new Token($data);
        if (($token->getAccessTokenExpiresIn() + $token->getTime()) < time()) {
            $data  = $this->refreshToken($token->getRefreshToken());
            $token = new Token($data);
        }

        return $token;
    }

    /**
     * @throws GuzzleException
     * @throws ClientException
     * @throws \JsonException
     */
    protected function refreshToken($refreshToken): array
    {
        return DouYinClient::build()->refreshToken($refreshToken);
    }
}
