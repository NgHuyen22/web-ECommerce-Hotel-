@extends('layouts.admin_home')
    @section('service_management')
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="{{ asset('admin/ad_css/service_management/sm_index.css')}}">
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
                <div class="sm_tool_search">
                    <div class="sm_services">
                        <a href="{{ route('admin.service_type')}}">
        
                            <div class="btn btn-primary sm_services_item">
                                    Loại dịch vụ
                            
                                <span class="badge badge-light" style="background-color:#155edb ;"> <span style="color:white">{{ $countSV  }}</span></span>
                                <span class="sr-only" >unread messages</span>
                            </div>
                        </a>
                    </div>
                    <form action="" method="get" class="sm_form_search mb-3">
                        @csrf   
    
                         <div class="sm_input_search container d-flex" style="font-family: 'Play', sans-serif !important;">
                            <div class="sm_search">
                                <input type="search" class="form-control" name="keywords" placeholder="Từ khóa tìm kiếm..."
                                    value="{{ request()->keywords }}">
                            </div>
    
                            
                            <div class="search__icon ">
                                <div class="col-2 w-100">
                                    <button type ="submit search_button" class=" btn btn-primary btn-block btn-css search_button"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
    
                        </div>
    
                    </form>

                </div>
 
              
                    <div class="tab-content booking_form_list" id="myTabContent" style="font-family: 'Play', sans-serif !important;">
                     
                        {{-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> --}}
                            <div class="tab-content table_content_csvc" id="pills-tabContent">
                                <div class="tab-pane fade show active content_csvc" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <table class="table update_room--table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="align-middle" style="text-align:center">STT</th>
                                                <th scope="col" class="align-middle" style="text-align:center">ID Đơn</th>
                                                <th scope="col" class="align-middle" style="text-align:center">Loại Phòng</th>
                                                <th scope="col" class="align-middle" style="text-align:center">Phòng</th>                             
                                                <th scope="col" class="align-middle" style="text-align:center">Loại Dịch Vụ</th>
                                                <th scope="col" class="align-middle" style="text-align:center">Dịch Vụ</th>
                                                <th scope="col" class="align-middle" style="text-align:center">Ngày Sử Dụng</th>
                                                <th scope="col" class="align-middle" style="text-align:center">Số Lượng</th>
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
                                                                <td class="align-middle"style="text-align:center    ;">{{ $row -> id_ct }}</td>
                                                                <td class="align-middle"style="text-align:center    ;">{{ $row -> ten_lp }}</td>
                                                                <td class="align-middle"style="text-align:center;color: rgb(209, 43, 43); font-weight:bold">{{ $row -> so_phong }}</td>
                                                                <td class="align-middle"style="text-align:center;width: 12rem">{{ $row -> ten_ldv }}</td>
                                                                <td class="align-middle"style="text-align:center;">{{ $row -> ten_dv }}</td>
                                                                <td class="align-middle"style="text-align:center">{{ $row -> ngay_su_dung }}</td>
                                                                <td class="align-middle"style="text-align:center">{{ $row -> so_luong_ct }}</td>
                                                                <td class="align-middle"style="text-align:center">{{ $row -> created_at }}</td>
                                                                <td class="align-middle"style="text-align:center">{{ $row -> updated_at }}</td>
                                                                <td class="align-middle"style="text-align:center; width: 5rem"">
                                                                    <div class="form-edit-delete d-flex">
        
                                                                        <form action="" method="GET" id="delete_csvc_form" onsubmit="return false;">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-danger delete_csvc" style="width: 2rem; height: 2rem; margin-left: 0.3rem; display: flex; justify-content: center; align-items: center;" onclick="confirmDelete('{{ route('admin.delete_form_sv',[$row -> id_ct])}}')">
                                                                                <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.9rem;"></i>
                                                                            </button>
                                                                           
                                                                        </form> 
                                                                        
                                                                        {{-- <div style="width: 30%; margin-top: 0.2rem; margin-left: 0.2rem;">
                                                                            <a href="" style="font-size: 0.7rem; text-decoration: none; ">Chi Tiết</a>
                                                                        </div> --}}
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
                    {{-- </div> --}}
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