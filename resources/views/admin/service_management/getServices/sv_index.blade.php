@extends('layouts.admin_home')
    @section('sv_index')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('admin/ad_css/service_management/getServices/sv_index.css')}}">
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
            


            
            <a href="{{ route('admin.add_dv', [$id_ldv])}}" class="add_room--wrapper" >
                <i class="fa-solid fa-plus add_room--icon" style="color: #ca1c50; cursor: pointer; font-size:1.2rem; margin-top : 0.5rem"></i>
            </a>

            @if(!$getService -> isEmpty())
                @foreach ( $getService as $row )
                    <div class="wrapper_detail">
                        <div class="sv_detail">
                                <p><span style="color: rgb(43, 107, 133); font-weight:bold;">Loại DV : </span> <span>   {{ $row -> ten_ldv }}</span></p>
                                <p><span style="color: rgb(43, 107, 133); font-weight:bold;">Tên DV : </span> <span>   {{ $row-> ten_dv }}</span></p>
                                <p> <span style="color: rgb(43, 107, 133); font-weight:bold;">Đơn giá : </span> 
                                    <span style="color: #dfa974; font-weight:bold">{{ number_format($row -> don_gia_dv,0,',','.') }} VND / 1 người</span>
                                </p>  
                                <p> <span style="color: rgb(43, 107, 133); font-weight:bold;">Mô Tả : </span> <span style="font-size: 0.9rem;">{{ $row -> mo_ta_dv}}</span></p>
                             
                            
                            <div class="sv_tool">
                                <div>
                                    <form action="{{ route('admin.edit_dv',[$row -> loai_dv, $row -> id_dv])}}" method="POST" class="edit_csvc_form" style="width: 2rem; height: 2rem;">
                                        @csrf
                                            <input type="hidden" name="id_dv" id="" value="{{ $row -> id_dv}}">
                                            <input type="hidden" name="ten_dv" id="" value="{{ $row -> ten_dv}}">
                                            <input type="hidden" name="loai_dv" id="" value="{{ $row -> loai_dv}}">
                                            <input type="hidden" name="don_gia_dv" id="" value="{{ $row -> don_gia_dv}}">
                                            <input type="hidden" name="mo_ta_dv" id="" value="{{ $row -> mo_ta_dv}}">
                                            <input type="hidden" name="menu" id="" value="{{ $row -> menu}}">
                                            <input type="hidden" name="created_at" id="" value="{{ $row -> created_at}}">
                                            <input type="hidden" name="updated_at" id="" value="{{ $row -> updated_at}}">
                                        <button type="submit" class="btn btn-dark edit_csvc" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                            <i class="fa-regular fa-pen-to-square edit_csvc-icon" style="font-size: 0.8rem;"></i>
                                        </button>
                                    </form>
                                </div>

                                <div>
                                    <form action="" method="GET" id="delete_csvc_form" onsubmit="return false;"style="width: 2rem; height: 2rem;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger delete_csvc" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;"  onclick="confirmDelete('{{route('admin.delete_sv',[$row -> loai_dv, $row -> id_dv])}}')">
                                            <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.8rem;"></i>
                                        </button>
                                        <input type="hidden" name="ma_csvc" value="">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="sv_menu">
                            
                           <h5>{{ $row -> ten_dv}}</h5>
                            @if($row->menu != null)
                                    <p>{!! str_replace('.', '.<br><br>', $row-> menu) !!}</p>
                            @else
                                     <p>Chưa có dữ liệu...</p>
                            @endif
                        </div>
                    </div>
                    
                @endforeach
            @else
                <p style="margin-top:2rem;margin-left: 4rem">Chưa có dữ liệu...</p>
            @endif

            <nav aria-label="Page navigation example">
                <ul class="pagination room_pagination">
                    <!-- Previous Page Link -->
                    @if ($getService->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $getService->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif
            
                    <!-- Pagination Elements -->
                    @foreach ($getService->appends(request()->query())->links()->elements[0] as $page => $url)
                        @if ($page == $getService->currentPage())
                            <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
            
                    <!-- Next Page Link -->
                    @if ($getService->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $getService->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
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
                <a href="{{ route('admin.service_type')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
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