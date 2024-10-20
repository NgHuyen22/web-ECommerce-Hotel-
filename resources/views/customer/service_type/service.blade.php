@extends('layouts.customer_home')
    @section('service_type.service')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('customer/ctm_css/service_type/service_detail.css')}}">
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

                                <div class="bt-option">
                                    <a href="{{ route('customer.service_type',['id_ldv' => $id_ldv])}}">Dịch Vụ</a>
                                    <span>Chi Tiết Dịch Vụ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <form action="" class="" id="service_booking" method="">
            {{-- @csrf --}}
            <div class="service-form-menu">
                <div class="service_form">
                        <div class="service_booking_form">
                            <label for="" style="color:red">*</label>
                            <input type="text" class="date-input form-control" id="ngay_su_dung" name="ngay_su_dung"  value="{{old('ngay_su_dung')}}" placeholder="Ngày sử dụng">
                                   
                                <div class="label-note d-flex">

                                    {{-- <label for=""  style="color:red;">*</label>  --}}
                                    <p style="font-size: 0.8rem; margin-left:0.7rem;color:rgb(217, 79, 79)">vd: Đối với DVA: (1) (NU3) - lạnh : 2 phần / Đối với dv khác : Gói 1 / Không có thông tin vui lòng để tên gói hoặc chú thích thêm.</p>
                                </div>
                                    <textarea type="text" class="form-control" id="ghi_chu" name="ghi_chu"  value="{{old('ghi_chu')}}" placeholder="Ghi chú"></textarea>
                        </div>

                        @if(count($service) > 0)
                            @foreach ($service as $row)    
                                <div>
                                    <div class="form-check" id="service_items" style="margin-bottom : 0.8rem">
                                        <input class="form-check-input" type="checkbox"  name="id_dv[]" value="{{ $row->id_dv}}" id="flexRadioDefault1_{{ $row->id_dv }}" data-index="{{ $row->id_dv }}" >          
                                        <label class="form-check-label" for="flexRadioDefault1_{{ $row->id_dv }}">
                                                {{ $row -> ten_dv}}
                                        </label>
                                    </div>
                                    <div class="items_attribute" id="items_attribute_{{ $row->id_dv }}" style="display: none">
                                        <label for=""  style="color:red">*</label>
                                        <input type="text" class="form-control" id="so_luong" name="so_luong[]"  value="{{old('so_luong')}}"  placeholder="Số lượng">

                                        <input type="hidden" name="hidden_id_dv[]" id="hidden_id_dv_{{ $row->id_dv }}" value="">
                                        <input type="hidden" name="hidden_so_luong[]" id="hidden_so_luong_{{ $row->id_dv }}" value="">
                                        
                                        <label for="don_gia_dv"  style="margin-top:1rem">Đơn giá : </label>
                                        <input type="text" class="form-control " name="don_gia_dv" id="don_gia_dv" placeholder="{{number_format($row -> don_gia_dv,0,',','.')}} VND / 1 người" readonly >

                                        <label for="mo_ta_dv" style="margin-top:1rem">Mô tả :</label>
                                        <textarea  class="form-control" name="mo_ta_dv" id="mo_ta_dv"  style="text-align:start;margin-bottom : 2rem" readonly >{{{$row ->mo_ta_dv}}}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        @else
                                <p>Chưa cập nhật...</p>
                        @endif
                        <button type="submit" class="btn btn-primary service_booking--button" onclick="Room('{{route('customer.service_booking')}}')">Đặt lịch</button>
                </div>

                <div class="service_menu">
                    @if(count($service) > 0)
                        @foreach ($service as $row)
                            <div class="service_menu_item">
                                    <h5>{{ $row -> ten_dv}}</h5>
                                    @if($row->menu != null)
                                        <p>{!! str_replace('.', '.<br><br>', $row->menu) !!}</p>
                                    @else
                                        <p></p>
                                    @endif
                            </div>
                        @endforeach                    
                    @endif
                </div>
                
            </div>
        </form>

        <div class="service_incentives">
                <p class="incentives">Ưu đãi:  </p>

                <p class="offer_name">
                    @if(count($special_offers) > 0)
                        @foreach ($special_offers as $sp_o )
                            - {{$sp_o -> ten_ud}} <br>
                        @endforeach
                    @endif
                </p>
        </div>
{{--         
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                    const radios= document.querySelectorAll('.form-check-input');

                    radios.forEach(radio =>{
                        radio.addEventListener('change', function () {
                            document.querySelectorAll('.items_attribute').forEach(item => {
                                item.style.display = 'none';
                            }); // đảm bảo cac class này đều âne trc khi hiển thị ptu cụ thể, chọn khác thì th còn lại ẩn,..
                            const index = this.getAttribute('data-index'); // lay gia tri thuoc tinh
                            const itemToShow = document.getElementById(`items_attribute_${index}`);
                            if(itemToShow){
                                    itemToShow.style.display = 'block';
                            }
                        });
                    });
            });
            
        </script> --}}
        {{-- <script>
            
            const ngay_su_dung = document.getElementById('ngay_su_dung').value;
            const ghi_chu = document.getElementById('ghi_chu').value;
              @if(count($id_form) >0)
                function Room(url){
                    event.preventDefault(); 
                    Swal.fire({
                        title: 'Xác nhận vị trí phòng',
                        html: `   <style>
                                            .swal2-background-custom{
                                                border: 2px solid black; 
                                                border-radius: 1rem; 
                                            }
                                            .nice-select {
                                                display: none !important;
                                            }
                                            
                                    </style>
                        <form id="confirmRoom" class="confirmRoom" action="{{  route('customer.service_booking') }}" method="POST">
                            @csrf
                                        <select class="form-select" aria-label="Default select example" id="id_don">
                                            <option selected disabled>Chọn số phòng</option>
                                            @foreach ($id_form as $form)
                                                
                                                <option value="$form->id_don">{{ $form -> so_phong}}</option>
                                            @endforeach
                                        </select>
        
                                <input type="hidden" name="ngay_su_dung" id="hidden_ngay_su_dung" value="${ngay_su_dung}">
                                <input type="hidden" name="ghi_chu" id="hidden_ghi_chu" value="${ghi_chu}">
                                <input type="hidden" name="hidden_id_dv[]" id="hidden_id_dv_{{ $row->id_dv }}" value="">
                                <input type="hidden" name="hidden_so_luong[]" id="hidden_so_luong_{{ $row->id_dv }}" value="">
                        </form>`,
                        icon: 'info',
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: 'Hủy',
                        showCancelButton: true,
                        confirmButtonColor: '#04AA6D',
                        cancelButtonColor: 'rgb(246, 81, 81)',
                        customClass: {
                                popup: 'swal2-background-custom',
                                container: 'swal2-borderless'
                            },
                            
                                background: '#30547e' ,
                                color: 'white'    
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('confirmRoom').submit(); 
                        }
                    });
           
                }
            @else
                function Room(){
                    even.preventDefault();
                            Swal.fire({
                                icon: 'error',
                                text: "Bạn chưa có phòng, vui lòng đặt phòng !",
                                showConfirmButton: false,
                                timer: 2000
                            });      
                }
            @endif
             --}}
        <script>    
            
             function Room(url){
                @if (count($id_form) > 0)
                    document.getElementById('service_booking').addEventListener('submit', function(event) {

                        const ngaySD = document.getElementById('ngay_su_dung').value;
                        const ghi_chu = document.getElementById('ghi_chu').value;
                        const dv = document.querySelectorAll('input[name="id_dv[]"]');
                        let dvSelected = false;
                        let slValid = true;
                        const selectedServices = [];

                        dv.forEach(function(service) {
                        if (service.checked) {
                            dvSelected = true; // Có ít nhất một dịch vụ được chọn
                            const serviceIndex = service.getAttribute('data-index'); // Lấy index của dịch vụ
                            const sl = document.querySelector(`#items_attribute_${serviceIndex} input[name="so_luong[]"]`);

                            // Kiểm tra nếu số lượng của dịch vụ đó có được điền không
                            if (!sl || sl.value === "") {
                                slValid = false; // Nếu bỏ trống số lượng, thì invalid
                            } else {
                                // Thêm dịch vụ và số lượng vào mảng
                                selectedServices.push({ id_dv: service.value, so_luong: sl.value });
                            }
                            }
                        });

                        // Kiểm tra nếu ngày sử dụng, dịch vụ và số lượng hợp lệ
                        if (ngaySD === "" || !dvSelected || !slValid) {
                            event.preventDefault();
                            Swal.fire({
                                icon: 'error',
                                text: 'Vui lòng chọn ít nhất 1 dịch vụ và không để trống thông tin bắt buộc.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } 
                        else if (selectedServices.length > 0) {
                            event.preventDefault();
                            Swal.fire({
                                title: 'Xác nhận vị trí phòng',
                                html: `<style>
                                                .swal2-background-custom{
                                                    border: 2px solid black; 
                                                    border-radius: 1rem; 
                                                }
                                                .nice-select {
                                                    display: none !important;
                                                }
                                            
                                            </style>
                                    <form id="confirmRoom" class="confirmRoom" action="{{ route('customer.service_booking')}}" method="POST">
                                        @csrf
                                        <select class="form-select" aria-label="Default select example" id="id_don" name="id_don">
                                            <option selected disabled>Chọn số phòng</option>
                                            @foreach ($id_form as $form)
                                                <option value="{{$form->id_don}}">{{ $form->so_phong }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="ngay_su_dung" value="${ngaySD}">
                                        <input type="hidden" name="ghi_chu" value="${ghi_chu}">
                                        ${selectedServices.map(service => `
                                            <input type="hidden" name="hidden_id_dv[]" value="${service.id_dv}">
                                            <input type="hidden" name="hidden_so_luong[]" value="${service.so_luong}">
                                        `).join('')}
                                    </form>
                                `,
                                icon: 'info',
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: 'Hủy',
                        showCancelButton: true,
                        confirmButtonColor: '#04AA6D',
                        cancelButtonColor: 'rgb(246, 81, 81)',
                        customClass: {
                                popup: 'swal2-background-custom',
                                container: 'swal2-borderless'
                            },
                            
                                background: '#30547e' ,
                                color: 'white'    
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('confirmRoom').submit();
                                }
                            });
                        } 
                        else {
                            Swal.fire({
                                icon: 'error',
                                text: "Bạn chưa chọn dịch vụ nào!",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });

                @else
                        event.preventDefault();
                                Swal.fire({
                                    icon: 'error',
                                    text: "Bạn chưa có phòng, vui lòng đặt phòng !",
                                    showConfirmButton: false,
                                    timer: 2000
                                });      
                    
                @endif
            }
        </script>

   
        <script src="{{ asset('customer/ctm_js/service_index/display.js')}}"></script>

        {{-- <script src="{{asset('customer/ctm_js/service_index/service.js')}}"></script> --}}
             
  
    </body>
    </html>
     
        
    @endsection
