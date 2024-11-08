@extends('layouts.admin_home')
    @section('customer_information_management')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/customer_infomation_management/ctm_management.css')}}">
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

        <form action="" class="select_room" method="POST" id="roomForm">
            @csrf
            <select name="type" id="roomTypeSelect" class="form-control select_item" onchange="submitFormWithRoomType()">
                <option value="0" {{ isset($type) && $type == 0 ? 'selected' : '' }}>Tất cả</option>
                <option value="1" {{ isset($type) && $type == 1 ? 'selected' : '' }}>Khách hàng mới</option>
                <option value="2" {{ isset($type) && $type == 2 ? 'selected' : '' }}>Khách hàng phổ thông</option>
                <option value="3" {{ isset($type) && $type == 3 ? 'selected' : '' }}>Khách hàng thân thuộc</option>
            </select>
        </form>

        <div class="wrapper_ttkh">
            <table class="table_ttkh">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center;">STT</th>
                        <th scope="col" style="text-align:center;">ID</th>
                        <th scope="col" style="text-align:center;">Họ Tên</th>
                        <th scope="col" style="text-align:center;">Giới Tính</th>
                        <th scope="col" style="text-align:center;">Địa Chỉ</th>
                        <th scope="col" style="text-align:center;">SDT</th>
                        <th scope="col" style="text-align:center;">Email</th>
                        <th scope="col" style="text-align:center;">Tổng lượt đặt</th>
                        <th scope="col" style="text-align:center;"></th>
                        <th scope="col" style="text-align:center;"></th>
                      </tr>
                </thead>
    
                <tbody>
                    @if($customer->count() > 0)
                        @php $count = 1; @endphp
                        @foreach ( $customer as $ct )
                            <tr style="border-bottom: 1px solid black;">
                                <th scope="row" class="align-middle" style="text-align:center">{{ $count++ }}</th>
                                <td class="align-middle"style="text-align:center    ;">{{ $ct -> id_kh }}</td>
                                <td class="align-middle"style="text-align:center;color: rgb(73 136 194);font-weight:bold">{{ $ct -> ho_ten }}</td>
                                <td class="align-middle"style="text-align:center    ;">{{ $ct -> gioi_tinh == 1 ? 'Nữ':'Nam' }}</td>
                                <td class="align-middle"style="text-align:center    ;">{{ $ct -> dia_chi}}</td>
                                <td class="align-middle"style="text-align:center    ;">{{ $ct -> sdt}}</td>
                                <td class="align-middle"style="text-align:center    ;">{{ $ct -> email}}</td>
                                <td class="align-middle"style="text-align:center    ;">{{ $ct -> so_lan_dat}}</td>
                                <td class="align-middle"style="text-align:center;">
                                    <p style="padding-top: 0.5rem">Lần đặt cuối cùng <span>{{ $ct->last_booking_date}}</span></p>
                                    <p style="background-color: rgb(84, 202, 141);width: 13rem;
                                        height: 4vh;color:rgb(255, 226, 190);border-radius: 10px;margin-left: 5rem;padding-top:0.2rem;font-weight:bold">
                                        {{ \Carbon\Carbon::parse($ct->last_booking_date)->diffInDays(\Carbon\Carbon::now()) }} ngày chưa đặt phòng
                                    </p>
                                </td>
                                <td class="align-middle"style="text-align:center;">
                                    <div class="tool_flex">
                                        <button type="submit" class="btn btn-danger delete_csvc" style="width: 2rem; height: 2rem; 
                                            margin-right: 0.5rem; display: flex; justify-content: center; align-items: center;" onclick="confirmDelete('{{ route('admin.delete_customer_info',[$ct->id_kh])}}')">
                                            <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.9rem;"></i>
                                        </button>    
                                        <a href="{{ route('admin.add_ldv') }}" class="add_room--wrapper" >
                                            <i class="fa-solid fa-plus add_room--icon" style="color: #ca1c50; cursor: pointer; font-size:1.2rem; margin-top : 0.5rem"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="align-middle"style="text-align:center;">Không có dữ liệu..</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <p style="margin-top: 3rem;margin-left: 70rem;">
            <span style="font-weight: bold;color: #ca1c50;font-size: 1rem">Tổng: </span> 
            <span>{{$customer -> count()}}</span>
        </p>

        @if($customer ->count() > 0)
            <nav aria-label="Page navigation example">
                <ul class="pagination room_pagination">
                    <!-- Previous Page Link -->
                    @if ($customer->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $customer->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif
            
                    <!-- Pagination Elements -->
                    @foreach ($customer->appends(request()->query())->links()->elements[0] as $page => $url)
                        @if ($page == $customer->currentPage())
                            <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
            
                    <!-- Next Page Link -->
                    @if ($customer->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $customer->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
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

        <script>
            function submitFormWithRoomType() {
                const selectElement = document.getElementById('roomTypeSelect');
                console.log(selectElement);
                const selectedRoomType = selectElement.value;
        
                if (selectedRoomType) {
                    const form = document.getElementById('roomForm');
                    const url = `{{ route('admin.customer_type', ['type' => ':type']) }}`.replace(':type', selectedRoomType || 0); 
                    form.action = url;
                    // form.method = 'GET';
                    form.submit();
                }
            }
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