/*  ---------------------------------------------------
    Template Name: Sona
    Description: Sona Hotel Html Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Offcanvas Menu
    $(".canvas-open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("show-offcanvas-menu-wrapper");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".canvas-close, .offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("show-offcanvas-menu-wrapper");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    // Search model
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Hero Slider
    --------------------*/
   $(".hero-slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        mouseDrag: false
    });

    /*------------------------
		Testimonial Slider
    ----------------------- */
    $(".testimonial-slider").owlCarousel({
        items: 1,
        dots: false,
        autoplay: true,
        loop: true,
        smartSpeed: 1200,
        nav: true,
        navText: ["<i class='arrow_left'></i>", "<i class='arrow_right'></i>"]
    });

    /*------------------
        Magnific Popup
    --------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*------------------
		Date Picker
	--------------------*/
    // $(".date-input").datepicker({
    //     minDate: 0,
    //     dateFormat: 'dd,MM, yy'
    // });

    $(".date-input").datepicker({
        minDate: 0,
        dateFormat: 'dd,MM, yy',  // Sử dụng 'yy' thay cho 'yyyy' trong jQuery UI
        onSelect: function(dateText, inst) {
            // Khi người dùng chọn ngày, định dạng lại ngày hiển thị
            var formattedDate = formatToCustomDate(dateText);
            $(this).val(formattedDate);  // Gán giá trị mới vào input
            calculateDays(); // Gọi hàm tính số ngày sau khi chọn ngày
        }
    });
    
    // Hàm chuyển định dạng từ 'dd,MM, yy' thành 'dd-MM-yyyy' hoặc 'dd/MM/yyyy'
    function formatToCustomDate(dateStr) {
        // Tách chuỗi ngày thành các phần
        var parts = dateStr.split(',');
        var day = parts[0].trim();
        var monthText = parts[1].trim();
        var year = parts[2].trim();
    
        // Tạo đối tượng Date từ chuỗi
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var monthNumber = monthNames.indexOf(monthText) + 1; // Lấy số tháng từ tên tháng
    
        // Đảm bảo tháng là 2 chữ số
        monthNumber = monthNumber.toString().padStart(2, '0');
    
        // Định dạng ngày theo 'dd-MM-yyyy' hoặc 'dd/MM/yyyy'
        return `${day}-${monthNumber}-${year}`;  // Hoặc `${day}/${monthNumber}/${year}`
    }
    
    // Hàm chuyển chuỗi 'dd/MM/yyyy' thành đối tượng Date
    function parseDate(dateStr) {
        var parts = dateStr.split('-'); // Sử dụng dấu '-' do dateStr theo định dạng 'dd-MM-yyyy'
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10) - 1;  // JavaScript months are 0-11
        var year = parseInt(parts[2], 10);
        return new Date(year, month, day);
    }
    

    // Hàm định dạng lại số thành định dạng tiền tệ
    function number_format(number, decimals, decPoint, thousandsSep) {
        number = number.toFixed(decimals);
        var parts = number.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);
        return parts.join(decPoint);
    }

    // Hàm tính số ngày giữa hai ngày
    function calculateDays() {
        var dateIn = document.getElementById('date-in').value;
        var dateOut = document.getElementById('date-out').value;
        var payText = document.getElementById('pay').innerText; // do thẻ p kh phải input nên kh dùng value dc
        var pay = parseInt(payText.replace(/\./g, '').replace(' VND', ''), 10); // Xóa dấu chấm và chữ "VND" rồi chuyển thành số
        // Kiểm tra xem cả hai ngày đã được nhập
        if (dateIn && dateOut) {
            var ngayNhan = parseDate(dateIn);  // Sử dụng parseDate để chuyển đổi từ chuỗi sang Date
            var ngayTra = parseDate(dateOut);
    
            // Tính số mili giây giữa hai ngày
            var differenceInTime = ngayTra.getTime() - ngayNhan.getTime();
            var differenceInDays = differenceInTime / (1000 * 3600 * 24);  // Chuyển đổi từ mili giây sang số ngày
            
            // Tính tổng tiền dựa trên số đêm và giá phòng
            var totalPay = differenceInDays * pay;
            // console.log("Tổng tiền (totalPay): ", totalPay); // Kiểm tra tổng tiền
            
            // Cập nhật nội dung hiển thị trong ô "Thời gian" và "Thanh toán"
            document.getElementById('differenceInTime').innerText = `(${differenceInDays} đêm)`;
            document.getElementById('pay').innerText = `${number_format(totalPay, 0 , ',' , '.')} VND`;
        }
    }
    
    // Thêm sự kiện để tính ngày khi thay đổi
    document.getElementById('date-in').addEventListener('change', calculateDays);
    document.getElementById('date-out').addEventListener('change', calculateDays);
    

    /*------------------
		Nice Select
	--------------------*/
    $("select").niceSelect();

})(jQuery);