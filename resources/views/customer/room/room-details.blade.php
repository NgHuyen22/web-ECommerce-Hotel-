@extends('layouts.customer_home')
@section('room_detail')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('customer/ctm_css/room/room_detail.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

        <style>
            .fc-event {
                color: #fff;
                padding: 5px;
                border-radius: 5px;
                text-align: center;
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
                        timer: 2500
                    });
                </script>
            @endif

            @if(Session::has('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        text: "{{ Session::get('success') }}",
                        showConfirmButton: false,
                        timer: 2300
                    });
                </script>
        @endif

        <!-- Breadcrumb Section Begin -->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            {{-- <h2>Chi Tiết Phòng</h2> --}}
                            <div class="bt-option">
                                <a href="{{ route('customer.room_index')}}">Phòng</a>
                                <span>Chi Tiết Phòng</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section End -->
        @if($room_detail != null)
        <!-- Room Details Section Begin -->
            <section class="room-details-section spad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            @if($room_detail != null)
                                <div class="room-details-item">

                                    <img src="{{ asset('customer/img/room/' . $room_detail->ten_lp . '.jpg') }}" alt="">
                                    <div class="rd-text">
                                        <div class="rd-title">
                                            <h3 style="font-weight: bold">{{ $room_detail -> ten_lp}} </h3>

                                            {{-- <div class="rdt-right1">
                                                <div class="rating">
                                                    <i class="fa-solid fa-star" style="color: #f4c725;"></i>
                                                    <i class="fa-solid fa-star" style="color: #f4c725;"></i>
                                                    <i class="fa-solid fa-star" style="color: #f4c725;"></i>
                                                    <i class="fa-solid fa-star" style="color: #f4c725;"></i>
                                                    <i class="fa-solid fa-star" style="color: #f4c725;"></i>
                                                </div>
                                            </div> --}}

                                            <div class="rdt-right1">
                                                <div class="rating">
                                                    @php
                                                        $fullStars = floor($avg); // Số sao vàng đầy đủ
                                                        $hasHalfStar = ($avg - $fullStars >= 0.1 && $avg - $fullStars < 1) ? true : false; 
                                                        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                                    @endphp
                                            
                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fa-solid fa-star" style="color: #f4c725;"></i>
                                                    @endfor
                                            
                                                    @if ($hasHalfStar)
                                                        <i class="fa-solid fa-star-half-alt" style="color: #f4c725;"></i> 
                                                    @endif
                                            
                                                    @for ($i = 0; $i < $emptyStars; $i++)
                                                        <i class="fa-solid fa-star" style="color: #cccccc;"></i>
                                                    @endfor
                                                    <span style="margin-left: 10px; font-weight: bold;">({{ number_format($avg, 1) }}/5)</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <h4>{{ number_format($room_detail->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h4>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="r-o">Mô tả :</td>
                                                    <td>{{ $room_detail -> mo_ta}} </td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Diện tích :</td>
                                                    <td>{{ $room_detail -> dien_tich}} </td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Sức chứa :</td>
                                                    <td>{{ $room_detail -> suc_chua}} người</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Số Lượng :</td>
                                                    <td> {{ $countRoom}} </td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>

                                <div class="form__table">
                                    <div class="d-flex align-items-start w-100 wrapper_div">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active room_detail--button" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" >TIỆN NGHI</button>
                                        {{-- <button class="nav-link room_detail--button" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">ĐÁNH GIÁ</button> --}}
                                        {{-- <button class="nav-link room_detail--button" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">DỊCH VỤ KHÁC</button> --}}
                                        <button class="nav-link room_detail--button" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">LỊCH ĐẶT</button>
                                        </div>
                                        <div class="tab-content w-100 div1" id="v-pills-tabContent ">
                                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            
                                                        <table class="room_detail--table">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col"><i class="fa-solid fa-bed" style="color: #204468;"></i> Phòng Ngủ</th>
                                                                <th scope="col"><i class="fa-solid fa-bath" style="color: #204468;"></i> Phòng Tắm</th>
                                                                </tr>
                                                            </thead>
                                                                <tbody>

                                                                    <tr style="">      
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.5rem"></i>{{ $room_detail -> tien_nghi}}</td>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.1rem"></i> Vòi sen</td>
                                                                    </tr>

                                                                    <tr>      
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.5rem"></i> Tủ quần áo</td>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.1rem"></i> Bồn tắm</td>
                                                                    </tr>

                                                                    <tr>      
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.5rem"></i> Thảm lau</td>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.1rem"></i> Đồ dùng vệ sinh cá nhân</td>
                                                                    </tr>

                                                                </tbody>         
                                                        </table>
                                                        <br>
                                                        <table class="room_detail--table1">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col"><i class="fa-solid fa-utensils" style="color: #204468;"></i> Nhà Bếp</th>
                                                                <th scope="col"><i class="fa-solid fa-robot" style="color: #204468;"></i> Thiết Bị</th>
                                                                </tr>
                                                            </thead>
                                                                <tbody>

                                                                    <tr>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.1rem"></i> Bếp ga</td>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.5rem"></i> Ổ cắm</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.1rem"></i> Tủ lạnh</td>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.5rem"></i> Tivi</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.1rem"></i> Khay đựng chén , dĩa</td>
                                                                        <td><i class="fa fa-circle" style="font-size: 0.3rem; vertical-align: middle; margin-right: 0.1rem; margin-left: 1.5rem"></i> Đèn ngủ</td>
                                                                    </tr>

                                                            </tbody>                                                          
                                                        </table>
                                            </div>      
                                            
                                            {{-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                
                                            </div> --}}
                                            <!-- Tab Pane for LỊCH ĐẶT -->
                                            <div class="tab-pane fade div2" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" style="">
                                                <div class="wrapper_calendar" id="wrapperCalendar">
                                                    <div id="calendar" style=""></div>
                                                </div>
                                                <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                       
                                                            document.getElementById('wrapperCalendar')
                                                            
                                                            const calendarEl = document.getElementById('calendar');
                                                            const rooms = @json($room_calendar);
                                                            const bookings = @json($bookings);
                                                            console.log(bookings);
                                                
                                                            const totalRooms = rooms.length;
                                                            const events = [];
                                                            const processedDates = {};
                                                
                                                            bookings.forEach(function(booking) {
                                                                const startDate = booking.ngay_nhan_phong;
                                                                const endDate = booking.ngay_tra_phong;
                                                                const dateRangeKey = `${startDate}:${endDate}`;
                                                
                                                                if (processedDates[dateRangeKey]) return;
                                                
                                                                const bookedRooms = bookings.filter(b => 
                                                                    b.ngay_nhan_phong <= endDate && b.ngay_tra_phong >= startDate
                                                                ).length;
                                                
                                                                const availableRooms = totalRooms - bookedRooms;
                                                                const color = availableRooms > 0 ? '#36cdef' : '#ff0000';
                                                
                                                                events.push({
                                                                    title: availableRooms > 0 ? `Còn trống: ${availableRooms} phòng` : "Đã đầy",
                                                                    start: startDate,
                                                                    end: moment(endDate).add(1, 'day').format('YYYY-MM-DD'),
                                                                    color: color,
                                                                });
                                                
                                                                processedDates[dateRangeKey] = true;
                                                            });
                                                
                                                            const calendar = new FullCalendar.Calendar(calendarEl, {
                                                                initialView: 'dayGridMonth',
                                                                initialDate: events.length > 0 ? events[0].start : moment().format('YYYY-MM-DD'),
                                                                events: events,
                                                                headerToolbar: {
                                                                    left: 'prev,next today',
                                                                    center: 'title',     
                                                                    right: '',                                                     
                                                                },
                                                                locale: 'vi',
                                                                buttonText: { today: 'Hôm nay' }
                                                            });
                                                
                                                            calendar.render();
                                                    });
                                                </script>
                                            </div>
                                    </div>
                                </div>
                            </div>

                                <div class="rd-reviews">
                                    <h4 style="font-weight:bold;color:#2e659b">Đánh giá ({{ $getEV->count()}} lượt)</h4>
                                    @if($getLimitEV ->isNotEmpty())
                                        <div class="review-item">
                                            @foreach ($getLimitEV as $ev )
                                                <div class="ri-text">
                                                        <span style="font-weight:bold">{{$ev -> updated_at}}</span>
                                                    <div class="rating">
                                                        @php
                                                            $fullStars = floor($ev->diem); // Số sao vàng đầy đủ
                                                            $emptyStars = 5 - $fullStars; // Tính số sao trống
                                                        @endphp
                                
                                                        @for ($i = 0; $i < $fullStars; $i++)
                                                            <i class="fa fa-star starIs" style="color: #f4c725;"></i>
                                                        @endfor
                                
                                                        @for ($i = 0; $i < $emptyStars; $i++)
                                                            <i class="fa fa-star starIs" style="color: #cccccc;"></i>
                                                        @endfor
                                                    </div>
                                                    <h5 style="font-weight:bold">{{$ev -> ho_ten}}</h5>
                                                    <p>{{$ev -> noi_dung}}</p>
                                                </div>                                               
                                            @endforeach
                                        </div>
                                        @if(count($getEV) > 2)
                                            <a href="" class="more_review">Xem thêm</a>
                                        @endif
                                    @else
                                        <div class="review-item">
                                            <p>Chưa có bài đánh giá..</p>
                                        </div>
                                    @endif
                                </div> 

                            @else
                                <span>Hiện tại loại phòng này chưa được cập nhật, bạn vui lòng tham khảo loại phòng khác nhé !</span>
                            @endif

                        </div>

                        <div class="col-lg-4 room-booking-wrapper" style="">
                            <div class="room-booking room_booking">
                                <h3 style="text-align: center; margin-top:1rem">Đặt Phòng</h3>
                                <form action= "{{ route('customer.booking_room')}}" class="" method="POST" id="booking_form">
                                    @csrf
                                    <div class="check-date">
                                        <label for="date-in">Ngày nhận phòng :  <span style="color:#d70951"> *</span></label>
                                        {{-- <input type="date" class="date-input" id="date-in" name="ngay_nhan_phong"> --}}
                                        <input type="text" class="date-input" id="date-in" name="ngay_nhan_phong" value="{{ old('ngay_nhan_phong') }}">
                                        {{-- <i class="fa-solid fa-calendar-days" style="color: #204468"></i> --}}
                                    </div>
                                    <div class="check-date">
                                        <label for="date-out">Ngày trả phòng :  <span style="color:#d70951"> *</span></label>
                                        {{-- <input type="date" class="date-input"  id="date-out" name="ngay_tra_phong"> --}}
                                        <input type="text" class="date-input"  id="date-out" name="ngay_tra_phong" value="{{ old('ngay_tra_phong') }}">
                                        {{-- <i class="fa-solid fa-calendar-days" style="color: #204468"></i> --}}
                                    </div>
                                    <div class="check-date">
                                        <label for="note">Ghi chú : </label>
                                        <textarea class="form-control updated_form--input" aria-label="With textarea"  id="note"  name ="ghi_chu" ></textarea>
                                    </div>
                                    
                                    <div class="check-date">
                                        <label for="quantity">Số lượng:</label>
                                        <div class="quantity-control">
                                            {{-- <button type="button" class="quantity-btn minus-btn">-</button> --}}
                                            <input type="number" class="form-control quantity-input" id="quantity" name="so_luong" value="1" min="1" max={{ $countRoom}} value="{{ old('so_luong') }}">
                                            {{-- <button type="button" class="quantity-btn plus-btn">+</button> --}}
                                        </div>
                                    </div>
                                    
                            

                                    <input type="hidden" name="id_rt" value="{{ $room_detail -> id_lp}}">
                                    <input type="hidden" name="ten_lp" value="{{ $room_detail -> ten_lp}}">
                                    
                                    <button type="submit">Đặt Ngay</button>
                                </form>
                            </div>
                            
                            <div class="separator"></div> 

                            <div class="room_preview" style="background-color: rgb(220, 220, 220)">
                                <h4 style="text-align: center; margin-top:1rem; border-bottom: 2px dotted rgb(126, 124, 124) !important;padding-bottom:0.3em">Tham Khảo (1 Phòng)</h4>

                                <div class="content_wrapper">
                                    <div class="content_wrapper2">
                                        <p class="preview-content"  name="so_ngay_o">Thời gian:</p>
                                        <p class="preview-content">Thanh toán :</p>
                                    </div>

                                    <div class="content_wrapper2">
                                        <p class="preview-content" id="differenceInTime"></p>
                                        <p class="preview-content" id="pay">
                                            {{ number_format($room_detail -> gia_lp, 0 , ',' , '.')}} VND
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </section>
        @else
                <p>Chưa có dữ liệu... Chúng tôi sẽ sớm cập nhật .</p>
        @endif

        <script>
                 document.getElementById("booking_form").addEventListener("submit", function(event) {
                    var ngayDen = document.getElementById('date-in').value;
                    var ngayNhan = document.getElementById('date-out').value;

    
                    if (ngayDen === "" || ngayNhan === "") {
                        event.preventDefault(); 
                        Swal.fire({
                            icon: 'error',
                            text: 'Vui lòng không để trống.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
            });
           

        </script>
        <script>
             @if(session('ngay_nhan_phong'))
                Swal.fire({
                    title: 'Xác nhận thông tin đặt phòng',
                    html: `   <style>
                                        .swal2-background-custom{
                                            border: 2px solid black; 
                                            border-radius: 1rem; 
                                        }
                                        .nice-select {
                                            display: none !important;
                                        }
                                        
                                         .list1 {
                                            justify-content: space-between;
                                        }
                                        .item1 {
                                            width: 46%;
                                        }
                                        .item2 {
                                            width: 50%;
                                        }
                                        .form-control {
                                            margin-top: 0.2rem;
                                            margin-bottom: 0.5rem;
                                            text-align: center;
                                        }
                                        .label_form {
                                            margin-top: 0.5rem;
                                        }
                                        .room--tools {
                                            margin-top: 0.4rem;
                                            justify-content: space-between;
                                        }
                                        .label_bf p{
                                            color: #b2b2b2 !important;
                                        }
                                        .countRoomNull p{
                                            color: #b2b2b2 !important;                                          
                                        }
                                        .countRoomNull p span{
                                            color: #b2b2b2 !important;                                          
                                        }
                                </style>
                    <form id="confirmBF_form" class="confirmBF_form" action="{{ route('customer.insert_form') }}" method="POST">
                        @csrf
                       <div class ="label_bf">
                            <p>Thông tin khách hàng :</p>
                        </div> 
                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="ho_ten" class="label_form">Họ Tên</label>
                                <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="{{ session('ho_ten') }}" readonly/>
                                </div>
                                <div class="form-group item2">
                                    
                                    <label for="gioi_tinh" class="label_form">Giới Tính</label>
                                    <input type="text" class="form-control" id="gioi_tinh" name="gioi_tinh" value="{{ session('gioi_tinh') == 1 ? 'Nữ' : 'Nam'}}" readonly/>
                            </div>
                        </div>

                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="sdt" class="label_form">SDT</label>
                                <input type="text" class="form-control input_form" id="sdt" name="sdt" value="{{ session('sdt') }}" readonly />
                            </div>
                            <div class="form-group item2">
                                <label for="email" class="label_form">Email</label>
                                <input type="text" class="form-control input_form" id="email" name="email" value="{{  session('email') }}" readonly/>
                            </div>
                        </div>

                        <div class ="label_bf">
                            <p>Thông tin đặt phòng :</p>
                        </div> 
                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="ngay_nhan_phong" class="label_form">Ngày Nhận Phòng</label>
                                <input type="text" class="form-control input_form" id="ngay_nhan_phong" name="ngay_nhan_phong" value="{{  session('ngay_nhan_phong') }}" readonly/>
                            </div>
                            <div class="form-group item2">
                                <label for="ngay_tra_phong" class="label_form">Ngày Trả Phòng</label>
                                <input type="text" class="form-control input_form" id="ngay_tra_phong" name="ngay_tra_phong" value="{{ session('ngay_tra_phong') }}" readonly />
                            </div>
                        </div>

  
                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="ghi_chu" class="label_form">Ghi Chú</label>
                                <input type="text" class="form-control input_form" id="ghi_chu" name="ghi_chu" value="{{ session('ghi_chu') }}" readonly />
                            </div>
                            <div class="form-group item2">
                                <label for="so_luong" class="label_form">Số Lượng</label>
                                <input type="text" class="form-control input_form" id="so_luong" name="so_luong" value="{{ session('so_luong') }}" readonly/>
                            </div>
                        </div>

                         <div class ="countRoomNull">
                                <p>Số phòng trống : <span>{{ session('so_phong_trong')}}</span></p>
                        </div>
                         <input type="hidden" name="id_kh" value="{{ session('id_kh') }}">
                         <input type="hidden" name="id_loai_phong" value="{{ session('id_loai_phong') }}">
                    </form>`,
                    icon: 'info',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy',
                    showCancelButton: true,
                    confirmButtonColor: '#04AA6D',
                    cancelButtonColor: 'rgb(246, 81, 81)',
                    customClass: {
                            popup: 'swal2-background-custom',
                            container: 'swal2-borderless'
                        },
                      
                            background: '#30547e' ,
                            color: 'white'    
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('confirmBF_form').submit(); 
                    }
                });
            @endif
        </script>

        <script>{{ asset('customer/ctm_js/room/room_detail.js')}}</script>
        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    </body>
    </html>
@endsection
