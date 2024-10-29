
{{--    
@extends('layouts.admin_home')

    @section('calendar_room_booking')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/statistical/calendar_room_booking.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    </head>
    <body>
            
    <!-- Calendar container -->
    <div class="wrapper_calendar">
        <div id="calendar" style="margin-top: 20px;"></div>
    </div>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var month = @json($month);
            var eventsData = @json($getDT); // Truyền dữ liệu tổng doanh thu từ PHP sang JavaScript
            
            // Khởi tạo sự kiện từ dữ liệu doanh thu
            var events = eventsData.map(data => ({
                title: `Doanh thu: ${data.tong_dt} VND`,
                start: data.ngay_thanh_toan // Ngày thanh toán
            }));
            
            var initialDate = month ? `2024-${month.toString().padStart(2, '0')}-01` : moment().format('YYYY-MM-DD'); 

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: initialDate,
                events: events, // Gán dữ liệu sự kiện vào lịch
                headerToolbar: {
                    start: 'title', 
                    center: '',
                    end: ''
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
    </script>
    @endsection
 --}}

 @extends('layouts.admin_home')

    @section('calendar_room_booking')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('admin/ad_css/statistical/calendar_room_booking.css')}}">
            <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
            <style>
                /* Tạo các màu nền cho sự kiện */
                .fc-event {
                    color: #fff; /* Màu chữ cho sự kiện */
                    padding: 5px;
                    border-radius: 5px;
                    text-align: center;
                }
            </style>
        </head>
        <body>
                
        <!-- Calendar container -->
        <div class="wrapper_calendar">
            <div id="calendar" style="margin-top: 20px;"></div>
        </div>

        <div class="back_room">
            <a href="{{ route('admin.room_booking_details')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
        </div>

        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var month = @json($month);
                var eventsData = @json($getDT); // Truyền dữ liệu tổng doanh thu từ PHP sang JavaScript
                
                // Khởi tạo sự kiện từ dữ liệu doanh thu, với màu ngẫu nhiên cho mỗi sự kiện
                var events = eventsData.map(data => ({
                    title: `Doanh thu: ${data.tong_dt} VND`,
                    start: data.ngay_thanh_toan, // Ngày thanh toán
                    backgroundColor: getRandomColor(), // Màu nền ngẫu nhiên
                }));
                
                var initialDate = month ? `2024-${month.toString().padStart(2, '0')}-01` : moment().format('YYYY-MM-DD'); 

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    initialDate: initialDate,
                    events: events, // Gán dữ liệu sự kiện vào lịch
                    headerToolbar: {
                        start: '', 
                        center: 'title', // Căn giữa title
                        end: ''
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

                // Hàm tạo màu ngẫu nhiên
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            });
        </script>
    @endsection

