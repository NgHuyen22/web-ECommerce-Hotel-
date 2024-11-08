@extends('layouts.admin_home')

@section('calendar_room_booking')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/booking_management/calendar.css')}}">
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
        {{-- <form action="{{ route('admin.view_booking_schedule') }}" class="select_room" method="GET">
            <select name="id_lp" id="roomTypeSelect" class="form-control select_item">
                <option value=""  selected hidden>Chọn loại phòng</option>
                @if($roomTypes ->isNotEmpty())
                    @foreach ($roomTypes as $item)
                    <option value="{{ $item-> id_lp }}">{{$item -> ten_lp}}</option>
                    @endforeach
                @else
                    <option value="" disabled>Trống..</option>
                @endif
            </select>

            <button type="submit" class="button">
                Chọn
            </button>
        </form> --}}

        <form action="" class="select_room" method="POST" id="roomForm">
            @csrf
            <select name="id_lp" id="roomTypeSelect" class="form-control select_item" onchange="submitFormWithRoomType()">
                <option value="" selected hidden>Chọn loại phòng</option>
                @if($roomTypes->isNotEmpty())
                    @foreach ($roomTypes as $item)
                        {{-- <option value="{{ $item->id_lp }}">{{ $item->ten_lp }}</option> --}}
                        <option value="{{ $item->id_lp }}" {{ isset($id_lp) && $id_lp == $item->id_lp ? 'selected' : '' }}>
                            {{ $item->ten_lp }}
                        </option>
                    @endforeach
                @else
                    <option value="" disabled>Trống..</option>
                @endif
            </select>
        </form>
        
        <div class="wrapper_calendar" id="wrapperCalendar" style="display: none;">
            <div id="calendar" style="margin-top: 20px;"></div>
        </div>

        <div class="back_room">
            <a href="{{ route('admin.booking_management')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
        </div>

        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>


      {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var rooms = @json($rooms);
                var bookings = @json($bookings); 
        
                var totalRooms = rooms.length;
                var events = [];
                var processedDates = {};
        
                // Xử lý dữ liệu đặt phòng và tạo sự kiện cho FullCalendar
                bookings.forEach(function(booking) {
                    var startDate = booking.ngay_nhan_phong;
                    var endDate = booking.ngay_tra_phong;
                    var dateRangeKey = `${startDate}:${endDate}`;
        
                    if (processedDates[dateRangeKey]) return;
        
                    var bookedRooms = bookings.filter(function(b) {
                        return b.ngay_nhan_phong <= endDate && b.ngay_tra_phong >= startDate;
                    }).length;
        
                    var availableRooms = totalRooms - bookedRooms;
                    var color = availableRooms > 0 ? '#36cdef' : '#ff0000';
        
                    // Thêm sự kiện vào danh sách
                    events.push({
                        title: availableRooms > 0 ? `Còn trống: ${availableRooms} phòng` : "Đã đầy",
                        start: startDate,
                        end: moment(endDate).add(1, 'day').format('YYYY-MM-DD'), 
                        color: color,
                    });
        
                    processedDates[dateRangeKey] = true; 
                });
        
                console.log(events);
        
                // Thiết lập initialDate là ngày bắt đầu của sự kiện đầu tiên nếu có
                var initialDate = events.length > 0 ? events[0].start : moment().format('YYYY-MM-DD');
        
                // Khởi tạo FullCalendar với initialDate và các sự kiện đã xử lý
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    initialDate: initialDate, // Thiết lập ngày khởi tạo lịch
                    events: events, // Sử dụng các sự kiện đã xử lý
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    locale: 'vi',
                    buttonText: {
                        today: 'Hôm nay'
                    },
                    monthNames: [
                        'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                        'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                });
        
                calendar.render();
            });
    </script>  --}}

      <script>
        function submitFormWithRoomType() {
            const selectElement = document.getElementById('roomTypeSelect');
            const selectedRoomType = selectElement.value;
    
            if (selectedRoomType) {
                const form = document.getElementById('roomForm');
                const url = `{{ route('admin.booking_schedule', ['id_lp' => ':id_lp']) }}`.replace(':id_lp', selectedRoomType);
                form.action = url;
                form.submit();
            }
        }
    
        document.addEventListener('DOMContentLoaded', function() {
            @if(isset($rooms) && isset($bookings))
                // Hiển thị lịch nếu có dữ liệu rooms và bookings
                document.getElementById('wrapperCalendar').style.display = 'block';
                
                const calendarEl = document.getElementById('calendar');
                const rooms = @json($rooms);
                const bookings = @json($bookings);
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
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    locale: 'vi',
                    buttonText: { today: 'Hôm nay' }
                });
    
                calendar.render();
            @endif
        });
    </script>

    </body>
@endsection