<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @php
    $routeName = Route::currentRouteName(); // Lấy tên route hiện tại
    @endphp
    @php
    $cssPath = isset($page) ? 'css/' . $page . '.css' : null;
    @endphp

    @if($cssPath && file_exists(public_path($cssPath)))
    <link href="{{ asset($cssPath) }}" rel="stylesheet" />
    @endif
    <!-- Fonts -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Common assets --}}
    @yield('head') {{-- Inject per-page Vite assets --}} -->
</head>

<body>
    {{-- Phần navbar --}}
    @include('layouts.navbar')
    {{-- Phần thông báo lỗi --}}
    {{-- Phần nội dung riêng từng trang --}}
    <!-- <div class="container mt-4">    
        @yield('content')
    </div> -->


    {{-- Phần script riêng từng trang --}}
    @yield('scripts')
    @php
    $routeName = Route::currentRouteName(); // Lấy tên route hiện tại
    @endphp
    @php
    $cssPath = isset($page) ? 'js/' . $page . '.js' : null;
    @endphp

    @if($cssPath && file_exists(public_path($cssPath))) 
    <script src="{{ asset($cssPath) }}"></script>
    @endif
</body>

</html>