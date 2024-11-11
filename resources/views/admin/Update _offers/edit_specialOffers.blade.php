@extends('layouts.admin_home')
    @section('edit_specialOffers')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/update_offers/edit_specialOffers.css')}}">
    </head>
    <body>
        @if($ud != null)     
            <form action="{{ route('admin.updated_special_offers') }}" method="POST" class="updated_form" id="updated_form" method="POST">
                @csrf
                <div class="form-group label_input">
                        <label for="id_ud" class="updated_form--label" id="id_ud--label">ID : </label>
                        <input type="text" class="form-control updated_form--input" id="id_ud" name ="id_ud" placeholder="" value="{{ $ud -> id_ud}}" readonly>
                </div>
        
                <div class="form-group label_input">
                        <label for="ten_ud" class="updated_form--label">Tên Ưu Đãi : <span style="color:red">*</span> </label>
                        <input type="text" class="form-control updated_form--input" id="ten_ud" name ="ten_ud" placeholder="" value="{{ $ud -> ten_ud }}" >
                </div>
                    
                <div class="form-group label_input">
                        <label for="giam" class="updated_form--label">Giảm : <span style="color:red">*</span> </label>
                        <div class="updated_form--input1">
                            <input type="text" class="form-control input_item" id="giam" name ="giam" placeholder="" value="{{ $ud -> giam }}" > 
                            <span class="input-group-text percent" style="">%</span>
                        </div>
                    
                </div>

                <div class="form-group label_input">
                    <label for="sl_ap_dung" class="updated_form--label">Số Lượng Áp Dụng : <span style="color:red">*</span> </label>
                    <input type="text" class="form-control updated_form--input" id="sl_ap_dung" name ="sl_ap_dung" placeholder="" value="{{ $ud -> sl_ap_dung }}" >
                </div>

                <div class="form-group label_input">
                        <label for="id_dv" class="updated_form--label">Dịch Vụ Áp Dụng : </label>
                        {{-- <select name="id_dv" class="form-control updated_form--input"  style="width: 5rem" id="id_dv">
                            @if($ttsv != null)
                                <option value="{{ $ttsv -> id_dv}}"  selected hidden>{{ $ttsv -> ten_dv}}</option>
                                @if($services -> isNotEmpty())
                                    @foreach ($services as $sv )
                                            <option value="{{ $sv-> id_dv }}">{{$sv -> ten_dv}}</option>
                                    @endforeach
                                @else
                                        <option value="" disabled>Chưa có dữ liệu..</option>
                                @endif
                            @else
                                <option value=""  selected hidden>Chọn dịch vụ</option>
                                @if($services -> isNotEmpty())
                                    @foreach ($services as $sv )
                                            <option value="{{ $sv-> id_dv }}">{{$sv -> ten_dv}}</option>
                                    @endforeach
                                @else
                                        <option value="" disabled>Chưa có dữ liệu..</option>
                                @endif
                            @endif
                        </select>     --}}
                    {{-- @if($services -> isNotEmpty())
                        @if($allTTServices->isNotEmpty())
                            <div class="updated_form--input">
                                @foreach ($services as $dv)     
                                    @php
                                        $is_in_offer = false;
                                    @endphp 

                                    @foreach ($allTTServices as $collection)
                                        @foreach ($collection as $sv)  
                                            @if($sv -> id_ud == $ud -> id_ud  )
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="" id="checkbox1_{{ $sv->id_dv }}" value="{{ $sv->id_dv }}" checked disabled>
                                                    <label class="form-check-label" for="checkbox_{{ $sv->id_dv }}">
                                                        {{ $sv->ten_dv }}
                                                    </label>
                                                </div>
                                            @endif   

                                            @if($sv -> id_dv != $dv->id_dv )    
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="id_dv[]" id="checkbox_{{ $dv->id_dv }}" value="{{ $dv->id_dv }}" checked>
                                                            <label class="form-check-label" for="checkbox_{{ $dv->id_dv }}">
                                                                {{ $dv->ten_dv }}
                                                            </label>
                                                        </div>
                                            @endif                 
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>
                        @else
                            <div class="updated_form--input">
                                @foreach ($services as $dv)    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="" id="checkbox1_{{ $dv->id_dv }}" value="{{ $dv->id_dv }}" checked disabled>
                                        <label class="form-check-label" for="checkbox_{{ $dv->id_dv }}">
                                            {{ $dv->ten_dv }}
                                        </label>
                                    </div> 
                                @endforeach
                            </div>
                        @endif
                    @else
                            <p>Chưa có dữ liệu..</p>
                    @endif --}}
                    @if($services->isNotEmpty())
                    <div class="updated_form--input">
                        {{-- Hiển thị dịch vụ có ưu đãi trước --}}
                        @if($allTTServices->isNotEmpty())
                            @foreach ($allTTServices as $collection)
                                @foreach ($collection as $sv)
                                    @if ($sv->id_ud == $ud->id_ud) {{-- Kiểm tra điều kiện theo mã ưu đãi --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="" id="checkbox1_{{ $sv->id_dv }}" value="{{ $sv->id_dv }}" checked disabled>
                                            <label class="form-check-label" for="checkbox_{{ $sv->id_dv }}">
                                                {{ $sv->ten_dv }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                
                        {{-- Hiển thị các dịch vụ chưa có ưu đãi --}}
                        @foreach ($services as $dv)
                            @php
                                $is_in_offer = false;
                            @endphp
                
                            {{-- Kiểm tra nếu dịch vụ này đã có trong $allTTServices --}}
                            @foreach ($allTTServices as $collection)
                                @foreach ($collection as $sv)
                                    @if ($sv->id_dv == $dv->id_dv && $sv->id_ud == $ud->id_ud)
                                        @php
                                            $is_in_offer = true;
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                
                            {{-- Hiển thị dịch vụ nếu chưa có ưu đãi --}}
                            @if (!$is_in_offer)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="id_dv[]" id="checkbox_{{ $dv->id_dv }}" value="{{ $dv->id_dv }}">
                                    <label class="form-check-label" for="checkbox_{{ $dv->id_dv }}">
                                        {{ $dv->ten_dv }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p>Chưa có dữ liệu..</p>
                @endif
                    
                </div>
        
                <div class="form-group label_input">
                        <label for="created_at" class="updated_form--label">Ngày Áp Dụng : <span style="color:red">*</span> </label>
                        <input type="date" class="form-control updated_form--input" id="created_at" name ="tg_ap_dung" placeholder="" value="{{$ud -> tg_ap_dung}}" >
                        
                </div>
                    
                <div class="form-group label_input">
                        <label for="updated_at" class="updated_form--label">Ngày Kết Thúc : <span style="color:red">*</span> </label>
                        <input type="date" class="form-control updated_form--input" id="updated_at" name ="tg_ket_thuc" placeholder="" value="{{$ud -> tg_ket_thuc}}">
                        
                </div>
        
            
        
                <div class="updated_form--tools">
                        <button  type="submit" class="btn btn-primary updated_button" name="updated_button"><i class="fa-regular fa-floppy-disk" style="font-size: 1rem"></i></button>
        
                </div>
            </form>
        @else
            <p>Lỗi...</p>
        @endif

        <div class="back_room">
            <a href="{{ route('admin.special_offers')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
        </div>

        <script>
            document.getElementById("updated_form").addEventListener('submit' , function(event){
                const ten_ud = document.getElementById('ten_ud').value;
                const giam = document.getElementById('giam').value;
                const tg_ap_dung = document.getElementById('created_at').value;
                const tg_ket_thuc = document.getElementById('updated_at').value;

                if(ten_ud === "" || giam === "" || tg_ap_dung === "" || tg_ket_thuc === "" ){
                    event.preventDefault();
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