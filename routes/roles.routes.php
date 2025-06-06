<?php 


use App\Http\Controllers\rolesController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

route::post('/createrole', [rolesController::class, 'createRole']);
route::delete('/deleterole',[rolesController::class,'deleteRole']);
route::patch('/updaterole', [rolesController::class, 'updateRole']);
route::get('/getrolebyname', [rolesController::class, 'getRoleByName']);
route::get('/getallroles', [rolesController::class, 'getAllRoles']);
route::get('/getrolesbyuser', [rolesController::class, 'getRolesByUser']);
