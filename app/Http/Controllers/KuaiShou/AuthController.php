<?php

namespace App\Http\Controllers\KuaiShou;

use Illuminate\Http\Request;
use App\Domain\auth\CallBackDTO;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use App\Domain\auth\KuaiShou\KuaiShouService;
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
            $service = new KuaiShouService();
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
            $data = (new KuaiShouService())->callback($dto);
        } catch (\Exception $e) {
            return $this->failure(ClientErrorCode::CLIENT_ERROR, $e->getMessage());
        }

        return $this->success($data);
    }
}
