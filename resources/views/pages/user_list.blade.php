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
                             <tbody>
                                 <?php for ($i = 0; $i < 10; $i++) {
                                    ?>
                                     <tr>
                                         <td>
                                             <div class="avatar-xs">
                                                 <span class="avatar-title rounded-circle">
                                                     D
                                                 </span>
                                             </div>
                                         </td>
                                         <td>
                                             <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">David McHenry</a></h5>
                                             <!-- <p class="text-muted mb-0">UI/UX Designer</p> -->
                                         </td>
                                         <td>david@skote.com</td>
                                         <td>
                                             <div>
                                                 <a href="#" class="badge badge-soft-primary font-size-11 m-1">Photoshop</a>
                                                 <a href="#" class="badge badge-soft-primary font-size-11 m-1">illustrator</a>
                                             </div>
                                         </td>
                                         <td>
                                             125
                                         </td>
                                         <td class="">
                                             <ul class="list-inline font-size-20 contact-links mb-0">
                                                 @hasPermission("user.delete")
                                                 <li class="list-inline-item px-2">
                                                     <a href="" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bx bx-trash"></i></a>
                                                 </li>
                                                 @endhasPermission
                                                 <li class="list-inline-item px-2">
                                                     <a href="" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bx bx-wrench"></i></a>
                                                 </li>
                                                 <li class="list-inline-item px-2">
                                                     <a href="" data-toggle="tooltip" data-placement="top" title="Profile"><i class="bx bx-user-circle"></i></a>
                                                 </li>
                                             </ul>
                                         </td>
                                     </tr>
                                 <?php } ?>
                             </tbody>
                         </table>
                     </div>
                     <div class="row">
                         <div class="col-lg-12">
                             <ul class="pagination pagination-rounded justify-content-center mt-4">
                                 <li class="page-item disabled">
                                     <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                 </li>
                                 <li class="page-item">
                                     <a href="#" class="page-link">1</a>
                                 </li>
                                 <li class="page-item active">
                                     <a href="#" class="page-link">2</a>
                                 </li>
                                 <li class="page-item">
                                     <a href="#" class="page-link">3</a>
                                 </li>
                                 <li class="page-item">
                                     <a href="#" class="page-link">4</a>
                                 </li>
                                 <li class="page-item">
                                     <a href="#" class="page-link">5</a>
                                 </li>
                                 <li class="page-item">
                                     <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endhasPermission
 @endsection