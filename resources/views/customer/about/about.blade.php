@extends('layouts.customer_home')
    @section('about')
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <link rel="stylesheet" href="{{ asset('customer/about/about.css')}}">
            </head>
            <body>

                
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <div class="bt-option">
                                <a href="{{ route('customer.index')}}">Trang Chủ</a>
                                <span>Giới Thiệu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Us Section Begin -->
            <section class="aboutus-section spad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-text">
                                <div class="section-title">
                                    <span>Về chúng tôi</span>
                                    <h2>Khách sạn Cần Thơ<br />HazBin Hotel</h2>
                                </div>
                                <p class="f-para">Khách sạn được thành lập 2014, với đội ngũ nhân viên chuyên nghiệp và các tiện nghi hiện đại, hứa hẹn sẽ mang đến cho du khách trải nghiệm ấn tượng .</p>
                                <p class="s-para">Giờ đây, du khách đã có một điểm đến lý tưởng ngay tại trung tâm thành phố Cần Thơ. 
                                    Sảnh chính rộng rãi, ngập tràn ánh sáng, kết hợp hài hòa giữa phong cách hiện đại và văn hóa miền Tây Nam Bộ, chào đón du khách đến với khách sạn Pullman Cần Thơ.
                                </p>
                                <p class="s-para hidden-content" style="display: hidden">Khách sạn được thiết kế với đa dạng các loại phòng, với tầm nhìn hướng ra sông Hậu và trung tâm thành phố sầm uất. Đây là một thiên 
                                    đường nghỉ dưỡng và công tác, chỉ cách sân bay Cần Thơ khoảng 15 phút di chuyển và dễ dàng tiếp cận các điểm tham quan nổi tiếng như chợ nổi Cái Răng.</p>
                                    <a href="javascript:void(0)" class="primary-btn about-btn" onclick="toggleReadMore()">Chi tiết</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-pic">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img src="{{ asset('customer/img/about/about-1.jpg') }}" alt="">
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="'{{ asset('customer/img/about/about-2.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- About Us Section End -->

            <div class="img_wrapper">

                <img src="https://images.pexels.com/photos/2684260/pexels-photo-2684260.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
            </div>
            <div class="address">
                <div>

                    <h4><a href=""><i class="fa-solid fa-location-dot location" style="color: rgb(255, 109, 109)"></i></a>Địa chỉ</h4>
                    <div class="info">
                        <p>HazBin Hotel</p>
                        <p>9C Tran Phu - P.Xuan Khanh - Q.Ninh Kieu - TP.Can Tho</p>
                        <p>Vietnam</p>
                        <p> (12) 345 67890</p>
                        <p>hazbinhotel@gmail.com</p>

                    </div>
                </div>
            </div>

            
                <script src="{{ asset('customer/ctm_js/about/about.js')}}"></script>
            </body>
            </html>
    @endsection