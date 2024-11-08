@extends('layouts.admin_home')
    @section('see_review_detail')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/manage_review/see_review_detail.css')}}">
    </head>
    <body>   
        <div class="select_by">
            <form action="{{ route('admin.see_review_details', $id_lp) }}" id="select_price" class ="select_price" method="POST">
                @csrf
                <select class="form-select item_price" aria-label="Default select example" name="value" style="width: 86% ">
                    <option value="">Tất cả</option>
                    <option value="1" {{ (isset($rating) && $rating == 1) ? 'selected' : '' }}>1 sao</option>
                    <option value="2" {{ (isset($rating) && $rating == 2) ? 'selected' : '' }}>2 sao</option>
                    <option value="3" {{ (isset($rating) && $rating == 3) ? 'selected' : '' }}>3 sao</option>
                    <option value="4" {{ (isset($rating) && $rating == 4) ? 'selected' : '' }}>4 sao</option>
                    <option value="5" {{ (isset($rating) && $rating == 5) ? 'selected' : '' }}>5 sao</option>
                </select>
                  <button type="submit" class="submit_price" style=" width: 10%;height: 4.5vh">
                     Sắp xếp
                </button>
            </form>
        </div>

        <div class="wrapper_flex">
            <div class="wrapper_srd">
                @if($showEV ->isNotEmpty())
                    @foreach ($showEV as $ev)        
                    <div class="item_srd {{ $ev->status === 0 ? 'hidden' : '' }}" id="review-{{$ev->id_danh_gia}}">
                        <div class="content_srd">
                            <span style="font-weight:bold;font-size: 0.8rem; color:rgb(227, 193, 148)">{{ $ev->updated_at }}</span>
                            <div class="rating_user">
                                <h5 style="font-weight:bold;margin-top: 0.7rem">{{ $ev->ho_ten }}</h5>   
                                <div class="rating">
                                    @php
                                        $fullStars = floor($ev->diem); 
                                        $emptyStars = 5 - $fullStars;
                                    @endphp
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fa fa-star starIs" style="color: #f4c725;"></i>
                                    @endfor
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="fa fa-star starIs" style="color: #cccccc;"></i>
                                    @endfor
                                </div>
                            </div>              
                            <p>{{ $ev->noi_dung }}</p>
                        </div>
                        <div class="icon-hide_srd">
                            <button type="button" onclick="hiddenEV('{{ route('admin.hide_review', [$ev->id_danh_gia]) }}', {{ $ev->id_danh_gia }})">
                                <i class="fa-solid fa-eye-slash" style="color: #11408d;"></i>
                            </button>
                        </div>
                    </div>
                    
                    <script>
                        // function hiddenEV(url) {
                        //     window.location.href = url;
                        // }

                        function hiddenEV(url, reviewId) {
                            fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ status: 0 })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById(`review-${reviewId}`).classList.add('hidden');
                                } else {
                                    console.error('Error: Unable to hide the review');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                        }

                    </script>
                    @endforeach
                @else
                    <p>Không có đánh giá..</p>
                @endif
            </div>  
        </div>
        
        <div class="back_room">
            <a href="{{ route('admin.manage_reviews')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
        </div>
    </body>
    </html>
      
    @endsection