<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\LogController;

Route::get('/getalllogs', [LogController::class,'getLogByType']);