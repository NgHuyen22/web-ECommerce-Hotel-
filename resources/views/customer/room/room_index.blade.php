
@extends('layouts.customer_home')
    @section('room_index')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <meta name="csrf-token" content="{{ csrf_token() }}">
        
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
                                <span>Phòng</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="wrapper_search">
        {{-- <form action="" method="get" class="search_room">
            @csrf
            <div style="flex-grow: 1; display: flex; flex-direction: column; width: 100%;">
                <input type="search" id="search-inputt" name="keywords" placeholder="Tìm kiếm loại phòng..." 
                       value="{{ request()->keywords }}" 
                       style="width: 100%; height: 4.5vh; border: 2px solid #cbcbcb; border-radius: 6px;">
        
                <div id="suggestions-container" style="position: relative; width: 100%;">
                    <ul id="suggestions" 
                        style="border: 1px solid #ddd; background-color: white; position: absolute;  z-index: 1000;display: none; 
                               width: 100%; list-style: none; padding: 0; margin: 0; border-radius: 0 0 6px 6px;">
                    </ul>
                </div>
                
                <p id="no-results-message" style="display:none; width: 100%; margin-top: 0.5rem;">Không tìm thấy kết quả</p>
            </div>
        
            <button type="submit" style="width: 10%; height: 4.5vh; margin-left: 5px;">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
         --}}
        <form action="{{ route('customer.search')}}" method="POST" class="search_room">
            @csrf
            <div style="flex-grow: 1; display: flex; flex-direction: column; width: 100%;">
                <input type="search" id="search-inputt" name="keywords" placeholder="Tìm kiếm loại phòng..." 
                       value="{{ request()->keywords }}" 
                       style="width: 100%; height: 4.5vh; border: 2px solid #cbcbcb; border-radius: 6px;">
        
                <div id="suggestions-container" style="position: relative; width: 100%;">
                    <ul id="suggestions" 
                        style="border: 1px solid #ddd; background-color: white; position: absolute;  z-index: 1000;display: none; 
                               width: 100%; list-style: none; padding: 0; margin: 0; border-radius: 0 0 6px 6px;">
                    </ul>
                </div>
                
                <p id="no-results-message" style="display:none; width: 100%; margin-top: 0.5rem;">Không tìm thấy kết quả</p>
            </div>
        
            <button type="submit" style="width: 10%; height: 4.5vh; margin-left: 5px;">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        
        

        <form action="{{route('customer.room_index')}}" id="select_price" class ="select_price" method="POST">
            @csrf
            <select class="form-select" aria-label="Default select example" name="value" class="item_price" style="width: 86% ">
                <option selected value="4">Tất cả</option>
                <option value="1" {{ (isset($selectedValue) && $selectedValue == 1) ? 'selected' : '' }}>500.000 - 800.000</option>
                <option value="2" {{ (isset($selectedValue) && $selectedValue == 2) ? 'selected' : '' }}>1tr - 1tr5</option>
                <option value="3" {{ (isset($selectedValue) && $selectedValue == 3) ? 'selected' : '' }}>Trên 1tr5</option>
            </select>
              <button type="submit" class="submit_price" style=" width: 10%;height: 4.5vh">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

        </form>

    </div>

        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                let debounceTimer;
                $('#search-inputt').on('input', function() {
                    clearTimeout(debounceTimer);
                    var query = $(this).val();
                    console.log(query);
                    if (query.length >= 2) {
                        debounceTimer = setTimeout(function() {
                            $.ajax({
                                url: '{{ route('customer.search_name') }}',
                                type: 'POST',
                                data: { keywords: query },
                                success: function(data) {
                                    if (data.roomTypes.length > 0) {
                                        let suggestionsHTML = '';
                                        data.roomTypes.forEach(function(item) {
                                            suggestionsHTML += `<li data-id="${item.id_lp}">${item.ten_lp}</li>`;
                                        });
                                        $('#suggestions').html(suggestionsHTML).show();
                                        $('#no-results-message').hide();
                                    } else {
                                        $('#suggestions').hide();
                                        $('#no-results-message').show();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("Lỗi:", error);
                                }
                            });
                        }, 300);
                    } else {
                        $('#suggestions').hide();
                        $('#no-results-message').hide();
                    }
                });
    
                $(document).on('click', '#suggestions li', function() {
                    const selectedRoomName = $(this).text();
                    $('#search-inputt').val(selectedRoomName);
                    $('#suggestions').hide();
                });
    
                $(document).click(function(event) {
                    if (!$(event.target).closest('#search-inputt, #suggestions').length) {
                        $('#suggestions').hide();
                    }
                });
            });
    
        </script>

        @if(request()->has('keywords') || (request()->has('value') && request()->value != 'Chọn mức giá'))
            @if(request()->has('keywords'))
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
                    <h4 style="margin-left: 12rem !important; font-weight: bold; margin-bottom: 2rem">Các phòng cùng hạng mục</h4>
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
            @endif

            @if (request()->has('value') && request()->value != 'Chọn mức giá')
               @if($getPrice ->isNotEmpty())
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
                @else
                    <p style="color: rgb(249 57 57); margin-left: 14rem !important;font-weight:bold;margin-bottom: 2rem">Không tìm thấy kết quả </p>
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
            @endif
        @else

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
        @endif
      
           


    
        

     
     
    </body>
    </html>
  

@endsection