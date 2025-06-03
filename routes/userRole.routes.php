<?php 

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userRoleController;

route::post('createuserrole', [userRoleController::class, 'createUserRole']);