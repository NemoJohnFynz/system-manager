<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


Route::post('/createPermission', [PermissionController::class, 'createPermission']);
Route::get('/getAllPermission', [PermissionController::class, 'getAllPermissions']);
Route::get('/getPermissionByName', [PermissionController::class,'getPermissionByName']);
Route::patch('/updatePermission', [PermissionController::class,'updatePermission']);
Route::delete('/deletePermission', [PermissionController::class,'deletePermission']);
Route::get('/getAllPermissionsByUser', [PermissionController::class, 'getPermissionsByUser']);
Route::get(('/getPermissionsByType'), [PermissionController::class, 'getPermissionsByType']);
Route::get('/getPermissionByUserAndType',[PermissionController::class,'getPermissionsByUserAndType']);
Route::get('/getPermissionByUserAndName', [PermissionController::class, 'getPermissionsByUserAndName']);
Route::get('/getPermissionByTypeAndName', [PermissionController::class, 'getPermissionsByTypeAndName']);
Route::get('/getPermissionByUserTypeAndName', [PermissionController::class, 'getPermissionsByUserTypeAndName']);
Route::get('/getPermissionByTime', [PermissionController::class, 'getPermisionByTime']);
