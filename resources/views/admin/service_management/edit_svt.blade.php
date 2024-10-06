@extends('layouts.admin_home')
    @section('edit_ldv')
          <!DOCTYPE html>
          <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('admin/ad_css/service_management/edit_svt.css')}}">
          </head>
          <body>
              @if($id_ldv != null)
                 <form action="{{ route('admin.updated_svt')}}" method="POST" class="updated_form" id="updated_form">
                         @csrf
                         <div class="form-group label_input">
                                 <label for="id_lp" class="updated_form--label" id="id_lp--label">ID : </label>
                                 <input type="text" class="form-control updated_form--input" id="id_lp" name ="id_ldv" placeholder="" value="{{ $id_ldv}}" readonly>
                         </div>
     
                         <div class="form-group label_input">
                                 <label for="ten_lp" class="updated_form--label">Tên Loại Dịch Vụ : <span style="color:red">*</span> </label>
                                 <input type="text" class="form-control updated_form--input" id="ten_lp" name ="ten_ldv" placeholder="" value="{{ $ten_ldv}}" >
                         </div>
                 
                         <div class="form-group label_input">
                                 <label for="mo_ta" class="updated_form--label">Mô Tả : <span style="color:red">*</span> </label>
                                 <textarea class="form-control updated_form--input" aria-label="With textarea"  id="mo_ta"  name ="mo_ta_ldv">{{ $mo_ta_ldv }}</textarea>
                         </div>
     
                         <div class="form-group label_input">
                                 <label for="created_at" class="updated_form--label">Ngày Tạo : </label>
                                 <input type="text" class="form-control updated_form--input" id="created_at" name ="created_at" placeholder="" value="{{ $created_at}}" readonly>
                                 
                                </div>
                                
                                <div class="form-group label_input">
                                    <label for="updated_at" class="updated_form--label">Ngày Cập Nhật : </label>
                                    <input type="text" class="form-control updated_form--input" id="updated_at" name ="updated_at" placeholder="" value="{{ $updated_at}}" readonly>
                                 
                         </div>
     
                      
     
                         <div class="updated_form--tools">
                                 <button  type="submit" class="btn btn-primary updated_button" name="updated_button"><i class="fa-regular fa-floppy-disk" style="font-size: 1rem"></i></button>
                 
                         </div>
                 </form>
              @endif
            
              <div class="back_room">
                        <a href="{{ route('admin.service_type')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
              </div>
          </body>
          </html>
      
    @endsection