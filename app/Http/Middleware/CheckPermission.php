<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Models\permissionModel;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;


class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Bước 1: Lấy thông tin người dùng từ token JWT
            // Sẽ tốt hơn nếu việc xác thực này được thực hiện bởi một middleware riêng (ví dụ: 'auth:api') trước middleware này.
            // Tuy nhiên, giữ lại ở đây nếu đây là middleware duy nhất xử lý cả auth và permission.
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                // Trường hợp này hiếm khi xảy ra nếu parseToken()->authenticate() thành công mà user lại null,
                // vì nó thường throw exception nếu không xác thực được.
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not authenticated.' // Thông báo rõ ràng hơn
                ], 401);
            }

            // Bước 2: Lấy danh sách vai trò của người dùng
            // Cân nhắc sử dụng Eloquent relationship nếu User model của bạn đã định nghĩa: $user->roles()->pluck('role_name')->all();
            $userRoles = DB::table('user_role')
                ->where('username', $user->username)
                ->pluck('role_name')
                ->all(); // Sử dụng all() thay cho toArray() với pluck

            if (empty($userRoles)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User has no roles assigned.'
                ], 403);
            }

            // Bước 3: Lấy danh sách tất cả quyền (permission_name) của người dùng dựa trên vai trò
            // Cache key nên bao gồm một yếu tố thay đổi khi quyền của user thay đổi, ví dụ version hoặc timestamp.
            // Hiện tại, đơn giản là username.
            $cacheKeyUserPermissions = 'user_permissions_' . $user->username;
            $userPermissions = Cache::remember($cacheKeyUserPermissions, now()->addHours(1), function () use ($userRoles) {
                return DB::table('role_permissions')
                    ->whereIn('role_name', $userRoles)
                    ->pluck('permission_name') // Giả định 'permission_name' trong 'role_permissions' là tên quyền chuẩn
                    ->unique() // Đảm bảo các quyền là duy nhất
                    ->all();
            });

            // Bước 4: Lấy tên route hiện tại
            $routeName = Route::currentRouteName();
                if (!$routeName) {
                    $incidentId = uniqid('ROUTE_NAME_ERR_');
                    Log::critical("Unnamed Route Accessed - Incident ID: {$incidentId}", [
                        'url' => $request->fullUrl(), 
                        'user' => $user->username, 
                        // 'user_id' => $user->getKey(),
                        'ip_address' => $request->ip(), 'user_agent' => $request->userAgent(),
                    ]);
                    // Ví dụ gửi notification (cần setup User model và Notification class)
                    // $adminUsers = User::where('some_admin_flag', true)->get();
                    // if ($adminUsers->isNotEmpty()) {
                    //     Notification::send($adminUsers, new UnnamedRouteAccessedNotification($request->fullUrl(), $user, $incidentId));
                    // }
                    return response()->json([
                        'status' => 'config_error',
                        'message' => 'A critical configuration error occurred. The requested action could not be processed. Please contact support.',
                        'incident_id' => $incidentId,
                        'reference_note' => 'Route for this action is not properly named.'
                    ], 500);
            }

            $requiredPermissionName = null;

            // Bước 5: Xác định quyền cần thiết cho route
            // Bước 5.1: Ưu tiên kiểm tra trong bảng `route_permission` (override)
            // Tên bảng trong migration bạn cung cấp là 'route_permission', không phải 'route_permissions'
            // Tên cột trong migration bạn cung cấp là 'permissions_name', không phải 'permission_name'
            $cacheKeyRouteOverride = 'route_override_permission_' . $routeName;
            $permissionOverride = Cache::remember($cacheKeyRouteOverride, now()->addHours(1), function () use ($routeName) {
                return DB::table('route_permission') // SỬA TÊN BẢNG CHO KHỚP MIGRATION
                    ->where('route_name', $routeName)
                    ->value('permissions_name'); // SỬA TÊN CỘT CHO KHỚP MIGRATION
            });

            if ($permissionOverride) {
                $requiredPermissionName = $permissionOverride;
            } else {
                // Bước 5.2: Nếu không có override, tự động suy luận tên quyền chuẩn
                $parts = explode('.', $routeName);
                if (count($parts) >= 2) {
                    $resource = $parts[0];
                    $actionFromRoute = $parts[1];
                    $standardizedPermissionAction = '';

                    // Logic suy luận tên action chuẩn của permission từ action của route
                    switch (strtolower($actionFromRoute)) { // Chuyển sang chữ thường để đồng nhất
                        case 'index':
                        case 'show':
                        case 'get':
                        case 'list':
                        case 'getlist':
                            $standardizedPermissionAction = 'view';
                            break;
                        case 'create': // Route để hiển thị form
                        case 'store':  // Route để xử lý tạo mới
                        case 'add':    // Thêm 'add' nếu có thể dùng
                        case 'new':    // Thêm 'new' nếu có thể dùng
                            $standardizedPermissionAction = 'create';
                            break;
                        case 'edit':   // Route để hiển thị form sửa
                        case 'update': // Route để xử lý cập nhật
                            $standardizedPermissionAction = 'edit';
                            break;
                        case 'destroy':
                        case 'delete': // Thêm 'delete' nếu có thể dùng
                            $standardizedPermissionAction = 'delete';
                            break;
                        // Thêm các action tùy chỉnh và ánh xạ của chúng ở đây
                        // ví dụ: case 'export': $standardizedPermissionAction = 'export'; break;
                        default:
                            // Nếu action không nằm trong danh sách chuẩn, có thể gán trực tiếp
                            // hoặc bỏ qua nếu không muốn tự động suy luận cho các action lạ
                            // $standardizedPermissionAction = $actionFromRoute;
                            break;
                    }

                    if (!empty($standardizedPermissionAction)) {
                        $potentialPermissionName = "{$resource}.{$standardizedPermissionAction}";

                        // Kiểm tra xem quyền suy luận này có thực sự tồn tại trong bảng `permissions` không
                        // Sử dụng Model Permission đã import
                        if (permissionModel::where('permissions_name', $potentialPermissionName)->exists()) {
                            $requiredPermissionName = $potentialPermissionName;
                        } else {
                            Log::warning("CheckPermission: Inferred permission '{$potentialPermissionName}' for route '{$routeName}' does not exist in permissions table.");
                        }
                    }
                }
            }

            // Bước 5.3: Nếu không xác định được quyền cần thiết (cả override và suy luận)
            if (!$requiredPermissionName) {
                // Nếu một route có tên nhưng không có quyền nào được cấu hình/suy luận, nên coi là lỗi.
                Log::error("CheckPermission: Permission for route '{$routeName}' could not be determined.", ['user' => $user->username]);
                return response()->json([
                    'status' => 'error',
                    'message' => "Access Denied: Permission for the requested action ('{$routeName}') is not configured or could not be inferred."
                ], 403);
            }

            // Bước 6: Kiểm tra xem người dùng có quyền cần thiết không
            if (!in_array($requiredPermissionName, $userPermissions)) {
                Log::warning("CheckPermission: User '{$user->username}' lacks permission '{$requiredPermissionName}' for route '{$routeName}'.", ['user_permissions' => $userPermissions]);
                return response()->json([
                    'status' => 'error',
                    'message' => "Access Denied: You do not have the required permission ('{$requiredPermissionName}') to perform this action."
                ], 403);
            }

            // Bước 7: Nếu có quyền, tiếp tục xử lý yêu cầu
            return $next($request);

        } catch (TokenExpiredException $e) {
            Log::info('CheckPermission: Token has expired.', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'token_expired', 'message' => 'Token has expired. Please login again.'], 401);
        } catch (TokenInvalidException $e) {
            Log::info('CheckPermission: Token is invalid.', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'token_invalid', 'message' => 'Token is invalid. Please login again.'], 401);
        } catch (JWTException $e) { // Bắt các lỗi JWT khác chung hơn
            Log::warning('CheckPermission: JWT error.', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'token_absent_or_malformed', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Throwable $e) { // Sử dụng \Throwable để bắt cả Error và Exception trong PHP 7+
            Log::error('CheckPermission Middleware Unexpected Error: ' . $e->getMessage(), [
                'user' => isset($user) ? $user->username : 'N/A',
                'route' => isset($routeName) ? $routeName : $request->path(),
                'exception_trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected server error occurred. Please try again later.'
            ], 500);
        }
    }
}