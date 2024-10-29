
@extends('layouts.admin_home')
        @section('room_detail')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            {{-- <title>Document</title> --}}
            <link rel="stylesheet" href="{{ asset('admin/ad_css/update_room/room_detail.css')}}">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        </head>

        <body>
            <style>
                @import url('https://fonts.cdnfonts.com/css/play');
            </style>
                {{-- ---alert--- --}}
                @if (Session::has('error'))
                    <div class="alert-csvc  alert alert-danger">{{ Session::get('error') }}</div>
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
                {{-- --- --}}
                @if(count($room) > 0)
                    <section class="section services-section" id="services">
                        <div class="container">
                            <div class="row" style="  font-family: 'Play', sans-serif !important;">
                                <div class="col-lg-6">
                                    <div class="section-title">
                                        <h2 style="color:rgb(48, 84, 126)">{{ ($room_type -> ten_lp) != null ? $room_type -> ten_lp : ''}}</h2>
                                            
                                        @if($countRoom > 0)
                                            <div style="font-size:1rem; margin-bottom: 1rem; ">
                                                <span style="font-weight: bold; margin-left : 2rem ;color:#ca1c50; font-size : 1rem">Tổng: </span>
                                                {{ $countRoom }}
                                            </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            {{-- @if($room_type -> ten_lp != null)
                                     <span>Danh sách các phòng thuộc loại phòng {{($room_type -> ten_lp)}}</span>
                                @endif --}}
                                <a href="{{ route('admin.add_room2' , [$room_type -> id_lp])}}" class="add_room--wrapper" >
                                    <i class="fa-solid fa-plus add_room--icon" style="color: #ca1c50; cursor: pointer; font-size:1.2rem; margin-top : 0.5rem"></i>
                                </a>
                            <div class="row">
                                <!-- feaure box -->
                                @if(count($room) > 0)
                                    @foreach ( $room as $row)
                                         <div class="col-sm-6 col-lg-4">
                                            <div class="feature-box-1">
                                                <div class="icon">
                                                    {{-- <img src="{{ asset('customer/img/room/' . $row->ten_lp . '.jpg') }}" alt=""> --}}
                                                    <i class="fa-solid fa-hotel"></i>
                                                </div>
                                                <div class=" discribe-icon-wrapper">
                                                    <div class="feature-content room_detail">
                                                        <h5 style="color: rgb(48, 84, 126)">{{ $row -> so_phong}}</h5>
                                                        {{-- <p style="color: rgb(48, 84, 126)">{{ $row -> tinh_trang }}</p> --}}
                                                    </div>

                                                    <button type="submit" class="btn btn-danger delete_room" style="width: 2rem; height: 2rem; margin-left: 0.3rem; display: flex; justify-content: center; align-items: center;" onclick="confirmDelete('{{ route('admin.delete_room', [ $row->id_phong]) }}')">
                                                        <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.9rem;"></i>
                                                    </button>
                                                </div>
                                               
                                            </div>
                                         </div>  
                                    @endforeach

                                @endif
                                <!-- / -->

                            </div>
                        </div>
                    </section>
                    
                    <nav aria-label="Page navigation example" >
                        <ul class="pagination room_pagination">
                            <!-- Previous Page Link -->
                            @if ($room->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $room->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif
                    
                            <!-- Pagination Elements -->
                            @foreach ($room->links()->elements[0] as $page => $url)
                                @if ($page == $room->currentPage())
                                    <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                    
                            <!-- Next Page Link -->
                            @if ($room->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $room->nextPageUrl() }}" aria-label="Next">
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
                    
                @else
                    <a href="{{ route('admin.add_room2' , [$room_type -> id_lp])}}" class="add_room--wrapper" style="margin-left: 2rem; margin-top:2rem">
                        <i class="fa-solid fa-plus add_room--icon" style="color: #ca1c50; cursor: pointer; font-size:1.2rem; margin-top : 0.5rem"></i>
                    </a>
                     <p style="margin-left: 2rem; font-weight:bold; margin-top:10rem">Chưa có dữ liệu .</p>
                @endif

                <div class="back_room">
                    <a href="{{ route('admin.update_room')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
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
                            Swal.fire({
                                icon: 'success',
                                text: 'Xóa thành công',
                                showConfirmButton: false,
                                timer: 2500
                                        });
                                    }
                                });
                            }
                </script>
            </body>
            </html>
        @endsection