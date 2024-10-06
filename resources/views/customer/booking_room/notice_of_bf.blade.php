{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('customer/ctm_css/booking_room/notice_of_bf.css')}}">
</head>
<body>
            <div>
            <h3>CT258 - HTQLKS</h3>
            <h2>HazBin Hotel - Thông báo đặt phòng thành công !</h2>
            <p>Xin chào <span style="font-weight: bold;">{{$customer -> ho_ten }}</span>. Hệ thống của chúng tôi đã nhận được đơn đặt phòng từ bạn.</p>
            <p>Sau đây là thông tin đơn đặt phòng của bạn :</p>
            <div class="div_parent" style="">
                <div class="div_child">
                            <h4 style="color:#204468; font-weight:bold;">Đơn đặt phòng</h4>
                            <div class="booking_content">
                                <p style="margin-left: 1rem">ID : <span>{{ $getForm -> id_don}}</span></p>
                                <div class="span_child1">
                                    <p>Khách hàng : <span>{{$getForm ->id}}</span></p>
                                    <p>Phòng : <span>{{$getForm -> loai_phong}}</span> <span>{{ ($getForm -> so_phong) ? $row -> so_phong :''}}</span></p>
                                </div>
                                <div class="span_child">
                                    <p>Ngày nhận : <span>{{$getForm -> ngay_nhan_phong}}</span></p>
                                    <p>Ngày trả :{{ $getForm -> ngay_tra_phong}}</p>
                                </div>
                                <div class="span_child">
                                    <p>Số ngày ở : <span>{{$getForm -> so_ngay_o}}</span></p>
                                    <p>Ghi chú : {{ ($row -> ghi_chu) ? $getForm -> ghi_chu :'' }}</p>
                                </div>              
                                <p style="margin-left: 1rem">Tình trạng : {{$getForm -> tinh_trang}}</p>
                            </div>
                </div>
            </div>
            <p>Nhân viên HazBin sẽ liên lạc với bạn để xác nhận thanh toán và sắp phòng trong thời gian sớm nhất, rất vui vì được phục vụ bạn.</p>
        
        </div>
</body>
</html>
 --}}

 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="font-family: Arial, sans-serif; color: #333;">
        <h3 style="color:#204468; font-weight:bold;">HazBin Hotel - Thông báo đặt phòng thành công!</h3>
        <p>Xin chào <span style="font-weight: bold;">{{$customer -> ho_ten }}</span>.</p>
        <p>Chúng tôi đã nhận được đơn đặt phòng từ bạn. Dưới đây là thông tin đơn của bạn:</p>
        
        <div style="background-color: #f4f4f4; padding: 10px; width:200px">
            <p>ID: <strong>{{ $getForm -> id_don }}</strong></p>
            <p>Phòng: <strong>{{ $getNameRT ->ten_lp }} - {{ $getForm -> so_phong }}</strong></p>
            <p>Ngày nhận phòng: <strong>{{ $getForm -> ngay_nhan_phong }}</strong></p>
            <p>Ngày trả phòng: <strong>{{ $getForm -> ngay_tra_phong }}</strong></p>
            <p>Số ngày ở: <strong>{{ $getForm -> so_ngay_o }}</strong></p>
            <p>Ghi chú: <strong>{{ $getForm -> ghi_chu ?? 'Không có' }}</strong></p>
            <p>Tình trạng : <span style="color: #da3e2d;font-weight: bold;">{{$getForm -> tinh_trang}}</span></p>
        </div>

        <p>Nhân viên HazBin sẽ liên lạc với bạn để xác nhận thanh toán và sắp phòng trong thời gian sớm nhất, rất vui vì được phục vụ bạn.</p>
    </div>
</body>

