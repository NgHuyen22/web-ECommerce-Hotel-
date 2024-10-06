
    @extends('layouts.customer_home')
    @section('insert_profile')
            
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="{{asset('customer/ctm_css/booking_room/insert_profile.css')}}">
            </head>
            <body>
            {{-- <script>
                Swal.fire({
                    title: "Điền thông tin cá nhân",
                    icon: "info",
                    html: `
                    <style>
                    
                    .swal2-background-custom {
                            margin-left : 2rem ;
                        }
                        .list1{
                            justify-content: space-between;
                        }
                        .item1{
                            width:46%;
                        }
                        .item2{
                            width:50%;
                        }
                        
                        .form-control {
                            margin-top:0.2rem;
                            margin-bottom:0.5rem;
                            text-align: center;
                         
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
                        .gender{
                            margin-top: 2.6rem;
                        }
                        .address{
                            width: 100%;
                        }
                    </style>
                    @if (Session::has('error'))
                        <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
        
                <form class="insert_profile--form" id="add_room--form" action="{{ route('customer.save_profile') }}" method="POST">
                    @csrf
                    <div class="form-row d-flex list1" >
                        <div class="form-group item1">
                                <label for="ho_ten" class="label_form">Họ Tên</label>
                                <input type="text" class="form-control " id="ho_ten" name="ho_ten" value="{{ old('ho_ten') }}" >
                        </div>
        
                        <div class="form-group item2">
                                 <select class="form-control input_form gender" id="gioi_tinh" name="gioi_tinh">
                                      <option value="" disabled selected hidden style="color: rgb(180, 179, 179);">Chọn giới tính</option>
                                      <option value="0" {{ old('gioi_tinh') == '0' ? 'selected' : '' }}>Nam</option>
                                      <option value="1" {{ old('gioi_tinh') == '1' ? 'selected' : '' }}>Nữ</option>
                                </select>
                        </div>
                    </div>
        
                    <div class="form-row d-flex list1" >
                            <div class="form-group item1">
                                <label for="sdt" class="label_form">SDT</label>
                                <input type="text" class="form-control input_form" id="sdt" name="sdt" value="{{ old('sdt') }}" >
                            </div>
        
                            <div class="form-group item2">
                                <label for="email" class="label_form">Email</label>
                                <input type="text" class="form-control input_form" id="email" name="email" value="{{ old('email') }}" >
                            </div>
                    </div>
        
                    <div class="form-row d-flex list1" >
                            <div class="form-group address">
                                <label for="dia_chi" class="label_form">Địa Chỉ</label>
                                <textarea type="text" class="form-control" id="dia_chi" name="dia_chi" value="{{ old('dia_chi') }}" ></textarea>
                            </div>
                                
                    </div>
                    <div>
                        <input type="hidden" name="ngayNhan" value="{{ session('ngayNhan') }}">
                        <input type="hidden" name="ngayTra" value="{{ session('ngayTra') }}">
                        <input type="hidden" name="soNgay" value="{{ session('soNgay') }}">
                        <input type="hidden" name="note" value="{{ session('note') }}">
                        <input type="hidden" name="id_rt" value="{{ session('id_rt') }}">
                        <input type="hidden" name="sl" value="{{ session('so_luong') }}">
                    </div>
                    <div class="room--tools d-flex">
                        <button  button type="submit" class="btn btn-primary save_room--button" name="register">
                            <i class="fa-regular fa-floppy-disk" style ="font-size: 1rem"></i>
                        </button>
                    
                    <div class="back_room--button">
                            <a href="{{ url() -> previous() }}"><i class="fa-solid fa-rotate-left" style ="color :white; margin-top: 0.5rem; font-size: 1rem"></i></a>
                    </div>
                </div>
        
                    
                `,
        
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal2-background-custom',
                        container: 'swal2-borderless't
                    },
                    background: 'rgb(48, 84, 126)',
                    color: 'white',
                });
        
                document.getElementById("insert_profile--form").addEventListener("submit", function(event) {
                        var ho_ten = document.getElementById('ho_ten').value;
                        var gioi_tinh = document.getElementById('gioi_tinh').value;
                        var sdt = document.getElementById('sdt').value;
                        var email = document.getElementById('email').value;
                        var dia_chi = document.getElementById('dia_chi').value;
        
                        if (ho_ten === "" || gioi_tinh === "Chọn giới tính" || sdt === "" || email === "" || dia_chi === "") {
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
        
            
            </script> --}}
            <script>
                // Tạo thông báo SweetAlert
                Swal.fire({
                    title: "Điền thông tin cá nhân",
                    icon: "info",
                    html: `
                    <style>
                        .swal2-background-custom {
                            margin-left: 2rem;
                        }
                        .list1 {
                            justify-content: space-between;
                        }
                        .item1 {
                            width: 46%;
                        }
                        .item2 {
                            width: 50%;
                        }
                        .form-control {
                            margin-top: 0.2rem;
                            margin-bottom: 0.5rem;
                            text-align: center;
                        }
                        .label_form {
                            margin-top: 0.5rem;
                        }
                        .room--tools {
                            margin-top: 0.4rem;
                            justify-content: space-between;
                        }
                        .back {
                            width: 15%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background-color: rgb(255, 71, 71);
                            border-radius: 0.5rem;
                        }
                        .back a {
                            color: white;
                        }
                        .gender {
                            margin-top: 2.6rem;
                        }
                        .address {
                            width: 100%;
                        }
                    </style>
                    <form id="insert_profile--form" class="insert_profile--form" action="{{ route('customer.save_profile') }}" method="POST">
                        @csrf
                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="ho_ten" class="label_form">Họ Tên</label>
                                <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="{{ old('ho_ten') }}" />
                            </div>
                            <div class="form-group item2">
                                <select class="form-control input_form gender" id="gioi_tinh" name="gioi_tinh">
                                    <option value="" disabled selected hidden style="color: rgb(180, 179, 179);">Chọn giới tính</option>
                                    <option value="0" {{ old('gioi_tinh') == '0' ? 'selected' : '' }}>Nam</option>
                                    <option value="1" {{ old('gioi_tinh') == '1' ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="sdt" class="label_form">SDT</label>
                                <input type="text" class="form-control input_form" id="sdt" name="sdt" value="{{ old('sdt') }}" />
                            </div>
                            <div class="form-group item2">
                                <label for="email" class="label_form">Email</label>
                                <input type="text" class="form-control input_form" id="email" name="email" value="{{ old('email') }}" />
                            </div>
                        </div>
                        <div class="form-row d-flex list1">
                            <div class="form-group address">
                                <label for="dia_chi" class="label_form">Địa Chỉ</label>
                                <textarea class="form-control" id="dia_chi" name="dia_chi">{{ old('dia_chi') }}</textarea>
                            </div>
                        </div>
                        <!-- Hidden inputs for session values -->
                        <div>
                            <input type="hidden" name="ngayNhan" value="{{ session('ngayNhan') }}">
                            <input type="hidden" name="ngayTra" value="{{ session('ngayTra') }}">
                            <input type="hidden" name="soNgay" value="{{ session('soNgay') }}">
                            <input type="hidden" name="note" value="{{ session('note') }}">
                            <input type="hidden" name="id_rt" value="{{ session('id_rt') }}">
                            <input type="hidden" name="sl" value="{{ session('so_luong') }}">
                        </div>
                        <div class="room--tools d-flex">
                            <button type="submit" class="btn btn-primary save_room--button" name="register">
                                <i class="fa-regular fa-floppy-disk" style="font-size: 1rem"></i>
                            </button>
                            <div class="back_room--button">
                                <a href="{{ url()->previous() }}">
                                    <i class="fa-solid fa-rotate-left" style="color: white; margin-top: 0.5rem; font-size: 1rem"></i>
                                </a>
                            </div>
                        </div>
                    </form>`,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal2-background-custom',
                        container: 'swal2-borderless',
                    },
                    background: 'rgb(48, 84, 126)',
                    color: 'white',
                });
            
                // Xử lý submit form
                document.getElementById("insert_profile--form").addEventListener("submit", function (event) {
                    var ho_ten = document.getElementById('ho_ten').value;
                    var gioi_tinh = document.getElementById('gioi_tinh').value;
                    var sdt = document.getElementById('sdt').value;
                    var email = document.getElementById('email').value;
                    var dia_chi = document.getElementById('dia_chi').value;
            
                    // Kiểm tra các trường không được để trống
                    if (ho_ten === "" || gioi_tinh === "" || sdt === "" || email === "" || dia_chi === "") {
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
