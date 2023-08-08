<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Rice\Basic\Components\DTO\Response;
use Illuminate\Validation\ValidationException;
use Rice\Basic\Components\Enum\ReturnCode\ClientErrorCode;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });

        $this->renderable(function (ValidationException $e, Request $request) {
            return response()->json(
                Response::buildFailure(
                    ClientErrorCode::USER_REQUEST_PARAMETER_ERROR,
                    $e->validator->errors()->first(),
                    $e->validator->getMessageBag()->toArray()
                )->toArray()
            );
        });
    }
}
