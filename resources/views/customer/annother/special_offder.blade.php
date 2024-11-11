@extends('layouts.customer_home')
    @section('specialOffers')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('customer/ctm_css/special_offer/special_offer.css')}}">
        </head>
        <body>
            <div class="breadcrumb-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-text">
                                {{-- <h2>Chi Tiết Phòng</h2> --}}
                                <div class="bt-option">
                                    <a href="{{ route('customer.index')}}">Trang Chủ</a>
                                    <span>Ưu Đãi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @if($specialOffers ->isNotEmpty())
                <div class="wrapper_ud">
                    @foreach ($specialOffers as $spo)
                        <div class="specialOffers">
                            <div class="spo_flex">
                                <p><span style="font-weight:bold;">Ưu đãi : </span><span>{{ $spo -> ten_ud}}</span></p>
                                <p><span style="font-weight:bold;">Áp dụng dịch vụ : </span><span>{{ $spo -> ten_dv}}</span></p>
                            </div>
                            <div class="spo_flex">
                                <p><span style="font-weight:bold;">Thời gian áp dụng: </span><span>{{ $spo -> tg_ap_dung}}</span></p>
                                <p><span style="font-weight:bold;">Thời gian kết thúc : </span><span>{{ $spo -> tg_ket_thuc}}</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="wrapper_ud">
                    <p>Không có dữ liệu..</p>
                </div>
            @endif
                 --}}


            
                <section class="testimonial-section spad special_of">
                    <div class="container">
                    
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title">
                                        <span>Chỉ Có Tại HazBin </span>
                                        <h2>Ưu Đãi Đặc Biệt</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="testimonial-slider owl-carousel">
                                        @if($specialOffers ->isNotEmpty())
                                            @foreach ($specialOffers as $spo)
                                                <div class="ts-item">
                                                    <p style="font-weight:bold; color:rgb(43, 172, 110)">{{ $spo -> ten_ud}}</p>
                                                    <p><span style="font-weight:bold;">Áp dụng dịch vụ : </span><span style="color: rgb(220, 169, 74)">{{ $spo -> ten_dv}}</span></p>
                                                    <div class="ti-author time">
                                                        <h5><span >Thời gian áp dụng : </span><span style="font-weight:bold;">{{ \Carbon\Carbon::parse($spo -> tg_ap_dung)->format('d-m-Y')}}  </span></h5>
                                                        <div class="rating">
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star-half_alt"></i>
                                                        </div>
                                                        
                                                        <h5><span>Thời gian kết thúc : </span><span  style="font-weight:bold;">{{ \Carbon\Carbon::parse($spo -> tg_ket_thuc)->format('d-m-Y')}}</span></h5>
                                                    </div>
                                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlRge8VJLqr7U-qQT7bdDtzz-uX0doe0z0JQ&s" alt=""  class="small-image">
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Chưa có ưu đãi...</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                    </div>
                </section>
        </body>
        </html>
    @endsection