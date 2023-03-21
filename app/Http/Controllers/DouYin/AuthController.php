<?php

namespace App\Http\Controllers\DouYin;

use Illuminate\Http\Request;
use App\Domain\auth\CallBackDTO;
use App\Http\Controllers\Controller;
use App\Domain\auth\DouYin\DouYinService;
use GuzzleHttp\Exception\GuzzleException;
use Rice\Basic\Components\Exception\SupportException;
use Rice\Basic\Components\Enum\ReturnCode\ClientErrorCode;

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

    public function callback(Request $request): array
    {
        try {
            $dto  = new CallBackDTO($request->input());
            $data = (new DouYinService())->callback($dto);
        } catch (\Exception $e) {
            return $this->failure(ClientErrorCode::CLIENT_ERROR, $e->getMessage());
        }

        return $this->success($data);
    }
}
