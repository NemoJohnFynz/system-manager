<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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
</body>

</html>