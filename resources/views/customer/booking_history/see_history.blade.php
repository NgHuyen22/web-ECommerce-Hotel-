@extends('layouts.customer_home')
    @section('see_history')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('customer/ctm_css/booking_history/see_history.css')}}">

        <style>
            .star-rating .star {
                font-size: 30px;
                cursor: pointer;
                color: #ffc107; 
            }
            .star-rating .star.selected {
                color: #ffc107; 
            }
            .star-rating .star.unselected {
                color: #ccc;
            }
            .star-ratingIs .starIs {
                font-size: 30px;
                cursor: pointer;
                color: #ffc107; 
            }
            .star-ratingIs .starIs.selected {
                color: #ffc107; 
            }
            .star-ratingIs .starIs.unselected {
                color: #ccc;
            }
        </style>
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

                                                        {{-- @if($row->ngay_tra_phong >= $current) --}}
                                                        @if($row -> tinh_trang == 'Đã xác nhận')
                                                        @php
                                                            $hasEvaluation = false;
                                                        @endphp
                                                    
                                                        @if($getEV->isNotEmpty())
                                                            @foreach ($getEV as $ev)
                                                                @if($ev->don == $row->id_don)
                                                                    @php
                                                                        $hasEvaluation = true;
                                                                    @endphp
                                                                    <button type="button" class="btn btn-danger evaluate" onclick="showEvaluateIsset('{{ $ev->noi_dung }}', {{ $ev->diem }}, '{{ $ev->created_at }}','{{ $ev->updated_at }}',{{ $ev->so_lan_sua }})">Xem đánh giá</button>
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    
                                                        @if(!$hasEvaluation)
                                                            <button type="button" class="btn btn-danger evaluate" onclick="showEvaluate()">Đánh giá</button>
                                                        @endif
                                                    @endif

                                                        <div id="evaluateModal" class="modal" style="display: none;">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content model-ev">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Đánh giá chất lượng phòng</h5>
                                                                        <button type="button" class="close" onclick="hideEvaluate()">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p style="font-style: italic; color: rgb(229, 227, 227);">Chúng tôi luôn trân trọng mọi đánh giá từ bạn. 
                                                                            Những góp ý quý báu này sẽ giúp chúng tôi mang đến dịch vụ hoàn hảo hơn cho từng trải nghiệm của bạn !!</p>
                                                                        </p>
                                                                
                                                                        <div class="status-rating">
                                                                            <div class="star-rating">
                                                                                <i class="fa fa-star star selected" onclick="toggleStar(1)"></i>
                                                                                <i class="fa fa-star star selected" onclick="toggleStar(2)"></i>
                                                                                <i class="fa fa-star star selected" onclick="toggleStar(3)"></i>
                                                                                <i class="fa fa-star star selected" onclick="toggleStar(4)"></i>
                                                                                <i class="fa fa-star star selected" onclick="toggleStar(5)"></i>
                                                                            </div>
                                                                            <span id="ratingText" style="display: block;font-weight: bold;color:#ffc107">Tuyệt vời</span>
                                                                        </div>
                                                                        <textarea id="comment" class="comment" type="text" placeholder="Nhập nhận xét của bạn"></textarea>

                                                                        <div class="tool" id="tool">
                                                                            <button id="" class="tool_button" onclick="send()">Gửi</button>
                                                                        </div>
                                                                    </div>                                
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="evaluateModalIs" class="modal" style="display: none;">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Đánh giá chất lượng phòng</h5>
                                                                        <button type="button" class="close" onclick="hideEvaluateIs()">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p style="font-style: italic; color: rgb(229, 227, 227);">Chúng tôi luôn trân trọng mọi đánh giá từ bạn. Những góp ý quý báu này sẽ giúp chúng tôi mang đến dịch vụ hoàn hảo hơn cho từng trải nghiệm của bạn !!</p>
                                                                        
                                                                        <div class="status-rating">
                                                                            <div class="star-ratingIs">
                                                                                <i class="fa fa-star starIs" onclick="toggleStar(1)"></i>
                                                                                <i class="fa fa-star starIs" onclick="toggleStar(2)"></i>
                                                                                <i class="fa fa-star starIs" onclick="toggleStar(3)"></i>
                                                                                <i class="fa fa-star starIs" onclick="toggleStar(4)"></i>
                                                                                <i class="fa fa-star starIs" onclick="toggleStar(5)"></i>
                                                                            </div>
                                                                            <span id="ratingTextIs" style="display: block; font-weight: bold; color:#ffc107">Tuyệt vời</span>
                                                                        </div>
                                                                        <textarea id="commentIs" type="text"  disabled></textarea>
                                                                        <span id="created_at_ev"></span>
                                                                        
                                                                        <div class="tool" id="tool">
                                                                            <button id="edit_ev" class="tool_button" onclick="enableEdit()">Sửa</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                        

                                                        <script>
                                                             function showEvaluate() {
                                                                document.getElementById("evaluateModal").style.display = "block";
                                                            }

                                                            function hideEvaluate() {
                                                                document.getElementById("evaluateModal").style.display = "none";
                                                            }

                                                            let currentRating = 5;
                                                            function toggleStar(rating) {
                                                                currentRating = rating;
                                                                let stars = document.querySelectorAll('.star-rating .star');
                                                                stars.forEach((star, index) => {
                                                                    if (index < rating) {
                                                                        star.classList.add('selected');
                                                                        star.classList.remove('unselected');
                                                                    } else {
                                                                        star.classList.add('unselected');
                                                                        star.classList.remove('selected');
                                                                    }
                                                                });

                                                                switch (rating) {
                                                                    case 5: ratingText.textContent = "Tuyệt vời"; break;
                                                                    case 4: ratingText.textContent = "Hài lòng"; break;
                                                                    case 3: ratingText.textContent = "Bình thường"; break;
                                                                    case 2: ratingText.textContent = "Không hài lòng"; break;
                                                                    case 1: ratingText.textContent = "Tệ"; break;
                                                                }

                                                                
                                                            }

                                                            function send() {
                                                                const rating = currentRating;
                                                                const comment = document.getElementById('comment').value;
                                                                const user_id = {{ $getUserLogin->id }};
                                                                const booking_id = {{ $row->id_don }};
                                                                const room_id = {{ $row->id_loai_phong }};
                                                                window.location.href = `{{ route('customer.evaluate') }}?rating=${rating}&comment=${encodeURIComponent(comment)}&user_id=${user_id}&booking_id=${booking_id}&room_id=${room_id}`;
                                                            }

                                                            //EvaluateModalIs
                                                            function showEvaluateIsset(noi_dung, diem, created_at,updated_at,so_lan_sua) {
                                                                document.getElementById("evaluateModalIs").style.display = "block";
                                                                
                                                                document.getElementById("commentIs").value = noi_dung;
                                                                document.getElementById("created_at_ev").textContent = created_at;
                                                                const editButton = document.getElementById("edit_ev");
                                                                if (so_lan_sua >= 1) {
                                                                    document.getElementById("created_at_ev").innerHTML = `<p><span id="edit_content"></span><span id="updated_at_ev"></span></p>`;
                                                                    document.getElementById("edit_content").textContent = "Đã sửa : ";
                                                                    document.getElementById("updated_at_ev").textContent = updated_at; 
                                                                    editButton.disabled = true;
                                                                } else {
                                                                    document.getElementById("created_at_ev").textContent = created_at;
                                                                    editButton.disabled = false;
                                                                }

                                                                let stars = document.querySelectorAll('#evaluateModalIs .star-ratingIs .starIs');
                                                                stars.forEach((star, index) => {
                                                                    if (index < diem) {
                                                                        star.classList.add('selected');
                                                                        star.classList.remove('unselected');
                                                                    } else {
                                                                        star.classList.remove('selected');
                                                                        star.classList.add('unselected');
                                                                    }
                                                                });
                                                                const ratingTextIs = document.getElementById("ratingText");
                                                                switch (diem) {
                                                                    case 5: ratingTextIs.textContent = "Tuyệt vời"; break;
                                                                    case 4: ratingTextIs.textContent = "Hài lòng"; break;
                                                                    case 3: ratingTextIs.textContent = "Bình thường"; break;
                                                                    case 2: ratingTextIs.textContent = "Không hài lòng"; break;
                                                                    case 1: ratingTextIs.textContent = "Tệ"; break;                                                                
                                                                }
                                                            
                                                            }

                                                            function hideEvaluateIs() {
                                                                document.getElementById("evaluateModalIs").style.display = "none";
                                                            }
                                                            
                                                            function enableEdit() {
                                                                document.getElementById("commentIs").disabled = false; 
                                                                document.getElementById("commentIs").style.color = "black"; 
                                                                // Thay nút "Sửa" thành "Cập Nhật"
                                                                // document.getElementById("edit_ev").innerHTML = `<button id="edit_ev" class="tool_button2" onclick="updateEvaluate()">Cập Nhật</button>`;
                                                                const editButton = document.getElementById("edit_ev");
                                                                editButton.textContent = "Cập Nhật";
                                                                editButton.classList.replace("tool_button", "tool_button2"); // Đổi class nếu cần
                                                                editButton.onclick = updateEvaluate;
                                                            }

                                                            function updateEvaluate() {
                                                                const comment = document.getElementById('commentIs').value;
                                                                const booking_id = {{ $row->id_don }};
                                                                window.location.href = `{{ route('customer.update_review') }}?comment=${encodeURIComponent(comment)}&booking_id=${booking_id}`;
                                                            }

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
                                                            <p><span style="color:#204468; font-weight:bold;">Ưu đãi áp dụng :  </span>
                                                                @if($allgia->isNotEmpty())
                                                                    @php $promotionDisplayed = false; @endphp
                                                                    @foreach ($allgia as $dv)
                                                                        @if($dv->id_dv == $sv->id_dv && !$promotionDisplayed)
                                                                            @if($dv->sl_ap_dung <= $sv->so_luong_ct)
                                                                                <span class="">{{ $dv -> ten_ud != null ? $dv->ten_ud : '' }}</span>
                                                                                @php $promotionDisplayed = true; @endphp 
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
                                                                {{-- <button type="button" style="margin-bottom: 1rem;margin-left: 1rem;" class="btn btn-danger cancle-form" onclick="printBill('{{ route('admin.print_bill',[$bill -> id_hd])}}')">In</button> --}}
                                                                <a href="{{ route('customer.print_bill',[$bill -> id_hd])}}"class="btn btn-danger cancle-form"  target="black" style="margin-bottom: 1rem;margin-left: 1rem;" >In</a>
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

        <script>
            function printBill(url){
                window.location.href = url;
            }
        </script>
    </body>
    </html>
    @endsection