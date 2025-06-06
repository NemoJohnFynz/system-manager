<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\hardwareModel;
use App\Policies\HardwarePolicy;



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
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'serial_number' => 'required|string|max:100|unique:hardware,serial_number',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,maintenance',
        ]);

        // Create a new hardware record
        $hardware = new hardwareModel();
        $hardware->name = $request->input('name');
        $hardware->type = $request->input('type');
        $hardware->serial_number = $request->input('serial_number');
        $hardware->location = $request->input('location');
        $hardware->status = $request->input('status');
        
        // Save the hardware record
        if ($hardware->save()) {
            return response()->json(['message' => 'Hardware created successfully', 'data' => $hardware], 201);
        } else {
            return response()->json(['message' => 'Failed to create hardware'], 500);
        }
        }catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not create domain. ' . $e->getMessage()], 500);
        }

    }
    public function getHardware()
    {   
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

        $hardware = hardwareModel::all();
        return response()->json($hardware);
        if ($hardware->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No hardware found'], 404);
        }
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not retrieve hardware. ' . $e->getMessage()], 500);
        }
    }
    public function getHardwareById(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }
        $hardware = hardwareModel::find($request->id);
        return response()->json($hardware);
        if (!$hardware) {
            return response()->json(['status' => 'error', 'message' => 'No hardware found'], 404);
        }
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not retrieve hardware. ' . $e->getMessage()], 500);
        }
    }
    //update hardware
    public function updateHardware(Request $request )
    {   
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

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
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not update hardware. ' . $e->getMessage()], 500);
        }
    }
    //delete hardware
    public function deleteHardware(Request $request)
    {   
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }
        $hardware = hardwareModel::find($request->id);
        $hardware->delete();
        return response()->json(['message' => 'Hardware deleted successfully']);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        }
    }

}

