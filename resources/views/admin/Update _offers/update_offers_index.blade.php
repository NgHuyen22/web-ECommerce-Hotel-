@extends('layouts.admin_home')
    @section('update_offers_index')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <link rel="stylesheet" href="{{ asset('admin/ad_css/update_offers/update_offers_index.css')}}">
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
  
            <a href="{{ route('admin.add_incentives')}}" class="add_room--wrapper">
                <i class="fa-solid fa-plus add_room--icon" style="color: #ca1c50; cursor: pointer; font-size:1.2rem; margin-top : 0.5rem"></i>
            </a>
   

            <div class="tab-content table_content_csvc" id="pills-tabContent">
                <div class="tab-pane fade show active content_csvc" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table update_room--table">
                        <thead>
                            <tr>
                                <th scope="col" class="align-middle" style="text-align:center">STT</th>
                                <th scope="col" class="align-middle" style="text-align:center">ID</th>
                                <th scope="col" class="align-middle" style="text-align:center">Tên Ưu Đãi</th>
                                <th scope="col" class="align-middle" style="text-align:center">Giảm</th>                             
                                <th scope="col" class="align-middle" style="text-align:center">SL Áp Dụng</th>                             
                                <th scope="col" class="align-middle" style="text-align:center">Dịch Vụ Áp Dụng </th>
                                <th scope="col" class="align-middle" style="text-align:center">Ngày Áp Dụng</th>
                                <th scope="col" class="align-middle" style="text-align:center">Ngày Kết Thúc</th>
                              
                                <th scope="col" colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider update_room--tbody">
                            @if($getUD -> isNotEmpty())
                                @php $count = 1; @endphp
                                @if(count($getUD) > 0)
                                        @foreach ( $getUD as $row )
                                            <tr>
                                                <th scope="row" class="align-middle" style="text-align:justify">{{ $count++ }}</th>                 
                                                <td class="align-middle"style="text-align:center    ;">{{ $row -> id_ud }}</td>
                                                <td class="align-middle"style="text-align:center    ;">{{ $row -> ten_ud }}</td>
                                                <td class="align-middle"style="text-align:center;color: rgb(209, 43, 43); font-weight:bold">{{ $row -> giam }} %</td>
                                                @if($getUdDv -> isNotEmpty())
                                                    {{-- @if(count($getUdDv) > 0 && count($getUdDv) < 2) --}}
                                                        {{-- @foreach ($getUdDv as $dv)
                                                            @if($dv -> id_ud == $row ->id_ud)
                                                            <td class="align-middle"style="text-align: left;">{{$dv -> ten_dv != null ? $dv -> ten_dv : ''}} 
                                                                <form action="" style="float: right;" method="POST">
                                                                    @csrf
                                                                    <button class="stop">Ngừng áp dụng</button>
                                                                </form>
                                                            </td>
                                                            @endif
                                                        @endforeach --}}

                                                    {{-- @else --}}
                                                    <td class="align-middle"style="text-align:center">{{ $row-> sl_ap_dung}}</td>
                                                    <td class="align-middle" style="text-align:left; width: 17rem;">
                                                        @foreach ($getUdDv as $dv)
                                                            @if($dv->id_ud == $row->id_ud)
                                                                <div style="display: flex; margin-bottom: 5px;justify-content: space-between;width: 100%;">
                                                                    <span style="width: 45%">
                                                                        {{ $dv->ten_dv != null ? $dv->ten_dv : '' }}
                                                                    </span>
                                                                    <form action="" method="POST" style="display: inline;width: 50%">
                                                                        @csrf
                                                                        <button class="stop" type="button" onclick="confirmStop('{{ route('admin.stop_applying_dv', [$dv->id_uddv]) }}')">Ngừng áp dụng</button>
                                                                    </form>
                                                                </div>
                                                                @php
                                                                    $ids_dv[] = $dv->id_dv;
                                                                @endphp
                                                            {{-- @else
                                                                <td class="align-middle"style="text-align:center;width: 12rem">Chưa có dữ liệu...</td> --}}
                                                            @endif
                                                            
                                                        @endforeach
                                                    </td>
                                                    
                                                    
                                                    @endif
                                              
                                                <td class="align-middle"style="text-align:center;width:10rem">{{ \Carbon\Carbon::parse($row -> tg_ap_dung)->format('d-m-Y' )}}</td>
                                                <td class="align-middle"style="text-align:center;width:10rem">{{ \Carbon\Carbon::parse($row -> tg_ket_thuc) -> format('d-m-Y') }}</td>
                                               
                                                <td class="align-middle"style="text-align:center; width: 7rem"">
                                                    <div class="form-edit-delete d-flex">
                                                        <form action="{{route('admin.edit_special_offers',[$row ->id_ud])}}" method="POST" class="edit_csvc_form" style="width: 2rem; height: 2rem;">
                                                            @csrf
                                                            @foreach($ids_dv as $id_dv)
                                                                <input type="hidden" name="id_dv[]" value="{{ $id_dv }}">
                                                            @endforeach
                                                            <button type="submit" class="btn btn-dark edit_csvc" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                                                <i class="fa-regular fa-pen-to-square edit_csvc-icon" style="font-size: 0.9rem;"></i>
                                                            </button>
                                                        </form>
                                                        
                                                        <form action="" method="POST" id="delete_csvc_form" onsubmit="return false;">
                                                            @csrf
                                                            <button type="button" class="btn btn-danger delete_csvc" style="width: 2rem; height: 2rem; margin-left: 0.3rem; display: flex; justify-content: center; align-items: center;" onclick="confirmDelete('{{ route('admin.remove_special_offers',[$row -> id_ud])}}')">
                                                                <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.9rem;"></i>
                                                            </button>
                                                        </form> 
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                @else
                                    <tr>
                                        <td colspan ="10" class="align-middle text-center">Chưa có dữ liệu ..</td>
                                    </tr>
                                @endif
                                    

                            @else
                                <tr>
                                    <td colspan ="9" class="align-middle text-center">Chưa có dữ liệu ..</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                  
                </div>

            </div>

            <div class="back_room">
                <a href="{{ route('admin.index')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
            </div>
         
        <script>
            function confirmStop(url){
                Swal.fire({
                    title: 'Xác nhận',
                    text: 'Bạn có chắc chắn muốn ngừng?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#04AA6D',
                    cancelButtonColor: 'rgb(246, 81, 81)',
                    confirmButtonText: 'Ngừng',
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

            function confirmDelete(url){
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