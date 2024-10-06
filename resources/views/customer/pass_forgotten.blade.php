{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Forgotten</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body>
    @if(Session::has('error'))
        <div class="alert-login alert-add alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    @if(Session::has('success'))
        <div class="alert-login alert-add alert alert-success" style="background-color: #209f71;
                                                                                                    color: rgb(5, 54, 36);
                                                                                                    text-align:center;">
        {{ Session::get('success') }}</div>
    @endif
    <form action="" method="POST">
        @csrf
        <h3>Cập nhật lại mật khẩu</h3>
        <p>Vui lòng nhập email bạn đã đăng ký tài khoản trước đó :</p>

        <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="email" class="form-control email" name="email"/>
            <label class="form-label" for="form2Example1">Email address</label>
          </div>

          <input type="submit" name="" value="Gửi email xác nhận" >
    </form>

</body>
</html> --}}

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
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlRge8VJLqr7U-qQT7bdDtzz-uX0doe0z0JQ&s" />
</head>
<body>
        {{-- @if(Session::has('success')) 
                <div class="alert-login alert alert-success">{{ Session :: get('success') }}</div>
        @endif --}}

        @if(Session::has('error'))
            <div class="alert-login alert-add alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if(Session::has('success'))
            <div class="alert-login alert-add alert alert-success" style="background-color: #209f71;
                                                                                                        color: rgb(5, 54, 36);
                                                                                                        text-align:center;">
            {{ Session::get('success') }}</div>
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
                        <h1 style="font-size: 1.5rem; white-space: nowrap">HazBin Hotel - Forgot Password</h1>
                        <p style="color:rgb(222, 222, 222)">Vui lòng nhập email bạn đã đăng ký tài khoản trước đó :</p>
                
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="email" class="form-control email" name="email" value="{{ old('email') }}"/>
                            <div class="error_username" style="color: red;"> 
                                @error('email') 
                                        <small>{{ $message }}</small>
                                @enderror
                            </div>
                          </div>
                
                          <input type="submit" name="" value="Gửi email xác nhận" >
                    </form>
              
                </div> 
            </div>
        </div>
    </div>
    {{-- <script src="{{asset("customer/ctm_js/pass_forgotten.js")}}"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>