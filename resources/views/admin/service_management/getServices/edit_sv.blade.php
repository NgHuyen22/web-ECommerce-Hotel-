@extends('layouts.admin_home')
    @section('edit_sv')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
           <link rel="stylesheet" href="{{ asset('admin/ad_css/service_management/getServices/edit_sv.css')}}">
        </head>
        <body>
            @if($id_dv != null)
                <form action="{{route('admin.updated_sv',[$id_dv])}}" method="POST" class="updated_form_sv" id="updated_form_sv">
                    @csrf
                    <div class="form-group label_input">
                            <label for="id_dv" class="updated_form_sv--label" id="id_dv--label">ID : </label>
                            <input type="text" class="form-control updated_form_sv--input" id="id_dv" name ="id_dv" placeholder="" value="{{ $id_dv}}" readonly>
                    </div>

                    <div class="form-group label_input">
                            <label for="loai_dv" class="updated_form_sv--label">Loại DV : <span style="color:red">*</span> </label>
                            <select name="loai_dv" class="form-control updated_form_sv--input"  style="width: 5rem">
                                <option value="{{ $loai_dv}}"  selected hidden>{{ $nameSVT != null ? $nameSVT : '' }}</option>
                                    @if(!$getNameSVT -> isEmpty())
                                        @foreach ($getNameSVT as $svt )
                                                <option value="{{ $svt-> id_ldv }}">{{$svt -> ten_ldv}}</option>
                                         @endforeach
                                    @endif
                            </select>    
                    </div>
                    
                    <div class="form-group label_input">
                            <label for="ten_dv" class="updated_form_sv--label">Tên  Dịch Vụ : <span style="color:red">*</span> </label>
                            <input type="text" class="form-control updated_form_sv--input" id="ten_dv" name ="ten_dv" placeholder="" value="{{ $ten_dv}}" >
                    </div>

                    <div class="form-group label_input">
                            <label for="don_gia_dv" class="updated_form_sv--label">Đơn giá : <span style="color:red">*</span> </label>
                            <input type="text" class="form-control updated_form_sv--input" id="don_gia_dv" name ="don_gia_dv" placeholder="" value="{{ $don_gia_dv}}" >
                    </div>
            
                    <div class="form-group label_input">
                            <label for="mo_ta_dv" class="updated_form_sv--label">Mô Tả : <span style="color:red">*</span> </label>
                            <textarea class="form-control updated_form_sv--input" aria-label="With textarea"  id="mo_ta_dv"  name ="mo_ta_dv">{{ $mo_ta_dv }}</textarea>
                    </div>

                    <div class="form-group label_input">
                            <label for="created_at" class="updated_form_sv--label">Ngày Tạo : </label>
                            <input type="text" class="form-control updated_form_sv--input" id="created_at" name ="created_at" placeholder="" value="{{ $created_at}}" readonly>
                            
                        </div>
                        
                        <div class="form-group label_input">
                            <label for="updated_at" class="updated_form_sv--label">Ngày Cập Nhật : </label>
                            <input type="text" class="form-control updated_form_sv--input" id="updated_at" name ="updated_at" placeholder="" value="{{ $updated_at}}" readonly>
                            
                        </div>

                    <div class="updated_form_sv--tools">
                            <button  type="submit" class="btn btn-primary updated_button" name="updated_button"><i class="fa-regular fa-floppy-disk" style="font-size: 1rem"></i></button>
            
                    </div>
                </form>
            @endif

            <div class="back_room">
                <a href="{{ route('admin.getServices',[$loai_dv])}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
            </div>

            <script>
                document.getElementById("updated_form_sv").addEventListener('submit', function(event){
                        const ten_dv = document.getElementById('ten_dv').value;
                        const mo_ta_dv = document.getElementById('mo_ta_dv').value;
           

                        if (ten_dv === "" || mo_ta_dv === "") {
                        event.preventDefault(); // Ngăn form gửi đi khi dữ liệu không hợp lệ

                        Swal.fire({
                                icon: 'error',
                                // title: 'Thất bại !!',
                                text: 'Vui lòng không để trống thông tin bắt buộc.',
                                showConfirmButton: false,
                                timer: 2500
                        });

                        }  
                });
            </script>
        </body>
        </html>
    @endsection