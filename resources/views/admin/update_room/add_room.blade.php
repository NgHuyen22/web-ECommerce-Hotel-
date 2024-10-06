
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('admin/ad_css/update_room/add_roomType.css')}}">
</head>
<body>
    @extends('layouts.admin_home')
    @section('add_room')
       
            <script>
                Swal.fire({
                    title: "Thêm Phòng",
                    icon: "info",
                    html: `
                    <style>
                    
                    .swal2-background-custom {
                            margin-left : 2rem;
                        }
                        .list1{
                            justify-content: space-between;
                        }
                        .item1{
                            width:40%;
                            
                        }
                        .item2{
                            width:53%;
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
                        .back{
                        width:15%;
                        display:flex;
                        align-items: center;
                        justify-content: center;
                        background-color:rgb(255, 71, 71);
                        border-radius: 0.5rem;
                        
                        }
                        .back a{
                            color:white;
                        }
                        
                    .label-input-wrapper{
                            width: 100%;
                        display: flex;
                            justify-content: center; 
                    }
                    </style>
                    @if (Session::has('error'))
                        <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
        
                <form class="room_registraion--form" id="add_room--form" action="" method="POST">
                    @csrf

                <div div class="label-input-wrapper">
                    
                        <div class="form-group col-md-2 item1">
                                <label for="so_phong" class="label_form">Nhập Số Phòng</label>
                                <input type="text" class="form-control " id="so_phong" name="so_phong" value="" >
                        </div>
                         <input type="hidden" name="id_rt" value="{{ $id_rt != null ? $id_rt : '' }}">
                    </div>

        

        
            
        
                        
                    <div class="room--tools d-flex">
                        <button  button type="submit" class="btn btn-primary save_room--button" name="register">
                            <i class="fa-regular fa-floppy-disk" style ="font-size: 1rem"></i>
                        </button>
                    
                    <div class="back_room--button">
                            <a href="{{ route('admin.update_room') }}"><i class="fa-solid fa-rotate-left" style ="color :white; margin-top: 0.5rem; font-size: 1rem"></i></a>
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
                        var ten_lp = document.getElementById('ten_lp').value;
                        var gia_lp = document.getElementById('gia_lp').value;
                        var mo_ta = document.getElementById('mo_ta').value;
                        var tien_nghi = document.getElementById('tien_nghi').value;
                        var suc_chua = document.getElementById('suc_chua').value;
                        var dien_tich = document.getElementById('dien_tich').value;
        
                        if (ten_lp === "" || gia_lp === "" || mo_ta === "" || tien_nghi === "" || suc_chua === "" || dien_tich === "") {
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
                        // else{
        
                        //     Swal.fire({
                        //     icon: 'success',
                        //     title: 'Thành công !!',
                        //     text: 'Cập nhật thành công.',
                        //     showConfirmButton: false,
                        //     timer: 2500
                        //     });
        
                        //     }
                });
        
            
            </script>
    @endsection
    
</body>
</html>
