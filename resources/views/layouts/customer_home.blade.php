<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlRge8VJLqr7U-qQT7bdDtzz-uX0doe0z0JQ&s" />
{{-- <!--Start of Fchat.vn--><script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=6702e5f18455de4d23175d46" async="async"></script><!--End of Fchat.vn--> --}}

    <title>HTQLKS</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/brands.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    {{-- SweetAlert2 --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('customer/ctm_css/home.css')}}">
    <link rel="stylesheet" href="{{ asset('customer/ctm_css/room/room_index.css')}}">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/flaticon.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('customer/ctm_css/style.css')}}" type="text/css">

    
</head>

<body>

        @include('customer.header')
        @include('customer.menu')
            @yield('content')
            @yield('about')
            @yield('insert_profile')
            @yield('view_profile')
            @yield('service_type.service_type')
            @yield('service_type.service')
            @yield('room_index')
            @yield('room_detail')
            @yield('see_form')
            @yield('see_history')
            @yield('search')
            @yield('contact')
            @include('customer.footer')


    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->
    {{-- chatbot --}}
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger
      intent="WELCOME"
      chat-title="HazBinHotel_HTQLKS"
      agent-id="31865877-cff5-4c70-b57c-ad845ccbaeb3"
      language-code="vi"
    ></df-messenger>
    <!-- Js Plugins -->
    <script src="{{asset('customer/ctm_js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('customer/ctm_js/bootstrap.min.js')}}"></script>
    <script src="{{asset('customer/ctm_js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('customer/ctm_js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('customer/ctm_js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('customer/ctm_js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('customer/ctm_js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('customer/ctm_js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>