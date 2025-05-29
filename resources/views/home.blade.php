@extends('layouts.app') 
@section('title', 'Dashboard Home') 
<!-- section('head')
 vite(['resources/css/home.css', 'resources/js/home.js'])
endsection -->
@section('content')
<div class="dashboard-overview">
    <h2>Overview</h2>
    <div class="dashboard-container">
        <div class="dashboard-left">
            <h3>Quy định về việc sử dụng máy tính:</h3>
            <p>Các quy tắc về việc sử dụng các thiết bị ngoại vi (bàn phím, chuột, màn hình), bảo vệ máy tính khỏi bụi bẩn và các tác nhân bên ngoài.
                <strong>2025</strong>
            </p>
        </div>
        <div class="dashboard-right">
            <h3>Quy trình bảo trì máy tính:</h3>
            <ul>
                <li>Các bước cần thực hiện để vệ sinh máy tính, thay thế linh kiện, kiểm tra hiệu suất của các thành phần.</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <h1>Welcome to the Home Page</h1>
        <p>Quy tắc sử dụng:
            Làm thế nào để sử dụng phần cứng một cách an toàn và hiệu quả.
            Quy trình bảo trì:
            Các bước cần thực hiện để duy trì hoạt động của phần cứng.
            Tiêu chuẩn kỹ thuật:
            Các thông số, tiêu chuẩn cần đáp ứng để đảm bảo chất lượng của phần cứng.
            Quy định về an toàn:
            Các biện pháp để đảm bảo an toàn khi sử dụng và bảo trì phần cứng.
            Ví dụ về quy chế phần cứng:</p>
    </div>
    <div class="content">
        <h2>Content Section</h2>
        <p>Vai trò quan trọng:.</p>
        <ul>
            <li> ?js 1</li>
            <li> 2</li>
            <li> 3</li>
        </ul>
        <p>Phần cứng là nền tảng để phần mềm hoạt động, và việc bảo trì, sửa chữa, và quản lý phần cứng tốt sẽ đảm bảo hệ thống hoạt động hiệu quả và ổn định. </p>
    </div>
    <div class="footer">
        <p>&copy; 2023 Your Company. All rights reserved.</p>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection