<?php

namespace App\Http\Controllers\KuaiShou;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use App\Domain\auth\KuaiShou\KuaiShouService;
use Rice\Basic\components\Exception\SupportException;
use Rice\Basic\components\Enum\ReturnCode\ClientErrorCode;

class AuthController extends Controller
{
    /**
     * @throws SupportException
     * @throws GuzzleException
     */
    public function getAccessToken(): array
    {
        try {
            $service = new KuaiShouService();
            $service->accessToken();
        } catch (\Exception $e) {
            return $this->failure(ClientErrorCode::CLIENT_ERROR, $e->getMessage());
        }

        return $this->success();
    }
}
