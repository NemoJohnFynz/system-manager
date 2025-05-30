<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="assets\css\bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <link href="assets\css\app.min.css" id="app-style" rel="stylesheet" type="text/css">
    @php
    $routeName = Route::currentRouteName();
    @endphp
    @php
    $cssPath = isset($page) ? 'css/' . $page . '.css' : null;
    @endphp

    @if($cssPath && file_exists(public_path($cssPath)))
    <link href="{{ asset($cssPath) }}" rel="stylesheet" />
    @endif 
</head>

<body>
    @include('layouts.navbar') 
    <main class="main-content">
        @yield('content')

    </main> 
    @yield('scripts')
    @php
    $routeName = Route::currentRouteName();
    @endphp
    @php
    $cssPath = isset($page) ? 'js/' . $page . '.js' : null;
    @endphp

    @if($cssPath && file_exists(public_path($cssPath)))
    <script src="{{ asset($cssPath) }}"></script>
    @endif
    
</body>

</html>
