<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/createPermission', [PermissionController::class, 'createPermission']);



?>