
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="font-family: Arial, sans-serif; color: #333;">
        <div style="background-color: #f4f4f4; padding: 10px; width: 250px;">
            <p>Họ Tên:   <span style="font-weight: bold;">{{  $info-> ho_ten ?? 'Không có thông tin'}}</span></p>
            <p>Nội dung liên hệ: <strong>{{ $info-> noi_dung_ll ?? 'Không có thông tin'}}</strong></p>
            <p>Ngày gửi: <strong>{{ $info -> created_at ?? 'Không có thông tin'}}</strong></p>
        </div>

        <p>{{ $noi_dung}}</p>
        <p></p>
        <p></p>
        <p style="font-size: 0.9rem">Trân trọng,</p>
        <p style="font-size: 0.9rem">Đội ngũ hỗ trợ khách hàng HazBin Hotel</p>
        <p style="color: rgb(225, 79, 79);font-size: 0.9rem">Mọi thắc mắc xin liên hệ : (12) 345 67890</p>
    </div>
</body>

