{{-- 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="font-family: Arial, sans-serif; color: #333;">
        <p>Xin chào {{$gioi_tinh == '1' ? 'chị' : 'anh' }} <span style="font-weight: bold;">{{ $ho_ten }}</span></p>
        <p>Chúng tôi đã nhận được yêu cầu liên hệ của bạn với nội dung sau:</p>
        
         <div style="background-color: #f4f4f4; padding: 10px; width: 300px;">
            <p>Họ tên: <strong>{{ $ho_ten }}</strong></p>
            <p>Giới tính: <strong>{{ $gioi_tinh == '1' ? 'Nữ' : 'Nam' }}</strong></p>
            <p>Địa chỉ: <strong>{{ $dia_chi }}</strong></p>
            <p>Số điện thoại: <strong>{{ $sdt }}</strong></p>
            <p>Nội dung liên hệ: <strong>{{ $noi_dung }}</strong></p>
        </div>
        <p>Chúng tôi sẽ liên lại với bạn trong thời gian sớm nhất. Cảm ơn bạn đã liên hệ với HazBin Hotel!</p>
        <p>Trân trọng,</p>
        <p>Đội ngũ hỗ trợ khách hàng HazBin Hotel</p>
    </div>
</body>
 --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="font-family: Arial, sans-serif; color: #333;">
        <p>Xin chào {{$gioi_tinh == '1' ? 'chị' : 'anh' }} <span style="font-weight: bold;">{{ $ho_ten }}</span></p>
        <p>Chúng tôi đã nhận được yêu cầu liên hệ của bạn với nội dung sau:</p>
        
         <div style="background-color: #f4f4f4; padding: 10px; width: 250px;">
            <p>Họ tên: {{ $ho_ten ?? 'Không có thông tin' }}</p>
            <p>Giới tính: <strong>{{ $gioi_tinh == '1' ? 'Nữ' : 'Nam' }}</strong></p>
            <p>Địa chỉ: <strong>{{ $dia_chi ?? 'Không có thông tin' }}</strong></p>
            <p>Số điện thoại: <strong>{{ $sdt ?? 'Không có thông tin'}}</strong></p>
            <p>Nội dung liên hệ: <strong>{{ $noi_dung ?? 'Không có thông tin'}}</strong></p>
        </div>
        <p>Chúng tôi sẽ liên lại với bạn trong thời gian sớm nhất. Trân trọng</p>
        <p style="font-size: 0.9rem">Đội ngũ hỗ trợ khách hàng HazBin Hotel</p>
        <p style="color: rgb(225, 79, 79);font-size:0.9rem">Đây là tin nhắn tự vui lòng không phản hồi. Mọi thắc mắc xin liên hệ : (12) 345 67890</p>
    </div>
</body>

