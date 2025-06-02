<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class JsonExceptionHandler
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Throwable $e) {
            return $this->handleException($request, $e);
        }
    }

    protected function handleException(Request $request, Throwable $e): JsonResponse
    {
        // Kiểm tra xem yêu cầu có phải là API không
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->prepareJsonResponse($request, $e);
        }

        // Nếu không phải API, ném ngoại lệ để Laravel xử lý mặc định (HTML)
        throw $e;
    }

    protected function prepareJsonResponse(Request $request, Throwable $e): JsonResponse
    {
        if ($this->isHttpException($e)) {
            /** @var \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e */
            $statusCode = $e->getStatusCode();
        } else {
            $statusCode = 500;
        }
        $message = $e->getMessage() ?: 'Server Error';

        // Tùy chỉnh thông điệp lỗi dựa trên loại ngoại lệ
        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            $statusCode = 401;
            $message = 'Unauthenticated.';
        } elseif ($e instanceof \Illuminate\Validation\ValidationException) {
            $statusCode = 422;
            $message = 'Validation failed.';
            $errors = $e->errors();
        } elseif ($e instanceof \Illuminate\Database\QueryException) {
            $statusCode = 500;
            $message = 'Database error occurred.';
            if (app()->isLocal()) {
                $message .= ' (' . $e->getMessage() . ')';
            }
        }

        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        // Thêm chi tiết lỗi nếu có (ví dụ: lỗi validation)
        if (isset($errors)) {
            $response['errors'] = $errors;
        }

        // Thêm thông tin debug nếu ở môi trường local
        if (app()->isLocal() && !isset($errors)) {
            $response['debug'] = [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
            ];
        }

        return new JsonResponse($response, $statusCode);
    }

    protected function isHttpException(Throwable $e): bool
    {
        return $e instanceof HttpExceptionInterface;
    }
}