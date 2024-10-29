@extends('layouts.customer_home')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>HazBin  Hotel</h1>
                        <p>We are pleased to welcome you to our hotel. As one of the famous hotels in Can Tho, it certainly does not disappoint.</p>
                        <a href="{{route('customer.index')}}" class="primary-btn">Discover Now</a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form">
                        <h3 style="text-align: center">Đặt Phòng</h3>
                        <form action="{{ route('customer.index')}}" class="" method="POST">
                            @csrf
                            <div class="check-date">
                                <label for="date-in">Ngày nhận phòng :</label>
                                <input type="text" class="date-input" id="date-in" name="ngay_nhan_phong">
                                <i class="fa-solid fa-calendar-days" ></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Ngày trả phòng :</label>
                                <input type="text" class="date-input" id="date-out" name="ngay_tra_phong">
                                <i class="fa-solid fa-calendar-days" ></i>
                            </div>
                            {{-- <div class="select-option">
                                <label for="guest">Người lớn :</label>
                                <select id="guest">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </div> --}}
                            <div class="check-date">
                                <label for="quantity">Người lớn:</label>
                                <div class="quantity-control">
                                    {{-- <button type="button" class="quantity-btn minus-btn">-</button> --}}
                                    <input type="number" class="form-control quantity-input" id="quantity"  min="1" max = "10"  value="{{ old('adult') }}"  name="adult">
                                    {{-- <button type="button" class="quantity-btn plus-btn">+</button> --}}
                                </div>
                            </div>
                            <div class="check-date">
                                <label for="quantity">Trẻ em:</label>
                                <div class="quantity-control">
                                    {{-- <button type="button" class="quantity-btn minus-btn">-</button> --}}
                                    <input type="number" class="form-control quantity-input" id="quantity" min="0" max = "10"  value="{{ old('children') }}" name="children">
                                    {{-- <button type="button" class="quantity-btn plus-btn">+</button> --}}
                                </div>
                            </div>
                            <button type="submit">Tìm phòng trống</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="{{ asset('customer/img/hero/hero-1.jpg') }}"></div>
            <div class="hs-item set-bg" data-setbg="{{ asset('customer/img/hero/hero-2.jpg') }}"></div>
            <div class="hs-item set-bg" data-setbg="{{ asset('customer/img/hero/hero-3.jpg') }}"></div>
        </div>
    </section>
    <!-- Hero Section End -->

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
                        <a href="{{ route('customer.about')}}" class="primary-btn about-btn">Chi tiết</a>
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

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-036-parking"></i>
                        <h4>Travel Plan</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-033-dinner"></i>
                        <h4>Catering Service</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-026-bed"></i>
                        <h4>Babysitting</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-024-towel"></i>
                        <h4>Laundry</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-044-clock-1"></i>
                        <h4>Hire Driver</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-012-cocktail"></i>
                        <h4>Bar & Drink</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    
    {{-- @if($mostSearch -> isEmpty())
        <p></p>
    @else
        <h4 style="text-align:center; font-weight: bold;margin-bottom: 2rem">Top các phòng thịnh hành</h4>

            <section class="hp-room-section">
                    <div class="container-fluid">
                        <div class="hp-room-items">
                            <div class="row">
                                @foreach ($mostSearch as $most)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="hp-room-item set-bg" data-setbg="{{ asset('customer/img/room/' . str_replace(' ', '_', $most->ten_lp) . '.jpg') }}">
                                            <div class="hr-text">
                                                <h3>{{ $most -> ten_lp}}</h3>
                                                <h2> {{ number_format($most->gia_lp, 0, ',', '.') }} VND <span> / Đêm</span></h2>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class="r-o">Diện tích :</td>
                                                            <td>{{ $most -> dien_tich}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="r-o">Sức chứa:</td>
                                                            <td>{{ $most -> suc_chua }} người</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="r-o">Mô tả:</td>
                                                            <td> {{ \Illuminate\Support\Str::words($most->mo_ta, 15, '...') }}</td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                                <a href="{{ route('customer.room_detail', $most->id_lp) }}" class="primary-btn">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div> 
                        </div>
                    </div>
            </section>
    @endif --}}

    @if($similarRoom -> isEmpty())
        <p></p>
    @else
        <h4 style="text-align:center; font-weight: bold;margin-bottom: 2rem">Có thể bạn sẽ thích</h4>

            <section class="hp-room-section">
                    <div class="container-fluid">
                        <div class="hp-room-items">
                            <div class="row">
                                @foreach ($similarRoom as $content)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="hp-room-item set-bg" data-setbg="{{ asset('customer/img/room/' . str_replace(' ', '_', $content->ten_lp) . '.jpg') }}">
                                            <div class="hr-text">
                                                <h3>{{ $content -> ten_lp}}</h3>
                                                <h2> {{ number_format($content->gia_lp, 0, ',', '.') }} VND <span> / Đêm</span></h2>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class="r-o">Diện tích :</td>
                                                            <td>{{ $content -> dien_tich}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="r-o">Sức chứa:</td>
                                                            <td>{{ $content -> suc_chua }} người</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="r-o">Mô tả:</td>
                                                            <td> {{ \Illuminate\Support\Str::words($content->mo_ta, 15, '...') }}</td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                                <a href="{{ route('customer.room_detail', $content->id_lp) }}" class="primary-btn">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div> 
                        </div>
                    </div>
            </section>
    @endif

        <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonials</span>
                        <h2>What Customers Say?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <p>After a construction project took longer than expected, my husband, my daughter and I
                                needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                city, neighborhood and the types of housing options available and absolutely love our
                                vacation at Sona Hotel.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="{{ asset('customer/img/testimonial-logo.png') }}" alt="">
                        </div>
                        <div class="ts-item">
                            <p>After a construction project took longer than expected, my husband, my daughter and I
                                needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                city, neighborhood and the types of housing options available and absolutely love our
                                vacation at Sona Hotel.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="{{ asset('customer/img/testimonial-logo.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Hotel News</span>
                        <h2>Our Blog & Event</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="{{ asset('customer/img/blog/blog-1.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Travel Trip</span>
                            <h4><a href="#">Tremblant In Canada</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="{{ asset('customer/img/blog/blog-2.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Camping</span>
                            <h4><a href="#">Choosing A Static Caravan</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="{{ asset('customer/img/blog/blog-3.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Event</span>
                            <h4><a href="#">Copper Canyon</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 21th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-item small-size set-bg" data-setbg="{{ asset('customer/img/blog/blog-wide.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Event</span>
                            <h4><a href="#">Trip To Iqaluit In Nunavut A Canadian Arctic City</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 08th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item small-size set-bg" data-setbg="{{ asset('customer/img/blog/blog-10.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Travel</span>
                            <h4><a href="#">Traveling To Barcelona</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 12th April, 2019</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>{{ asset('customer/ctm_js/room/room_detail.js')}}</script>
    <!-- Blog Section End -->
@endsection
