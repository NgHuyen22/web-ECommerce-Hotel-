@extends('layouts.customer_home')
    @section('see_history')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('customer/ctm_css/booking_history/see_history.css')}}">
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
        @if($getUserLogin != null || $getUser != null)
            @if($getUserLogin != null)
                <p style="margin-left: 2.2rem"><span style="color:#204468; font-weight:bold;">Khách hàng : </span><span style="font-weight: bold;color:rgb(237, 180, 107)">{{$getUserLogin -> ho_ten}}</span></p>
                <div class="wrapper_history">  
                    @if(count($getFormLogin) > 0)
                        @foreach ($getFormLogin as $row)
                                <div class="div_parent">
                                        <div class="booking_form">
                                                        <h4 style="color:#204468; font-weight:bold;">Đặt phòng</h4>
                                                        <div class="booking_content">
                                                            <div class="span_child">
                                                                <p><span style="color:#204468; font-weight:bold;">ID : <span style="">{{ $row -> id_don}}</span></span></p>
                                                                                                                         
                                                                <p><span style="color:#204468; font-weight:bold;">Phòng : </span><span style="">{{$row ->ten_lp}}</span>  - <span >{{ ($row -> so_phong) ? $row -> so_phong : ''}}</span></p>
                                                            </div>
                                                            <div class="span_child">
                                                                <p><span style="color:#204468; font-weight:bold;">Ngày nhận : </span><span style="">{{ \Carbon\Carbon::parse($row->ngay_nhan_phong)->format('d-m-Y') }}</span></p>
                                                                <p><span style="color:#204468; font-weight:bold;">Ngày trả : </span><span style="">{{ \Carbon\Carbon::parse($row->ngay_tra_phong)->format('d-m-Y') }}</span></p>
                                                            </div>
                                                            <div class="span_child">
                                                                <p><span style="color:#204468; font-weight:bold;">Số ngày ở : </span> <span style="">{{$row -> so_ngay_o}}</span></p>
                                                                <p><span style="color:#204468; font-weight:bold;">Ghi chú : </span> <span style="">{{ ($row -> ghi_chu) ? $row -> ghi_chu :'' }}</span></p>
                                                            </div>          
                                                            
                                                            @php
                                                                $gia_lp = $row -> gia_lp;
                                                                $so_ngay= $row -> so_ngay_o;
                                                                $tong_tien = $gia_lp * $so_ngay;

                                                            @endphp
                                                            <div class="span_child">
                                                                <p><span style="color:#204468; font-weight:bold;">Giá Phòng : </span> <span style="font-weight: bold;color:rgb(237, 180, 107)">{{number_format($row -> gia_lp, 0 , ',' ,'.' )}} VND</span></p>
                                                                <p><span style="color:#204468; font-weight:bold;">Tổng : </span> <span style="font-weight: bold;color:rgb(237, 180, 107)">{{number_format($tong_tien, 0 , ',' ,'.' )}} VND</span></p>
                                                            </div>              
                                                            <div class="span_child" style="margin-bottom: 0.8rem">
                                                                <p> <span style="color:#204468; font-weight:bold;">Ngày tạo : </span><span class="created_at" >{{$row -> created_at}}</span></p>
                                                                <p ><span style="color:#204468; font-weight:bold;">Ngày cập nhật : </span><span class="created_at" >{{$row -> updated_at}}</span></p>
                                                            </div>   

                                                            <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">Tình trạng : <span class="status" >{{$row -> tinh_trang}}</span></p>
                                                        </div>
                                                        @if( $row -> tinh_trang == 'Chưa xác nhận')
                                                            <button type="button" style="margin-bottom: 1rem;margin-left: 1rem;" class="btn btn-danger cancle-form" onclick="buttonCancle('{{route('customer.cancle_form',[$row -> id_don])}}')">Hủy</button>
                                                        @endif

                                                        {{-- @if($bill -> tinh_trang == "Đã  xác nhận")
                                                            <button type="button" class="btn btn-danger cancle-form" onclick="">Đánh giá</button>
                                                        @endif --}}

                                        </div>
                                  
                                        <div class="services">
                                            <h4 style="color:#204468; font-weight:bold;">Đặt dịch vụ</h4>
                                        
                                            @php
                                                $hasService = false; 
                                            @endphp
                                        
                                            @if (count($allServicesLg) > 0)
                                                @foreach ($allServicesLg as $sv)
                                                    @if($sv -> id_ddp == $row -> id_don)
                                                        @php
                                                            $hasService = true;
                                                        @endphp
                                                        
                                                     <div class="div_child">
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Tên :  </span><span style="font-weight: bold;color:rgb(237, 180, 107)">{{ $sv -> ten_dv}}</span></p>
                                                          
                                                            <p><span style="color:#204468; font-weight:bold;">Giá :  </span><span style="">{{ number_format($sv -> don_gia_dv, 0 , ',', '.')}} VND</span></p>
                                                        </div>

                                                        @php
                                                            
                                                            $finalPrice = $sv->don_gia_dv;
                                                            $sl = $sv-> so_luong_ct;
                                                            $discountPercentage = 0;
                                                
                                                 
                                                            if ($allgia->isNotEmpty()) {
                                                                foreach ($allgia as $dv) {
                                                                    if ($dv->id_dv == $sv->id_dv && $dv->giam != null) {
                                                                        if($dv->sl_ap_dung <= $sl){
                                                                            $discountPercentage = $dv->giam; 
                                                                        }else{
                                                                            $discountPercentage = 0;
                                                                        }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                
                                               
                                                            if ($discountPercentage > 0) {
                                                                $discountAmount = $finalPrice * $sl * ($discountPercentage / 100);
                                                                $finalPrice = $finalPrice * $sl - $discountAmount;
                                                            } else {
                                                                    $finalPrice = $finalPrice * $sl; // Không giảm giá, giữ giá gốc
                                                            }
                                                        @endphp

                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Số lượng :  </span><span >{{$sv -> so_luong_ct}}</span></p>
                                                            <p><span style="color:#204468; font-weight:bold;">Tổng : </span><span style="font-weight: bold;color:rgb(237, 180, 107)">{{ number_format($finalPrice, 0 , ',', '.')}} VND</span></p>
                                                            
                                                        </div>              
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Ghi chú :  </span><span >{{$sv-> ghi_chu_ct != null ? $sv-> ghi_chu_ct : ''}}</span></p>
                                                            
                                                        </div>              
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Ngày tạo :  </span><span class="created_at">{{$sv -> created_at}}</span></p>
                                                            <p ><span style="color:#204468; font-weight:bold;">Ngày cập nhật :  </span><span class="created_at">{{$sv -> updated_at}}</span></p>
                                                        </div>
                                                        <div class="span_child">
                                                            <p><span style="color:#204468; font-weight:bold;">Ngày sử dụng :  </span><span class="">{{ \Carbon\Carbon::parse($sv->ngay_su_dung)->format('d-m-Y') }}</span></p>
                                                            <p ><span style="color:#204468; font-weight:bold;">Ưu đãi áp dụng :  </span>
                                                                @if($allgia ->isNotEmpty())
                                                                    @foreach ($allgia as $dv)
                                                                        @if($dv -> id_dv == $sv ->id_dv)
                                                                            @if($dv->sl_ap_dung <= $sv -> so_luong_ct)
                                                                                <span class="">{{$dv -> ten_ud != null ? $dv -> ten_ud: '' }}</span>
                                                                            @else
                                                                                <span></span>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">Tình trạng : <span class="status" >{{ ($sv -> tinh_trang_ct) != null ? $sv -> tinh_trang_ct:''}}</span></p>
                                                        @if( $sv -> tinh_trang_ct == "Chưa xác nhận")
                                                            <button type="button" style="margin-bottom: 1rem;margin-left: 1rem;" class="btn btn-danger cancle-form" onclick="buttonCancle('{{route('customer.cancle_service',[$sv -> id_ct])}}')">Hủy</button>
                                                        @endif
                                                     </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        
                                            @if (!$hasService)
                                                <p>Chưa có dữ liệu...</p>
                                            @endif
                                        </div>
                                        
                       
                                </div>
                                
                                <div class="bill">
                                    <h4 style="color:#204468; font-weight:bold;">Hóa đơn</h4>
                                        @php
                                            $hasService = false;
                                        @endphp
                                    @if(count($getBillLogin) >0 )
                                        @foreach ($getBillLogin as $bill )
                                            @if($bill -> don_dat_phong == $row -> id_don)
                                                @php
                                                    $hasService = true;
                                                @endphp
                                                  <div class="booking_content">
                                                                <p style="margin-left: 1.3rem; margin-top: 2rem;margin-bottom: 1rem; color:#204468; font-weight:bold;">ID : <span>{{ $bill -> id_hd}}</span></p>
                                                                <div class="span_child" style="">
                                                                    <p><span style="color:#204468; font-weight:bold;">Trễ hạn :  </span><span >{{$bill -> tre_han}} ngày</span></p>
                                                                    <p><span style="color:#204468; font-weight:bold;">Phí thêm : </span> <span >{{ number_format($bill -> phi_them,0,',','.')}} VND</span></p>
                                                                </div>
                                                                <div class="span_child">
                                                                    <p><span style="color:#204468; font-weight:bold;">Ngày tạo :  </span><span class="created_at">{{$bill -> created_at}}</span></p>
                                                                    <p ><span style="color:#204468; font-weight:bold;">Ngày cập nhật :  </span><span class="created_at">{{$bill -> updated_at}}</span></p>               
                                                                </div>              
                                                                <div class="span_child">
                                                                    <p><span style="color:#204468; font-weight:bold;">Phí_dv :  </span><span >{{number_format($bill -> phi_dv,0,',','.')}} VND</span></p>
                                                                    <p><span style="color:#204468; font-weight:bold;">Tổng tiền : </span>  <span style="font-weight: bold;color:rgb(237, 180, 107)">{{number_format($bill -> tong_tien,0, ',', '.')}} VND</span></p>
                                                                    {{-- <p style="margin-left: 1.3rem;margin-top:0.5rem"><span style="color:#204468; font-weight:bold;">Tổng tiền : </span>  <span>{{number_format($row -> tong_tien,0, ',', '.')}} VND</span></p> --}}
                                                                </div>
                                                                <p style="margin-left: 1.3rem;color:#204468; font-weight:bold;">Tình trạng : <span class="status" >{{($bill -> trang_thai_hd !=null) ? $bill-> trang_thai_hd :''}}</span></p>
                                                            @if($bill -> trang_thai_hd == 'Đã thanh toán')
                                                                <button type="button" style="margin-bottom: 1rem;margin-left: 1rem;" class="btn btn-danger cancle-form" onclick="">In</button>
                                                            @endif
                                                  </div>
                                             @endif
                                        @endforeach
                                    @endif
                                    
                                    @if (!$hasService)
                                        <p>Chưa có dữ liệu...</p>
                                    @endif
                                    
                                </div>
                        @endforeach

        
                    @else
                        <div class="div_parent"><p>Chưa có dữ liệu</p></div>           
                    @endif
                </div>
            @endif
        @else
                <p>Chưa có dữ liệu</p>
        @endif

        {{-- <div class="sum_form" style="margin-left: 4rem">
            <p><span style="font-weight: bold">Tổng : </span><span>{{$countLogin}}</span></p>
        </div> --}}
        
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
    </body>
    </html>
    @endsection