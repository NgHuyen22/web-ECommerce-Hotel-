
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
    @section('add_roomType')
        <script>
            Swal.fire({
                title: "Thêm Loại Phòng",
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
                   
                </style>
                @if (Session::has('error'))
                    <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
                @endif
    
            <form class="room_registraion--form" id="add_room--form" action="{{ route('admin.save_room') }}" method="POST" >
                @csrf
                <div class="form-row d-flex list1" >
                    <div class="form-group col-md-2 item1">
                            <label for="ten_lp" class="label_form">Tên Loại Phòng</label>
                            <input type="text" class="form-control " id="ten_lp" name="ten_lp" value="{{old('ten_lp')}}" >
                    </div>
    
                    <div class="form-group col-md-2 item2">
                            <label for="gia_lp" class="label_form">Giá</label>
                            <input type="text" class="form-control input_form" id="gia_lp" name="gia_lp" value="{{old('gia_lp')}}" >
                    </div>
                </div>
    
                <div class="form-row d-flex list1" >
                        <div class="form-group col-md-2 item1">
                            <label for="mo_ta" class="label_form">Mô Tả</label>
                            <input type="text" class="form-control input_form" id="mo_ta" name="mo_ta" value="{{old('mo_ta')}}" >
                        </div>
    
                        <div class="form-group col-md-2 item2">
                            <label for="tien_nghi" class="label_form">Tiện Nghi</label>
                            <input type="text" class="form-control input_form" id="tien_nghi" name="tien_nghi" value="{{old('tien_nghi')}}" >
                        </div>
                </div>
    
                <div class="form-row d-flex list1" >
                        <div class="form-group col-md-2 item1">
                            <label for="suc_chua" class="label_form">Sức Chứa</label>
                            <input type="text" class="form-control input_form" id="suc_chua" name="suc_chua" value="{{old('suc_chua')}}" >
                        </div>
    
                        <div class="form-group col-md-2 item2">
                            <label for="dien_tich" class="label_form">Diện Tích</label>
                            <input type="text" class="form-control input_form" id="dien_tich" name="dien_tich" value="{{old('dien_tich')}}" >
                        </div>
                </div>
                <div class="form-row d-flex list1" >
                        <div class="form-group col-md-2 item1">
                            <label for="phan_hang" class="label_form">Hạng mục</label>
                            <input type="text" class="form-control input_form" id="phan_hang" name="phan_hang" value="{{old('phan_hang')}}" >
                        </div>
                </div>
    
                <div class="room--tools d-flex">
                    <button  button type="submit" class="btn btn-primary save_room--button" name="register">
                        <i class="fa-regular fa-floppy-disk" style ="font-size: 1rem"></i>
                    </button>
                
                <div class="back_room--button">
                        <a href="{{ route('admin.update_room') }}"><i class="fa-solid fa-rotate-left" style ="color :white; margin-top: 0.7rem; font-size: 1rem"></i></a>
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
                    var ten_lp = document.getElementById('ten_lp').value;
                    var gia_lp = document.getElementById('gia_lp').value;
                    var mo_ta = document.getElementById('mo_ta').value;
                    var tien_nghi = document.getElementById('tien_nghi').value;
                    var suc_chua = document.getElementById('suc_chua').value;
                    var dien_tich = document.getElementById('dien_tich').value;
                    var phan_hang = document.getElementById('phan_hang').value;
    
                    if (ten_lp === "" || gia_lp === "" || mo_ta === "" || tien_nghi === "" || suc_chua === "" || dien_tich === "" || phan_hang ==="") {
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
