<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\client\AuthController;

// Route riêng cho root "/"
Route::get('/', function () {
    return view('pages/software_manager'); // hoặc 'welcome', hoặc trang chính của bạn
});
Route::get('/apis', function () {
    return view('scribe/index'); // hoặc 'welcome', hoặc trang chính của bạn
});


Route::get('/{page}', function ($page) {
    // Chuyển đổi thành tên view trong thư mục 'pages'
    $view = 'pages.' . str_replace('/', '.', $page);

    if (View::exists($view)) {
        return view($view, ['page' => $page]);
    } else {
        return view('pages_not_found');
    }
})->where('page', '.*');

// Password Reset Routes
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');