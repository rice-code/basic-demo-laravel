<?php

namespace App\Domain\auth\KuaiShou;

use JsonException;
use GuzzleHttp\RequestOptions;
use App\Exceptions\ClientException;
use Illuminate\Support\Facades\Redis;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use Rice\Basic\Support\Abstracts\Guzzle\LaravelClient;

class KuaiShouClient extends LaravelClient
{
    public function init(): void
    {
        $this->options[RequestOptions::JSON] = [
            'app_id'    => KuaiShouEnum::APP_ID,
            'secret'    => KuaiShouEnum::SECRET,
            'auth_code' => KuaiShouEnum::AUTH_CODE,
        ];
    }

    /**
     * @throws GuzzleException
     * @throws ClientException
     */
    public function accessToken()
    {
        if ($accessToken = Redis::get(KuaiShouEnum::CACHE_KEY)) {
            return json_decode($accessToken, true);
        }

        $url = KuaiShouEnum::DOMAIN_URL . KuaiShouEnum::ACCESS_TOKEN_URL;

        return $this->handle($url);
    }

    /**
     * @throws GuzzleException
     * @throws ClientException|JsonException
     */
    public function refreshToken($refreshToken): array
    {
        $url = KuaiShouEnum::DOMAIN_URL . KuaiShouEnum::REFRESH_TOKEN_URL;

        $time = time();
        $this->mergeOption(RequestOptions::JSON, [
            'refresh_token' => $refreshToken,
        ]);
        $data = $this->handle($url);

        $data['time'] = $time;
        Redis::set(KuaiShouEnum::CACHE_KEY, json_encode($data, JSON_UNESCAPED_UNICODE));

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
        $this->setCallback(function (?ResponseInterface $response) {
            if (!$response) {
                return false;
            }

            $res = json_decode($response->getBody(), true);

            return 'OK' === $res['message'];
        });

        $res = $this->client->post($url, $this->options);

        $resArr = json_decode($res->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (!$this->isSuccess()) {
            throw new ClientException($resArr['message'] ?? '请求失败');
        }

        return $resArr['data'];
    }
}
