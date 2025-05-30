<?php 


use App\Http\Controllers\rolesController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

route::post('/createRole', [rolesController::class, 'createRole']);
route::delete('/deleteRole',[rolesController::class,'deleteRole']);
route::patch('/updateRole', [rolesController::class, 'updateRole']);
route::get('/getRoleByName', [rolesController::class, 'getRoleByName']);
route::get('/getAllRoles', [rolesController::class, 'getAllRoles']);
route::get('/getRolesByUser', [rolesController::class, 'getRolesByUser']);
