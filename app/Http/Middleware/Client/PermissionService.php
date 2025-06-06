<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\PermissionService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'Token hết hạn'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'Token không hợp lệ'], 401);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token không tồn tại'], 401);
        }

        // Gọi từ service tái sử dụng logic
        $permissions = PermissionService::getPermissionsForUser($user);

        if (!in_array($permission, $permissions)) {
            return response()->json(['message' => 'Không có quyền truy cập.'], 403);
        }

        return $next($request);
    }
}
