@extends('layouts.admin_home')
    @section('add_ldv')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/service_management/add_ldv.css')}}">
    </head>
    <body>
        <script>
            Swal.fire({
                title: "Thêm Loại Dịch Vụ",
                icon: "info",
                html: `
                <style>
                   @import url('https://fonts.cdnfonts.com/css/play');
                    .swal2-background-custom {
                            margin-left : 2rem;
                            border: 2px solid black; 
                            border-radius: 1rem; 
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
                    #ten_ldv{
                        height: 5.2vh;
                    }
                
                </style>
                @if (Session::has('error'))
                    <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
                @endif

            <form class="add_ldv_form" id="add_room--form" action="{{route('admin.insert_ldv')}}" method="POST">
                @csrf
                <div class="form-row d-flex list1" >
                    <div class="form-group col-md-2 item1">
                            <label for="ten_ldv" class="label_form">Tên Loại DV</label>
                            <input type="text" class="form-control " id="ten_ldv" name="ten_ldv" value="{{old('ten_ldv')}}" >
                    </div>

                    <div class="form-group col-md-2 item2">
                            <label for="mo_ta_ldv" class="label_form">Mô Tả</label>
                            <textarea type="text" class="form-control" id="mo_ta_ldv" name="mo_ta_ldv"  value="{{old('mo_ta_ldv')}}"></textarea>
                    </div>
                </div>

            
                <div class="room--tools d-flex">
                    <button  button type="submit" class="btn btn-primary save_room--button" name="register">
                        <i class="fa-regular fa-floppy-disk" style ="font-size: 1rem"></i>
                    </button>
                
                <div class="back_room--button">
                        <a href="{{ route('admin.service_type') }}"><i class="fa-solid fa-rotate-left" style ="color :white; margin-top: 0.7rem; font-size: 1rem"></i></a>
                </div>
            </div>

                
            `,

                showConfirmButton: false,
                customClass: {
                    popup: 'swal2-background-custom',
                    container: 'swal2-borderless'
                },
                // background: 'rgb(48, 84, 126)',
                background: 'rgb(48, 84, 126)',
                color: 'white',
            });

            document.getElementById("add_room--form").addEventListener("submit", function(event) {
                    var ten_ldv = document.getElementById('ten_ldv').value;
                    var mo_ta = document.getElementById('mo_ta_ldv').value;
                

                    if (ten_ldv === "" || mo_ta === "") {
                        event.preventDefault(); 
                        Swal.fire({
                            icon: 'error',
                            title: 'Thất bại!',
                            text: 'Vui lòng không để trống bất kỳ thông tin nào.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 2300)
                    }
            });

        
        </script>
        
    </body>
    </html>
    @endsection