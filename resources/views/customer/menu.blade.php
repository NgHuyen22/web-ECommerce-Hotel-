     <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{ route('customer.index')}}">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlRge8VJLqr7U-qQT7bdDtzz-uX0doe0z0JQ&s" alt="">
                                {{-- <img src="{{asset('customer/img/logo.png')}}" alt=""> --}}
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="active"><a href="{{ route('customer.index')}}">Trang Chủ</a></li>
                                    <li><a href="{{ route('customer.about')}}">Giới Thiệu</a></li>
                                    <li><a href="{{ route('customer.room_index')}}">Phòng</a>
                                        <ul class="dropdown">
                                            {{-- @if(count($room_type) > 0)
                                                @foreach ( $room_type as $row )
                                                    <li><a href="{{ route('customer.room_type', $row ->id_lp) }}">{{ $row ->ten_lp}}</a></li>
                                                @endforeach
                                            @else
                                                <li>Chưa cập nhật</li>
                                            @endif --}}
                                            {{-- <li><a href="{{ route('customer.room_single')}}">Phòng single</a></li>
                                            <li><a href="./blog-details.html">Phòng twin</a></li>
                                            <li><a href="./blog-details.html">Phòng double</a></li>
                                            <li><a href="#">Phòng triple</a></li>
                                            <li><a href="#">Phòng gia đình </a></li> --}}
                                        </ul>
                                    </li>
                                    <li><a href="">Dịch Vụ</a>
                                        <ul class="dropdown" style="width: 12rem">
                                            @if($getServiceType != null)
                                               @if(count($getServiceType) > 0)
                                                @foreach ( $getServiceType as $row )
                                                    <li><a href="{{ route('customer.service_type', $row ->id_ldv) }}" style="width:100%;">{{ $row ->ten_ldv}}</a></li>
                                                @endforeach
                                                @endif
                                            @else
                                                <li>Chưa cập nhật</li>
                                            @endif
                                        </ul>
                                    </li>
                                    {{-- <li><a href="./pages.html">Hướng Dẫn</a></li> --}}
                                    <li><a href="{{ route('customer.contact_index')}}">Liên Hệ</a></li>
                                    <li><a href="./pages.html">Khác</a>                                    
                                        <ul class="dropdown">
                                            <li><a href="./room-details.html">Tin Tức</a></li>
                                            <li><a href="./blog-details.html">Ưu Đãi</a></li>
                                            <li><a href="#">FAQ</a></li> 
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                            {{-- <div class="nav-right search-switch"> --}}
                                {{-- <form action="{{ route('customer.search')}}" method="POST">
                                    @csrf
                                    <input type="search" id="search-input" name="query" placeholder="Tìm kiếm loại phòng..." value="{{ request('query', old('query')) }}">
                                    <button type="submit">
                                        <i class="fa-solid fa-magnifying-glass "></i>
                                    </button>
                                </form> --}}
                                {{-- <form action="{{ route('customer.search') }}" method="POST">
                                    @csrf
                                    <input type="search" id="search-input" name="query" placeholder="Tìm kiếm loại phòng..." value="{{ request('query', old('query')) }}">
                                    <div id="suggestions" style="border: 1px solid #ddd; background-color: white; position: absolute; z-index: 1000;"></div>
                                    <button type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form> --}}
                                
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>