    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="tn-left">
                            <li><i class="fa fa-phone"></i> (12) 345 67890</li>
                            <li><i class="fa fa-envelope"></i> hazbinhotel@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="tn-right">
                            <div class="top-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                            <a href="#" class="bk-btn">Booking Now</a>
                            <div class="language-option">
                                {{-- <img src="{{asset('customer/img/flag.jpg')}}" alt=""> --}}
                                <img src="https://png.pngtree.com/png-clipart/20191122/original/pngtree-user-icon-isolated-on-abstract-background-png-image_5192004.jpg" alt="">
                                @if(session('ten_ctm')  )

                                    <span>{{ session('ten_ctm') }}<i class="fa fa-angle-down"></i></span>
                                    <div class="flag-dropdown" style="width:13rem">
                                        <ul>
                                            <li><a href="{{ route('customer.view_profile') }}" style="font-size: 0.8rem">Xem thông tin cá nhân</a></li>
                                            <li><a href="{{route('customer.logout')}}" style="font-size: 0.8rem">Đăng xuất</a></li>
                                        </ul>
                                    </div>
                                @else
                                    
                                    <span class="user_login"><a href="{{ route('customer.login') }}">Đăng nhập</a></span>
                            
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
    </header>
    <!-- Header End -->