<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{asset("customer/ctm_css/register.css")}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlRge8VJLqr7U-qQT7bdDtzz-uX0doe0z0JQ&s" />

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
        @if(Session::has('success')) 
                <div class="alert-login alert alert-success">{{ Session :: get('success') }}</div>
        @endif
        @if(Session::has('error')) 
                <div class="alert-login alert alert-register">{{ Session :: get('error') }}</div>
        @endif

        
        {{-- @if (Session::has('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    text: "{{ Session::get('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif
        @if (Session::has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    text: "{{ Session::get('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif --}}
    <video autoplay muted loop id="myVideo">
        {{-- <source src="https://videos.pexels.com/video-files/12173625/12173625-uhd_1440_2560_25fps.mp4" type="video/mp4"> --}}
        <source src="https://videos.pexels.com/video-files/7131764/7131764-uhd_1440_2732_30fps.mp4" type="video/mp4">
        {{-- <source src="https://videos.pexels.com/video-files/4069480/4069480-uhd_2560_1440_25fps.mp4" type="video/mp4"> --}}
       
      </video>
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-6"> 
                 <div class="card"> 
                    <form action="" id ="form_register"class="box box-register" method="POST"> 
                        @csrf
                            <h1 style="font-size: 1.5rem;">HazBin Hotel - Register</h1> 
                            {{-- <div class="div_user1" style="margin-left:1rem"> --}}
{{--                                 
                                    <div class="div_user d-flex"> --}}

                                        <input type="text" name="ho_ten" id="ho_ten" placeholder="Nhập họ tên" value="{{ old('ho_ten') }}"> 
                                            <div class="error_username" style="color: red;"> 
                                                @error('ho_ten') 
                                                        <small> Vui lòng nhập họ tên ! </small>
                                                @enderror
                                            </div>
                                    {{-- </div> --}}

                                    {{-- <input type="text" name="gioi_tinh" id="gioi_tinh" placeholder="Nhập giới tính" value="">  --}}
                                    {{-- <div class="div_user d-flex"> --}}
                                        <select class="user_gender" id="gioi_tinh" name="gioi_tinh" style="background-color: black; opacity: 0.9; 
                                                                                                                                color: rgb(154, 153, 153);
                                                                                                                                border: 3px solid #149cd7;
                                                                                                                                text-align:center;
                                                                                                                                margin-top:0.5rem;
                                                                                                                                margin-bottom: 0.5rem;
                                                                                                                                width:60%
                                                                                                                                ">
                                            <option value="" disabled selected hidden style="color: rgb(180, 179, 179);">Chọn giới tính</option>
                                             <option value="0" {{ old('gioi_tinh') == '0' ? 'selected' : '' }}>Nam</option>
                                             <option value="1" {{ old('gioi_tinh') == '1' ? 'selected' : '' }}>Nữ</option>
                                         </select>
                                         <script>
                                            document.getElementById('gioi_tinh').addEventListener('change', function() {
                                                if (this.value) {
                                              
                                                    this.style.borderColor = '#20c997'; // Thay đổi màu viền khi chọn giá trị
                                                    this.style.background = 'rgb(232, 240, 254)'; 
                                                    this.style.color = 'black'; 
                                                }
                                            });
                                        </script>

                                            <div class="error_username" style="color: red;"> 
                                                @error('gioi_tinh') 
                                                        <small> Vui lòng chọn giới tính ! </small>
                                                @enderror
                                            </div> 
                                    {{-- </div> 
                                        
                                    {{-- <div class="div_user d-flex"> --}}
                                        <input type="text" name="sdt" id="sdt" placeholder="Nhập SDT" value="{{ old('sdt') }}"> 
                                            <div class="error_username" style="color: red; "> 
                                                @error('sdt') 
                                                        <small>{{$message}} </small>
                                                @enderror
                                            </div>
                                    {{-- </div> --}}

                                    {{-- <div class="div_user d-flex"> --}}
                                        <input type="text" name="email" placeholder="Nhập email" value="{{ old('email') }}"> 
                                        <div class="error_username" style="color: red;"> 
                                            @error('email') 
                                            <small> {{$message}}</small>
                                            @enderror
                                        </div>
                                        {{-- </div> --}}
                                        
                                        {{-- <div class="div_user d-flex"> --}}
                                            {{-- <textarea type="text" class="address align-middle" name="dia_chi" id="dia_chi" placeholder="Nhập địa chỉ">{{ old('dia_chi') }}</textarea> --}}
                                            <input type="text" name="dia_chi" id="dia_chi" placeholder="Nhập địa chỉ" value="{{ old('dia_chi') }}"> 
                                        <div class="error_username" style="color: red;"> 
                                            @error('dia_chi') 
                                                    <small> Vui lòng nhập mật khẩu ! </small>
                                            @enderror
                                        </div>
                                    {{-- </div> --}}
                            {{-- </div> --}}

                            {{-- <div class="div_user d-flex"> --}}
                                <div class="pass_icon">
                                    <input type="password" name="pass" id="pass" placeholder="Nhập mật khẩu" value="{{ old('pass') }}" style="width:85%"> 
                                    <i class="fa-regular fa-eye" style="color: #0d419c;width:10%;cursor: pointer; " id="eyes_icon"></i>    
                                </div>
                                <div class="error_username" style="color: red;"> 
                                    @error('pass') 
                                            <small> Vui lòng nhập mật khẩu ! </small>
                                    @enderror
                                </div>
                            {{-- </div> --}}

                            {{-- <div class="div_user d-flex"> --}}
                                <div class="pass_icon">
                                    <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Xác nhận lại mật khẩu" value="" style="width:85%"> 
                                    <i class="fa-regular fa-eye" style="color: #0d419c;width:10%;cursor: pointer; " id="eyes_icon2"></i>
                                    <i class="fa-solid fa-check" style="color: #12a17d; display:none" id="match_icon"></i>
                                </div>
                                <div class="error_username" style="color: red;"> 
                                    @error('confirm_pass') 
                                            <small> {{ $message}}</small>
                                    @enderror
                                </div>
                            {{-- </div> --}}
                              
                            {{-- <a class="forgot text-muted" href="#">Quên mật khẩu?</a>  --}}
                            <input type="submit" name="" value="Đăng ký" >
                            <span class="register_note"><a href="{{route('customer.login')}}">Đăng nhập</a></span>
                         
                    </form> 
                </div> 
            </div>
        </div>
    </div>

    {{-- <script>
                  document.getElementById("form_register").addEventListener("submit", function (event) {
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
                    }   
  
                });
    </script> --}}
    <script src="{{asset("customer/ctm_js/register.js")}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>