<?php 

use App\Http\Controllers\role_permissionController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


route::post('/createrolepermission', [role_permissionController::class, 'createRolePermission']);
route::patch('/updateRolePermission', [role_permissionController::class, 'updateRolePermission']);
route::delete('/deleteRolePermission', [role_permissionController::class, 'deleteRolePermission']);
route::get('/getAllrolePermission', [role_permissionController::class, 'getAllRolePermissions']);
route::get('/getRolePermissionByName', [role_permissionController::class, 'getRolePermissionByName']);