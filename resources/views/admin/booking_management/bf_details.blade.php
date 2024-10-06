@extends('layouts.admin_home')
    @section('bf_details')
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="{{ asset('admin/ad_css/booking_management/bf_details.css')}}">
            </head>
            <body>
                @if($details != null)
                    <div class="wrapper_detai">

                        <div class="bf_detail">
                          <div class="bf_detail--item">
  
                              <p class="item_left"> <span style="color: rgb(43, 107, 133); font-weight:bold;">ID :</span> <span>{{ $details ->id_don}}</span></p>
                              <p class="item_right"><span style="color: rgb(43, 107, 133); font-weight:bold;">Tên KH : </span> <span>   {{ $details-> ho_ten }}</span></p>
                          </div>
  
                          <div class="bf_detail--item">
  
                              <p> <span style="color: rgb(43, 107, 133); font-weight:bold;">Loại Phòng : </span> <span>{{ $details -> ten_lp }}</span></p>
                              <p ><span style="color: rgb(43, 107, 133); font-weight:bold;">Số Phòng : </span><span>{{ ($details -> so_phong) != null ? $details -> so_phong : '' }}</span></p>
                          </div>
  
                          <div class="bf_detail--item">
  
                              <p> <span style="color: rgb(43, 107, 133); font-weight:bold;">Ngày nhận phòng : </span><span>{{ $details -> ngay_nhan_phong}}</span></p>
                              <p><span style="color: rgb(43, 107, 133); font-weight:bold;">Ngày trả phòng : </span> <span>{{ $details -> ngay_tra_phong}}</span></p>
                          </div>
  
                          <div class="bf_detail--item">
                              <p > <span style="color: rgb(43, 107, 133); font-weight:bold;">Đơn giá : </span><span>{{ number_format($details -> gia_lp,0,',','.')}} VND / Đêm</span></p>
                              <p> <span style="color: rgb(43, 107, 133); font-weight:bold;">Số ngày ở : </span><span>{{ $details -> so_ngay_o}}</span></p>
  
                          </div>
                          
                          <div class="bf_detail--item">
  
                              <p> <span style="color: rgb(43, 107, 133); font-weight:bold;">Ngày tạo : </span><span>{{ $details -> created_at}}</span></p>
                              <p > <span style="color: rgb(43, 107, 133); font-weight:bold;">Ngày cập nhật :</span>  <span>{{ $details -> updated_at}}</span></p>
                          </div>
  
                          <div class="bf_detail--item">
  
                              <p> <span style="color: rgb(43, 107, 133); font-weight:bold;">Ghi chú :</span> <span>{{ ($details -> ghi_chu) != null ? $details -> ghi_chu : '' }}</span></p>
                              <p><span style="color: rgb(43, 107, 133); font-weight:bold;"> Tình trạng  : </span><span style="color: rgb(218, 86, 86); font-weight:bold;">{{ $details -> tinh_trang}}</span></p>
                          </div>
  
                        </div>
                    </div>
                    
                @endif
            
                <div class="back_room">
                        <a href="{{ route('admin.booking_management')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
                </div>
            </body>
            </html>
    @endsection