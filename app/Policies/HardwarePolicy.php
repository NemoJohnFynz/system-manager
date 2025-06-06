<?php

namespace App\Policies;

use App\Models\hardwareModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HardwarePolicy
{
    /**
     * Kiểm tra quyền trên phần cứng dựa trên route_name trong bảng route_permission.
     */
    protected function checkHardwarePermission(UserModel $user, hardwareModel $hardware, string $permissionName): bool
    {
        // 1. Tìm route_name tương ứng với permissions_name từ bảng route_permission
        // Sử dụng cache để tối ưu hóa truy vấn
        $cacheKey = "route_permission_{$permissionName}";
        $routeName = Cache::remember($cacheKey, now()->addHours(1), function () use ($permissionName) {
            return DB::table('route_permission')
                ->where('permissions_name', $permissionName)
                ->value('route_name');
        });

        // 2. Nếu không tìm thấy route_name, ghi log và fallback
        if (!$routeName) {
            Log::warning("No route_name found for permission: {$permissionName} in route_permission table.", [
                'user' => $user->username,
                'hardware_ip' => $hardware->ip,
            ]);
            return $user->hasPermissionTo($permissionName); // Fallback về quyền chung
        }

        // 3. Kiểm tra xem có quy tắc cụ thể trong bảng hardware_permissions
        // với route_name thay vì permissions_name
        $hasSpecificRules = DB::table('hardware_permissions')
            ->where('user_name', $user->username)
            ->where('hardware_ip', $hardware->ip)
            ->where('permissions_name', $routeName) // Kiểm tra route_name
            ->exists();

        // 4. Nếu có quy tắc cụ thể, trả về true
        if ($hasSpecificRules) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserModel $userModel): bool
    {
        return false; // Giữ nguyên logic hiện tại
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserModel $user, hardwareModel $hardware): bool
    {
        return $this->checkHardwarePermission($user, $hardware, 'hardware.view');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserModel $userModel, hardwareModel $hardware): bool
    {
        return $this->checkHardwarePermission($userModel, $hardware, 'hardware.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserModel $userModel, hardwareModel $hardware): bool
    {
        return $this->checkHardwarePermission($userModel, $hardware, 'hardware.delete');
    }
}