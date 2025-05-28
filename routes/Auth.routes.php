<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/getuser',[AuthController::class, 'getAuthenticatedUser']);
Route::patch('/updateuser', [AuthController::class, 'updateUser']);
Route::patch('/changepassword', [AuthController::class, 'changePassword']);
?>