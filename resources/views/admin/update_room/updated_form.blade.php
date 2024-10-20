@extends('layouts.admin_home')
    @section('updated_form')
        <!DOCTYPE html>
        <html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">

                <link rel="stylesheet" href="{{asset('admin/ad_css/update_room/updated_form.css')}}">
        </head>

        <body>
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

        @if($room_type != null)
                <form action="{{ route('admin.updated') }}" method="POST" class="updated_form" id="updated_form">
                        @csrf
                        <div class="form-group label_input">
                                <label for="id_lp" class="updated_form--label" id="id_lp--label">ID: </label>
                                <input type="text" class="form-control updated_form--input" id="id_lp" name ="id_lp" placeholder="" value="{{ $room_type -> id_lp}}" readonly>
                        </div>

                        <div class="form-group label_input">
                                <label for="ten_lp" class="updated_form--label">Tên Loại Phòng : <span style="color:red">*</span> </label>
                                <input type="text" class="form-control updated_form--input" id="ten_lp" name ="ten_lp" placeholder="" value="{{ $room_type -> ten_lp}}" >
                        </div>
                
                        <div class="form-group label_input">
                                <label for="gia_lp" class="updated_form--label">Giá : <span style="color:red">*</span> </label>
                                <div class="updated_form--input1">
                                        <input type="text" class="form-control input_item" id="gia_lp" name ="gia_lp"  placeholder="" value="{{ number_format($room_type -> gia_lp, 0, ',' , '.' )}}" >
                                        <span class="input-group-text percent">VND</span>
                                    </div>
                           
                        </div>

                        <div class="form-group label_input">
                                <label for="mo_ta" class="updated_form--label">Mô Tả : <span style="color:red">*</span> </label>
                                {{-- <input type="text" class="form-control" id="mo_ta"  name ="mo_ta" placeholder="" value="{{ $room_type -> mo_ta}}" > --}}
                                <textarea class="form-control updated_form--input" aria-label="With textarea"  id="mo_ta"  name ="mo_ta">{{ $room_type->mo_ta }}</textarea>
                        </div>

                        <div class="form-group label_input">
                                <label for="tien_nghi" class="updated_form--label">Tiện Nghi : <span style="color:red">*</span> </label>
                                <input type="text" class="form-control updated_form--input" id="tien_nghi" name ="tien_nghi" placeholder="" value="{{ $room_type -> tien_nghi }}" >
                        </div>

                        <div class="form-group label_input">
                                <label for="suc_chua" class="updated_form--label">Sức Chứa : <span style="color:red">*</span> </label>
                                <input type="text" class="form-control updated_form--input" id="suc_chua" name ="suc_chua" placeholder="" value="{{ $room_type -> suc_chua}}" >
                        </div>

                        <div class="form-group label_input">
                                <label for="dien_tich" class="updated_form--label">Diện Tích : <span style="color:red">*</span> </label>
                                <input type="text" class="form-control updated_form--input" id="dien_tich" name ="dien_tich" placeholder="" value="{{ $room_type -> dien_tich}}" >
                        </div>

                        <div class="updated_form--tools">
                                <button  type="submit" class="btn btn-primary updated_button" name="updated_button"><i class="fa-regular fa-floppy-disk" style="font-size: 1rem"></i></button>
                
                                {{-- <div class="back_room">
                                                <a href="{{ route('admin.update_room') }}"><i class="fa-solid fa-arrow-left" style="color: rgb(221, 72, 72);"></i></a>
                                </div> --}}
                        </div>
                </form>
        @endif
        
        <div class="back_room">
                <a href="{{ route('admin.update_room')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
        </div>

        <script>
                document.getElementById("updated_form").addEventListener('submit', function(event){
                        var ten_lp = document.getElementById('ten_lp').value;
                        var gia_lp = document.getElementById('gia_lp').value;
                        var mo_ta = document.getElementById('mo_ta').value;
                        var tien_nghi = document.getElementById('tien_nghi').value;
                        var suc_chua = document.getElementById('suc_chua').value;
                        var dien_tich = document.getElementById('dien_tich').value;

                        if (ten_lp === "" || gia_lp === "" || mo_ta === "" || tien_nghi === "" || suc_chua === "" || dien_tich === "") {
                        event.preventDefault(); // Ngăn form gửi đi khi dữ liệu không hợp lệ

                        Swal.fire({
                                icon: 'error',
                                // title: 'Thất bại !!',
                                text: 'Vui lòng không để trống  thông tin yêu cầu.',
                                showConfirmButton: false,
                                timer: 2500
                        });

                        }
                
                });
        </script>
   
                   
        </body>
        </html>
    @endsection