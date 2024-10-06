@extends('layouts.admin_home')
    @section('services')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/service_management/service_type.css')}}">
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
        
        <a href="{{ route('admin.add_ldv') }}" class="add_room--wrapper" >
            <i class="fa-solid fa-plus add_room--icon" style="color: #ca1c50; cursor: pointer; font-size:1.2rem; margin-top : 0.5rem"></i>
        </a>

        @if(!$getService -> isEmpty())
            @foreach ($getService as $sv)
                <div class="service_type">
                        <div class="accordion" id="accordionExample-{{ $sv->id_ldv }}">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="heading-{{ $sv->id_ldv }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $sv->id_ldv }}" aria-expanded="true" aria-controls="collapse-{{ $sv->id_ldv }}">
                                    {{ $sv -> ten_ldv}}
                                </button>
                              </h2>
        
                              <div id="collapse-{{ $sv->id_ldv }}" class="accordion-collapse collapse show" aria-labelledby="heading-{{ $sv->id_ldv }}" data-bs-parent="#accordionExample-{{ $sv->id_ldv }}">
                                <div class="accordion-body">
                                    
                                    <p>{{ $sv -> mo_ta_ldv}}</p>
                                <div class="sm_tool_text">
                                    <div class="sm_tool">
                                        <div>
                                            <form action="{{ route('admin.getServices',[$sv -> id_ldv])}}" method="POST" class="edit_csvc_form" >
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id_ldv" id="" value="{{ $sv -> id_ldv}}">
                                                <button type="submit" class="btn btn-success">Dịch vụ</button>
                                            </form>
                                        </div>

                                        <div>
                                            <form action="{{ route('admin.edit_svt', [$sv -> id_ldv])}}" method="POST" class="edit_csvc_form" style="width: 3rem; height: 2rem;">
                                                @csrf
                                                    <input type="hidden" name="id_ldv" id="" value="{{ $sv -> id_ldv}}">
                                                    <input type="hidden" name="ten_ldv" id="" value="{{ $sv -> ten_ldv}}">
                                                    <input type="hidden" name="mo_ta_ldv" id="" value="{{ $sv -> mo_ta_ldv}}">
                                                    <input type="hidden" name="created_at" id="" value="{{ $sv -> created_at}}">
                                                    <input type="hidden" name="updated_at" id="" value="{{ $sv -> updated_at}}">
                                                <button type="submit" class="btn btn-dark edit_csvc" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                                    <i class="fa-regular fa-pen-to-square edit_csvc-icon" style="font-size: 0.85rem;"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div>
                                            <form action="" method="GET" id="delete_csvc_form" onsubmit="return false;"style="width: 3rem; height: 2rem;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger delete_csvc" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;"  onclick="confirmDelete('{{ route('admin.delete_svt',[$sv -> id_ldv])}}')">
                                                    <i class="fa-regular fa-trash-can delete_csvc-icon" style="font-size: 0.85rem;"></i>
                                                </button>
                                                <input type="hidden" name="ma_csvc" value="">
                                            </form>
                                        </div>

                                    </div>
                                    <div class="sm_text">
                                            <p style="font-size: 0.9rem;font-style:italic;margin-top:0.7rem">{{ $sv->created_at}}</p>
                                            <p style="font-size: 0.9rem;font-style:italic;margin-top:0.7rem">{{ $sv->updated_at}}</p>
                                    </div>
                                </div>
                              

                                </div>
                              </div>
                            </div>
                        </div>
                </div>
            @endforeach
        @else
                <p style="margin-top:2rem;margin-left: 4rem">Chưa có dữ liệu...</p>
        @endif

        <div class="back_room">
            <a href="{{ route('admin.service_management')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
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