<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\hardwareModel;


class HardwareController extends Controller
{
    public function createHardware(Request $request)
        {
            try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Please login to use this function'], 401);
        }
            // Validate the request data
            $request->validate([
                'ip' => 'required|string|max:25',
                'dbname' => 'required|string|max:100',
                'dbversion' => 'required|string|max:100',
                'isVirtualServer' => 'required|boolean',
                'HDD' => 'nullable|string|max:50',
                'RAM' => 'nullable|string|max:50',
                'services' => 'nullable|string|max:100',
                'user_createby' => $user->username,
            ]);

            // Create a new hardware record
            $hardware = new hardwareModel();
            $hardware->ip = $request->input('ip');
            $hardware->dbname = $request->input('dbname');
            $hardware->dbversion = $request->input('dbversion');
            $hardware->isVirtualServer = $request->input('isVirtualServer');
            $hardware->HDD = $request->input('HDD');
            $hardware->RAM = $request->input('RAM');
            $hardware->services = $request->input('services');
            $hardware->user_createby = $user->username;
            $hardware->created_at = now();
            // Save the hardware record
            if ($hardware->save()) {
                LogController::createLogAuto([
                    'username' => $user->username,
                    'hardware_ip' => $hardware->ip,
                    'message' => " user {$user->username} created hardware '{$hardware->ip}'.",
                    'is_delete' => false
                ]);
                return response()->json(['message' => 'Hardware created successfully', 'data' => $hardware], 201);
            } else {
                return response()->json(['message' => 'Failed to create hardware'], 500);
            }
        }
        catch (TokenExpiredException $e) {
            return response()->json([
                'message' => 'Token expired'
            ], 401);
        }
        catch (TokenInvalidException $e) {
            return response()->json([
                'message' => 'Token invalid'
            ], 401);
        }
        catch (JWTException $e) {
            return response()->json([
                'message' => 'Token absent or could not be parsed'
            ], 401);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => 'Could not create hardware'
            ], 500);
        }

    }
    public function getHardware()
    {
        $hardware = hardwareModel::all();
        return response()->json($hardware);
        if ($hardware->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No hardware found'], 404);
        }
    }
    public function getHardwareById(Request $request)
    {
        $hardware = hardwareModel::find($request->id);
        return response()->json($hardware);
        if (!$hardware) {
            return response()->json(['status' => 'error', 'message' => 'No hardware found'], 404);
        }
    }
    //update hardware
    public function updateHardware(Request $request)
    {
        $hardware = hardwareModel::find($request->id);
        $hardware->name = $request->input('name');
        $hardware->type = $request->input('type');
        $hardware->serial_number = $request->input('serial_number');
        $hardware->location = $request->input('location');
        $hardware->status = $request->input('status');
        $hardware->save();
        return response()->json(['message' => 'Hardware updated successfully', 'data' => $hardware]);
        if (!$hardware) {
            return response()->json(['status' => 'error', 'message' => 'No hardware found'], 404);
        }
    }
    //delete hardware
    public function deleteHardware(Request $request)
    {
        $hardware = hardwareModel::find($request->id);
        $hardware->delete();
        return response()->json(['message' => 'Hardware deleted successfully']);
    }
}
