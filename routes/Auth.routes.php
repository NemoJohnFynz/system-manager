<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::post('/createUser', [AuthController::class, 'CreateUser']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/getuser',[AuthController::class, 'getAuthenticatedUser']);
Route::patch('/updateuser', [AuthController::class, 'updateUser']);
Route::patch('/changepassword', [AuthController::class, 'changePassword']);
// Route::get('/getuserbyid/{id}', [UserController::class, 'getUserById']);
route::get('/getallusers', [UserController::class, 'getAllUsers']);
route::get('/getuserbyname', [UserController::class, 'getUserByName']);
route::get('/getuserbyusername', [UserController::class,'getUserByUsername']);

