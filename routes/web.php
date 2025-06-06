<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
Route::get('/login', fn() => view('pages/login'));
Route::get('/apis', fn() => view('scribe/index'));
Route::middleware(['check.login'])->group(function () {
    $getCommonData = fn(Request $request) => [
        'user' => $request->attributes->get('user'),
        'permissions' => $request->attributes->get('permissions'),
    ];
    Route::get('/', function (Request $request) use ($getCommonData) {
        return view('pages/hardware_detail', $getCommonData($request));
    });
    Route::get('/{page}', function ($page, Request $request) use ($getCommonData) {
        $view = 'pages.' . str_replace('/', '.', $page);
        if (View::exists($view)) {
            return view($view, array_merge(['page' => $page], $getCommonData($request)));
        }
        return view('pages_not_found');
    })->where('page', '.*');
});