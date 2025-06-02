<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use app\Http\Middleware\CheckPermission;

Route::post('/createPermission', [PermissionController::class, 'createPermission']);
Route::get('/getallpermission', [PermissionController::class, 'getAllPermissions']);
Route::get('/getpermissionbyname', [PermissionController::class,'getPermissionByName']);
Route::patch('/updatepermission', [PermissionController::class,'updatePermission']);
Route::delete('/deletepermission',  [PermissionController::class,'deletePermission']);
Route::get('/getusercreatepermission', [PermissionController::class, 'getUserCreatePermissions']);
Route::get('/getpermissionsbytype', [PermissionController::class, 'getPermissionsByType']);
Route::get('/getpermissionbyuserandtype',[PermissionController::class,'getPermissionsByUserAndType']);
Route::get('/getPermissionByUserAndName', [PermissionController::class, 'getPermissionsByUserAndName']);
Route::get('/getPermissionByTypeAndName', [PermissionController::class, 'getPermissionsByTypeAndName']);
Route::get('/getPermissionByUserTypeAndName', [PermissionController::class, 'getPermissionsByUserTypeAndName']);
Route::get('/getpermissionbytime', [PermissionController::class, 'getPermisionByTime']);
