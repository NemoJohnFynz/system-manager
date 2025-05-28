<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function getUserById($id)
    {
        try { 
            if(!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['please login to use the function'], 404);
            }
            $user = ModelsUser::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ]);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status'=> 'error',
                'message' => 'Token has expired.'
            ], 401);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status'=> 'error',
                'message' => 'Token is invalid.'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status'=> 'error',
                'message' => 'Token is absent or could not be parsed.'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not retrieve user. ' . $e->getMessage()
            ], 500);
            
        }
    }


    public function getAllUsers()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['please login to use the function'], 404);
            }
            $users = ModelsUser::all();
            return response()->json([
                'status' => 'success',
                'users' => $users,
            ]);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status'=> 'error',
                'message' => 'Token has expired.'
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status'=> 'error',
                'message' => 'Token is invalid.'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status'=> 'error',
                'message' => 'Token is absent or could not be parsed.'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not retrieve users. ' . $e->getMessage()
            ], 500);
        }
    }
}
