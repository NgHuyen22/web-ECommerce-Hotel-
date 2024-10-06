@extends('layouts.customer_home')
    @section('confirmBF')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
        </head>
        <body>
            <script>
                // Tạo thông báo SweetAlert
                Swal.fire({
                    title: "Xác nhận thông tin đặt phòng",
                    icon: "info",
                    html: `
                    <style>
                        .swal2-background-custom {
                            margin-left: 2rem;
                        }
                       
                    </style>
                    <form id="confirmBF_form" class="confirmBF_form" action="" method="POST">
                        @csrf
                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="ho_ten" class="label_form">Họ Tên</label>
                                <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="{{ $getUser ->ho_ten }}" />
                                </div>
                                <div class="form-group item2">
                                    
                                    <label for="gioi_tinh" class="label_form">Giới Tính</label>
                                    <input type="text" class="form-control" id="gioi_tinh" name="gioi_tinh" value="{{ $getUser -> gioi_tinh}}" />
                            </div>
                        </div>
                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="sdt" class="label_form">SDT</label>
                                <input type="text" class="form-control input_form" id="sdt" name="sdt" value="{{ $getUser -> sdt }}" />
                            </div>
                            <div class="form-group item2">
                                <label for="email" class="label_form">Email</label>
                                <input type="text" class="form-control input_form" id="email" name="email" value="{{  $getUser -> email }}" />
                            </div>
                        </div>

                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="ngay_nhan_phong" class="label_form">Ngày Nhận Phòng</label>
                                <input type="text" class="form-control input_form" id="ngay_nhan_phong" name="ngay_nhan_phong" value="{{  $ngay_nhan_phong }}" />
                            </div>
                            <div class="form-group item2">
                                <label for="ngay_tra_phong" class="label_form">Ngày Trả Phòng</label>
                                <input type="text" class="form-control input_form" id="ngay_tra_phong" name="ngay_tra_phong" value="{{ $ngay_tra_phong }}" />
                            </div>
                        </div>

                        <div class="form-row d-flex list1">
                            <div class="form-group item1">
                                <label for="ghi_chu" class="label_form">Ghi Chú</label>
                                <input type="text" class="form-control input_form" id="ghi_chu" name="ghi_chu" value="{{ $ghi_chu }}" />
                            </div>
                            <div class="form-group item2">
                                <label for="so_luong" class="label_form">Số Lượng</label>
                                <input type="text" class="form-control input_form" id="so_luong" name="so_luong" value="{{ $sl }}" />
                            </div>
                        </div>

                        <div class="room--tools d-flex">
                            <button type="submit" class="btn btn-primary confirm_button" name="">
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
            
            </script>
        </body>
        </html>
    @endsection