 @extends('layouts.app') 
 @section('content')

 <div>
     <div class="container-fluid">
         <div class="row">
             <div class="col-12">
                 <div class="page-title-box d-flex align-items-center justify-content-between">
                     <h4 class="mb-0 font-size-18">software manager</h4>
                 </div>
             </div>
         </div>
         <?php
            for ($i = 0; $i < 3; $i++) {
            ?>
             <div class="row">
                 <div class="col-xl-4 col-sm-6">
                     <div class="card">
                         <div class="card-body">
                             <div class="media">
                                 <div class="avatar-md mr-4">
                                     <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                         <img src="images\img-1.jpg" alt="" height="30">
                                     </span>
                                 </div>

                                 <div class="media-body overflow-hidden">
                                     <h5 class="text-truncate font-size-15"><a href="#" class="text-dark">New admin Design</a></h5>
                                     <p class="text-muted mb-4">It will be as simple as Occidental</p>
                                     <div class="team">
                                         <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Daniel Canales">
                                             <img src="images\avatar-1.jpg" class="rounded-circle avatar-xs m-1" alt="">
                                         </a>

                                         <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jennifer Walker">
                                             <img src="images\avatar-1.jpg" class="rounded-circle avatar-xs m-1" alt="">
                                         </a>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="px-4 py-3 border-top">
                             <ul class="list-inline mb-0">
                                 <li class="list-inline-item mr-3">
                                     <span class="badge badge-primary">Completed</span>
                                 </li>
                                 <li class="list-inline-item mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Due Date">
                                     <i class="bx bx-calendar mr-1"></i> 15 Oct, 19
                                 </li>
                                 <li class="list-inline-item mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Comments">
                                     <i class="bx bx-comment-dots mr-1"></i> 214
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>

                 <div class="col-xl-4 col-sm-6">
                     <div class="card">
                         <div class="card-body">
                             <div class="media">
                                 <div class="avatar-md mr-4">
                                     <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                         <img src="images\img-1.jpg" alt="" height="30">
                                     </span>
                                 </div>

                                 <div class="media-body overflow-hidden">
                                     <h5 class="text-truncate font-size-15"><a href="#" class="text-dark">Brand logo design</a></h5>
                                     <p class="text-muted mb-4">To achieve it would be necessary</p>
                                     <div class="team">
                                         <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kenneth Johnson">
                                             <img src="images\avatar-1.jpg" class="rounded-circle avatar-xs m-1" alt="">
                                         </a>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="px-4 py-3 border-top">
                             <ul class="list-inline mb-0">
                                 <li class="list-inline-item mr-3">
                                     <span class="badge badge-warning">Pending</span>
                                 </li>
                                 <li class="list-inline-item mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Due Date">
                                     <i class="bx bx-calendar mr-1"></i> 22 Oct, 19
                                 </li>
                                 <li class="list-inline-item mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Comments">
                                     <i class="bx bx-comment-dots mr-1"></i> 183
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>

                 <div class="col-xl-4 col-sm-6">
                     <div class="card">
                         <div class="card-body">
                             <div class="media">
                                 <div class="avatar-md mr-4">
                                     <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                         <img src="images\img-1.jpg" alt="" height="30">
                                     </span>
                                 </div>

                                 <div class="media-body overflow-hidden">
                                     <h5 class="text-truncate font-size-15"><a href="#" class="text-dark">New Landing Design</a></h5>
                                     <p class="text-muted mb-4"> For science, music, sport, etc</p>
                                     <div class="team">
                                         <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Natalie Salerno">
                                             <img src="images\avatar-1.jpg" class="rounded-circle avatar-xs m-1" alt="">
                                         </a>
                                         <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Andy Miller">
                                             <div class="avatar-xs m-1">
                                                 <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                                     A
                                                 </span>
                                             </div>
                                         </a>

                                         <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Helen Chaffin">
                                             <img src="images\avatar-1.jpg" class="rounded-circle avatar-xs m-1" alt="">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="px-4 py-3 border-top">
                             <ul class="list-inline mb-0">
                                 <li class="list-inline-item mr-3">
                                     <span class="badge badge-danger">Delay</span>
                                 </li>
                                 <li class="list-inline-item mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Due Date">
                                     <i class="bx bx-calendar mr-1"></i> 13 Oct, 19
                                 </li>
                                 <li class="list-inline-item mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Comments">
                                     <i class="bx bx-comment-dots mr-1"></i> 175
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>

             </div>
         <?php
            }

            ?> 
         <div class="row">
             <div class="col-lg-12">
                 <ul class="pagination pagination-rounded justify-content-center mt-2 mb-5">
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
 @endsection
 