<?php

namespace App\Http\Controllers;

use Rice\Basic\Components\DTO\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function success($data = []): array
    {
        $resp = Response::buildSuccess($data);

        return $this->toArray($resp);
    }

    public function failure(string $errCode, string $errMessage): array
    {
        $resp = Response::buildFailure($errCode, $errMessage);

        return $this->toArray($resp);
    }

    public function toArray(Response $resp): array
    {
        return [
            'success'    => $resp->getSuccess(),
            'errCode'    => $resp->getErrCode(),
            'errMessage' => $resp->getErrMessage(),
            'data'       => $resp->getData(),
        ];
    }
}
