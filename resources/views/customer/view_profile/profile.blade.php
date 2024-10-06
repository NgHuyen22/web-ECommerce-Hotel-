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
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h4 style="font-weight: bold;font-style:italic;margin-bottom:1.3rem">Chào {{ $user->ho_ten }}</h4>
                            <div class="bt-option">
                                <a href="{{ route('customer.index')}}">Trang chủ</a>
                                <span>Xem Hồ Sơ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="" style="margin-bottom: 7rem">
            {{-- @if($user) --}}
              
                <br>
                    <div class="profile_table">
                        <form action="#">
                        
                            <div class="div_profile">
                                <label for="gioi_tinh" class="label_profile">Giới tính</label>
                                <input type="text" class="form-control input_profile" name="gioi_tinh" id="gioi_tinh" value="{{ $user->gioi_tinh == 1 ? 'Nữ' : 'Nam' }}" readonly>
                                <i class="fa-solid fa-venus-mars"  id ="icon_profile" style="color: 204468"></i>
                            </div>
                            <div class="div_profile">
                                <label for="sdt" class="label_profile">SDT</label>
                                <input type="text" class="form-control input_profile" id="sdt" value="{{ $user->sdt }}" readonly>
                                <i class="fa-solid fa-phone-flip" id ="icon_profile" style="color: rgb(109, 167, 255)"></i>
                            </div>
            
                            <div class="div_profile">
                                <label for="email"  class="label_profile">Email</label>
                                <input type="text" class="form-control input_profile" id="email" value="{{ $user->email }}" readonly>
                                <i class="fa-regular fa-envelope" id ="icon_profile" style="color: rgb(246, 205, 122)"></i>
                            </div>
            
                            <div class="div_profile">
                                <label for="dia_chi" class="label_profile">Địa chỉ</label>
                                <input type="text" class="form-control input_profile" id="dia_chi" value="{{ $user->dia_chi }}" readonly>
                                <i class="fa-solid fa-address-card" id ="icon_profile" style="color: rgb(66, 151, 106)"></i>
                            </div>
                            
                            <div class="div_profile">
                                <label for="diem_tl"  class="label_profile">Điểm tích lũy</label>
                                <input type="text" class="form-control input_profile" id="diem_tl" value="" readonly>
                                <i class="fa-solid fa-coins" id ="icon_profile" style="color: rgb(198, 84, 109)"></i>
                            </div>
                        </form>
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

                        <div class="div_edit_profile">

                            <button type="submit" class="edit_info--button">Chỉnh sửa thông tin</button>
                        </div>
                      
                    </div>
                
        
            {{-- @else --}}
                {{-- <h4>Không có thông tin vui lòng đăng nhập !!</h4> --}}
            {{-- @endif --}}
        </div>
    </body>
    </html>
@endsection
