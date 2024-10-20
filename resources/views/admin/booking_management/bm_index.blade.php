@extends('layouts.admin_home')
    @section('booking_management')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
           <link rel="stylesheet" href="{{ asset('admin/ad_css/booking_management/bkm_index.css')}}">
        </head>
        <body>
            <style>
                @import url('https://fonts.cdnfonts.com/css/play');
            </style>

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
            <div class="tool_wrapper">
                <a href="" class="wrapper_calender">
                    <i class="fa-solid fa-calendar-days" style="color: #1f407a;"></i>
                </a>

                <div class="wrapper_search">
                    <form action="{{ route('admin.booking_management')}}" class="bm_index_form" id="" method="POST">
                         @csrf
                         <div class="form-group label_input">
                             <label for="ngay_nhan_phong" class="bm_index_label" style="font-weight:bold">Ngày nhận phòng : </label>
                             <input type="date" class="form-control bm_index_input" id="ngay_nhan_phong" name ="ngay_nhan_phong" placeholder="" value="{{old('ngay_nhan_phong', isset($ngay_nhan_phong) ? $ngay_nhan_phong : '')}}" >
                             
                         </div>
                         
                         <div class="form-group label_input">
                             <label for="ngay_tra_phong" class="bm_index_label" style="font-weight:bold">Ngày trả phòng : </label>
                             <input type="date" class="form-control bm_index_input" id="ngay_tra_phong" name ="ngay_tra_phong" placeholder="" value="{{ old('ngay_tra_phong', isset($ngay_tra_phong) ? $ngay_tra_phong : '') }}">
                             
                         </div>

                         <button type ="submit" class=" btn btn-primary btn-block btn-css search_button" style="background: #4398d1;"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>       
                </div>
            </div>


            <ul class="nav nav-tabs tab_list" id="myTab" role="tablist">
                {{-- 1 --}}
                <li class="nav-item" role="presentation">
                  <button class="nav-link active nav_item_button" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                       Chưa xác nhận
                    </button>
                </li> 
                {{-- 2 --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link nav_item_button1" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                       Đã xác nhận
                    </button>
                </li>
            </ul>

            <div class="tab-content booking_form_list" id="myTabContent" style="  font-family: 'Play', sans-serif !important;">
                <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab"> 
                    {{-- <div class="wrapper_search">
                        <form action="" class="bm_index_form" id="" method="POST">
                             @csrf
                             <div class="form-group label_input">
                                 <label for="ngay_nhan_phong" class="bm_index_label" style="font-weight:bold">Ngày nhận phòng : </label>
                                 <input type="date" class="form-control bm_index_input" id="ngay_nhan_phong" name ="ngay_nhan_phong" placeholder="" value="" >
                                 
                             </div>
                             
                             <div class="form-group label_input">
                                 <label for="ngay_tra_phong" class="bm_index_label" style="font-weight:bold">Ngày trả phòng : </label>
                                 <input type="date" class="form-control bm_index_input" id="ngay_tra_phong" name ="ngay_tra_phong" placeholder="" value="">
                                 
                             </div>
                        </form>       
                    </div> --}}

                    <div class="tab-content table_content_csvc" id="pills-tabContent">
                        <div class="tab-pane fade show active content_csvc" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <table class="table update_room--table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="align-middle" style="text-align:center">STT</th>
                                        <th scope="col" class="align-middle" style="text-align:center">ID Đơn</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Tên KH</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Loại Phòng</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Phòng</th> 
                                        <th scope="col" class="align-middle" style="text-align:center">Đơn Giá</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Ngày Nhận Phòng</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Ngày Trả Phòng</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Ngày Tạo</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Ngày Cập Nhật</th>
                                      
                                        <th scope="col" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider update_room--tbody">
                                    @if(!$unapproved -> isEmpty())
                                        @php $count = 1; @endphp
                                        @if(count($unapproved) > 0)
                                                @foreach ( $unapproved as $row )
                                                    <tr>
                                                        <th scope="row" class="align-middle" style="text-align:justify">{{ $count++ }}</th>
                                                        {{-- <td class="align-middle" style="text-align:justify">{{ $row -> id_lp }}</td> --}}
                                                        <td class="align-middle"style="text-align:center    ;">{{ $row -> id_don }}</td>
                                                        <td class="align-middle"style="text-align:center;color: rgb(209, 43, 43); font-weight:bold;width: 10rem">{{ $row-> ho_ten }}</td>
                                                        <td class="align-middle"style="text-align:center;">{{ $row -> ten_lp }}</td>
                                                        <td class="align-middle"style="text-align:center;width: 5rem"> 
                                                            {{-- <select name="" id="room-select-{{ $row->id_don }}" style="width: 5rem" name="id_phong">
                                                                <option value="" disabled selected hidden>Phòng</option>
                                                                    @if(!$all -> isEmpty())
                                                                        @foreach ($all as $phong )
                                                                            @if($phong -> loai_phong == $row -> id_loai_phong)
                                                                                
                                                                                    <option value="{{ $phong->id_phong }}">{{$phong -> so_phong}}</option>
                                                                                  
                                                                            @endif

                                                                         @endforeach
                                                                    @endif
                                                            </select>                                --}}
                                                            <select name="" id="room-select-{{ $row->id_don }}" style="width: 5rem" name="id_phong">
                                                                <option value="" disabled selected hidden>Phòng</option>
                                                                @if(!$all->isEmpty())
                                                                    @foreach ($all as $phong )
                                                                        @if($phong->loai_phong == $row->id_loai_phong)
                                                                            <option value="{{ $phong->id_phong }}">{{ $phong->so_phong }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td class="align-middle"style="text-align:center">{{ number_format($row -> gia_lp, 0, ',' , '.') }} VND / Đêm</td>
                                                        <td class="align-middle"style="text-align:center">{{ \Carbon\Carbon::parse($row->ngay_nhan_phong)->format('d-m-Y')  }}</td>
                                                        <td class="align-middle"style="text-align:center">{{ \Carbon\Carbon::parse($row->ngay_tra_phong)->format('d-m-Y') }}</td>
                                                        <td class="align-middle"style="text-align:center">{{ $row -> created_at }}</td>
                                                        <td class="align-middle"style="text-align:center">{{ $row -> updated_at }}</td>
                                                        {{-- <td class="align-middle"style="text-align:center">{{ $row -> created_at }}</td>
                                                        <td class="align-middle"style="text-align:center">{{ $row -> updated_at }}</td> --}}
                                                        <td class="align-middle"style="text-align:center; width: 11rem">
                                                            <div class="form-edit-delete d-flex">
                                                              
                                                                {{-- <form action="{{ route('admin.approved', [ $row -> id_don])}}" method="POST" id="approved_bf">
                                                                    @csrf
                                                                    <input type="hidden" name="id_kh" value="{{$row -> id_kh}}">
                                                                    <input type="hidden" name="id_don" value="{{$row -> id_don}}">
                                                                    <input type="hidden" name="id_rt" value="{{$row -> id_loai_phong}}">
                                                                    <input type="hidden" id="hidden_id_phong" name="hidden_id_phong" value="">
                                                                    <input type="hidden" name="gia" value="{{$row -> gia_lp}}">
                                                                    <input type="hidden" name="soNgay" value="{{$row -> so_ngay_o}}">
                                                                    <button type="submit" class="btn btn-danger approved_icon" style="width: 2rem; height: 2rem; margin-left: 0.3rem; display: flex; justify-content: center; align-items: center;">
                                                                        <i class="fa-regular fa-square-check fa-fade" style="color: white"></i>
                                                                    </button>    
                                                                </form> --}}

                                                                {{-- <script>
                                                                      document.getElementById('room-select-{{ $row->id_don }}').addEventListener('change', function() {
                                                                        var selectedRoomId = this.value;
                                                                        console.log(selectedRoomId);
                                                                        document.getElementById('hidden_id_phong').value = selectedRoomId;
                                                                       
                                                                    }); 

                                                                    // document.getElementById('approved_bf').addEventListener('submit', function(event){
                                                                    //     var selectedRoom = document.getElementById('room-select-{{ $row->id_don }}').value;
                                                                    //     if (selectedRoom === "") {
                                                                    //             event.preventDefault(); 
                                                                                
                                                                    //             Swal.fire({
                                                                    //                 icon: 'error',
                                                                    //                 text: 'Vui lòng chọn phòng trước khi duyệt',
                                                                    //                 showConfirmButton: false,
                                                                    //                 timer: 2500
                                                                    //             });
                                                                    //         }
                                                                    // });
                                                                {{-- </script> --}}

                                                                <form action="{{ route('admin.approved', [$row->id_don])}}" method="POST" id="approved_bf_{{ $row->id_don }}">
                                                                    @csrf
                                                                    <input type="hidden" name="id_kh" value="{{ $row->id_kh }}">
                                                                    <input type="hidden" name="id_don" value="{{ $row->id_don }}">
                                                                    <input type="hidden" name="id_rt" value="{{ $row->id_loai_phong }}">
                                                                    <input type="hidden" id="hidden_id_phong_{{ $row->id_don }}" name="hidden_id_phong" value="">
                                                                    <input type="hidden" name="gia" value="{{ $row->gia_lp }}">
                                                                    <input type="hidden" name="soNgay" value="{{ $row->so_ngay_o }}">
                                                                    <button type="submit" class="btn btn-danger approved_icon" style="width: 2rem; height: 2rem; margin-right: 0.5rem; display: flex; justify-content: center; align-items: center;">
                                                                        <i class="fa-regular fa-square-check fa-fade" style="color: white"></i>
                                                                    </button>    
                                                                </form>
                                                                
                                                                <script>
                                                                    document.getElementById('room-select-{{ $row->id_don }}').addEventListener('change', function() {
                                                                        var selectedRoomId = this.value;
                                                                        // console.log(selectedRoomId);
                                                                        document.getElementById('hidden_id_phong_{{ $row->id_don }}').value = selectedRoomId;
                                                                    });
                                                                </script>

                                                             
                                                                {{-- <div style="width: 30%; margin-top: 0.2rem; margin-left: 0.2rem;">
                                                                    <a href="{{ route('admin.bf_detail',[ $row -> id_don])}}" style="font-size: 0.7rem; text-decoration: none; ">Chi Tiết</a>
                                                                </div> --}}
                                                                <button type="button" onclick="Detail('{{ route('admin.bf_detail',[ $row -> id_don])}}')" class="button_popover"  data-bs-toggle="popover" data-bs-html="true"
                                                                    data-bs-content =
                                                                    "<div class='wrapper_info'>
                                                                        <p><span class='info_label'>Số Ngày Ở : </span> <span>{{ $row -> so_ngay_o }}</span></p>
                                                                        <div class= 'info'>
                                                                            <p><span class='info_label'>Ghi Chú : </span> <span class='info_value'>{{ $row-> ghi_chu != null ?  $row-> ghi_chu : ''}}</span></p>     
                                                                        </div>
                                                                    </div>"
                                                                    title="Thông Tin Phòng">
                                                                    Chi tiết
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        @else
                                            <tr>
                                                
                                                <td colspan ="10" class="align-middle text-center">Không có dữ liệu</td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td colspan ="10" class="align-middle text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div style="font-size:1rem; margin-bottom: 1rem; ">
                                <span style="font-weight: bold; margin-left : 70rem ;color:#ca1c50; font-size : 1rem">Tổng: </span>
                                {{ $unapproved -> total()}}
                            </div>
                        </div>
        
                    </div>
                        @if(!$unapproved -> isEmpty())
                            <nav aria-label="Page navigation example">
                                <ul class="pagination room_pagination">
                                    <!-- Previous Page Link -->
                                    @if ($unapproved->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $unapproved->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif
                            
                                    <!-- Pagination Elements -->
                                    @foreach ($unapproved->appends(request()->query())->links()->elements[0] as $page => $url)
                                        @if ($page == $unapproved->currentPage())
                                            <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                            
                                    <!-- Next Page Link -->
                                    @if ($unapproved->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $unapproved->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
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
                        @endif     
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="tab-content table_content_csvc" id="pills-tabContent">
                        <div class="tab-pane fade show active content_csvc" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <table class="table update_room--table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="align-middle" style="text-align:center">STT</th>
                                        <th scope="col" class="align-middle" style="text-align:center">ID Đơn</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Tên KH</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Loại Phòng</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Phòng</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Đơn Giá</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Ngày Nhận Phòng</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Ngày Trả Phòng</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Ngày Tạo</th>
                                        <th scope="col" class="align-middle" style="text-align:center">Ngày Cập Nhật</th>
                                      
                                        <th scope="col" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider update_room--tbody">
                                    @if(!$approved -> isEmpty())
                                        @php $count = 1; @endphp
                                        @if(count($approved) > 0)
                                                @foreach ( $approved as $row )
                                                    <tr>
                                                        <th scope="row" class="align-middle" style="text-align:justify">{{ $count++ }}</th>
                                                        {{-- <td class="align-middle" style="text-align:justify">{{ $row -> id_lp }}</td> --}}
                                                        <td class="align-middle"style="text-align:center    ;">{{ $row -> id_don }}</td>
                                                        <td class="align-middle"style="text-align:center;color: rgb(209, 43, 43); font-weight:bold;width: 10rem">{{ $row-> ho_ten }}</td>
                                                        <td class="align-middle"style="text-align:center;">{{ $row -> ten_lp }}</td>
                                                        <td class="align-middle"style="text-align:center;">{{ $row -> so_phong }}</td>
                                                        <td class="align-middle"style="text-align:center">{{ number_format($row -> gia_lp, 0, ',' , '.') }} VND / Đêm</td>
                                                        <td class="align-middle"style="text-align:center">{{  \Carbon\Carbon::parse($row->ngay_nhan_phong)->format('d-m-Y')  }}</td>
                                                        <td class="align-middle"style="text-align:center">{{  \Carbon\Carbon::parse($row->ngay_tra_phong)->format('d-m-Y') }}</td>
                                                        <td class="align-middle"style="text-align:center">{{ $row -> created_at }}</td>
                                                        <td class="align-middle"style="text-align:center">{{ $row -> updated_at }}</td>
                                                        {{-- <td class="align-middle"style="text-align:center">{{ $row -> created_at }}</td>
                                                        <td class="align-middle"style="text-align:center">{{ $row -> updated_at }}</td> --}}
                                                        <td class="align-middle"style="text-align:center; width: 11rem">
                                                            <div class="form-edit-delete d-flex">

                                                                <form action="" method="GET" id="delete_csvc_form" onsubmit="return false;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger delete_csvc" style="width: 2rem; height: 2rem; margin-right: 0.5rem; display: flex; justify-content: center; align-items: center;" onclick="confirmDelete('{{ route('admin.delete', [$row -> id_don])}}')">
                                                                        <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.9rem;"></i>
                                                                    </button>
                                                                   
                                                                </form> 
                                                                
                                                                {{-- <div style="width: 30%; margin-top: 0.2rem; margin-left: 0.2rem;">
                                                                    <a href="{{ route('admin.bf_detail',[ $row -> id_don])}}" style="font-size: 0.7rem; text-decoration: none; ">Chi Tiết</a>
                                                                </div> --}}
                                                                <button type="button" onclick="Detail('{{ route('admin.bf_detail',[ $row -> id_don])}}')" class="button_popover"  data-bs-toggle="popover" data-bs-html="true"
                                                                    data-bs-content =
                                                                    "<div class='wrapper_info'>
                                                                        <p><span class='info_label'>Số Ngày Ở : </span> <span>{{ $row -> so_ngay_o }}</span></p>
                                                                        <div class= 'info'>
                                                                            <p><span class='info_label'>Ghi Chú : </span> <span class='info_value'>{{ $row-> ghi_chu != null ?  $row-> ghi_chu : ''}}</span></p>     
                                                                        </div>
                                                                    </div>"
                                                                    title="Thông Tin Phòng">
                                                                    Chi tiết
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        @else
                                            <tr>
                                                
                                                <td colspan ="10" class="align-middle text-center">Không có dữ liệu</td>
                                            </tr>
                                        @endif
                                            

                                    @else
                                        <tr>
                                            <td colspan ="10" class="align-middle text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div style="font-size:1rem; margin-bottom: 1rem; ">
                                <span style="font-weight: bold; margin-left : 70rem ;color:#ca1c50; font-size : 1rem">Tổng: </span>
                                {{ $approved -> total()}}
                            </div>
                        </div>
        
                    </div>
                        @if(!$approved -> isEmpty())
                            <nav aria-label="Page navigation example">
                                <ul class="pagination room_pagination">
                                    <!-- Previous Page Link -->
                                    @if ($approved->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $approved->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif
                            
                                    <!-- Pagination Elements -->
                                    @foreach ($approved->appends(request()->query())->links()->elements[0] as $page => $url)
                                        @if ($page == $approved->currentPage())
                                            <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                            
                                    <!-- Next Page Link -->
                                    @if ($approved->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $approved->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
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
                        @endif  
                </div>
            </div>

            
            <div class="back_room">
                <a href="{{ route('admin.index')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
            </div>
            <script>
                    //  function Approve(){
                //     event.preventDefault();
                //     Swal.fire({
                //     title: 'Danh sách các phòng trống',
                //     html: `   <style>
                //                         .swal2-background-custom{
                //                             border: 2px solid black; 
                //                             border-radius: 1rem; 
                //                         }
                //                         .confirmBF_form{
                //                             display: flex;
                //                             justify-content: center;
                //                             align-items: center;
                //                         }
                //                         .select_sp{
                //                             width: 12rem;
                //                         }
                //                 </style>
                //                  <form id="confirmBF_form" class="confirmBF_form" action="{{ route('customer.insert_form') }}" method="POST">
                //                         @csrf
                //                         <select class="form-select select_sp" aria-label="Default select example" id="id_don" name="id_don">
                                            
                                            
                //                         </select>
                //                 </form>`,
                //                 icon: 'info',
                //                 confirmButtonText: 'Xác nhận',
                //                 cancelButtonText: 'Hủy',
                //                 showCancelButton: true,
                //                 confirmButtonColor: '#04AA6D',
                //                 cancelButtonColor: 'rgb(246, 81, 81)',
                //                 customClass: {
                //                     popup: 'swal2-background-custom',
                //                     container: 'swal2-borderless'
                //                 },
                      
                //             background: '#30547e' ,
                //             color: 'white'    
                //             }).then((result) => {
                //                 if (result.isConfirmed) {
                //                     document.getElementById('confirmBF_form').submit(); 
                //                 }
                //             });
                // }
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

                 // Kích hoạt popover khi hover
                 document.addEventListener('DOMContentLoaded', function () {
                    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                        return new bootstrap.Popover(popoverTriggerEl, {
                            trigger: 'hover' 
                        })
                    })
                });

                function Detail(url) {
                    window.location.href = url;
                }
            </script>
        </body>
        </html>
    @endsection