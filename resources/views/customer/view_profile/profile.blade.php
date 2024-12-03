@extends('layouts.customer_home')
@section('view_profile')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('customer/ctm_css/view_profile/profile.css')}}">
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
                    timer: 2300
                });
            </script>
        @endif
        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi xác thực',
                    html: '{!! implode("<br>", $errors->all()) !!}', // Hiển thị tất cả lỗi trên từng dòng
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>
        @endif
        
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <div class="bt-option">
                                <a href="{{ route('customer.index')}}">Trang chủ</a>
                                <span>Xem Hồ Sơ</span>
                            </div>
                            <p></p>
                            {{-- <h4 style="font-weight: bold;font-style:italic;margin-bottom:1.3rem">Chào {{ $user->ho_ten }}</h4> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="" style="margin-bottom: 7rem">
            {{-- @if($user) --}}
              
                <br>
                    <div class="profile_table">
                        <form action="{{ route('customer.edit_profile',[$user->id])}}" method="POST" id="info_ctm">
                            @csrf
                            <div class="div_profile">
                                <label for="ho_ten" class="label_profile">Họ tên</label>
                                <input type="text" class="form-control input_profile" name="ho_ten" id="ho_ten" value="{{ $user->ho_ten }}" readonly>
                                <i class="fa-solid fa-venus-mars"  id ="icon_profile" style="color: 204468"></i>
                            </div>
                            <div class="div_profile">
                                <label for="gioi_tinh" class="label_profile">Giới tính</label>
                                <select class="form-control input_form input_profile" id="gioi_tinh" name="gioi_tinh" disabled>
                                    <option value="0" {{ (old('gioi_tinh') == '0' || (isset($user) && $user->gioi_tinh == '0')) ? 'selected' : '' }}>Nam</option>
                                    <option value="1" {{ (old('gioi_tinh') == '1' || (isset($user) && $user->gioi_tinh == '1')) ? 'selected' : '' }}>Nữ</option>
                                </select>
                                <i class="fa-solid fa-venus-mars"  id ="icon_profile" style="color: 204468"></i>
                            </div>
                            <div class="div_profile">
                                <label for="sdt" class="label_profile">SDT</label>
                                <input type="text" class="form-control input_profile" id="sdt" name="sdt" value="{{ $user->sdt }}" readonly>
                                <i class="fa-solid fa-phone-flip" id ="icon_profile" style="color: rgb(109, 167, 255)"></i>
                            </div>
            
                            <div class="div_profile">
                                <label for="email"  class="label_profile">Email</label>
                                <input type="text" class="form-control input_profile" id="email" name="email" value="{{ $user->email }}" readonly>
                                <i class="fa-regular fa-envelope" id ="icon_profile" style="color: rgb(246, 205, 122)"></i>
                            </div>
            
                            <div class="div_profile">
                                <label for="dia_chi" class="label_profile">Địa chỉ</label>
                                <input type="text" class="form-control input_profile" id="dia_chi" name="dia_chi" value="{{ $user->dia_chi }}" readonly>
                                <i class="fa-solid fa-address-card" id ="icon_profile" style="color: rgb(66, 151, 106)"></i>
                            </div>
                            
                            {{-- <div class="div_profile">
                                <label for="diem_tl"  class="label_profile">Điểm tích lũy</label>
                                <input type="text" class="form-control input_profile" id="diem_tl" value="" readonly>
                                <i class="fa-solid fa-coins" id ="icon_profile" style="color: rgb(198, 84, 109)"></i>
                            </div> --}}
                    
                    </div>
                    <div class="profile-booking_history">
                        <div class="div_see_form">
                            <a href="{{ route('customer.see_form')}}">
            
                                <div class="btn btn-primary see_form">
                                    
                                    Xem lịch sử đơn
                                
                                    <span class="badge badge-light">{{$countFormLogin}}</span>
                                    <span class="sr-only">unread messages</span>
                                </div>
                            </a>
                        </div>

                        {{-- <div class="div_edit_profile">

                            <button type="submit" class="edit_info--button">Chỉnh sửa thông tin</button>
                        </div> --}}
                        <div class="div_edit_profile">
                            <button type="button" id="edit_button" class="edit_info--button">Chỉnh sửa thông tin</button>
                            <button type="submit" id="save_button" class="edit_info--button" style="display:none;">Lưu thông tin</button>
                        </div>
                    </form>
                    </div>
        </div>

        <script>
            document.getElementById('edit_button').addEventListener('click', function() {

                document.querySelectorAll('.input_profile').forEach(input => {
                    input.removeAttribute('readonly');
                });
                document.getElementById('gioi_tinh').removeAttribute('disabled');
                document.getElementById('save_button').style.display = 'inline-block';
                document.getElementById('edit_button').style.display = 'none';
            });

            document.getElementById("info_ctm").addEventListener('submit', function(event){
                        var ho_ten = document.getElementById('ho_ten').value;
                        var sdt = document.getElementById('sdt').value;
                        var  email = document.getElementById('email').value;
                        var dia_chi = document.getElementById('dia_chi').value;

                        if (ho_ten === "" || sdt === "" || email === "" || dia_chi === "") {
                        event.preventDefault(); 

                        Swal.fire({
                                icon: 'error',
                                text: 'Vui lòng không để trống  thông tin',
                                showConfirmButton: false,
                                timer: 2500
                        });

                        }
                
                });
        </script>
    </body>
    </html>
@endsection
