{{-- <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa Đơn</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('path/to/DejaVuSans.ttf') format('truetype'); /* Đường dẫn tới file phông chữ */
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif; /* Sử dụng phông chữ hỗ trợ tiếng Việt */
        }
        .wrapper {
            width: 40rem;
            border: 1px solid rgb(18, 122, 196); 
            padding: 10px;
        }
        .content {
            width: 30rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px; /* Thêm khoảng cách giữa các dòng */
        }
    </style>
</head>
<body>
        <h2 style="font-weight: bold ; text-align:center;color:rgb(25, 103, 159)">Hóa Đơn</h2>
        <div style="" class="wrapper">
                <div class="content" style="">
                    <p style="float: left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">ID : </span> <span>{{ $bill -> id_hd}}</span></p>
                    <p style="float: right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Khách Hàng : </span><span>{{ $bill -> ho_ten}}</span></p> 
                </div>

                <div class="content">
                    <p style="float: left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Phòng : </span> <span>{{ $bill -> so_phong}}</span></p>
                    <p style="float: right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Loại Phòng : </span> <span>{{ $bill -> id_lp}}</span></p>
                </div>

                <div class="content">
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Trễ Hạn : </span> <span>{{$bill -> tre_han}} ngày</span></p>
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Phí Thêm : </span> <span >{{ number_format($bill -> phi_them,0,',','.')}} VND</span></p>
                </div>

                <div class="content">
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Phí DV : </span> <span style="font-weight: bold;color:rgb(237, 180, 107)">{{number_format($bill -> phi_dv,0,',','.')}} VND</span></p>
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Tổng Tiền : </span> <span style="font-weight: bold;color:rgb(237, 180, 107)">{{number_format($bill -> tong_tien,0,',','.')}} VND</span></p>
                </div>

                <div class="content">
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Tạo : </span> <span>{{$bill -> created_at}}</span></p>
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Cập Nhật : </span> <span>{{$bill -> updated_at}}</span></p>
                </div>
            </div>
        </div>
</body>
</html> --}}

\{{-- <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa Đơn</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('path/to/DejaVuSans.ttf') format('truetype'); /* Đường dẫn tới file phông chữ */
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif; /* Sử dụng phông chữ hỗ trợ tiếng Việt */
        }
        .wrapper {
            width: 40rem;
            border: 1px solid rgb(18, 122, 196); 
            padding: 10px;
        }
        .content {
            width: 30rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px; /* Thêm khoảng cách giữa các dòng */
        }
    </style>
</head>
<body>
        <h2 style="font-weight: bold ; text-align:center;color:rgb(25, 103, 159)">Hóa Đơn</h2>
        <div style="" class="wrapper">
                <div class="content" style="">
                    <p style="float: left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">ID : </span> <span>{{ $bill -> id_hd}}</span></p>
                    <p style="float: right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Khách Hàng : </span><span>{{ $bill -> ho_ten}}</span></p> 
                </div>

                <div class="content">
                    <p style="float: left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Phòng : </span> <span>{{ $bill -> so_phong}}</span></p>
                    <p style="float: right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Loại Phòng : </span> <span>{{ $bill -> id_lp}}</span></p>
                </div>

                <div class="content">
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Trễ Hạn : </span> <span>{{$bill -> tre_han}} ngày</span></p>
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Phí Thêm : </span> <span >{{ number_format($bill -> phi_them,0,',','.')}} VND</span></p>
                </div>

                <div class="content">
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Phí DV : </span> <span style="font-weight: bold;color:rgb(237, 180, 107)">{{number_format($bill -> phi_dv,0,',','.')}} VND</span></p>
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Tổng Tiền : </span> <span style="font-weight: bold;color:rgb(237, 180, 107)">{{number_format($bill -> tong_tien,0,',','.')}} VND</span></p>
                </div>

                <div class="content">
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Tạo : </span> <span>{{$bill -> created_at}}</span></p>
                    <p><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Cập Nhật : </span> <span>{{$bill -> updated_at}}</span></p>
                </div>
            </div>
        </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa Đơn</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('path/to/DejaVuSans.ttf') format('truetype'); /* Đường dẫn tới file phông chữ */
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif; /* Sử dụng phông chữ hỗ trợ tiếng Việt */
        }
        .wrapper {
            width: 43rem;
            border: 1px solid rgb(18, 122, 196); 
            padding: 10px;
        }
        .ttdp_table{
            width: 43rem;
            border-bottom: 1px solid rgb(18, 122, 196);
            padding: 10px;
        }
        table {
            width: 100%;
            /* border-collapse: collapse; */
            margin-bottom: 10px;
        }
        td {
            padding: 5px;
            
        }
        .left {
            text-align: left;
            width: 50%;
        }
        .right {
            text-align: right;
            width: 50%;
        }
    </style>
</head>
<body>
    <h2 style="font-weight: bold ; text-align:center;color:rgb(25, 103, 159)">Hóa Đơn</h2>
    <div class="wrapper">
        <table>
            <tr>
                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">ID :</span> {{ $bill->id_hd }}</td>
                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Khách Hàng :</span> {{ $bill->ho_ten }}</td>
            </tr>
        </table>
        
        <table>
            <tr>
                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159);width:50%">Phòng :</span> <span>{{ $bill->so_phong }}</span></td>
                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159);width:100%">Loại Phòng :</span> {{ $bill->id_lp }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Trễ Hạn :</span> {{ $bill->tre_han }} ngày</td>
                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Phí Thêm :</span><span style="font-weight: bold;color:rgb(237, 180, 107)"> {{ number_format($bill->phi_them, 0, ',', '.') }} VND</span></td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Phí DV :</span> <span style="font-weight: bold;color:rgb(237, 180, 107)">{{ number_format($bill->phi_dv, 0, ',', '.') }} VND</span> </td>
                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Tổng Tiền :</span> <span style="font-weight: bold;color:rgb(237, 180, 107)">{{ number_format($bill->tong_tien, 0, ',', '.') }} VND</span></td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Tạo :</span> {{ $bill->created_at }}</td>
                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Cập Nhật :</span> {{ $bill->updated_at }}</td>
            </tr>
        </table>
    </div>

    <h3 style="font-weight: bold ; text-align:center;color:rgb(25, 103, 159);margin-top: 4rem">Thông Tin Đặt Phòng</h3>
    <div class="wrapper">
        <table>
            <tr>
                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Nhận Phòng :</span> {{ $bill->ngay_nhan_phong }}</td>
                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Trả Phòng :</span> {{ $bill->ngay_tra_phong }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Số Ngày Ở :</span> {{ $bill->so_ngay_o }}</td>
                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Giá Loại Phòng : </span> {{ number_format($bill-> gia_lp, 0, ',', '.')}} VND</td>
            </tr>
        </table>
        @php
            $soNgay = $bill->so_ngay_o;
            $giaPhong = $bill -> gia_lp;
            $tong_tien = $soNgay * $giaPhong;
        @endphp
        <table>
            <tr>
                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Tổng Tiền :</span><span style="font-weight: bold;color:rgb(237, 180, 107)"> {{ number_format($tong_tien, 0, ',', '.') }} VND</span></td>
                {{-- <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Giá Loại Phòng : </span> {{ number_format($bill-> gia_lp, 0, ',', '.')}} VND</td> --}}
            </tr>
        </table>
    </div>


    {{-- <h3 style="font-weight: bold ; text-align:center;color:rgb(25, 103, 159)">Thông Tin Đặt DV</h3>
    <div class="ttdp_table">
        @if($services -> isNotEmpty())
            @foreach ($services as $sv)     
                <table>
                    <tr>
                        <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)"> :</span> {{ $bill->ngay_nhan_phong }}</td>
                        <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Trả Phòng :</span> {{ $bill->ngay_tra_phong }}</td>
                    </tr>
                </table>
            @endforeach
        @endif
    </div> --}}
    <h3 style="font-weight: bold; text-align:center;color:rgb(25, 103, 159);margin-top: 4rem">Thông Tin Đặt DV</h3>
  
        @if ($services->isNotEmpty())
            @foreach ($services as $sv)  
                <div class="ttdp_table">
                        @php
                            $finalPrice = $sv->don_gia_dv * $sv->so_luong_ct;
                            $discountAmount = 0;
                            $discountPercentage = 0;

                            if ($gia_sl->isNotEmpty()) {
                                foreach ($gia_sl as $dv) {
                                    if ($dv->id_dv == $sv->id_dv && $dv->giam != null) {
                                        if ($dv->sl_ap_dung <= $sv->so_luong_ct) {
                                            $discountPercentage = $dv->giam; 
                                        } else {
                                            $discountPercentage = 0;
                                        }
                                        break;
                                    }
                                }
                            }

                            if ($discountPercentage > 0) {
                                $discountAmount = $finalPrice * ($discountPercentage / 100);
                                $finalPrice -= $discountAmount;
                            }
                        @endphp
                        <table>
                            <tr>
                                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Tên Dịch Vụ:</span>{{ $sv->ten_dv }}</td>
                                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Giá  : </span> <span style="">{{ number_format($sv->don_gia_dv, 0, ',', '.') }} VND</span></td>
                            </tr>
                        </table>
                        
                        <table>
                            <tr>
                                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Số Lượng :</span>{{ $sv->so_luong_ct }}</td>
                                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ngày Sử Dụng : </span> {{ \Carbon\Carbon::parse($sv->ngay_su_dung)->format('d-m-Y') }}</td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ghi Chú :</span>{{ $sv->ghi_chu_ct ?? '' }}</td>
                                
                                <td class="right"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Ưu Đãi : </span>
                                    @if($gia_sl->isNotEmpty())
                                      @php $promotionDisplayed = false; @endphp
                                        @foreach ($gia_sl as $dv)
                                                @if($dv->id_dv == $sv->id_dv && !$promotionDisplayed)
                                                    @if($dv->sl_ap_dung <= $sv->so_luong_ct)
                                                        <span class="">{{ $dv -> ten_ud != null ? $dv->ten_ud : '' }}</span>
                                                        @php $promotionDisplayed = true; @endphp 
                                                    @endif
                                                @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <td class="left"><span style="font-weight: bold ;color: rgb(25, 103, 159)">Tổng : </span > <span style="font-weight: bold;color:rgb(237, 180, 107)"> {{ number_format($finalPrice, 0, ',', '.') }} VND</span></td>
                            </tr>
                        </table>
                </div>
            @endforeach
        @else
            <p>Chưa có dữ liệu...</p>
        @endif

</body>
</html>

