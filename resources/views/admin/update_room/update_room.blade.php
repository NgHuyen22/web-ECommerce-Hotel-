@extends('layouts.admin_home')
@section('update_room')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link rel="stylesheet" href="{{asset('admin/ad_css/update_room/update_room.css')}}">
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

            <ul class="nav nav-pills mb-3 nav_tabs list_nav update_room--tool" id="pills-tab" role="tablist" style="margin-left : 2rem; margin-top : 3rem">
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">CSVC</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">CSVC Các Phòng</button>
                </li> --}}

                <li class="add_room--icon">
                    <a href="{{ route('admin.add_room') }}"  class="add_room--wrapper" >
                        <i class="fa-solid fa-plus" style="color: #ca1c50; cursor: pointer; font-size:1.2rem; margin-top : 0.5rem"></i>
                    </a>
                </li>
                
                <form action="" method="get" class="form__search mb-3">
                    @csrf

                    <div class="input_search_icon container d-flex">
                        <div class="update_room--search">
                            <input type="search" class="form-control" name="keywords" placeholder="Từ khóa tìm kiếm..."
                                value="{{ request()->keywords }}">
                        </div>

                        {{-- <div class="search__icon">
                            <a href="">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                    </div> --}}
                        <div class="search__icon ">
                            <div class="col-2 w-100">
                                <button type ="submit" class=" btn btn-primary btn-block btn-css">Tìm</button>
                            </div>
                        </div>

                    </div>

                </form>
                
            </ul>

            <div class="tab-content table_content_csvc" id="pills-tabContent">
                <div class="tab-pane fade show active content_csvc" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <table class="table update_room--table">
                        <thead>
                            <tr>
                                <th scope="col" class="align-middle" style="text-align:center">STT</th>
                                {{-- <th scope="col" class="align-middle" style="text-align:center">ID</th> --}}
                                <th scope="col" class="align-middle" style="text-align:center">Tên LP</th>
                                <th scope="col" class="align-middle" style="text-align:center">Giá</th>
                                <th scope="col" class="align-middle" style="text-align:center">Mô Tả</th>
                                <th scope="col" class="align-middle" style="text-align:center">Tiện Nghi</th>
                                <th scope="col" class="align-middle" style="text-align:center">Sức Chứa</th>
                                <th scope="col" class="align-middle" style="text-align:center">Diện Tích</th>
                                <th scope="col" class="align-middle" style="text-align:center">Ngày Tạo</th>
                                <th scope="col" class="align-middle" style="text-align:center">Ngày Cập Nhật</th>
                                <th scope="col" class="align-middle" style="text-align:center">Trạng Thái</th>
                                <th scope="col" class="align-middle" style="text-align:center"></th>
                                <th scope="col" colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider update_room--tbody">
                            @if(!$room_type -> isEmpty())
                                    @php $count = 1; @endphp
                                    @if (count($room_type) > 0)
                                        @foreach ($room_type as $row) 
                                            <tr>
                                                <th scope="row" class="align-middle" style="text-align:justify">{{ $count++ }}</th>
                                                {{-- <td class="align-middle" style="text-align:justify">{{ $row -> id_lp }}</td> --}}
                                                <td class="align-middle"style="text-align:justify; color: rgb(209, 43, 43); font-weight:bold">{{ $row -> ten_lp }}</td>
                                                <td class="align-middle"style="text-align:justify">{{ number_format($row -> gia_lp, 0 , ',', '.') }} VND / Đêm</td>
                                                <td class="align-middle"style="text-align:justify">{{ $row -> mo_ta }}</td>
                                                <td class="align-middle"style="text-align:center">{{ $row -> tien_nghi }}</td>
                                                <td class="align-middle"style="text-align:center">{{ $row -> suc_chua }}</td>
                                                <td class="align-middle"style="text-align:center">{{ $row -> dien_tich }}</td>
                                                <td class="align-middle"style="text-align:center">{{ $row -> created_at }}</td>
                                                <td class="align-middle"style="text-align:center">{{ $row -> updated_at }}</td>
                                                <td class="align-middle"style="text-align:center;width: 6rem;dispaly:flex; justify-content: center;align-items: center; "> <p style="text-align: center;width: 96%;background-color: #33a67f; color: white;border-radius: 4px;margin-top:0.7rem">{{ ($row -> status  == 1 )? 'Hiển thị' : ''}}</p></td>
                                                <td class="align-middle"style="text-align:center; width: 9rem">
                                                    <div class="form-edit-delete d-flex">
                                                        <form action="{{ route('admin.updated_form',['id_rt' => $row->id_lp]) }}" method="POST" class="edit_csvc_form" style="width: 2rem; height: 2rem;">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-dark edit_csvc" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                                                <i class="fa-regular fa-pen-to-square edit_csvc-icon" style="font-size: 0.9rem;"></i>
                                                            </button>
                                                        </form>
                                                        
                                                        <form action="" method="GET" id="delete_csvc_form" onsubmit="return false;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger delete_csvc" style="width: 2rem; height: 2rem; margin-left: 0.3rem; display: flex; justify-content: center; align-items: center;" onclick="confirmDelete('{{ route('admin.delete_roomType', ['id_rt' => $row->id_lp]) }}')">
                                                                <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.9rem;"></i>
                                                            </button>
                                                            <input type="hidden" name="ma_csvc" value="">
                                                        </form>
                                                        
                                                        <div style="width: 30%; margin-top: 0.2rem; margin-left: 0.2rem;">
                                                            <a href="{{ route('admin.room_detail', [$row->id_lp]) }}" style="font-size: 0.7rem; text-decoration: none; ">Chi Tiết</a>
                                                        </div>
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
                        {{ $countRT}}
                    </div>
                </div>

            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination room_pagination">
                    <!-- Previous Page Link -->
                    @if ($room_type->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $room_type->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif
            
                    <!-- Pagination Elements -->
                    @foreach ($room_type->appends(request()->query())->links()->elements[0] as $page => $url)
                        @if ($page == $room_type->currentPage())
                            <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
            
                    <!-- Next Page Link -->
                    @if ($room_type->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $room_type->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
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
            
            <div class="back_room">
                <a href="{{ route('admin.index')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
            </div>
            <script>
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
