
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="font-family: Arial, sans-serif; color: #333;">
        <h3 style="color:#204468; font-weight:bold;">HazBin Hotel - Thông báo đặt phòng thành công!</h3>
        <p>Xin chào {{$customer -> gioi_tinh == '1' ? 'chị' : 'anh' }} <span style="font-weight: bold;">{{$customer -> ho_ten }}</span>.</p>
        <p>Chúng tôi đã nhận được đơn đặt phòng từ bạn. Dưới đây là thông tin đơn của bạn:</p>
        
        <div style="background-color: #f4f4f4; padding: 10px; width: 300px">
            <p>ID: <strong>{{ $getForm -> id_don }}</strong></p>
            <p>Phòng: <strong>{{ $getNameRT ->ten_lp }} - {{ $getForm -> so_phong }}</strong></p>
            <p>Ngày nhận phòng: <strong>{{ $getForm -> ngay_nhan_phong }}</strong></p>
            <p>Ngày trả phòng: <strong>{{ $getForm -> ngay_tra_phong }}</strong></p>
            <p>Số ngày ở: <strong>{{ $getForm -> so_ngay_o }}</strong></p>
            <p>Ghi chú: <strong>{{ $getForm -> ghi_chu ?? 'Không có' }}</strong></p>
            <p>Tình trạng : <span style="color: #da3e2d;font-weight: bold;">{{$getForm -> tinh_trang}}</span></p>
        </div>

        <p>Chúng tôi sẽ liên lại với bạn trong thời gian sớm nhất. Cảm ơn bạn đã liên hệ với HazBin Hotel!</p>
        <p>Trân trọng,</p>
        <p>Đội ngũ hỗ trợ khách hàng HazBin Hotel</p>
        <p style="color: rgb(225, 79, 79);font-size:0.7rem">Đây là tin nhắn tự vui lòng không phản hồi. Mọi thắc mắc xin liên hệ : (12) 345 67890</p>
    </div>
</body>

