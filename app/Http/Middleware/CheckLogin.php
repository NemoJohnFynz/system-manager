<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        $token = $_COOKIE['auth_token'] ?? null;

        if ($token) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        } else {
            return redirect('/login');
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return redirect('/login');
            }

            // Lấy tất cả permission_name từ username
            $username = $user->username;

            $permissions = DB::table('user_role')
                ->join('roles', 'user_role.role_name', '=', 'roles.role_name')
                ->join('role_permissions', 'roles.role_name', '=', 'role_permissions.role_name')
                ->join('permissions', 'role_permissions.permission_name', '=', 'permissions.permissions_name')
                ->where('user_role.username', $username)
                ->pluck('permissions.permissions_name')
                ->unique()
                ->values()
                ->toArray();
            
            // Gán permissions vào request
            $request->attributes->set('permissions', $permissions);
            // Gắn user vào request
            $request->attributes->set('user', $user);

            return $next($request);
        } catch (TokenExpiredException | TokenInvalidException | JWTException $e) {
            return redirect('/login');
        }
    }
}
