<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // truyền vào dữ liệu mảng permission đã xắp xếp , code dựa trên logic cứng, api --> logic có sẵn
        View::composer('*', function ($view) {
            $permissions = $view->getData()['permissions'] ?? [];
            $permissionMap = [
                "lấy danh sách người dùng" => "user.list",
                "xoá người dùng" => "user.delete",
                "thêm người dùng" => "user.create",
            ];
            $userPermissionCodes = [];
            if (!empty($permissions) && !empty($permissionMap)) {
                foreach ($permissions as $permName) {
                    if (isset($permissionMap[$permName])) {
                        $userPermissionCodes[] = $permissionMap[$permName];
                    }
                }
            }

            $view->with('userPermissionCodes', $userPermissionCodes);
        });
    }
}
