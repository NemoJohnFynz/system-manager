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
    Route::get('/', function () {
        return view('pages/hardware_detail');
    });
    Route::get('/{page}', function (Request $request, $page) {
        // Chuyển thành tên view trong thư mục 'pages'
        $view = 'pages.' . str_replace('/', '.', $page);
        if (View::exists($view)) {
            $user = $request->attributes->get('user');
            return view($view, ['page' => $page, 'user' => $user]);
        } else {
            return view('pages_not_found');
        }
    })->where('page', '.*');
});
