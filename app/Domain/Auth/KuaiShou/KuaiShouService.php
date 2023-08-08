<?php

namespace App\Domain\Auth\KuaiShou;

use App\Domain\Auth\Token;
use App\Domain\Auth\CallBackDTO;
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

    /**
     * oath2回调地址
     * @param CallBackDTO $dto
     * @return void
     */
    public function callback(CallBackDTO $dto): array
    {
        // 数据入库

        return [
            'state'     => $dto->getState(),
            'auth_code' => $dto->getAuthCode(),
        ];
    }
}
