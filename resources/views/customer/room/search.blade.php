@extends('layouts.customer_home')
    @section('search')
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
                                    <span>Phòng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

       
            @if($roomTypes->isEmpty())
                <p style="color: rgb(249 57 57); margin-left: 14rem !important;font-weight:bold;margin-bottom: 2rem">Không tìm thấy kết quả </p>
                @else
                <p style="margin-left: 14rem !important;margin-bottom: 2rem; font-weight:bold"><span>Có </span><span style="color: rgb(249 57 57);font-weight:bold"">{{ $count}}</span> kết quả trả về </p>
                <section class="rooms-section spad">
                    <div class="container">
                        <div class="row">
                            @foreach($roomTypes as $room)
                                <div class="col-lg-4 col-md-6 ctm_div_room">
                                    <div class="room-item">
                                        {{-- <img src="{{ asset('customer/img/room/' . $room->ten_lp . '.jpg') }}" alt=""> --}}
                                        <img src="{{ asset('customer/img/room/' . $room->ten_lp . '.jpg') }}" alt="">
                                        <div class="ri-text">
                                            <h4 style="font-weight:bold;">{{ $room -> ten_lp}}</h4>
                                            <h3>{{ number_format($room->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="r-o">Diện tích :</td>
                                                        <td>{{ $room -> dien_tich}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="r-o">Sức chứa:</td>
                                                        <td>{{ $room -> suc_chua }} người</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="r-o">Mô tả:</td>
                                                        <td> {{ \Illuminate\Support\Str::words($room->mo_ta, 15, '...') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <a href="{{ route('room.increment_search', $room->id_lp) }}" class="primary-btn">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif


            @if($mostSearch -> isEmpty())
                <p></p>
            @else
                <h4 style="margin-left: 12rem !important; font-weight: bold;margin-bottom: 2rem">Top các phòng thịnh hành</h4>
                <section class="rooms-section spad">
                    <div class="container">
                        <div class="row">
                            @foreach ($mostSearch as $most)
                                <div class="col-lg-4 col-md-6 ctm_div_room">
                                    <div class="room-item">
                                        {{-- <img src="{{ asset('customer/img/room/' . $most->ten_lp . '.jpg') }}" alt=""> --}}
                                        <img src="{{ asset('customer/img/room/' . str_replace(' ', '_', $most->ten_lp) . '.jpg') }}" alt="">
                                        <div class="ri-text">
                                            <h4 style="font-weight:bold;">{{ $most -> ten_lp}}</h4>
                                            <h3>{{ number_format($most->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
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
                </section>
            @endif

            @if($mostBooking -> isEmpty())
                <p></p>
            @else
                <h4 style="margin-left: 12rem !important; font-weight: bold;margin-bottom: 2rem">Top các phòng được yêu thích</h4>
                <section class="rooms-section spad">
                    <div class="container">
                        <div class="row">
                            @foreach ($mostBooking as $most)
                                <div class="col-lg-4 col-md-6 ctm_div_room">
                                    <div class="room-item">
                                        <img src="{{ asset('customer/img/room/' . $most->ten_lp . '.jpg') }}" alt="">
                                        <div class="ri-text">
                                            <h4 style="font-weight:bold;">{{ $most -> ten_lp}}</h4>
                                            <h3>{{ number_format($most->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
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
                </section>
            @endif
        </body>

        @if($room_type != null) 
            <section class="rooms-section spad">
                <div class="container">
                    <div class="row">
                    @if(count($room_type) > 0)
                            @foreach ($room_type as $row)
                                <div class="col-lg-4 col-md-6 ctm_div_room">
                                    <div class="room-item">
                                        <img src="{{ asset('customer/img/room/' . str_replace(' ', '_',  $row->ten_lp) . '.jpg') }}" alt="">
                                        <div class="ri-text">
                                            <h4 style="font-weight:bold;">{{ $row -> ten_lp}}</h4>
                                            <h3>{{ number_format($row->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="r-o">Diện tích :</td>
                                                        <td>{{ $row -> dien_tich}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="r-o">Sức chứa:</td>
                                                        <td>{{ $row -> suc_chua }} người</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="r-o">Mô tả:</td>
                                                        <td> {{ \Illuminate\Support\Str::words($row->mo_ta, 15, '...') }}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td class="r-o">=:</td>
                                                        <td>Wifi, Television, Bathroom,...</td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                            <a href="{{ route('room.increment_search', $row->id_lp) }}" class="primary-btn">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <h3>Trống... Chưa cập nhật thông tin phòng !!</h3>
                    @endif
            
                    
                    </div>
        
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination room_pagination">

                                @if ($room_type->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $room_type->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @endif
                        
                                @foreach ($room_type->links()->elements[0] as $page => $url)
                                    @if ($page == $room_type->currentPage())
                                        <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                
                                @if ($room_type->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $room_type->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                        
                </div>
            
            </section>
        @else
                <p>Chưa có dữ liệu . Chúng tôi sẽ sớm cập nhật .</p>
        @endif 
    @endsection


    @if(!request()->has('keywords') || request('keywords') != '')
    {{-- Trường hợp kh có từ khóa tìm kiếm --}}
    @if(($room_type != null) && count($room_type) > 0)
        <section class="rooms-section spad">
            <div class="container">
                <div class="row">
                @if(count($room_type) > 0)
                        @foreach ($room_type as $row)
                            <div class="col-lg-4 col-md-6 ctm_div_room">
                                <div class="room-item">
                                    <img src="{{ asset('customer/img/room/' . str_replace(' ', '_',  $row->ten_lp) . '.jpg') }}" alt="">
                                    <div class="ri-text">
                                        <h4 style="font-weight:bold;">{{ $row -> ten_lp}}</h4>
                                        <h3>{{ number_format($row->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="r-o">Diện tích :</td>
                                                    <td>{{ $row -> dien_tich}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Sức chứa:</td>
                                                    <td>{{ $row -> suc_chua }} người</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Mô tả:</td>
                                                    <td> {{ \Illuminate\Support\Str::words($row->mo_ta, 15, '...') }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td class="r-o">=:</td>
                                                    <td>Wifi, Television, Bathroom,...</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                        <a href="{{ route('room.increment_search', $row->id_lp) }}" class="primary-btn">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <h3>Trống... Chưa cập nhật thông tin phòng !!</h3>
                @endif
        
                
                </div>
    
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination room_pagination">

                            @if ($room_type->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $room_type->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif
                    
                            @foreach ($room_type->links()->elements[0] as $page => $url)
                                @if ($page == $room_type->currentPage())
                                    <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
            
                            @if ($room_type->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $room_type->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    
            </div>
        
        </section>
    @else
        <p>Chưa có dữ liệu. Chúng tôi sẽ sớm cập nhật.</p>
    @endif
@elseif(request()->has('keywords') || request('keywords') == '')
    {{-- Trường hợp  có từ khóa tìm kiếm --}}
        @if($roomTypes->isEmpty())
            <p style="color: rgb(249 57 57); margin-left: 14rem !important;font-weight:bold;margin-bottom: 2rem">Không tìm thấy kết quả </p>
        @else
            <p style="margin-left: 14rem !important;margin-bottom: 2rem; font-weight:bold"><span>Có </span><span style="color: rgb(249 57 57);font-weight:bold"">{{ $count}}</span> kết quả trả về </p>
            <section class="rooms-section spad">
                <div class="container">
                    <div class="row">
                        @foreach($roomTypes as $room)
                            <div class="col-lg-4 col-md-6 ctm_div_room">
                                <div class="room-item">
                                    {{-- <img src="{{ asset('customer/img/room/' . $room->ten_lp . '.jpg') }}" alt=""> --}}
                                    <img src="{{ asset('customer/img/room/' . $room->ten_lp . '.jpg') }}" alt="">
                                    <div class="ri-text">
                                        <h4 style="font-weight:bold;">{{ $room -> ten_lp}}</h4>
                                        <h3>{{ number_format($room->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="r-o">Diện tích :</td>
                                                    <td>{{ $room -> dien_tich}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Sức chứa:</td>
                                                    <td>{{ $room -> suc_chua }} người</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Mô tả:</td>
                                                    <td> {{ \Illuminate\Support\Str::words($room->mo_ta, 15, '...') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="{{ route('room.increment_search', $room->id_lp) }}" class="primary-btn">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($similarPricedRooms->isNotEmpty())
            <h4 style="margin-left: 12rem !important; font-weight: bold; margin-bottom: 2rem">Các phòng có mức giá tương tự</h4>
            <section class="rooms-section spad">
                <div class="container">
                    <div class="row">
                        @foreach($similarPricedRooms as $similarRoom)
                            <div class="col-lg-4 col-md-6 ctm_div_room">
                                <div class="room-item">
                                    <img src="{{ asset('customer/img/room/' . str_replace(' ', '_', $similarRoom->ten_lp) . '.jpg') }}" alt="">
                                    <div class="ri-text">
                                        <h4 style="font-weight:bold;">{{ $similarRoom->ten_lp }}</h4>
                                        <h3>{{ number_format($similarRoom->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="r-o">Diện tích :</td>
                                                    <td>{{ $similarRoom->dien_tich }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Sức chứa:</td>
                                                    <td>{{ $similarRoom->suc_chua }} người</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Mô tả:</td>
                                                    <td>{{ \Illuminate\Support\Str::words($similarRoom->mo_ta, 15, '...') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="{{ route('customer.room_detail', $similarRoom->id_lp) }}" class="primary-btn">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <p></p>
        @endif

        @if($mostSearch -> isEmpty())
            <p></p>
        @else
            <h4 style="margin-left: 12rem !important; font-weight: bold;margin-bottom: 2rem">Top các phòng thịnh hành</h4>
            <section class="rooms-section spad">
                <div class="container">
                    <div class="row">
                        @foreach ($mostSearch as $most)
                            <div class="col-lg-4 col-md-6 ctm_div_room">
                                <div class="room-item">
                                    {{-- <img src="{{ asset('customer/img/room/' . $most->ten_lp . '.jpg') }}" alt=""> --}}
                                    <img src="{{ asset('customer/img/room/' . str_replace(' ', '_', $most->ten_lp) . '.jpg') }}" alt="">
                                    <div class="ri-text">
                                        <h4 style="font-weight:bold;">{{ $most -> ten_lp}}</h4>
                                        <h3>{{ number_format($most->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
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
            </section>
        @endif

        @if($mostBooking -> isEmpty())
            <p></p>
        @else
            <h4 style="margin-left: 12rem !important; font-weight: bold;margin-bottom: 2rem">Top các phòng được yêu thích</h4>
            <section class="rooms-section spad">
                <div class="container">
                    <div class="row">
                        @foreach ($mostBooking as $most)
                            <div class="col-lg-4 col-md-6 ctm_div_room">
                                <div class="room-item">
                                    <img src="{{ asset('customer/img/room/' . $most->ten_lp . '.jpg') }}" alt="">
                                    <div class="ri-text">
                                        <h4 style="font-weight:bold;">{{ $most -> ten_lp}}</h4>
                                        <h3>{{ number_format($most->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
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
            </section>
        @endif

@elseif(request() -> has('value') && $getPrice ->isNotEmpty()) 
  
        <p style="margin-left: 14rem !important;margin-bottom: 2rem; font-weight:bold"><span>Có </span><span style="color: rgb(249 57 57);font-weight:bold"">{{ $countP}}</span> kết quả trả về </p>
        <section class="rooms-section spad">
            <div class="container">
                <div class="row">
                    @foreach($getPrice as $price)
                        <div class="col-lg-4 col-md-6 ctm_div_room">
                            <div class="room-item">
                                {{-- <img src="{{ asset('customer/img/room/' . $room->ten_lp . '.jpg') }}" alt=""> --}}
                                <img src="{{ asset('customer/img/room/' . $price->ten_lp . '.jpg') }}" alt="">
                                <div class="ri-text">
                                    <h4 style="font-weight:bold;">{{ $price -> ten_lp}}</h4>
                                    <h3>{{ number_format($price->gia_lp, 0, ',', '.') }} VND<span> / Đêm</span></h3>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="r-o">Diện tích :</td>
                                                <td>{{ $price -> dien_tich}}</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Sức chứa:</td>
                                                <td>{{ $price -> suc_chua }} người</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Mô tả:</td>
                                                <td> {{ \Illuminate\Support\Str::words($price->mo_ta, 15, '...') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('room.increment_search', $price->id_lp) }}" class="primary-btn">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


@endif