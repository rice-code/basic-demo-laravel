<?php

namespace App\Domain\auth\DouYin;

use JsonException;
use GuzzleHttp\RequestOptions;
use App\Exceptions\ClientException;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Exception\GuzzleException;
use Rice\Basic\Support\Abstracts\Guzzle\LaravelClient;

class DouYinClient extends LaravelClient
{
    public function init(): void
    {
        $this->mergeOption(RequestOptions::JSON, [
            'app_id'    => DouYinEnum::APP_ID,
            'secret'    => DouYinEnum::SECRET,
            'auth_code' => DouYinEnum::AUTH_CODE,
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws ClientException
     */
    public function accessToken()
    {
        if ($accessToken = Redis::get(DouYinEnum::CACHE_KEY)) {
            return json_decode($accessToken, true);
        }

        $url = DouYinEnum::DOMAIN_URL . DouYinEnum::ACCESS_TOKEN_URL;

        $this->mergeOption(
            RequestOptions::JSON,
            [
                'grant_type' => DouYinEnum::getGrantType(DouYinEnum::ACCESS_TOKEN_URL),
            ]
        );

        return $this->handle($url);
    }

    /**
     * @throws GuzzleException
     * @throws ClientException|JsonException
     */
    public function refreshToken($refreshToken): array
    {
        $url = DouYinEnum::DOMAIN_URL . DouYinEnum::REFRESH_TOKEN_URL;

        $time = time();

        $this->mergeOption(
            RequestOptions::JSON,
            [
                'grant_type'    => DouYinEnum::getGrantType(DouYinEnum::REFRESH_TOKEN_URL),
                'refresh_token' => $refreshToken,
            ]
        );

        $data = $this->handle($url);

        $data['time'] = $time;
        Redis::set(DouYinEnum::CACHE_KEY, json_encode($data, JSON_UNESCAPED_UNICODE));

        return $data;
    }

    /**
     * @param string $url
     * @return array
     * @throws ClientException
     * @throws GuzzleException
     */
    private function handle(string $url): array
    {
        $this->setSuccessCondition(function () {
            if (!$this->response) {
                return false;
            }

            $res = json_decode($this->response->getBody(), true);

            return 0 === $res['code'];
        });

        $res = $this->client->post($url, $this->getOptions());

        $resArr = json_decode($res->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (!$this->isSuccess()) {
            throw new ClientException($resArr['message'] ?? '请求失败');
        }

        return $resArr['data'];
    }
}
