@extends('layouts.customer_home')
    @section('contact')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="{{ asset('customer/ctm_css/contact/contact.css') }}">
    </head>
    <body>
        @if(Session::has('success'))
            <script>
                Swal.fire({
                        icon: 'success',
                        text: "{{ Session::get('success') }}",
                        showConfirmButton: false,
                        timer: 2700
                });
            </script>
        @endif
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <p style="font-style: italic">   Hãy gửi cho chúng tôi thông tin liên hệ của bạn. Chúng tôi rất vui mừng được phục vụ và 
                                đồng hành cùng bạn trong hành trình trải nghiệm dịch vụ tuyệt vời tại đây. 
                                Mọi thắc mắc của bạn sẽ được giải đáp nhanh chóng và tận tình!</p>
                                
                            <div class="bt-option">
                                <a href="{{route('customer.index')}}">Trang Chủ</a>
                                <span>Liên hệ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper_ct">
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.794869645704!2d105.75469417761802!3d10.033779364478098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a088155893aaab%3A0xe52e63ae0bd18fec!2zOSDEkC4gVHLhuqduIE5hbSBQaMO6LCBQaMaw4budbmcgQW4gS2jDoW5oLCBOaW5oIEtp4buBdSwgQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1729783966047!5m2!1svi!2s" width="600" height="450" 
                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            @if($user !=null)
                <div class="contact">
                    <form action="{{route('customer.insert_form_ct')}}" class="content" id="content" method="POST" >
                        @csrf
                        <div class="tool_flex">
                            <div class="item_ct">
                                <label for="ho_ten">Họ Tên <span style="color: rgb(233, 81, 81)">*</span></label>
                                <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $user->ho_ten ?? '') }}">
                            </div>

                            <div class="item_ct">
                                <label for="gioi_tinh">Giới tính <span style="color: rgb(233, 81, 81)">*</span></label>
                                <select class="form-control input_form gender" id="gioi_tinh" name="gioi_tinh">
                                    <option value="0" {{ (old('gioi_tinh') == '0' || (isset($user) && $user->gioi_tinh == '0')) ? 'selected' : '' }}>Nam</option>
                                    <option value="1" {{ (old('gioi_tinh') == '1' || (isset($user) && $user->gioi_tinh == '1')) ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                        </div>

                        <div class="tool_flex">
                            <div class="item_ct">
                                <label for="dia_chi" class="label_form">Địa Chỉ <span style="color: rgb(233, 81, 81)">*</span></label>
                                <textarea class="form-control" id="dia_chi" name="dia_chi">{{ old('dia_chi', $user->dia_chi ?? '') }}</textarea>
                            </div>
                            <div class="item_ct">
                                <label for="noi_dung" class="label_form">Nôi dung liên lạc <span style="color: rgb(233, 81, 81)">*</span> </label>
                                <textarea class="form-control" id="noi_dung" name="noi_dung">{{ old('noi_dung') }}</textarea>
                            </div>
                        </div>

                        <div class="tool_flex">     
                            <div class="item_ct">
                                <label for="sdt" class="label_form">SDT <span style="color: rgb(233, 81, 81)">*</span></label>
                                <input type="text" class="form-control input_form" id="sdt" name="sdt" value="{{ old('sdt', $user->sdt ?? '') }}" />
                            </div>
        
                            <div class="item_ct">
                                <label for="email" class="label_form">Email <span style="color: rgb(233, 81, 81)">*</span></label>
                                <input type="text" class="form-control input_form" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" />
                            </div>
                        </div>
                        <div class="tool_button">
                            <button type="submit" class="submit">Gửi</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="contact">
                    <form action="{{route('customer.insert_form_ct')}}" class="content" id="content" method="POST" >
                        @csrf
                        <div class="tool_flex">
                            <div class="item_ct">
                                <label for="ho_ten">Họ Tên <span style="color: rgb(233, 81, 81)">*</span></label>
                                <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="{{ old('ho_ten') }}">
                            </div>

                            <div class="item_ct">
                                <label for="gioi_tinh">Giới tính <span style="color: rgb(233, 81, 81)">*</span></label>
                                <select class="form-control input_form gender" id="gioi_tinh" name="gioi_tinh">
                                    <option value="" selected hidden style="color: rgb(180, 179, 179);"></option>
                                    <option value="0" {{ old('gioi_tinh') == '0' ? 'selected' : '' }}>Nam</option>
                                    <option value="1" {{ old('gioi_tinh') == '1' ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                        </div>

                        <div class="tool_flex">
                            <div class="item_ct">
                                <label for="dia_chi" class="label_form">Địa Chỉ <span style="color: rgb(233, 81, 81)">*</span></label>
                                <textarea class="form-control" id="dia_chi" name="dia_chi">{{ old('dia_chi') }}</textarea>
                            </div>
                            <div class="item_ct">
                                <label for="noi_dung" class="label_form">Nôi dung liên lạc <span style="color: rgb(233, 81, 81)">*</span></label>
                                <textarea class="form-control" id="noi_dung" name="noi_dung">{{ old('noi_dung') }}</textarea>
                            </div>
                        </div>

                        <div class="tool_flex">     
                            <div class="item_ct">
                                <label for="sdt" class="label_form">SDT <span style="color: rgb(233, 81, 81)">*</span></label>
                                <input type="text" class="form-control input_form" id="sdt" name="sdt" value="{{ old('sdt') }}" />
                            </div>

                            <div class="item_ct">
                                <label for="email" class="label_form">Email <span style="color: rgb(233, 81, 81)">*</span></label>
                                <input type="text" class="form-control input_form" id="email" name="email" value="{{ old('email') }}" />
                            </div>
                        </div>
                        <div class="tool_button">
                            <button type="submit" class="submit">Gửi</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    
        <script>
            document.getElementById("content").addEventListener('submit', function(event){
                    var ho_ten = document.getElementById('ho_ten').value;
                    var gioi_tinh = document.getElementById('gioi_tinh').value;
                    var dia_chi = document.getElementById('dia_chi').value;
                    var noi_dung = document.getElementById('noi_dung').value;
                    var sdt = document.getElementById('sdt').value;
                    var email = document.getElementById('email').value;

                    if (ho_ten === "" || gioi_tinh === "" || dia_chi === "" || noi_dung === "" || sdt === "" || email === "") {
                    event.preventDefault(); 

                    Swal.fire({
                            icon: 'error',
                            text: 'Vui lòng không để trống  thông tin yêu cầu.',
                            showConfirmButton: false,
                            timer: 2500
                    });

                    }
            
            });
        </script>
        
    </body>
    </html>
    @endsection