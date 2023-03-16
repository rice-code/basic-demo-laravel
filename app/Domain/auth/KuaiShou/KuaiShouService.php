<?php

namespace App\Domain\auth\KuaiShou;

use App\Domain\auth\Token;
use App\Exceptions\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class KuaiShouService
{
    /**
     * @throws GuzzleException
     * @throws \JsonException
     * @throws ClientException
     */
    public function accessToken(): Token
    {
        $data  = KuaiShouClient::build()->accessToken();
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
        return KuaiShouClient::build()->refreshToken($refreshToken);
    }
}
