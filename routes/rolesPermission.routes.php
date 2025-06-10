<?php 

use App\Http\Controllers\rolepermissionController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


route::post('/createrolepermission', [rolepermissionController::class, 'createRolePermission']);
route::patch('/updateRolePermission', [rolepermissionController::class, 'updateRolePermission']);
route::delete('/deleteRolePermission', [rolepermissionController::class, 'deleteRolePermission']);
route::get('/getAllrolePermission', [rolepermissionController::class, 'getAllRolePermissions']);
route::get('/getRolePermissionByName', [rolepermissionController::class, 'getRolePermissionByName']);