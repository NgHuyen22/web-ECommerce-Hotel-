    @extends('layouts.customer_home')
        @section('service_type.service_type')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('customer/ctm_css/service_type/service_type.css')}}">
        </head>
        <body>

            <div class="breadcrumb-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-text">
                                <p style="font-style: italic">HazBin là 1 trong những khách sạn nổi tiếng , được nhiều khách hàng tin tưởng và yêu thích . Không gian thoáng
                                    mát , đem lại cảm giác dễ chịu. Đi kèm các dịch vụ cũng như nhiều ưu đãi tốt nhất cho khách hàng cùng đội ngũ nhân viên phục vụ chu đáo , 
                                    tận tình chắc chắn sẽ không làm bạn thất vọng !!</p>
                                    {{-- <p></p> --}}
                                <div class="bt-option">
                                    <a href="{{ route('customer.index')}}">Trang Chủ</a>
                                    <span>Dịch Vụ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="video_wrapper">

                <video autoplay muted loop class="video_title">
                    <source src="https://videos.pexels.com/video-files/3998275/3998275-uhd_2732_1440_25fps.mp4" type="video/mp4" id ="source_service">
                </video>
            </div>
            @if($ldv != null)
                <?php
                        $images_ldv = [
                            1 => [
                                    'https://images.pexels.com/photos/1833349/pexels-photo-1833349.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                                    // 'https://images.pexels.com/photos/1741285/pexels-photo-1741285.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                                    'https://images.pexels.com/photos/1841184/pexels-photo-1841184.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                                    'https://images.pexels.com/photos/1126728/pexels-photo-1126728.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
                            ],

                            2 => [
                                    'https://images.pexels.com/photos/374148/pexels-photo-374148.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                                    'https://images.pexels.com/photos/4397840/pexels-photo-4397840.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                                    'https://images.pexels.com/photos/4056723/pexels-photo-4056723.jpeg?auto=compress&cs=tinysrgb&w=600'
                            ],
                        ];
                            $ldvImages = $images_ldv[$ldv -> id_ldv] ?? [
                                    'https://images.pexels.com/photos/96444/pexels-photo-96444.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                                    'https://images.pexels.com/photos/2096983/pexels-photo-2096983.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                                    'https://images.pexels.com/photos/210604/pexels-photo-210604.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
                            ];

                ?>
                    
                <div class="service_information">

                    <div class="service_img">
                        <div class="service_img--item">
                            <div class="item1">
                                <img src="{{$ldvImages[0]}}" alt=" {{ $ldv->ten_ldv}}">
                            </div>

                            <div class="item2">
                                <img src="{{$ldvImages[1]}}" alt=" {{ $ldv->ten_ldv}}">
                            </div>

                            <div class="item3">
                                <img src="{{$ldvImages[2]}}" alt=" {{ $ldv->ten_ldv}}">
                            </div>

                        </div>
                    </div>
                    <div class="service_content">
                        <div>
                    
                            <h4 style="margin-bottom : 1rem">{{ $ldv -> ten_ldv}}</h4>
                            <p style="font-style: italic;"> {{ $ldv -> mo_ta_ldv}}
                            </p>
                            <p style="font-style: italic; color:#f79f48"><span>@if($special_offers != null)<i class="fa-solid fa-angles-right fa-beat-fade"></i>@endif  </span>  {{ ($special_offers != null) ? 'Đang có ưu đãi đặc biệt' : ''}}</p>
                            <a href="{{ route('customer.service',[$ldv -> id_ldv])}}" class="detail_view">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- <div class="service_information2">

                <div class="service_img">
                    <div class="service_img--item">
                        <div class="item1">
                            <img src="https://images.pexels.com/photos/374148/pexels-photo-374148.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="spa & wellness">
                        </div>

                        <div class="item2">
                            <img src="https://images.pexels.com/photos/4162485/pexels-photo-4162485.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="gym">
                        </div>

                        <div class="item3">
                            <img src="https://images.pexels.com/photos/4056723/pexels-photo-4056723.jpeg?auto=compress&cs=tinysrgb&w=600" alt="yoga">
                        </div>

                    </div>
                </div>
                <div class="service_content">
                    <div>

                        <p style="font-style: italic;">Dịch vụ spa & Chăm sóc sức khỏe tại khách sạn HazBin sẽ mang đến cho quý khách trải nghiệm toàn diện với các liệu trình chăm sóc sắc đẹp, 
                            thư giãn kết hợp cùng những hoạt động thể chất giúp bạn đạt được sự cân bằng cả về thể lực và tinh thần. Chúng tôi tự hào cung cấp dịch vụ Gym và Yoga với không gian 
                            thoáng đãng, trang thiết bị hiện đại, và đội ngũ huấn luyện viên chuyên nghiệp.
                        </p>
                        <a href="" class="detail_view">Xem chi tiết</a>
                    </div>
                </div>
            </div> --}}
        
        </body>
        </html>
        
        @endsection