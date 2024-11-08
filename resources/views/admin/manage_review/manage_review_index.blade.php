@extends('layouts.admin_home')
    @section('manage_reviews')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/manage_review/manage_review_index.css')}}">
    </head>
    <body>
        @if (Session::has('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        text: "{{ Session::get('error') }}",
                        showConfirmButton: false,
                        timer: 2500
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
        <div class="wrapper_table">
            <table class="table table-striped evaluate_table">
                <thead>
                    <tr>
                      <th scope="col" style="text-align:center;">STT</th>
                      <th scope="col" style="text-align:center;">Loại Phòng</th>
                      <th scope="col" style="text-align:center;">Đánh Giá</th>
                      <th scope="col" style="text-align:center;">Số lượt</th>
                      <th scope="col" colspan="2"></th>
                    </tr>
                </thead>
        
                <tbody>
                    @if($getRT->isNotEmpty())
                        @foreach ($getRT as $rt)
                            <tr>
                                <th scope="row" class="align-middle" style="text-align:center">{{ $loop->iteration }}</th>
                                <td class="align-middle" style="text-align:center;">{{ $rt->ten_lp }}</td>
                                
                                {{-- Lấy đánh giá cho loại phòng hiện tại nếu tồn tại --}}
                                @php
                                    $review = $getEV->firstWhere('loai_phong', $rt->id_lp);
                                    $rating = $review ? $review->danh_gia : 0;
                                    $count = $review ? $review->so_luot : 0;
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars >= 0.1 && $rating - $fullStars < 1);
                                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                @endphp
                                
                                {{-- Cột Đánh Giá --}}
                                <td class="align-middle" style="text-align:center;">
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fa-solid fa-star" style="color: #f4c725;"></i>
                                    @endfor
                                    @if ($hasHalfStar)
                                        <i class="fa-solid fa-star-half-alt" style="color: #f4c725;"></i>
                                    @endif
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="fa-solid fa-star" style="color: #cccccc;"></i>
                                    @endfor
                                    <span style="margin-left: 10px; font-weight: bold;">({{ number_format($rating, 1) }}/5)</span>
                                </td>
                                
                                {{-- Cột Số lượt --}}
                                <td class="align-middle" style="text-align:center;">{{ $count }} lượt</td>
                                
                                {{-- Cột Xem chi tiết --}}
                                @if($count > 0)
                                    <td class="align-middle" style="text-align:center;"><a href="{{ route('admin.see_review_details',[$rt->id_lp]) }}" class="more_detail">Xem chi tiết</a></td>
                                @else
                                    <td class="align-middle" style="text-align:center;"><p class="more_detail_dis">Xem chi tiết</p></td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="align-middle text-center">Không có dữ liệu..</td>
                        </tr>
                    @endif
                </tbody>                
            </table>      
        </div>
        
        <div class="back_room">
            <a href="{{ route('admin.index')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
        </div>
    </body>
    </html>
    @endsection