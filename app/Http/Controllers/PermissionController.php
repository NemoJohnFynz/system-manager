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
    public function getPermissionByName(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $name = $request->query('name');
            if (!$name) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'name is required.'
                ], 400);
            }

            $permission = DB::table('permissions')->where('permissions_name', 'like', '%' . $name . '%')->get();

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

    // /**
    //  * Create a new permission.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\JsonResponse
    //  * @throws \Tymon\JWTAuth\Exceptions\TokenExpiredException
    //  */
    // private function formatPermissionName($permissionsName)
    // {
    //     $permissionsName = mb_strtolower($permissionsName, 'UTF-8');

    // }
    

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

            $input = mb_strtolower($request->permissions_name, 'UTF-8');
            $defaultPermission = $request->permissions_name;
            // Map tiếng Việt sang resource tiếng Anh
            $resourceMap = [
                'phần cứng' => 'hardware',
                'hardware' => 'hardware',
                'phần mềm' => 'software',
                'software' => 'software',
                'người dùng' => 'user',
                'user' => 'user',
                'quyền hạn' => 'permission',
                'quyền' => 'permission',
                'permission' => 'permission',
                'pháp lý' => 'legal',
                'legal' => 'legal',
                'hệ thống' => 'system',
                'system' => 'system',
                'danh mục' => 'category',
                'category' => 'category',
                'phân quyền' => 'role',
                'role' => 'role',
                'phân quyền phần cứng' => 'hardware_role',
                'hardware_role' => 'hardware_role',
                'phân quyền phần mềm' => 'software_role',
                'software_role' => 'software_role',
                'phân quyền người dùng' => 'user_role',
                'user_role' => 'user_role',
                'phân quyền hệ thống' => 'system_role',
                'system_role' => 'system_role',
            ];

            // Map hành động sang action chuẩn
            $actionMap = [
                'thêm' => 'create', 'tạo' => 'create', 'add' => 'create', 'create' => 'create',
                'cập nhật' => 'edit', 'sửa' => 'edit', 'update' => 'edit', 'edit' => 'edit',
                'xoá' => 'delete', 'thu hồi' => 'delete', 'delete' => 'delete', 'remove' => 'delete',
                'xem danh sách' => 'list', 'lấy danh sách'=> 'list', 'xem' => 'list', 'list' => 'list', 'view' => 'list', 'lấy toàn bộ' => 'list', 'xem tất cả' => 'list', 'lấy tất cả' => 'list',
                'xem chi tiết' => 'detail', 'chi tiết' => 'detail', 'detail' => 'detail', 'xem thông tin' => 'detail', 'getdetail' => 'detail', 'get detail'=> 'detail'
            ];

            $resource = '';
            $action = '';

            // Tìm resource
            foreach ($resourceMap as $vi => $en) {
                if (str_contains($input, $vi)) {
                    $resource = $en;
                    $input = str_replace($vi, '', $input);
                    break;
                }
            }

            // Tìm action
            foreach ($actionMap as $vi => $en) {
                if (str_contains($input, $vi)) {
                    $action = $en;
                    break;
                }
            }

            // Nếu không tìm thấy thì giữ nguyên
            if (!$resource) $resource = 'other';
            if (!$action) $action = 'other';

            $permissions_name = $resource . '.' . $action;

            $now = now();
            DB::table('permissions')->insert([
                'user_creately' => $user->username,
                'permissions_name' => $defaultPermission,
                'type' => $request->type,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('route_permission')->insert([
                'route_name' => $permissions_name,
                'permissions_name' => $defaultPermission,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Permission and route_permission created successfully.',
                'permission' => [
                    'permissions_name' => $defaultPermission,
                    'type' => $request->type,
                    'user_creately' => $user->username,
                    'route_permission' =>$permissions_name,
                    'created_at' => $now,
                    'updated_at' => $now,
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
    public function deletePermission(Request $request)
    {
        try {
            // Xác thực JWT
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            // Validation dữ liệu từ body
            $validator = Validator::make($request->all(), [
                'permissions_name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            // Lấy permissions_name từ body
            $permissionName = $request->input('permissions_name');

            if (!$permissionName) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'permissions_name is required.'
                ], 400);
            }

            // Kiểm tra tồn tại trong permissions
            $permission = DB::table('permissions')->where('permissions_name', $permissionName)->first();

            if (!$permission) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission not found.'
                ], 404);
            }

            // Xóa trong route_permission
            DB::table('route_permission')->where('permissions_name', $permissionName)->delete();

            // Xóa trong permissions
            DB::table('permissions')->where('permissions_name', $permissionName)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Permission deleted successfully.',
                'permissions:' => $permissionName,
            ], 200);
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
    public function getUserCreatePermissions(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            // Lấy username từ query, nếu không có thì lấy từ token
            $username = $request->query('username', $user->username);

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
    public function getPermissionsByType(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            $type = $request->query('type' );

            $permissions = DB::table('permissions')->where('type', 'like', '%' . $type .'%')->get();

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


    public function getPermisionByTime(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            // Nhận và chuyển đổi định dạng ngày từ d/m/Y sang Y-m-d
            $date = $request->query('date'); // dạng: 01/06/2024
            $from = $request->query('from'); // dạng: 01/06/2024
            $to = $request->query('to');     // dạng: 05/06/2024

            // Hàm chuyển đổi d/m/Y sang Y-m-d
            $convertDate = function($str) {
                if (!$str) return null;
                $dt = \DateTime::createFromFormat('d/m/Y', $str);
                return $dt ? $dt->format('Y-m-d') : null;
            };

            $date = $convertDate($date);
            $from = $convertDate($from);
            $to = $convertDate($to);

            $query = DB::table('permissions');

            if ($date) {
                $query->whereDate('created_at', $date);
            } elseif ($from && $to) {
                $query->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            } elseif ($from) {
                $query->whereDate('created_at', '>=', $from);
            } elseif ($to) {
                $query->whereDate('created_at', '<=', $to);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bạn phải nhập ngày (date) hoặc khoảng ngày (from, to) theo định dạng ngày/tháng/năm.'
                ], 400);
            }

            $permissions = $query->get();

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