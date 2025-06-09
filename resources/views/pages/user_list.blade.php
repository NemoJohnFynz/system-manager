@extends('layouts.app')
@section('content')
<div>
    @hasPermission("user.list")
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 font-size-18">Danh sách người dùng</h4>
            <button onclick="loadModal('/create_user')">Xem Modal Từ Server</button>
            @hasPermission("user.create")
            <a href="/users/create" class="btn btn-primary">Thêm người dùng</a>
            @endhasPermission
        </div>
    </div>
    <div class="row" aria-hidden="true">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>
                                    <th scope="col">Họ và tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Quyền hạng</th>
                                    <th scope="col">Projects</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="user-table-body">
                                <!-- Dữ liệu sẽ được load vào đây -->
                            </tbody>
                        </table>
                    </div>
                    <!-- pagination ... -->
                </div>
            </div>
        </div>
    </div>
</div>
@php
// Truyền token cho JS
$token = $token ?? null;
@endphp
<script>
    window.appConfig = {
        apiToken: @json($token),
        apiUrl: '{{ url('
        api / getallusers ') }}',
    };
</script>
<script src="{{ asset('js/user_list.js') }}"></script>
@endhasPermission
@endsection