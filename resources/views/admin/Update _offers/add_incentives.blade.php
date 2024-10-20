@extends('layouts.admin_home')
    @section('add_incentives')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/update_offers/add_incentives.css')}}">
    </head>
    <body>
        
    </body>
    </html>
    <script>
        Swal.fire({
            title: "Thêm Ưu Dãi",
            icon: "info",
            html: `
            <style>
                    @import url('https://fonts.cdnfonts.com/css/play');
                    .swal2-background-custom {
                        margin-left : 2rem;
                        font-family: 'Play', sans-serif ;
                    }
                   .list1{
                        justify-content: space-between;
                    }
                    .item1{
                        width:47%;
                    }
                    .item2{
                        width:47%;
                    }
                    .services{
                        display:flex;
                       align-item: center;
                    }
                    .services_label{
                        width: 47%;
                        margin-top : 0.5rem;
                    }
                    .sv_select{
                        width: 100%;
                        height: 5vh;
                        margin-top : 1rem;
                        margin-bottom : 0.9rem;
                        border-radius: 5px;
                    }
                     .sv_select:focus{
                      
                         border-color: rgb(37, 164, 249);
                          outline: none;
                    }

                    .form-control {
                        margin-top:0.2rem;
                        margin-bottom:0.5rem;
                        text-align: center;
                        height:4vh;
                    }
                    .label_form{
                        margin-top:0.5rem;
                    }
    
                    .room--tools{
                        margin-top:0.4rem;
                        justify-content: space-between;
                        
                    }
       
            </style>
            @if (Session::has('error'))
                <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
            @endif

        <form class="room_registraion--form" id="add_room--form" action="{{ route('admin.insert_incentives')}}" method="POST">
            @csrf

            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                        <label for="ten_ud" class="label_form">Tên Ưu Đãi <span style="color:rgb(239, 80, 80)">*</span></label>
                        <input type="text" class="form-control " id="ten_ud" name="ten_ud" value="{{old('ten_ud')}}" >
                </div>
    
                <div class="form-group col-md-2 item2">
                        <label for="giam" class="label_form">Giảm<span style="color:rgb(239, 80, 80)">*</span></label>
                        <input type="text" class="form-control input_form" id="giam" name="giam" value="{{old('giam')}}" >
                </div>
            </div>

         
             <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                        <label for="ngay_ap_dung" class="label_form">Ngày Áp Dụng<span style="color:rgb(239, 80, 80)">*</span></label>
                        <input type="date" class="form-control " id="ngay_ap_dung" name="ngay_ap_dung" value="{{old('ngay_ap_dung')}}" >
                </div>
    
                <div class="form-group col-md-2 item2">
                        <label for="ngay_ket_thuc" class="label_form">Ngày Kết Thúc<span style="color:rgb(239, 80, 80)">*</span></label>
                        <input type="date" class="form-control input_form" id="ngay_ket_thuc" name="ngay_ket_thuc" value="{{old('ngay_ket_thuc')}}" >
                </div>
            </div>

            <div class="form-row d-flex list1">
                <div class="form-group col-md-2 item1" style="margin-top: 0.5rem;">
                   <div class="updated_form--input">
                      @if($services -> isNotEmpty())
                         <p>Chọn dịch vụ áp dụng :</p>
                            @foreach ($services as $sv)
                                <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="id_dv[]" id="checkbox1_{{ $sv->id_dv }}" value="{{ $sv->id_dv }}">
                                        <label class="form-check-label" for="checkbox_{{ $sv->id_dv }}">
                                                        {{ $sv->ten_dv }} 
                                        </label>
                                </div>
                            @endforeach
                       @else
                           <p>Chưa có dữ liệu ..</p>
                       @endif
                   </div>
                </div>
                    <div class="form-group col-md-2 item2">
                        <label for="sl_ap_dung" class="label_form">SL Áp Dụng<span style="color:rgb(239, 80, 80)">*</span></label>
                        <input type="text" class="form-control input_form" id="sl_ap_dung" name="sl_ap_dung" value="{{old('sl_ap_dung')}}" >
                </div>
            </div>

                
            <div class="room--tools d-flex">
                <button  button type="submit" class="btn btn-primary save_room--button" name="register">
                    <i class="fa-regular fa-floppy-disk" style ="font-size: 1rem"></i>
                </button>
            
            <div class="back_room--button">
                    <a href="{{ route('admin.special_offers') }}"><i class="fa-solid fa-rotate-left" style ="color :white; margin-top: 0.7rem; font-size: 1rem"></i></a>
            </div>
        </div>

            
        `,

            showConfirmButton: false,
            customClass: {
                popup: 'swal2-background-custom',
                container: 'swal2-borderless'
            },
            background: 'rgb(48, 84, 126)',
            color: 'white',
        });

        document.getElementById("add_room--form").addEventListener("submit", function(event) {
                var ten_ud = document.getElementById('ten_ud').value;
                var giam = document.getElementById('giam').value;
                var ngay_ap_dung = document.getElementById('ngay_ap_dung').value;
                var ngay_ket_thuc = document.getElementById('ngay_ket_thuc').value;
                var sl_ap_dung = document.getElementById('sl_ap_dung').value;

                if (ten_ud === "" || giam === "" || ngay_ap_dung === "" || ngay_ket_thuc === "" || sl_ap_dung === "") {
                    event.preventDefault(); 
                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại!',
                        text: 'Vui lòng không để trống thông tin yêu cầu',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 2300)
                }
        });

    
    </script>
    @endsection