<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// }); 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/{page}', function ($page) {
    if (View::exists($page)) {
        return view($page);
    }
    abort(404);
})->where('page', '.*');
