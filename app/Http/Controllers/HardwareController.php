<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\hardwareModel;


class HardwareController extends Controller
{
    public function createHardware(Request $request)
    {
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
