<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use app\Http\Middleware\CheckPermission;


//function basic
Route::post('/createPermission', [PermissionController::class, 'createPermission'])
    ->middleware('check.permission')
    ->name('permission.create');

Route::get('/getallpermission', [PermissionController::class, 'getAllPermissions'])
    ->middleware('check.permission')
    ->name('permission.list');

Route::get('/getpermissionbyname', [PermissionController::class,'getPermissionByName']);

Route::patch('/updatepermission', [PermissionController::class,'updatePermission'])
    ->middleware('check.permission')
    ->name('permission.edit');

Route::delete('/deletepermission',  [PermissionController::class,'deletePermission'])
    ->middleware('check.permission')
    ->name('permission.delete');

    
// function sepcific
Route::get('/getusercreatepermission', [PermissionController::class, 'getUserCreatePermissions'])
    ->middleware('check.permission')
    ->name('permission.list');

Route::get('/getpermissionsbytype', [PermissionController::class, 'getPermissionsByType'])
    ->middleware('check.permission')
    ->name('permission.list');

Route::get('/getpermissionbyuserandtype',[PermissionController::class,'getPermissionsByUserAndType'])
    ->middleware('check.permission')
    ->name('permission.list');

Route::get('/getPermissionByUserAndName', [PermissionController::class, 'getPermissionsByUserAndName'])
    ->middleware('check.permission')
    ->name('permission.list');

Route::get('/getPermissionByTypeAndName', [PermissionController::class, 'getPermissionsByTypeAndName'])
    ->middleware('check.permission')
    ->name('permission.list');

Route::get('/getPermissionByUserTypeAndName', [PermissionController::class, 'getPermissionsByUserTypeAndName'])
    ->middleware('check.permission')
    ->name('permission.list');

Route::get('/getpermissionbytime', [PermissionController::class, 'getPermisionByTime'])
    ->middleware('check.permission')
    ->name('permission.list');

Route::get('/getalltypepermission', [PermissionController::class, 'getAllTypePermission'])
    ->middleware('check.permission')
    ->name('permission.list');
