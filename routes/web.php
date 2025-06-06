<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/login', function () {
    return view('pages/login');
});

Route::get('/apis', function () {
    return view('scribe/index');
});

Route::middleware(['check.login'])->group(function () {

    Route::get('/', function (Request $request) {
        $user = $request->attributes->get('user');
        $permissions = $request->attributes->get('permissions');
        $permissionMap = [
            "lấy danh sách người dùng" => "user.detail",
        ];
        return view('pages/hardware_detail', [
            'user' => $user,
            'permissions' => $permissions,
            'permissionMap' =>  $permissionMap,
        ]);
    });

    Route::get('/{page}', function ($page, Request $request) {
        $view = 'pages.' . str_replace('/', '.', $page);

        if (View::exists($view)) {
            $user = $request->attributes->get('user');
            $permissions = $request->attributes->get('permissions');
            $permissionMap = [
                "lấy danh sách người dùng" => "user.detail",
            ];
            return view($view, [
                'page' => $page,
                'user' => $user,
                'permissions' => $permissions,
                'permissionMap' =>  $permissionMap,
            ]);
        } else {
            return view('pages_not_found');
        }
    })->where('page', '.*');
});
