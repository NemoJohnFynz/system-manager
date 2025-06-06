<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class userRoleController extends Controller
{
    public function createUserRole(Request $request)
    {
        try 
        {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'role_name' => 'required|string|max:50',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 422);
            }
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed', 'errors' => $validator->errors()
                ], 422);
            }

            $user_role = DB::table('user_role')->insert([
                'username' => $request->input('username'),
                'role_name' => $request->input('role_name'),
                'assigned_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            LogController::createLogAuto([
                'username' => $user->username,
                'message' => "User {$user->username} created a new user role: {$request->input('role_name')}.",
                'is_delete' => false
            ]);

            if ($user_role) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User role created successfully',
                    'user role' => [
                        'username' => $request->input('username'),
                        'role_name' => $request->input('role_name'),
                        'assigned_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create user role'
                ], 500);
            }

        }
        catch (TokenExpiredException $e) {
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
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not delete role. ' . $e->getMessage()
            ], 500);
        }    
    }
}