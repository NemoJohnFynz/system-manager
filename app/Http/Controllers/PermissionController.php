<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionController extends Controller
{
    public function getAllPermissions()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permissions = DB::table('permissions')->get();

            return response()->json([
                'status' => 'success',
                'permissions' => $permissions,
            ]);
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
                'message' => 'Could not retrieve permissions. ' . $e->getMessage()
            ], 500);
        }
    }
    public function getPermissionByName($name)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permission = DB::table('permissions')->where('permissions_name', $name)->first();

            if (!$permission) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission not found.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'permission' => $permission,
            ]);
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
    public function createPermission(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $validator = Validator::make($request->all(), [
                'permissions_name' => 'required|string|max:255',
                'type' => 'required|string|max:50',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 422);
            }

            $permission = DB::table('permissions')->insert([
                'user_creately' => $user->username,
                'permissions_name' => $request->permissions_name,
                'type' => $request->type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Permission created successfully.',
                'permission' => [
                    'permissions_name' => $request->permissions_name,
                    'type' => $request->type,
                    'user_creately' => $user->username,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
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
                'message' => 'Could not create permission. ' . $e->getMessage()
            ], 500);
        }
    }
    public function updatePermission(Request $request, $name)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $validator = Validator::make($request->all(), [
                'permission_name' => 'sometimes|required|string|max:255',
                'type' => 'sometimes|required|string|max:50',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 422);
            }

            $permission = DB::table('permissions')->where('permissions_name', $name)->first();

            if (!$permission) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission not found.'
                ], 404);
            }

            DB::table('permissions')->where('permissions_name', $name)->update(array_filter($request->only(['permission_name', 'type'])));

            return response()->json([
                'status' => 'success',
                'message' => 'Permission updated successfully.',
            ]);
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
                'message' => 'Could not update permission. ' . $e->getMessage()
            ], 500);
        }
    }
    public function deletePermission($name)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permission = DB::table('permissions')->where('permission_name', $name)->first();

            if (!$permission) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission not found.'
                ], 404);
            }

            DB::table('permissions')->where('permissions_name', $name)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Permission deleted successfully.',
            ]);
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
                'message' => 'Could not delete permission. ' . $e->getMessage()
            ], 500);
        }
    }
    public function getPermissionsByUser($username)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permissions = DB::table('permissions')->where('user_creately', $username)->get();

            return response()->json([
                'status' => 'success',
                'permissions' => $permissions,
            ]);
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
                'message' => 'Could not retrieve permissions. ' . $e->getMessage()
            ], 500);
        }
    }
    public function getPermissionsByType($type)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permissions = DB::table('permissions')->where('type', $type)->get();

            return response()->json([
                'status' => 'success',
                'permissions' => $permissions,
            ]);
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
                'message' => 'Could not retrieve permissions. ' . $e->getMessage()
            ], 500);
        }
    }
    // public function getPermissionsByName($name)
    // {
    //     try {
    //         if (!$user = JWTAuth::parseToken()->authenticate()) {
    //             return response()->json(['message' => 'Please login to use this function'], 401);
    //         }

    //         $permissions = DB::table('permissions')->where('permission_name', 'like', '%' . $name . '%')->get();

    //         return response()->json([
    //             'status' => 'success',
    //             'permissions' => $permissions,
    //         ]);
    //     } catch (TokenExpiredException $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Token has expired.'
    //         ], 401);
    //     } catch (TokenInvalidException $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Token is invalid.'
    //         ], 401);
    //     } catch (JWTException $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Token is absent or could not be parsed.'
    //         ], 401);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Could not retrieve permissions. ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function getPermissionsByUserAndType($username, $type)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permissions = DB::table('permissions')
                ->where('user_creately', $username)
                ->where('type', $type)
                ->get();

            return response()->json([
                'status' => 'success',
                'permissions' => $permissions,
            ]);
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
                'message' => 'Could not retrieve permissions. ' . $e->getMessage()
            ], 500);
        }
    }
    public function getPermissionsByUserAndName($username, $name)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permissions = DB::table('permissions')
                ->where('user_creately', $username)
                ->where('permission_name', 'like', '%' . $name . '%')
                ->get();

            return response()->json([
                'status' => 'success',
                'permissions' => $permissions,
            ]);
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
                'message' => 'Could not retrieve permissions. ' . $e->getMessage()
            ], 500);
        }
    }
    public function getPermissionsByTypeAndName($type, $name)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permissions = DB::table('permissions')
                ->where('type', $type)
                ->where('permission_name', 'like', '%' . $name . '%')
                ->get();

            return response()->json([
                'status' => 'success',
                'permissions' => $permissions,
            ]);
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
                'message' => 'Could not retrieve permissions. ' . $e->getMessage()
            ], 500);
        }
    }
    public function getPermissionsByUserTypeAndName($username, $type, $name)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permissions = DB::table('permissions')
                ->where('user_creately', $username)
                ->where('type', $type)
                ->where('permission_name', 'like', '%' . $name . '%')
                ->get();

            return response()->json([
                'status' => 'success',
                'permissions' => $permissions,
            ]);
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
                'message' => 'Could not retrieve permissions. ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPermisionByTime(int $time)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $permissions = DB::table('permissions')
                ->where('created_at', '>=', now()->subMinutes($time))
                ->get();

            return response()->json([
                'status' => 'success',
                'permissions' => $permissions,
            ]);
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
                'message' => 'Could not retrieve permissions. ' . $e->getMessage()
            ], 500);
        }
    }
}
