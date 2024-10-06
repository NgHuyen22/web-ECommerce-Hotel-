<div>
    <h3>CT258 - HTQLKS</h3>
    <h2>HazBin Hotel - Cập nhật lại mật khẩu</h2>
    <p>Xin chào <span style="font-weight: bold;">{{$customer -> ho_ten }}</span>. Hệ thống nhận được yêu cầu cập nhật lại mật khẩu từ email bạn đã cung cấp .</p>
    <p>Để tiếp tục , bạn vui lòng click vào link bên dưới :</p>
    <p>Chú ý : mã xác nhận chỉ có hiệu lực trong 15 phút.</p>
    <p>{{$token}}</p>
    <p>
            <a href="{{ route('customer.getPass',['id_ctm' => $customer -> id, 'token' => $token])}}" style="display:inline-block ; background: rgb(4, 135, 91); color: #fff; font-weight: bold; font-size: 20px; text-align:center;">Đặt lại mật khẩu</a>
    </p>
</div>