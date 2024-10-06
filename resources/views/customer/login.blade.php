<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{asset("customer/ctm_css/login.css")}}">
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlRge8VJLqr7U-qQT7bdDtzz-uX0doe0z0JQ&s" />
</head>
<body>
        {{-- @if(Session::has('success')) 
                <div class="alert-login alert alert-success">{{ Session :: get('success') }}</div>
        @endif --}}

        @if(Session::has('error'))
            <div class="alert-login alert-add alert alert-danger">{{ Session::get('error') }}</div>
        @endif
    <video autoplay muted loop id="myVideo">
        {{-- <source src="https://videos.pexels.com/video-files/12173625/12173625-uhd_1440_2560_25fps.mp4" type="video/mp4"> --}}
        <source src="https://videos.pexels.com/video-files/7131764/7131764-uhd_1440_2732_30fps.mp4" type="video/mp4">
        {{-- <source src="https://videos.pexels.com/video-files/4069480/4069480-uhd_2560_1440_25fps.mp4" type="video/mp4"> --}}
       
      </video>
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-6"> 
                 <div class="card"> 
                    <form action="" class="box box-login" method="POST"> 
                        @csrf
                        <h1 style="font-size: 2rem;">HazBin Hotel - Login</h1> 
                            {{-- <p class="text-muted"> Nhập thông tin bên dưới !</p> --}}
                            {{-- <input type="text" name="id_ad" placeholder="Mã số đăng nhập" value="{{session('remember_id_ad') }}">  --}}
                            <input type="text" name="email" placeholder="Nhập email" value="{{ old('email') }}"> 
                                <div class="error_username" style="color: red;"> 
                                    @error('email') 
                                            <small> Vui lòng nhập email !</small>
                                    @enderror
                                </div>
                            <input type="password" name="pass" id="pass" placeholder="Nhập mật khẩu" value="{{ old('pass') }}"> 
                                <div class="error_username" style="color: red;"> 
                                    @error('pass') 
                                            <small> Vui lòng nhập mật khẩu ! </small>
                                    @enderror
                                </div>
                              
                            {{-- <a class="forgot text-muted" href="#">Quên mật khẩu?</a>  --}}
                            <input type="submit" name="" value="Đăng nhập" >

                            <div class="tool_pass ">
                                <div class="show_pass">
                                    <input type="checkbox" id="showPasswordCheckbox" class="check__bock--pass" onchange="togglePasswordVisibility()">
                                    <label for="showPasswordCheckbox" class="text__pass">Hiển thị mật khẩu</label><br>
                                </div>
    
                                <div class="row div_remember ">
                                 
                                    <div class="text-content w-100">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember" class="check__bock--remember" name="remember">
                                            <label for="remember" class="text__pass">Ghi nhớ </label><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <span class="register_note">Bạn chưa có tài khoản ? <a href="{{route('customer.register')}}">Đăng ký</a> / <a href="{{route('customer.pass_forgotten')}}">Quên mật khẩu</a></span>
                            
                            
                    </form> 
                </div> 
            </div>
        </div>
    </div>
    <script src="{{asset("customer/ctm_js/login.js")}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>