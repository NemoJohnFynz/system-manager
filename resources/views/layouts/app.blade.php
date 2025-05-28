<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Trang chung')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body> 
    {{-- Phần nội dung riêng từng trang --}}
    @yield('content')

    {{-- Phần script riêng từng trang --}}
    @yield('scripts')
</body>
</html>
