@extends('layouts.admin_home')
    @section('add_sv')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            {{-- <link rel="stylesheet" href="style.css"> --}}
        </head>
        <body>
            <script>
                Swal.fire({
                    title: "Thêm Loại Dịch Vụ",
                    icon: "info",
                    html: `
                    <style>
                    
                    .swal2-background-custom {
                            margin-left : 2rem;
                            border: 2px solid black; 
                            border-radius: 1rem; 
                            
                        }
                        .list1{
                            justify-content: space-between;
                        }
                        
                        .list1_item{
                            width : 100%;
                        }
                        .item1{
                            width: 47%;
    
                        }
                        .item2{
                            width: 47%;
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
                        .tt_dv{
                            height: 5.2vh;
                        }
                    
                    </style>
                    @if (Session::has('error'))
                        <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
    
                <form class="add_ldv_form" id="add_room--form" action="{{ route('admin.insert_dv', [$id_ldv])}}" method="POST">
                    @csrf
                  
                    <div class="form-row d-flex list1" >
                        <div class="form-group col-md-2 item1">
                                <label for="ten_dv" class="label_form">Tên  DV</label>
                                <input type="text" class="form-control tt_dv " id="ten_dv" name="ten_dv" value="{{old('ten_dv')}}" >
                        </div>
    
                        <div class="form-group col-md-2 item2">
                                 <label for="mo_ta_dv" class="label_form">Mô Tả : </label>
                                <textarea type="text" class="form-control" id="mo_ta_dv" name="mo_ta_dv"  value="{{old('mo_ta_dv')}}"></textarea>
                        </div>
                    </div>

                    <div class="form-row d-flex list1" >
                        <div class="form-group col-md-2 item1">
                                <label for="don_gia_dv" class="label_form">Đơn Giá : </label>
                                <input type="text" class="form-control tt_dv" id="don_gia_dv" name="don_gia_dv" value="{{old('don_gia_dv')}}" >
                        </div>
    
                        <div class="form-group col-md-2 item2">
                                 <label for="menu" class="label_form">Menu / Options : </label>
                                <textarea type="text" class="form-control" id="menu" name="menu"  value="{{old('menu')}}"></textarea>
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