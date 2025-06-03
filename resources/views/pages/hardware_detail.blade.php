 @extends('layouts.app')
 @section('content')
 <div class="row">
     <div class="col-12">
         <div
             class="page-title-box d-flex align-items-center justify-content-between">
             <h4 class="mb-0 font-size-18">Chi tiết phần cứng</h4>

         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-xl-4">
         <div class="card overflow-hidden">
             <div class="bg-soft-primary">
                 <div class="row">
                     <div class="col-6">
                         <div class="text-primary p-3">
                             <h5 class="text-primary">Máy ảo</h5>
                             <p>Ip: 192.168.1.140</p>
                         </div>
                     </div>
                     <div class="col-6">
                         <div class="text-primary p-3">
                             <h5 class="text-primary">Domain</h5>
                             <p> website.com.vn</p>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="card-body pt-0">
                 <div class="row">
                     <div class="col-sm-4">
                         <div class=" profile-user-wid aspect-square" style=" aspect-ratio: 1 / 1;">
                             <img
                                 src="/images/img-1.jpg"
                                 alt=""
                                 style=" aspect-ratio: 1 / 1;"
                                 class="img-thumbnail rounded-circle" />
                         </div>
                         <h5 class="font-size-15 text-truncate">
                             Domain:
                         </h5>
                         <p class="text-muted mb-0 text-truncate">
                             website.com.vn
                         </p>
                     </div>

                     <div class="col-sm-8">
                         <div class="pt-4">
                             <div class="row">
                                 <div class="col-6">
                                     <h5 class="font-size-15">Lần cập nhật gần nhất</h5>
                                     <p class="text-muted mb-0">
                                         3/6/2025
                                     </p>
                                 </div>
                                 <div class="col-6">
                                     <h5 class="font-size-15">Tạo bởi</h5>
                                     <p class="text-muted mb-0">
                                         ONO
                                     </p>
                                 </div>

                             </div>
                             <div class="mt-4">
                                 <a
                                     href=""
                                     class="btn btn-primary waves-effect waves-light btn-sm">View Domain
                                     <i
                                         class="mdi mdi-arrow-right ml-1"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- end card -->

         <div class="card">
             <div class="card-body">
                 <h4 class="card-title mb-4">Thông tin kỹ thuật</h4>

                 <div class="table-responsive">
                     <table class="table table-nowrap mb-0">
                         <tbody>
                             <tr>
                                 <th scope="row">HDD :</th>
                                 <td>1 TG</td>
                             </tr>
                             <tr>
                                 <th scope="row">Ram :</th>
                                 <td>524 MB</td>
                             </tr>
                             <tr>
                                 <th scope="row" class="text-primary">Database :</th>
                                 <td>Mysql</td>
                             </tr>
                             <tr>
                                 <th scope="row" class="text-primary"> Database Version:</th>
                                 <td>1.0.0</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         <!-- end card -->

         <div class="card">
             <div class="card-body">
                 <h4 class="card-title mb-5">Lịch sử thay đổi</h4>
                 <div class="">
                     <ul class="verti-timeline list-unstyled">
                         <li class="event-list active">
                             <div class="event-timeline-dot">
                                 <i
                                     class="bx bx-right-arrow-circle bx-fade-right"></i>
                             </div>
                             <div class="media">
                                 <div class="mr-3">
                                     <i
                                         class="bx bx-server h4 text-primary"></i>
                                 </div>
                                 <div class="media-body">
                                     <div>
                                         <h5 class="font-size-15">
                                             <a
                                                 href="#"
                                                 class="text-dark">Dung lượng ở cứng vừa được thay đổi</a>
                                         </h5>
                                         <span class="text-primary">3/6/2025</span>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="event-list">
                             <div class="event-timeline-dot">
                                 <i class="bx bx-right-arrow-circle"></i>
                             </div>
                             <div class="media">
                                 <div class="mr-3">
                                     <i
                                         class="bx bx-code h4 text-primary"></i>
                                 </div>
                                 <div class="media-body">
                                     <div>
                                         <h5 class="font-size-15">
                                             <a
                                                 href="#"
                                                 class="text-dark">Mini đã thay đổi thông tin dịch vụ</a>
                                         </h5>
                                         <span class="text-primary">16/5/2013</span>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="event-list">
                             <div class="event-timeline-dot">
                                 <i class="bx bx-right-arrow-circle"></i>
                             </div>
                             <div class="media">
                                 <div class="mr-3">
                                     <i
                                         class="bx bx-edit h4 text-primary"></i>
                                 </div>
                                 <div class="media-body">
                                     <div>
                                         <h5 class="font-size-15">
                                             <a
                                                 href="#"
                                                 class="text-dark">Admin đã sửa ip phần cứng</a>
                                         </h5>
                                         <span class="text-primary">10/5/2013</span>
                                     </div>
                                 </div>
                             </div>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>

         <div class="card">
             <div class="card-body">
                 <h4 class="card-title mb-4 text-primary">Điều khoản và Pháp lý sử dụng</h4>
                 <div id="revenue-chart" class="apex-charts ">
                     <p class="text-muted mb-4">
                         Không s
                     </p>
                     <p class="text-muted mb-4">
                         không được phép lạm dụng lỗ hỏng trong
                     </p>
                 </div>
             </div>
         </div> <!-- end card -->
     </div>

     <div class="col-xl-8">
         <div class="row">
             <div class="col-md-4">
                 <div class="card mini-stats-wid">
                     <div class="card-body">
                         <div class="media">
                             <div class="media-body">
                                 <p
                                     class="text-muted font-weight-medium">
                                     Phát hành
                                 </p>
                                 <h4 class="mb-0">2/4/2025</h4>
                             </div>

                             <div
                                 class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary">
                                 <span class="avatar-title">
                                     <i
                                         class="bx bx-check-circle font-size-24"></i>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="card mini-stats-wid">
                     <div class="card-body">
                         <div class="media">
                             <div class="media-body">
                                 <p
                                     class="text-muted font-weight-medium">
                                     Trạng thái phần cứng
                                 </p>
                                 <h4 class="mb-0">đang hoạt động</h4>
                             </div>

                             <div
                                 class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                 <span class="avatar-title">
                                     <i
                                         class="bx bx-hourglass font-size-24"></i>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="card mini-stats-wid">
                     <div class="card-body">
                         <div class="media">
                             <div class="media-body">
                                 <p
                                     class="text-muted font-weight-medium">
                                     Sản xuất
                                 </p>
                                 <h4 class="mb-0">9001 domain</h4>
                             </div>

                             <div
                                 class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                 <span class="avatar-title">
                                     <i
                                         class="bx bx-package font-size-24"></i>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="card">
             <div class="card-body">
                 <h4 class="card-title mb-4">dịch vụ</h4>
                 <div id="revenue-chart" class="apex-charts">
                     <p class="text-muted mb-4">
                         cung cấp máy ảo VPS, server hosting,.. sẵn sàng hỗ trợ các bạn tậng tâm. chúng tôi vui lòng tiếp nhận nhận
                     </p>
                 </div>
             </div>
         </div>

         <div class="card">
             <div class="card-body">
                 <h4 class="card-title mb-4">Thành viên quản lý phần cứng</h4>
                 <div class="table-responsive">
                     <table class="table table-nowrap table-hover mb-0">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">tên</th>
                                 <th scope="col">Ngày tham gia</th>
                                 <th scope="col">Quyền hạng</th>
                                 <th scope="col">Thao tác</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                for ($i = 0; $i < 13; $i++) {
                                ?>
                                 <tr>
                                     <th scope="row"><?php echo $i ?></th>
                                     <td>ONOOOOO</td>
                                     <td>2 Sep, 2019</td>
                                     <td><?= ($i % 3 == 1) ? "manager" : "editer" ?></td>
                                     <td>
                                         <ul class="list-inline font-size-20   mb-0">
                                             <li class="list-inline-item">
                                                 <a href="" data-toggle="tooltip" data-placement="top" title="Message"><i class="bx bx-trash"></i></a>
                                             </li>
                                             <li class="list-inline-item">
                                                 <a href="" data-toggle="tooltip" data-placement="top" title="Profile"><i class="bx bx-wrench"></i></a>
                                             </li>
                                             <li class="list-inline-item">
                                                 <a href="" data-toggle="tooltip" data-placement="top" title="Profile"><i class="bx bx-user-circle"></i></a>
                                             </li>
                                         </ul>
                                     </td>
                                 </tr>
                             <?php } ?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>


     </div>
 </div>
 @endsection