<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\softwarePermissionModel;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class SoftwarePermissionController extends Controller
{
    //thêm 1 user mới vào đồng quản lý phần mềm
    public function createSoftwarePermission(Request $request)
    {
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Please login to use this function'], 401);
        }

        $validated = $request->validate([
            'software_id' => 'required|integer|exists:software,id',
            'user_name' => 'required|string|exists:users,username',
            'permissions_name' => 'required|string|exists:permissions,permissions_name',
        ]);

        // Kiểm tra type của permission
        $permission = DB::table('permissions')->where('permissions_name', $validated['permissions_name'])->first();
        if (!$permission || $permission->type !== 'software') {
            return response()->json([
                'status' => 'error',
                'message' => 'Permission type is not suitable for software.'
            ], 422);
        }

        // Kiểm tra trùng lặp
        $exists = softwarePermissionModel::where([
            'software_id' => $validated['software_id'],
            'user_name' => $validated['user_name'],
            'permissions_name' => $validated['permissions_name'],
        ])->exists();

        if ($exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Permission already exists for this user and software.'
            ], 409);
        }

        // Lưu vào DB
        $permission = softwarePermissionModel::create([
            'software_id' => $validated['software_id'],
            'user_name' => $validated['user_name'],
            'permissions_name' => $validated['permissions_name'],
            'user_createdby' => $user->username,
            'assigned_at' => now(),
        ]);

        return response()->json([
            'message' => 'Software permission created successfully.',
            'data' => $permission,
        ], 201);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not create software permission. ' . $e->getMessage()], 500);
        }
    }

    public function getAllUserPermission(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }
            $permissions = softwarePermissionModel::where('user_name', $user->username)
                ->with(['user', 'software'])
                ->get();
            return response()->json([
                'message' => 'User software permissions retrieved successfully.',
                'data' => $permissions,
            ], 200);
            } catch (TokenExpiredException $e) {
                return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
            } catch (TokenInvalidException $e) {
                return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
            } catch (JWTException $e) {
                return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Could not retrieve software permissions. ' . $e->getMessage()], 500);
            }
    }

    public function getDetailUserPermissionInSoftware(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $username = $request->query('user_name') ?? $request->input('user_name');
            $softwareId = $request->query('software_id') ?? $request->input('software_id');

            if (!$username || !$softwareId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'user_name and software_id are required.'
                ], 400);
            }

            $userExists = DB::table('users')->where('username', $username)->exists();
            $softwareExists = DB::table('software')->where('id', $softwareId)->exists();
            if (!$userExists || !$softwareExists) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User or software not found.'
                ], 404);
            }

            $permissions = softwarePermissionModel::where([
                    'software_id' => $softwareId,
                    'user_name' => $username,
                ])
                ->with(['user', 'software'])
                ->get();

            if ($permissions->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No permissions found for this user on this software.'
                ], 404);
            }

            return response()->json([
                'message' => 'User permissions on software retrieved successfully.',
                'data' => $permissions,
            ], 200);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not retrieve user permission details. ' . $e->getMessage()], 500);
        }
    }

    //só 1 user ra khỏi phần quản lý phần mềm
    public function removeUserPermissionInSoftware(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $username = $request->query('user_name') ?? $request->input('user_name');
            $softwareId = $request->query('software_id') ?? $request->input('software_id');

            if (!$username || !$softwareId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'user_name and software_id are required.'
                ], 400);
            }

            $userExists = DB::table('users')->where('username', $username)->exists();
            $softwareExists = DB::table('software')->where('id', $softwareId)->exists();
            if (!$userExists || !$softwareExists) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User or software not found.'
                ], 404);
            }

            $deletedRows = softwarePermissionModel::where([
                    'software_id' => $softwareId,
                    'user_name' => $username,
                ])->delete();

            if ($deletedRows === 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No permissions found to delete for this user on this software.'
                ], 404);
            }

            return response()->json([
                'message' => 'User permissions removed successfully.',
                'deleted_rows' => $deletedRows,
            ], 200);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not remove user permission. ' . $e->getMessage()], 500);
        }
    }

    public function getAllUserPermissionInSoftware(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }
            $username = $request->query('username') ?? $request->input('username');
            if (!$username) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'please input username'
                ], 400);
            }
            $userExists = DB::table('users')->where('username', $username)->exists();
            if (!$userExists) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found.'
                ], 404);
            }
            $permissions = softwarePermissionModel::where('user_name', $username)
                ->with(['user', 'software'])
                ->get();

            if ($permissions->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No software permissions found for this user.'
                ], 404);
            }

            return response()->json([
                'message' => 'User software permissions retrieved successfully.',
                'data' => $permissions,
            ], 200);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not retrieve user software permissions. ' . $e->getMessage()], 500);
        }
    }

    public function updatePermissionUserInSoftware(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $validated = $request->validate([
                'software_id' => 'required|integer|exists:software,id',
                'user_name' => 'required|string|exists:users,username',
                'permissions_name' => 'required|string|exists:permissions,permissions_name',
            ]);

            // Kiểm tra type của permission
            $permission = DB::table('permissions')->where('permissions_name', $validated['permissions_name'])->first();
            if (!$permission || $permission->type !== 'software') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission type is not suitable for software.'
                ], 422);
            }

            // Cập nhật quyền
            $softwarePermission = softwarePermissionModel::where([
                'software_id' => $validated['software_id'],
                'user_name' => $validated['user_name'],
            ])->first();

            if (!$softwarePermission) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission not found for this user and software.'
                ], 404);
            }

            $softwarePermission->permissions_name = $validated['permissions_name'];
            $softwarePermission->save();

            return response()->json([
                'message' => 'Software permission updated successfully.',
                'data' => $softwarePermission,
            ], 200);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not update software permission. ' . $e->getMessage()], 500);
        }
    }

    public function addPermissionForUser(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $validated = $request->validate([
                'software_id' => 'required|integer|exists:software,id',
                'user_name' => 'required|string|exists:users,username',
                'permissions_name' => 'required|string|exists:permissions,permissions_name',
            ]);

            // Kiểm tra type của permission
            $permission = DB::table('permissions')->where('permissions_name', $validated['permissions_name'])->first();
            if (!$permission || $permission->type !== 'software') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission type is not suitable for software.'
                ], 422);
            }

            // Kiểm tra trùng lặp
            $exists = softwarePermissionModel::where([
                'software_id' => $validated['software_id'],
                'user_name' => $validated['user_name'],
                'permissions_name' => $validated['permissions_name'],
            ])->exists();

            if ($exists) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission already exists for this user and software.'
                ], 409);
            }

            // Lưu vào DB
            $permission = softwarePermissionModel::create([
                'software_id' => $validated['software_id'],
                'user_name' => $validated['user_name'],
                'permissions_name' => $validated['permissions_name'],
                'user_createdby' => $user->username,
                'assigned_at' => now(),
            ]);

            return response()->json([
                'message' => 'Software permission created successfully.',
                'data' => $permission,
            ], 201);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not create software permission. ' . $e->getMessage()], 500);
        }
    }
}