@extends('layouts.customer_home')
    @section('see_form')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('customer/ctm_css/booking_history/see_form.css')}}">
    </head>
    <body>
        @if (Session::has('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    text: "{{ Session::get('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif

        @if(Session::has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    text: "{{ Session::get('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif

        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <div class="bt-option">
                                <a href="{{ route('customer.view_profile')}}">Xem Hồ Sơ</a>
                                <span>Lịch sử đơn</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--LIST --}}
        <ul class="nav nav-tabs tab_list" id="myTab" role="tablist">
            {{-- 1 --}}
            <li class="nav-item" role="presentation">
              <button class="nav-link active nav_item_button" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                    Đặt Phòng
                </button>
            </li> 
            {{-- 2 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link nav_item_button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    Dịch Vụ
                </button>
            </li>
            {{-- 3 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link nav_item_button" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                    Hóa Đơn
                </button>
            </li>
        </ul>

    
            <div class="tab-content booking_form_list" id="myTabContent">
                {{-- 1 --}}
                <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">           
                    @if($getUserLogin != null || $getUser != null)
                        @if($getUserLogin != null)
                            @if(count($getFormLogin) > 0)
                                @foreach ($getFormLogin as $row)
                                    <div class="div_parent">
                                        <div class="div_child">
                                                    <h4 style="color:#204468; font-weight:bold;">Đơn đặt phòng</h4>
                                                    <div class="booking_content">
                                                        <span style="margin-left: 1.3rem; margin-top: 2rem;color:#204468; font-weight:bold;">ID : <span style="">{{ $row -> id_don}}</span></span>
                                                        <div class="span_child1">
                                                            <p><span style="color:#204468; font-weight:bold;">Khách hàng : </span><span style="">{{$getUserLogin -> ho_ten}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Phòng : </span><span style="">{{$row ->ten_lp}}</span>  - <span >{{ ($row -> so_phong) ? $row -> so_phong : ''}}</span></p>
                                                        </div>
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Ngày nhận : </span><span style="">{{$row -> ngay_nhan_phong}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Ngày trả : </span><span style="">{{ $row -> ngay_tra_phong}}</span></p>
                                                        </div>
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Số ngày ở : </span> <span style="">{{$row -> so_ngay_o}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Ghi chú : </span> <span style="">{{ ($row -> ghi_chu) ? $row -> ghi_chu :'' }}</span></p>
                                                        </div>              
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Giá Phòng: </span> <span style="">{{number_format($row -> gia_lp, 0 , ',' ,'.' )}} VND</span></p>
                                                       
                                                        </div>              
                                                        <div class="span_child">
                                                            <p> <span style="color:#204468; font-weight:bold;">Ngày tạo : </span><span class="created_at" >{{$row -> created_at}}</span></p>
                                                            <p ><span style="color:#204468; font-weight:bold;">Ngày cập nhật : </span><span class="created_at" >{{$row -> updated_at}}</span></p>
                                                        </div>   

                                                        <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">Tình trạng : <span class="status" >{{$row -> tinh_trang}}</span></p>
                                                    </div>
                                                    @if( $row -> tinh_trang == 'Chưa xác nhận')
                                                        <button type="button" class="btn btn-danger cancle-form" onclick="buttonCancle('{{route('customer.cancle_form',[$row -> id_don])}}')">Hủy</button>
                                                    @endif

                                                    @if( $row -> tinh_trang == "Đã xác nhận")
                                                        <button type="button" class="btn btn-danger cancle-form" onclick="">Đánh giá</button>
                                                    @endif

                                        </div>
                                    </div> 
                                    
                                @endforeach

                                <div class="sum_form">
                                    <p>Tổng : <span>{{$countLogin}}</span></p>
                                </div>
                                
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination room_pagination">
                                        <!-- Previous Page Link -->
                                        @if ($getFormLogin->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $getFormLogin->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        @endif
                                
                                        <!-- Pagination Elements -->
                                        @foreach ($getFormLogin->appends(request()->query())->links()->elements[0] as $page => $url)
                                            @if ($page == $getFormLogin->currentPage())
                                                <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                
                                        <!-- Next Page Link -->
                                        @if ($getFormLogin->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $getFormLogin->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @else
                                <p style="margin-left: 10rem">Chưa có dữ liệu ...</p>
                            @endif
                    
                        @endif 

                        @if($getUser != null)
                            @if($getForm != null)
                                @foreach ($getForm as $row)
                                    <div class="div_parent">
                                        <div class="div_child">
                                                    <h4 style="color:#204468; font-weight:bold;">Đơn đặt phòng</h4>
                                                    <div class="booking_content">
                                                        <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">ID : <span>{{ $row -> id_don}}</span></p>
                                                        <div class="span_child1">
                                                            <p><span style="color:#204468; font-weight:bold;">Khách hàng : </span><span>{{$getUser -> ho_ten}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Phòng : </span><span>{{$row ->ten_lp}}</span>  - <span>{{ ($row -> so_phong) ? $row -> so_phong : ''}}</span></p>
                                                        </div>
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Ngày nhận : </span><span>{{$row -> ngay_nhan_phong}}</span></p>
                                                            <p><span>Ngày trả :</span>{{ $row -> ngay_tra_phong}}</p>
                                                        </div>
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Số ngày ở : </span><span>{{$row -> so_ngay_o}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Ghi chú : </span>{{ ($row -> ghi_chu) ? $row -> ghi_chu :'' }}</p>
                                                        </div>              
                                                        <div class="span_child">
                                                            <p> <span style="color:#204468; font-weight:bold;">Ngày tạo : </span><span class="created_at">{{$row -> created_at}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Ngày cập nhật : </span><span class="created_at">{{$row -> updated_at}}</span></p>
                                                        </div>   

                                                        <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">Tình trạng : <span class="status">{{$row -> tinh_trang}}</span></p>
                                                    </div>
                                                    @if( $row -> tinh_trang == 'Chưa xác nhận')
                                                        <button type="button" class="btn btn-danger cancle-form" onclick="buttonCancle('{{route('customer.cancle_form',[$row -> id_don])}}')">Hủy</button>
                                                    @endif
                                            </div>
                                        </div> 
                                @endforeach

                                <div class="sum_form">
                                    <p>Tổng : <span>{{$count}}</span></p>
                                </div>       

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination room_pagination">
                                        <!-- Previous Page Link -->
                                        @if ($getForm->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $getForm->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        @endif
                                
                                        <!-- Pagination Elements -->
                                        @foreach ($getForm->appends(request()->query())->links()->elements[0] as $page => $url)
                                            @if ($page == $getForm->currentPage())
                                                <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                
                                        <!-- Next Page Link -->
                                        @if ($getForm->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $getForm->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>

                            @else
                                <p>Trống...Bạn chưa đặt phòng.</p>
                            @endif
                    
                        @endif
                    @else
                                    <p style="margin-left: 10rem">Chưa có dữ liệu ...</p>
                    @endif

                </div>
                {{-- 2 --}}
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @if($getUserLogin != null || $getUser != null)
                        @if($getUserLogin != null)
                            @if ( count($allServicesLg) > 0)
                                @foreach ($allServicesLg as $row)
                                    <div class="div_parent">
                                        <div class="div_child">
                                                    <h4 style="color:#204468; font-weight:bold;">Đơn đặt dịch vụ</h4>
                                                    <div class="booking_content">
                                                        <span style="margin-left: 1.3rem; margin-top: 2rem;color:#204468; font-weight:bold;">ID : <span>{{ $row -> id_ct}}</span></span>
                                                        <div class="span_child1">
                                                            <p><span style="color:#204468; font-weight:bold;">Khách hàng :  </span><span>{{ session('ten_ctm') != null ? session('ten_ctm'): ''}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Phòng : </span> <span >{{$row ->ten_lp}}</span>  - <span ></span>{{ ($row -> so_phong) ? $row -> so_phong : ''}}</span></p>
                                                        </div>
                                                        <div class="span_child">
                                                            
                                                            <p><span style="color:#204468; font-weight:bold;">Tên :  </span><span ></span>{{ $row -> ten_dv}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Giá :  </span><span ></span>{{ number_format($row -> don_gia_dv, 0 , ',', '.')}} VND</span></p>
                                                        </div>
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Số lượng :  </span><span ></span>{{$row -> so_luong_ct}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Ghi chú : </span><span ></span>{{ ($row -> ghi_chu_ct) ? $row -> ghi_chu_ct :'' }}</span></p>
                                                        </div>              
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Ngày tạo :  </span><span class="created_at">{{$row -> created_at}}</span></p>
                                                            <p ><span style="color:#204468; font-weight:bold;">Ngày cập nhật :  </span><span class="created_at">{{$row -> updated_at}}</span></p>
                                                        </div>   
                                                  
                                                        <div class="span_child">
                                                                {{-- <p style="margin-left: 1.3rem; margin-top: 1rem"><span style="color:#204468; font-weight:bold;">Ngày sử dụng : </span><span ></span>{{$row -> ngay_su_dung}}</span></p> --}}
                                                            <p><span style="color:#204468; font-weight:bold;">Ngày sử dụng :  </span><span class="">{{$row -> ngay_su_dung}}</span></p>
                                                            <p ><span style="color:#204468; font-weight:bold;">Uu đãi áp dụng :  </span>
                                                                @if($allgia ->isNotEmpty())
                                                                    @if(count($allgia) > 0 && count($allgia) < 2)
                                                                        @foreach ($allgia as $dv)
                                                                            @if($dv -> id_dv == $row ->id_dv)
                                                                                <span class="">{{$dv -> ten_ud != null ? $dv -> ten_ud: '' }}</span>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        @foreach ($allgia as $dv)
                                                                            @if($dv -> id_dv == $row ->id_dv)
                                                                                <span class="">{{$dv -> ten_ud != null ? $dv -> ten_ud : '' }}<br></span>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">Tình trạng : <span class="status" >{{ ($row -> tinh_trang_ct) != null ? $row -> tinh_trang_ct:''}}</span></p>
                                                    </div>
                                                    @if( $row -> tinh_trang_ct == "Đã xác nhận")
                                                        <button type="button" class="btn btn-danger cancle-form" onclick="">Đánh giá</button>
                                                    @endif

                                                    @if( $row -> tinh_trang_ct == "Chưa xác nhận")
                                                        <button type="button" class="btn btn-danger cancle-form" onclick="buttonCancle('{{route('customer.cancle_service',[$row -> id_ct])}}')">Hủy</button>
                                                    @endif


                                        </div>
                                    </div> 
                                    
                                @endforeach

                                <div class="sum_form">
                                    <p>Tổng : <span>{{$countServiceLg}}</span></p>
                                </div>       
                                
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination room_pagination">
                                        <!-- Previous Page Link -->
                                        @if ($allServicesLgperPage->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $allServicesLgperPage->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        @endif
                                
                                        <!-- Pagination Elements -->
                                        @foreach ($allServicesLgperPage->appends(request()->query())->links()->elements[0] as $page => $url)
                                            @if ($page == $allServicesLgperPage->currentPage())
                                                <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                
                                        <!-- Next Page Link -->
                                        @if ($allServicesLgperPage->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $allServicesLgperPage->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @else
                                <p style="margin-left: 10rem">Chưa có dữ liệu ...</p>
                            @endif
                    
                        @endif 

                     
                    @else
                                    <p style="margin-left: 10rem">Chưa có dữ liệu ...</p>
                    @endif

                </div>

             {{-- 3 --}}
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            @if($getUserLogin != null || $getUser != null)
                                @if($getUserLogin != null)
                                    @if(count($getBillLogin) >0 )
                                        @foreach ($getBillLogin as $row )
                                            <div class="div_parent">
                                                <div class="div_child">
                                                            <h4 style="color:#204468; font-weight:bold;">Hóa đơn</h4>
                                                            <div class="booking_content">
                                                                <span style="margin-left: 1.3rem; margin-top: 2rem;color:#204468; font-weight:bold;">ID : <span ></span>{{ $row -> id_hd}}</span></span>
                                                                <div class="span_child1">
                                                                    <p><span style="color:#204468; font-weight:bold;">Khách hàng :  </span><span ></span>{{$getUserLogin -> ho_ten}}</span></p>
                                                                    <p><span style="color:#204468; font-weight:bold;">Phòng :  </span><span >{{$row -> ten_lp}}</span> - {{$row ->so_phong }}</span></p>
                                                                    
                                                                </div>
                                                                <div class="span_child">
                                                                    <p><span style="color:#204468; font-weight:bold;">Trễ hạn :  </span><span >{{$row -> tre_han}} ngày</span></p>
                                                                    <p><span style="color:#204468; font-weight:bold;">Phí thêm : </span> <span >{{ number_format($row -> phi_them,0,',','.')}} VND</span></p>
                                                                </div>
                                                                <div class="span_child">
                                                                    <p><span style="color:#204468; font-weight:bold;">Ngày tạo :  </span><span class="created_at">{{$row -> created_at}}</span></p>
                                                                    <p ><span style="color:#204468; font-weight:bold;">Ngày cập nhật :  </span><span class="created_at">{{$row -> updated_at}}</span></p>               
                                                                </div>              
                                                                <div class="span_child">
                                                                    <p><span style="color:#204468; font-weight:bold;">Phí_dv :  </span><span >{{number_format($row -> phi_dv,0,',','.')}} VND</span></p>
                                                                    <p><span style="color:#204468; font-weight:bold;">Tổng tiền : </span>  <span>{{number_format($row -> tong_tien,0, ',', '.')}} VND</span></p>
                                                                    {{-- <p style="margin-left: 1.3rem;margin-top:0.5rem"><span style="color:#204468; font-weight:bold;">Tổng tiền : </span>  <span>{{number_format($row -> tong_tien,0, ',', '.')}} VND</span></p> --}}
                                                                </div>
                                                                <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">Tình trạng : <span class="status" >{{($row -> trang_thai_hd !=null) ? $row-> trang_thai_hd :''}}</span></p>
                                                            </div>
                                                </div>
                                            </div> 
                                            
                                        @endforeach

                                        <div class="sum_form">
                                            <p>Tổng : <span>{{$countBillLg}}</span></p>
                                        </div>
                                        
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination room_pagination">
                                                <!-- Previous Page Link -->
                                                @if ($getBillLogin->onFirstPage())
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $getBillLogin->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                @endif
                                        
                                                <!-- Pagination Elements -->
                                                @foreach ($getBillLogin->appends(request()->query())->links()->elements[0] as $page => $url)
                                                    @if ($page == $getBillLogin->currentPage())
                                                        <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                        
                                                <!-- Next Page Link -->
                                                @if ($getBillLogin->hasMorePages())
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $getBillLogin->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    @else
                                        <p style="margin-left: 10rem">Chưa có dữ liệu...</p>
                                    @endif
                                @endif 

                                @if($getUser != null)
                                    @if(count($getBill) >0 )
                                        @foreach ($getBill as $row )
                                            <div class="div_parent">
                                                <div class="div_child">
                                                            <h4 style="color:#204468; font-weight:bold;">Hóa đơn</h4>
                                                            <div class="booking_content">
                                                                <span style="margin-left: 1rem; margin-top: 2rem;color:#204468; font-weight:bold;">ID : <span ></span>{{ $row -> id_hd}}</span></span>
                                                                <div class="span_child1">
                                                                    <p><span style="color:#204468; font-weight:bold;">Khách hàng :  </span><span ></span>{{$getUser -> ho_ten}}</span></p>
                                                                    <p><span style="color:#204468; font-weight:bold;">Phí_dv : </span><span ></span>{{$row -> phi_dv}}</span></p>
                                                                </div>
                                                                <div class="span_child">
                                                                    <p><span style="color:#204468; font-weight:bold;">Trễ hạn : </span> <span>{{$row -> tre_han}}</span></p>
                                                                    <p><span style="color:#204468; font-weight:bold;" >Phí thêm : </span> <span>{{ $row -> phi_them}}</span></p>
                                                                </div>
                                                                <div class="span_child">
                                                                    <p><span style="color:#204468; font-weight:bold;">Tổng tiền : </span> <span>{{number_format($row -> tong_tien,0, ',', '.')}} VND</span></p>
                                                                    
                                                                </div>              
                                                                <p style="margin-left: 1.3rem;margin-top:0.5rem"><span style="color:#204468; font-weight:bold;">Ngày tạo : </span> <span class="created_at" ></span>{{$row -> created_at}}</span></p>
                                                                <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">Tình trạng : <span class="status" >{{$row -> trang_thai_hd}}</span></p>
                                                            </div>
                                                </div>
                                            </div> 
                                            
                                        @endforeach

                                        <div class="sum_form">
                                            <p>Tổng : <span>{{$countBill}}</span></p>
                                        </div>
                                        
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination room_pagination">
                                                <!-- Previous Page Link -->
                                                @if ($getBill->onFirstPage())
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $getBill->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                @endif
                                        
                                                <!-- Pagination Elements -->
                                                @foreach ($getBill->appends(request()->query())->links()->elements[0] as $page => $url)
                                                    @if ($page == $getBill->currentPage())
                                                        <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                        
                                                <!-- Next Page Link -->
                                                @if ($getBill->hasMorePages())
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $getBill->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    @else
                                        <p style="margin-left: 10rem">Chưa có dữ liệu...</p>
                                    @endif
                                @endif 
                                
                            @else
                                <p style="margin-left: 10rem">Chưa có dữ liệu ...</p>
                            @endif
                </div>
            </div>

        {{-- <div class="back_room">
            <a href="{{ url()-> previous() }}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
        </div> --}}
        <script>
            function buttonCancle(url) {
            Swal.fire({
                title: 'Xác nhận',
                text: 'Bạn có chắc chắn muốn hủy?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#04AA6D',
                cancelButtonColor: 'rgb(246, 81, 81)',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
                customClass: {
                        popup: 'swal2-background-custom',
                    container: 'swal2-borderless'
                },
                    background: '#30547e' ,
                    color: 'white'    
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        </script>
    </body>
    </html>
    
    @endsection