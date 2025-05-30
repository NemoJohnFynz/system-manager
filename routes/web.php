<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AuthController;

// Route riêng cho root "/"
Route::get('/', function () {
    return view('home'); // hoặc 'welcome', hoặc trang chính của bạn
});


Route::get('/{page}', function ($page) {
    // Chuyển đổi thành tên view trong thư mục 'pages'
    $view = 'pages.' . str_replace('/', '.', $page);

    if (View::exists($view)) {
        return view($view, ['page' => $page]);
    }

    abort(404);
})->where('page', '.*');