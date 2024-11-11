@extends('layouts.admin_home')
    @section('bill_index')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('admin/ad_css/bill_management/bill_index.css')}}">
        </head>
        <body>
            @if (Session::has('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    text: "{{ Session::get('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif

        @if(Session::has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    text: "{{ Session::get('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif
               <div class="wrapper_search">
                    <a href="" class="add_room--wrapper" >
                        <i class="fa-solid fa-plus add_room--icon" style="color: #ca1c50; cursor: pointer; font-size:1.2rem; margin-top : 0.5rem"></i>
                    </a>

                    <form action="" method="get" class="form_search mb-3">
                        @csrf
                        <div class="input_search_icon container d-flex">
                            <div class="update_room--search">
                                <input type="search" class="form-control" name="keywords" placeholder="Từ khóa tìm kiếm..."
                                    value="{{ request()->keywords }}">
                            </div>
                            <div class="search__icon ">
                                <div class="col-2 w-100">
                                    <button type ="submit" class=" btn btn-primary btn-block btn-css search_button" style="background: #4398d1;"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('admin.bill_index')}}" class="bill_index" id="" method="POST">
                            @csrf
                            <p>Ngày thanh toán : </p>
                            <div class="form-group label_input">
                                <input type="date" class="form-control bm_index_input" id="ngay_nhan_phong" name ="ngay_thanh_toan" placeholder="" value="{{ old('ngay_thanh_toan', isset($ngay_thanh_toan) ? $ngay_thanh_toan : '') }}" >
                            </div>
                            
                            <div class="form-group label_input">
                                <input type="date" class="form-control bm_index_input" id="ngay_tra_phong" name ="ngay_thanh_toan1" placeholder="" value="{{ old('ngay_thanh_toan1' , isset($ngay_thanh_toan1) ? $ngay_thanh_toan1 : '') }}">
                            </div>

                            <button type ="submit" class=" btn btn-primary btn-block btn-css search_button" style="background: #4398d1;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                    </form>       
               </div>

             <nav class="nav_tab_list">
                <div class="nav nav-tabs tab_list" id="nav-tab" role="tablist">
                  <button class="nav-link active nav_item_button" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Chưa thanh toán</button>
                  <button class="nav-link nav_item_button1" id="nav-profile-tab " data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Đã thanh toán</button>
                </div>
              </nav>

     
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    {{-- <button>Thanh toán</button> --}}

                    <div class="tab-pane fade show active bill_management" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <table class="table bill_management--table">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle" style="text-align:center">STT</th>
                                    <th scope="col" class="align-middle" style="text-align:center">ID HD</th>
                                    <th scope="col" class="align-middle" style="text-align:center;">Khách Hàng</th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 9rem;">ID Đơn Phòng</th>
                                    <th scope="col" class="align-middle" style="text-align:center">Phòng</th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 5rem;">Trễ Hạn </th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 9rem">Phí Thêm</th>
                                    <th scope="col" class="align-middle" style="text-align:center;;width: 9rem">Phí DV</th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 9rem">Tổng Tiền</th>
                                    {{-- <th scope="col" class="align-middle" style="text-align:center;;width: 13rem">Trạng Thái</th> --}}
                                    <th scope="col" class="align-middle" style="text-align:center;width: 10rem">Ngày Tạo</th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 10rem">Ngày Cập Nhật</th>
                                    <th scope="col" colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider update_room--tbody">
                                    @if (count($allBill) > 0)
                                        @php $count = 1 @endphp
                                        @foreach ($allBill as $bill )
                                            <tr>
                                                <th scope="row" class="align-middle" style="text-align:justify">{{ $count++ }}</th>
                                                <td class="align-middle" style="text-align:center">{{ $bill -> id_hd }}</td>
                                                <td class="align-middle"style="text-align:justify; color: rgb(209, 43, 43); font-weight:bold;width: 16rem;">{{ $bill -> ho_ten }} 
                                                    {{-- @if(!empty($ttkh))
                                                        @foreach ($ttkh as $item)
                                                            <input type="hidden" name="ttkh" value="{{$item -> id}}" id="ttkh">
                                                        @endforeach
                                                    @endif --}}
                                                    <button type="button" class=""  data-bs-toggle="popover" data-bs-html="true"
                                                            data-bs-content =
                                                            "<div class='wrapper_info'>
                                                                <p><span class='info_label'>ID : </span> <span>{{ $bill->khach_hang }}</span></p>
                                                                <div class= 'info'>
                                                                    <p><span class='info_label'>Họ Tên : </span> <span class='info_value'>{{ $bill->ho_ten }}</span></p>
                                                                    <p><span class='info_label'>Giới Tính :</span> <span class='info_value'>{{ $bill -> gioi_tinh == 0 ? 'Nam' : 'Nữ' }}</span> </p>
                                                                </div>
                                                                <div class= 'info'>
                                                                    <p><span class='info_label'>SDT : </span> <span class='info_value'>{{ $bill-> sdt }}</span></p>
                                                                    <p><span class='info_label'>Email : </span> <span class='info_value'>{{ $bill -> email}}</span></p>
                                                                </div>
                                                                <div class= 'info'>
                                                                    <p><span class='info_label'>Địa chỉ: </span> <span class='info_value'>{{ $bill-> dia_chi }}</span></p>
                                                                    <p><span class='info_label'>DTL : </span><span class='info_value'>{{ $bill -> DTL}}</span></p>
                                                                </div>
                                                            </div>"
                                                            title="Thông Tin Khách Hàng">
                                                        <i class="fa-solid fa-user" style="color: #2662c9;"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle"style="text-align: center">{{ $bill -> don_dat_phong }}
                                                    <button type="button" style="" class=""  data-bs-toggle="popover" data-bs-html="true"
                                                        data-bs-content =
                                                        "<div class='wrapper_info'>
                                                            <p><span class='info_label'>Ngày Nhận Phòng : </span> <span>{{  \Carbon\Carbon::parse($bill-> ngay_nhan_phong)->format('d-m-Y')  }}</span></p>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Ngày Trả Phòng : </span> <span class='info_value'>{{  \Carbon\Carbon::parse($bill -> ngay_tra_phong)->format('d-m-Y') }}</span></p>
                                                                <p><span class='info_label'>Số Ngày Ở :</span> <span class='info_value'>{{ $bill -> so_ngay_o}} ngày</span> </p>
                                                            </div>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Ghi Chú : </span> <span class='info_value'>{{ $bill -> ghi_chu != null ? $bill-> ghi_chu : ''  }}</span></p>
                                                                @php $tong_tien = $bill -> gia_lp * $bill -> so_ngay_o @endphp
                                                                <p><span class='info_label'>Tổng tiền : </span> <span class='info_value'>{{ number_format($tong_tien,0,',','.') }} VND</span></p>
                                                            </div>  
                                                        </div>"
                                                        title="Thông Tin Đặt Phòng">
                                                        <i class="fa-solid fa-user" style="color: #2662c9;"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle"style="text-align: center; width: 7rem">{{ $bill -> so_phong }} 
                                                    <button type="button" class=""  data-bs-toggle="popover" data-bs-html="true"
                                                        data-bs-content =
                                                        "<div class='wrapper_info'>
                                                            <p><span class='info_label'>ID : </span> <span>{{ $bill -> id_phong }}</span></p>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Số Phòng : </span> <span class='info_value'>{{ $bill-> so_phong }}</span></p>
                                                                <p><span class='info_label'>Loại Phòng :</span> <span class='info_value'>{{ $bill -> ten_lp}}</span> </p>
                                                            </div>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Giá : </span> <span class='info_value'>{{ number_format($bill-> gia_lp,0,',','.') }} VND</span></p>
                                                                <p><span class='info_label'>Sức Chứa : </span> <span class='info_value'>{{ $bill -> suc_chua}}</span></p>
                                                            </div>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Tiện Nghi : </span> <span class='info_value'>{{ $bill-> tien_nghi }}</span></p>
                                                                <p><span class='info_label'>Mô Tả : </span><span class='info_value'>{{ $bill -> mo_ta}}</span></p>
                                                            </div>
                                                        </div>"
                                                        title="Thông Tin Phòng">
                                                        <i class="fa-solid fa-circle-info"  style="color: #2662c9;"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle"style="text-align:center">{{ $bill -> tre_han}} ngày</td>
                                                <td class="align-middle" style="text-align:center">
                                                    @php
                                                        if ($bill->phi_them != 0) {
                                                            echo number_format($bill->phi_them, 0, ',', '.') . ' VND';
                                                        } else {
                                                            echo '0';
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="align-middle" style="text-align:center;">
                                                    @php
                                                        if ($bill->phi_dv != 0) {
                                                            echo number_format($bill->phi_dv, 0, ',', '.') . ' VND';
                                                        } else {
                                                            echo '0';
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="align-middle" style="text-align:center">
                                                    @php
                                                        if ($bill->tong_tien != 0) {
                                                            echo number_format($bill-> tong_tien, 0, ',', '.') . ' VND';
                                                        } else {
                                                            echo '0';
                                                        }
                                                    @endphp
                                                </td>
                                                {{-- <td class="align-middle"style="text-align:center">{{ $bill -> trang_thai_hd }}</td> --}}
                                                <td class="align-middle"style="text-align:center">{{ $bill -> created_at }}</td>
                                                <td class="align-middle"style="text-align:center">{{ $bill -> updated_at }}</td>
                                                <td class="align-middle"style="text-align:center; width: 9rem">
                                                    <div class="form-edit-delete d-flex">
                                                        <form action="{{ route('admin.accept_bill',[$bill -> id_hd ])}}" method="POST" class="edit_csvc_form" style="width: 2rem; height: 2rem;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-dark accept" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                                                <i class="fa-regular fa-square-check fa-fade" style="color: white"></i>
                                                            </button>
                                                        </form>
                                                        
                                                        {{-- <form action="" method="GET" id="delete_csvc_form" onsubmit="return false;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger delete_csvc" style="width: 2rem; height: 2rem; margin-left: 0.3rem; display: flex; justify-content: center; align-i
                                                            tems: center;" onclick="confirmDelete()">
                                                                <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.9rem;"></i>
                                                            </button>
                                                            <input type="hidden" name="ma_csvc" value="">
                                                        </form>
                                                         --}}
                                                        {{-- <div style="width: 30%; margin-top: 0.2rem; margin-left: 0.2rem;">
                                                            <a href="" style="font-size: 0.7rem; text-decoration: none; ">Chi Tiết</a>
                                                        </div> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                       <td class="align-middle" style="text-align:center" colspan="13">Chưa có dữ liệu ..</td>
                                    @endif
                            </tbody>
                        </table>
                        <div style="font-size:1rem; margin-bottom: 1rem; ">
                            <span style="font-weight: bold; margin-left : 70rem ;color:#ca1c50; font-size : 1rem">Tổng: </span>
                            {{ $count}}
                        </div>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination room_pagination">
                                <!-- Previous Page Link -->
                                @if ($allBill->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $allBill->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @endif
                        
                                <!-- Pagination Elements -->
                                @foreach ($allBill->appends(request()->query())->links()->elements[0] as $page => $url)
                                    @if ($page == $allBill->currentPage())
                                        <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                        
                                <!-- Next Page Link -->
                                @if ($allBill->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $allBill->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
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
                </div>

                {{-- DA THANH TOAN --}}
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="tab-pane fade show active bill_management" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <table class="table bill_management--table">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle" style="text-align:center">STT</th>
                                    <th scope="col" class="align-middle" style="text-align:center">ID HD</th>
                                    <th scope="col" class="align-middle" style="text-align:center;">Khách Hàng</th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 9rem;">ID Đơn Phòng</th>
                                    <th scope="col" class="align-middle" style="text-align:center">Phòng</th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 5rem;">Trễ Hạn </th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 9rem">Phí Thêm</th>
                                    <th scope="col" class="align-middle" style="text-align:center;;width: 9rem">Phí DV</th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 9rem">Tổng Tiền</th>
                                    {{-- <th scope="col" class="align-middle" style="text-align:center;;width: 13rem">Trạng Thái</th> --}}
                                    <th scope="col" class="align-middle" style="text-align:center;width: 10rem">Ngày Tạo</th>
                                    <th scope="col" class="align-middle" style="text-align:center;width: 10rem">Ngày Thanh Toán</th>
                                    <th scope="col" colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider update_room--tbody">
                                    @if ($allBill_acp -> isNotEmpty())
                                        @php $count = 1 @endphp
                                        @foreach ($allBill_acp as $bill )
                                            <tr>
                                                <th scope="row" class="align-middle" style="text-align:justify">{{ $count++ }}</th>
                                                <td class="align-middle" style="text-align:center">{{ $bill -> id_hd }}</td>
                                                <td class="align-middle"style="text-align:justify; color: rgb(209, 43, 43); font-weight:bold;width: 16rem;">{{ $bill -> ho_ten }} 
                                                    <button type="button" class=""  data-bs-toggle="popover" data-bs-html="true"
                                                            data-bs-content =
                                                            "<div class='wrapper_info'>
                                                                <p><span class='info_label'>ID : </span> <span>{{ $bill->khach_hang }}</span></p>
                                                                <div class= 'info'>
                                                                    <p><span class='info_label'>Họ Tên : </span> <span class='info_value'>{{ $bill->ho_ten }}</span></p>
                                                                    <p><span class='info_label'>Giới Tính :</span> <span class='info_value'>{{ $bill -> gioi_tinh == 0 ? 'Nam' : 'Nữ' }}</span> </p>
                                                                </div>
                                                                <div class= 'info'>
                                                                    <p><span class='info_label'>SDT : </span> <span class='info_value'>{{ $bill-> sdt }}</span></p>
                                                                    <p><span class='info_label'>Email : </span> <span class='info_value'>{{ $bill -> email}}</span></p>
                                                                </div>
                                                                <div class= 'info'>
                                                                    <p><span class='info_label'>Địa chỉ: </span> <span class='info_value'>{{ $bill-> dia_chi }}</span></p>
                                                                    <p><span class='info_label'>DTL : </span><span class='info_value'>{{ $bill -> DTL}}</span></p>
                                                                </div>
                                                            </div>"
                                                            title="Thông Tin Khách Hàng">
                                                        <i class="fa-solid fa-user" style="color: #2662c9;"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle"style="text-align: center">{{ $bill -> don_dat_phong }}
                                                    <button type="button" style="" class=""  data-bs-toggle="popover" data-bs-html="true"
                                                        data-bs-content =
                                                        "<div class='wrapper_info'>
                                                            <p><span class='info_label'>Ngày Nhận Phòng : </span> <span>{{ \Carbon\Carbon::parse($bill-> ngay_nhan_phong) ->format('d-m-Y')  }}</span></p>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Ngày Trả Phòng : </span> <span class='info_value'>{{ \Carbon\Carbon ::parse($bill -> ngay_tra_phong) ->format('d-m-Y')  }}</span></p>
                                                                <p><span class='info_label'>Số Ngày Ở :</span> <span class='info_value'>{{ $bill -> so_ngay_o}} ngày</span> </p>
                                                            </div>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Ghi Chú : </span> <span class='info_value'>{{ $bill -> ghi_chu != null ? $bill-> ghi_chu : ''  }}</span></p>
                                                                @php $tong_tien = $bill -> gia_lp * $bill -> so_ngay_o @endphp
                                                                <p><span class='info_label'>Tổng tiền : </span> <span class='info_value'>{{ number_format($tong_tien,0,',','.') }} VND</span></p>
                                                            </div>  
                                                        </div>"
                                                        title="Thông Tin Đặt Phòng">
                                                        <i class="fa-solid fa-user" style="color: #2662c9;"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle"style="text-align: center; width: 7rem">{{ $bill -> so_phong }} 
                                                    <button type="button" class=""  data-bs-toggle="popover" data-bs-html="true"
                                                        data-bs-content =
                                                        "<div class='wrapper_info'>
                                                            <p><span class='info_label'>ID : </span> <span>{{ $bill -> id_phong }}</span></p>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Số Phòng : </span> <span class='info_value'>{{ $bill-> so_phong }}</span></p>
                                                                <p><span class='info_label'>Loại Phòng :</span> <span class='info_value'>{{ $bill -> ten_lp}}</span> </p>
                                                            </div>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Giá : </span> <span class='info_value'>{{ number_format($bill-> gia_lp,0,',','.') }} VND</span></p>
                                                                <p><span class='info_label'>Sức Chứa : </span> <span class='info_value'>{{ $bill -> suc_chua}}</span></p>
                                                            </div>
                                                            <div class= 'info'>
                                                                <p><span class='info_label'>Tiện Nghi : </span> <span class='info_value'>{{ $bill-> tien_nghi }}</span></p>
                                                                <p><span class='info_label'>Mô Tả : </span><span class='info_value'>{{ $bill -> mo_ta}}</span></p>
                                                            </div>
                                                        </div>"
                                                        title="Thông Tin Phòng">
                                                        <i class="fa-solid fa-circle-info"  style="color: #2662c9;"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle"style="text-align:center">{{ $bill -> tre_han}} ngày</td>
                                                <td class="align-middle" style="text-align:center">
                                                    @php
                                                        if ($bill->phi_them != 0) {
                                                            echo number_format($bill->phi_them, 0, ',', '.') . ' VND';
                                                        } else {
                                                            echo '0';
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="align-middle" style="text-align:center;">
                                                    @php
                                                        if ($bill->phi_dv != 0) {
                                                            echo number_format($bill->phi_dv, 0, ',', '.') . ' VND';
                                                        } else {
                                                            echo '0';
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="align-middle" style="text-align:center">
                                                    @php
                                                        if ($bill->tong_tien != 0) {
                                                            echo number_format($bill-> tong_tien, 0, ',', '.') . ' VND';
                                                        } else {
                                                            echo '0';
                                                        }
                                                    @endphp
                                                </td>
                                                {{-- <td class="align-middle"style="text-align:center">{{ $bill -> trang_thai_hd }}</td> --}}
                                                <td class="align-middle"style="text-align:center">{{ $bill -> created_at }}</td>
                                                <td class="align-middle"style="text-align:center">{{ $bill -> updated_at }}</td>
                                                <td class="align-middle"style="text-align:center; width: 9rem">
                                                    <div class="form-edit-delete d-flex" style="width: 9rem">
                                                        <form action="" method="GET" id="delete_csvc_form" onsubmit="return false;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger delete_csvc" style="width: 2rem; height: 2rem; margin-right: 0.5rem; display: flex; justify-content: center; align-items: center;" onclick="confirmDelete('{{ route('admin.deleteBill',[$bill -> id_hd])}}')">
                                                                <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.9rem;"></i>
                                                            </button>
                                                            <input type="hidden" name="ma_csvc" value="">
                                                        </form>
                                                        
                                                        <button type="button" class="button_popover"  data-bs-toggle="popover" data-bs-html="true"
                                                                data-bs-content =
                                                                "<div class='wrapper_info'>
                                                                    <p><span class='info_label'>Phương Thức TT : </span> <span>{{ $bill-> phuong_thuc_tt }}</span></p>
                                                                    <div class= 'info'>
                                                                        <p><span class='info_label'>Tiền Khách Gửi : </span> <span class='info_value'>{{ $bill->tien_kh_gui != 0 ? number_format($bill->tien_kh_gui, 0 , ',', '.')  .' VND' : 0 }}</span></p>
                                                                        <p><span class='info_label'>Tiền Thừa :</span> <span class='info_value'>{{ $bill->tien_thua != 0 ? number_format($bill->tien_thua, 0 , ',', '.')  .' VND' : 0 }}</span> </p>
                                                                    </div>
                                                                </div>"
                                                                title="Thông Tin Thanh Toán">
                                                            Chi Tiết
                                                        </button>
                                                        {{-- <div style="width: 30%; margin-top: 0.2rem; margin-left: 0.2rem;">
                                                            <a href="" style="font-size: 0.7rem; text-decoration: none; ">Chi Tiết</a>
                                                        </div> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td class="align-middle" style="text-align:center" colspan="13">Chưa có dữ liệu ..</td>
                                    @endif
                            </tbody>
                        </table>
                        <div style="font-size:1rem; margin-bottom: 1rem; ">
                            <span style="font-weight: bold; margin-left : 70rem ;color:#ca1c50; font-size : 1rem">Tổng: </span>
                            {{ $countAcp}}
                        </div>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination room_pagination">
                                <!-- Previous Page Link -->
                                @if ($allBill_acp -> onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $allBill_acp -> appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @endif
                        
                                <!-- Pagination Elements -->
                                @foreach ($allBill_acp->appends(request()->query())->links()->elements[0] as $page => $url)
                                    @if ($page == $allBill_acp->currentPage())
                                        <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                        
                                <!-- Next Page Link -->
                                @if ($allBill_acp->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $allBill_acp->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
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
                </div>
              </div>

              <div class="back_room">
                <a href="{{ route('admin.index')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
            </div>

            <script>
                function getUser(url){
                    window.location.href = url;
                }
                // Kích hoạt popover khi hover
                document.addEventListener('DOMContentLoaded', function () {
                    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                        return new bootstrap.Popover(popoverTriggerEl, {
                            trigger: 'hover' 
                        })
                    })
                });

                function confirmDelete(url) {
                Swal.fire({
                    title: 'Xác nhận',
                    text: 'Bạn có chắc chắn muốn xóa?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#04AA6D',
                    cancelButtonColor: 'rgb(246, 81, 81)',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy',
                    customClass: {
                            popup: 'swal2-background-custom',
                        container: 'swal2-borderless'
                    },
                        background: '#30547e' ,
                        color: 'white'    
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                        
                                }
                     });
               }

            </script>    


        </body>
        </html>
    @endsection