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

    public function createLogManual(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'software_id' => 'required|integer',
            'hardware_ip' => 'required|string|max:255',
            'rule_id' => 'required|integer',
            'message' => 'required|string|max:1000',
            'software_file_id' => 'nullable|integer',
            'is_delete' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $logData = $validator->validated();
        $logData['is_delete'] = $logData['is_delete'] ?? false;

        try {
            logModel::create($logData);
            return response()->json(['message' => 'Log created successfully'], 201);
        } catch (\Exception $e) {
            Log::error('Log creation failed: ' . $e->getMessage(), $logData);
            return response()->json(['error' => 'Log creation failed'], 500);
        }
    }

    public function getAllLogs(Request $request)
    {
        $logs = logModel::where('is_delete', false)->get();
        return response()->json($logs);
    }

    public function getLogByType(Request $request)
{
    $query = logModel::where('is_delete', false);

    if ($request->has('hardware')) {
        $query->whereNotNull('hardware_ip');
    } elseif ($request->has('software')) {
        $query->whereNotNull('software_id');
    } elseif ($request->has('software_file')) {
        $query->whereNotNull('software_file_id');
    } else {
        // Log user: các trường hardware_ip, software_id, software_file_id đều null
        $query->whereNull('hardware_ip')
              ->whereNull('software_id')
              ->whereNull('software_file_id');
    }

    $logs = $query->get();

    if ($logs->isEmpty()) {
        return response()->json(['message' => 'No logs found for this type'], 404);
    }

    return response()->json($logs);
}
}
