@extends('layouts.app')

@section('title', 'Trang Đăng Nhập')

@section('content')
    <form id="loginForm" action="/login" method="POST">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <button type="submit">Login</button>
    </form>

    <button id="deleteButton">Xóa</button>

    <div id="error" style="color:red;"></div>
@endsection

@section('scripts')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
