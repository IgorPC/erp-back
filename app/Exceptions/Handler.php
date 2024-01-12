<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $message = $exception->getMessage();

        if ($message === "Token has expired" && $exception instanceof UnauthorizedHttpException) {
            return response()->json(['error' => "Expired token"], 401);
        }

        if ($message === "Token Signature could not be verified." && $exception instanceof UnauthorizedHttpException) {
            return response()->json(['error' => "Invalid token"], 401);
        }

        if ($message) {
            return response()->json(['error' => "Internal Server error"], 500);
        }

        return parent::render($request, $exception);
    }
}
