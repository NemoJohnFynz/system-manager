<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        try {
            // Lấy thông tin người dùng từ token
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please login to use this function'
                ], 401);
            }

            // Lấy danh sách vai trò của người dùng
            $roles = DB::table('user_role')
                ->where('username', $user->username)
                ->pluck('role_name')
                ->toArray();

            if (empty($roles)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User has no roles assigned.'
                ], 403);
            }

            // Lấy danh sách quyền của các vai trò
            $permissions = DB::table('role_permissions')
                ->whereIn('role_name', $roles)
                ->pluck('permission_name')
                ->toArray();

            // Kiểm tra xem người dùng có quyền được yêu cầu hay không
            if (!in_array($permission, $permissions)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to perform this action.'
                ], 403);
            }

            // Nếu có quyền, tiếp tục xử lý yêu cầu
            return $next($request);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token has expired.'
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is invalid.'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is absent or could not be parsed.'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}