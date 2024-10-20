@extends('layouts.admin_home')
    @section('accept_bill')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('admin/ad_css/bill_management/accept_bill.css')}}">
        </head>
        <body>
            <script>
                Swal.fire({
                    title: "Xác Nhận Thanh Toán",
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

                    </style>
                    @if (Session::has('error'))
                        <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
    
                <form class="add_ldv_form" id="add_room--form" action="{{route('admin.updated_bill',[$id_hd])}}" method="POST">
                    @csrf
                    @method('POST')
                    <label for="pttt" class="label_form">Phương Thức Thanh Toán : </label>
                    <select class="sv_select" style="text-align:center" id="pttt" name="pttt">
                        <option value=""  selected hidden>Chọn Phương Thức</option>
                        <option value="0">Chuyển Khoản</option>
                        <option value="1">Tiền Mặt</option>
                    </select>

                    <div class="form-row d-flex list1" >
                        <div class="form-group col-md-2 item1">
                                <label for="tien_kh_gui" class="label_form">Tiền Khách Gửi : </label>
                                <input type="text" class="form-control " id="tien_kh_gui" name="tien_kh_gui" value="{{old('tien_kh_gui')}}" >
                        </div>
            
                        <div class="form-group col-md-2 item2">
                                <label for="tien_thua" class="label_form">Tiền Thừa</label>
                                <input type="text" class="form-control input_form" id="tien_thua" name="tien_thua" value="{{old('tien_thua')}}" >
                        </div>
                    </div>
    
                
                    <div class="room--tools d-flex">
                        <button  button type="submit" class="btn btn-primary save_room--button" name="register">
                            <i class="fa-regular fa-floppy-disk" style ="font-size: 1rem"></i>
                        </button>
                    
                    <div class="back_room--button">
                            <a href="{{ route('admin.bill_index') }}"><i class="fa-solid fa-rotate-left" style ="color :white; margin-top: 0.7rem; font-size: 1rem"></i></a>
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
            </script>
            <script>
                     document.getElementById('pttt').addEventListener('change', function() {
                        var pttt = this.value;
                        var tienKhGui = document.getElementById('tien_kh_gui');
                        var tienThua = document.getElementById('tien_thua');

                        if(pttt === "0"){
                            
                                tienKhGui.disabled = true;
                                tienThua.disabled = true;
                                tienKhGui.value = ''; 
                                tienThua.value = ''; 
                            }
                            else if(pttt === "1") {
                            
                                tienKhGui.disabled = false;
                                tienThua.disabled = false;
                        }
                    });
            </script>
            
        </body>
        </html>
    @endsection