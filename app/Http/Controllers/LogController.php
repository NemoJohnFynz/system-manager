<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logModel; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public static function createLogAuto(array $data)
    {
        $fields = [
            'username',
            'software_id',
            'hardware_ip',
            'rule_id',
            'message',
            'software_file_id',
            'is_delete'
        ];
         $logData = array_intersect_key($data, array_flip($fields));

    // Thiết lập mặc định cho is_delete nếu chưa có
    if (!isset($logData['is_delete'])) {
        $logData['is_delete'] = false;
    }

    try {
        logModel::create($logData);
    } catch (\Exception $e) {
        // Ghi log lỗi vào laravel.log để dễ debug
        Log::error('Log ghi không thành công: ' . $e->getMessage(), $logData);
    }
    }
}
