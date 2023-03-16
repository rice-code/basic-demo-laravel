<?php

namespace App\Http\Controllers\DouYin;

use App\Http\Controllers\Controller;
use App\Domain\auth\DouYin\DouYinService;
use GuzzleHttp\Exception\GuzzleException;
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
            $service = new DouYinService();
            $service->accessToken();
        } catch (\Exception $e) {
            return $this->failure(ClientErrorCode::CLIENT_ERROR, $e->getMessage());
        }

        return $this->success();
    }
}
