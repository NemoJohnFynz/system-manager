<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SoftwareModel;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class SoftwareController extends Controller
{
    public function createSoftware(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Please login to use this function'], 401);
        }

        // Validate the request data
        $request->validate([
            'softwareName' => 'required|string|max:255',
            'language' => 'required|string|max:100',
            'version' => 'nullable|string|max:255',
            'user_createby' => $user->username,
            'description' => 'nullable|string|max:1000',
        ]);

        // Create a new software record
        $software = new SoftwareModel();
        $software->name = $request->input('name');
        $software->version = $request->input('version');
        $software->license_key = $request->input('license_key');
        $software->vendor = $request->input('vendor');
        $software->description = $request->input('description');

        // Save the software record
        if ($software->save()) {
            return response()->json(['message' => 'Software created successfully', 'data' => $software], 201);
        } else {
            return response()->json([
                'message' => 'Failed to create software'
            ], 500);
        }
    } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token has expired.'
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is invalid.'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is absent or could not be parsed.'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not retrieve permission. ' . $e->getMessage()
            ], 500);
        }
    }
}
