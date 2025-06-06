<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
            if ($user) {
                // Gắn user vào request để dùng tiếp
                $request->attributes->set('user', $user);
                return $next($request);
            } else {
                return redirect('/login');
            }
        } catch (TokenExpiredException | TokenInvalidException | JWTException $e) {
            return redirect('/login');
        }
    }
}
