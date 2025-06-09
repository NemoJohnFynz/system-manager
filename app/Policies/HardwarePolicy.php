<?php

namespace App\Policies;

use App\Models\hardwareModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HardwarePolicy
{
    protected function checkHardwarePermission(UserModel $user, hardwareModel $hardware, string $permissionName): bool
    {
        $cacheKey = "route_permission_{$permissionName}";
        $routeName = Cache::remember($cacheKey, now()->addHours(1), fn() =>
            DB::table('route_permission')
                ->where('permissions_name', $permissionName)
                ->value('route_name')
        );

        if (!$routeName) {
            Log::warning("No route_name found for permission: {$permissionName} in route_permission table.", [
                'user' => $user->username,
                'hardware_ip' => $hardware->ip,
            ]);
            return $user->hasPermissionTo($permissionName);
        }

        $hasSpecificRules = DB::table('hardware_permissions')
            ->where('user_name', $user->username)
            ->where('hardware_ip', $hardware->ip)
            ->where('permissions_name', $routeName)
            ->exists();

        if ($hasSpecificRules) {
            return true;
        }

        return false;
    }

    public function viewAny(UserModel $userModel): bool
    {
        return false;
    }

    public function view(UserModel $user, hardwareModel $hardware): bool
    {
        return $this->checkHardwarePermission($user, $hardware, 'hardware.view');
    }

    public function update(UserModel $userModel, hardwareModel $hardware): bool
    {
        return $this->checkHardwarePermission($userModel, $hardware, 'hardware.edit');
    }

    public function delete(UserModel $userModel, hardwareModel $hardware): bool
    {
        return $this->checkHardwarePermission($userModel, $hardware, 'hardware.delete');
    }
}