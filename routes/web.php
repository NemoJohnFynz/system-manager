<?php 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View; 
use App\Http\Controllers\AuthController;

// Route riêng cho root "/"
Route::get('/', function () {
    return view('home'); // hoặc 'welcome', hoặc trang chính của bạn
});

Route::get('/{page}', function ($page) {
    $view = str_replace('/', '.', $page);
    
    if (View::exists($view)) {
        return view($view);
    }
    abort(404);
})->where('page', '.*');
