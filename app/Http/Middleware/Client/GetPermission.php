<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class GetPermission
{
    public function handle($request, Closure $next)
    {
        try {
            $response = Http::withToken($request->bearerToken())
                ->get('http://127.0.0.1:8000/api/getallpermission');

            if ($response->successful()) {
                $permissions = $response->json();
                // Truyền permissions vào request để dùng tiếp trong controller hoặc view
                $request->attributes->set('permissions', $permissions);
            } else {
                // Nếu API lỗi, truyền giá trị rỗng
                $request->attributes->set('permissions', []);
            }
        } catch (\Exception $e) {
            // Bắt lỗi HTTP hoặc kết nối
            $request->attributes->set('permissions', []);
        }

        return $next($request);
    }
}
