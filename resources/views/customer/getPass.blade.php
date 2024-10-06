<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{asset("customer/ctm_css/pass_forgotten.css")}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlRge8VJLqr7U-qQT7bdDtzz-uX0doe0z0JQ&s" />
</head>
<body>
        {{-- @if(Session::has('success')) 
                <div class="alert-login alert alert-success">{{ Session :: get('success') }}</div>
        @endif --}}

        @if(Session::has('error'))
            <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if(Session::has('success'))
            <div class="alert-register  alert-add alert alert-success">{{ Session::get('success') }}</div>
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
                    <form action="" class="box box-register" method="POST"> 
                        @csrf
                            <h1 style="font-size: 1.2rem;white-space: nowrap">HazBin Hotel - Forgot Password</h1> 
                    
                                <div class="pass_icon">
                                    <input type="password" name="pass" id="pass" placeholder="Nhập mật khẩu" value="{{ old('pass') }}" style="width:85%"> 
                                    <i class="fa-regular fa-eye" style="color: #0d419c;width:10%;cursor: pointer; " id="eyes_icon"></i>    
                                </div>
                                <div class="error_username" style="color: red;"> 
                                    @error('pass') 
                                            <small> Vui lòng nhập mật khẩu ! </small>
                                    @enderror
                                </div>

                            <div class="pass_icon">
                                <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Xác nhận lại mật khẩu" value="" style="width:85%"> 
                                <i class="fa-regular fa-eye" style="color: #0d419c;width:10%;cursor: pointer; " id="eyes_icon2"></i>
                                <i class="fa-solid fa-check" style="color: #12a17d; display:none" id="match_icon"></i>
                            </div>
                            <div class="error_username" style="color: red;"> 
                                @error('confirm_pass') 
                                        <small> Vui lòng nhập lại mật khẩu! </small>
                                @enderror
                            </div>

                            <input type="submit" name="" value="Xác nhận" >
                            <span class="register_note"><a href="{{route('customer.login')}}">Đăng nhập</a></span>
                         
                    </form> 
                </div> 
            </div>
        </div>
    </div>
    <script src="{{asset("customer/ctm_js/register.js")}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>