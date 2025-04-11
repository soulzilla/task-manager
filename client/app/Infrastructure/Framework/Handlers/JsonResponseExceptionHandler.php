<?php

namespace App\Infrastructure\Framework\Handlers;

use App\Application\Exceptions\TaskNotFoundException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class JsonResponseExceptionHandler
{
    public function handle(Throwable $exception, Exceptions $exceptions): null|JsonResponse
    {
        if (! $exceptions->handler->shouldReport($exception)) {
            return null;
        }
        Log::error($exception::class, [
            'msg' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]);
        return response()->json([
            'error_code' => method_exists($exception, 'getErrorCode') ? $exception->getErrorCode() : $exception::class,
            'error' => ! empty($exception->getMessage()) ? $exception->getMessage() : 'Houston, we have a problem!',
        ], match ($exception::class) {
            TaskNotFoundException::class => 400,
            default => 500
        });
    }
}
