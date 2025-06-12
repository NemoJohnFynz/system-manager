 @extends('layouts.app')
 @section('content')
 <div class="row">
     <div class="col-12">
         <div class="page-title-box d-flex align-items-center justify-content-between">
             <h4 class="mb-0 font-size-18">Danh sách quyền hạng</h4>

             <div class="page-title-right">
                 <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Role</a></li>
                     <li class="breadcrumb-item active">Role List</li>
                 </ol>
             </div>

         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-lg-12">
         <div class="">
             <div class="table-responsive">
                 <table class="table project-list-table table-nowrap table-centered table-borderless">
                     <thead>
                         <tr>
                             <th scope="col">Tên Quyền Hạng</th>
                             <th scope="col">Permission</th>
                             <th scope="col">Ngày tạo</th>
                             <th scope="col">Người dùng liên quan</th>
                             <th scope="col">Action</th>
                         </tr>
                     </thead>
                     <tbody id="role-table-body"></tbody>
                     <!-- <tbody>
                         <tr>
                             <td>
                                 <h5 class="text-truncate font-size-14"><a href="#" class="text-dark">admin</a></h5>
                                 <p class="text-muted mb-0">It will beeeeeeeeeeeeeeeeeeeeeeeeeee    </p>
                             </td>
                             <td>
                                 <div class="role_permission_list">
                                     <span class="badge badge-primary">Thêm phần cứng</span>
                                     <span class="badge badge-primary">Thêm phần mềm</span>
                                     <span class="badge badge-secondary">29+</span>
                                 </div>
                             </td>

                             <td>12/6/2025</td>

                             <td>
                                 <div class="team">
                                     <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Daniel Canales">
                                         <img src="assets\images\users\avatar-2.jpg" class="rounded-circle avatar-xs m-1" alt="">
                                     </a>

                                     <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jennifer Walker">
                                         <img src="assets\images\users\avatar-1.jpg" class="rounded-circle avatar-xs m-1" alt="">
                                     </a>

                                 </div>
                             </td>
                             <td>
                                 <div class="dropdown">
                                     <button class="btn btn-link p-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                     </button>
                                     <div class="dropdown-menu dropdown-menu-right">
                                         <button class="dropdown-item" type="button">sửa</button>
                                         <button class="dropdown-item" type="button">Xem permission</button>
                                         <button class="dropdown-item" type="button">Xem chi tiết</button>
                                     </div>
                                 </div>
                             </td>
                         </tr>
                     </tbody> -->
                 </table>
             </div>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-12">
         <div class="text-center my-3">
             <a href="javascript:void(0);" class="text-success"><i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more </a>
         </div>
     </div> <!-- end col-->
 </div>
 @vite('resources/js/pages/roles.js')
 @endsection