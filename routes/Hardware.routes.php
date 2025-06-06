<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HardwareController;
use App\Http\Middleware\CheckPermission;

    Route::post('/createhardware', [HardwareController::class, 'createHardware'])
        ->middleware('check.permission')
        ->name('hardware.create');
    Route::get('/getallhardware', [HardwareController::class, 'getAllHardware'])
        ->middleware('check.permission')
        ->name('hardware.list');
    Route::get('/getbyidhardware', [HardwareController::class, 'getHardwareById'])
        ->middleware('check.permission')
        ->name('hardware.getbyid');
    Route::put('/updatehardware', [HardwareController::class, 'updateHardware'])
        ->middleware('check.permission')
        ->name('hardware.update');
    Route::delete('/deletehardware', [HardwareController::class, 'deleteHardware'])
        ->middleware('check.permission')
        ->name('hardware.delete');
