@extends('layouts.customer_home')
    @section('news')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <style>
                .news-item {
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }
                .news-item:hover {
                    transform: scale(1.05);
                    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
                }
                .news-title {
                    font-size: 1.2rem;
                    font-weight: bold;
                    color: #007bff;
                }
                .news-title:hover {
                    text-decoration: underline;
                    color: #0056b3;
                }
                .news-date {
                    color: #6c757d;
                    font-size: 0.9rem;
                }
                .sidebar-title {
                    font-weight: bold;
                    margin-bottom: 1rem;
                    font-size: 1.2rem;
                }
                .sidebar-news {
                    margin-bottom: 1rem;
                }
                .sidebar-news img {
                    width: 100%;
                    height: auto;
                    margin-bottom: 0.5rem;
                }
                .sidebar-link {
                    color: #007bff;
                    text-decoration: none;
                }
                .sidebar-link:hover {
                    color: #0056b3;
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>   
            <div class="container my-5">
                <h2 class="mb-4">Tin Tức Liên Quan</h2>
                <div class="row">
                    <!-- Bài viết chính -->
                    <div class="col-lg-8">
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            <!-- Tin tức 1 -->
                            <div class="col">
                                <div class="card news-item h-100">
                                    <a href="https://www.marriott.com/hotels/travel/parmc-paris-marriott-champs-elysees-hotel/" class="text-decoration-none" target="_blank">
                                        <img src="https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Paris Marriott Champs Elysees" width="200px" height="300px">
                                        <div class="card-body">
                                            <h5 class="news-title">Khách sạn Paris Marriott Champs Elysees</h5>
                                            <p class="news-date">Ngày đăng: 05/11/2024</p>
                                            <p class="card-text">Trải nghiệm đẳng cấp tại đại lộ Champs Elysees nổi tiếng với các phòng nghỉ sang trọng và nhà hàng đẳng cấp của Marriott.</p>
                                            <a href="https://www.marriott.com/hotels/travel/parmc-paris-marriott-champs-elysees-hotel/" class="btn btn-primary mt-2" target="_blank">Xem thêm</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- Tin tức 2 -->
                            <div class="col">
                                <div class="card news-item h-100">
                                    <a href="https://www.hilton.com/en/hotels/laxchhh-hilton-checkers-los-angeles/" class="text-decoration-none" target="_blank">
                                        <img src="https://images.pexels.com/photos/1001965/pexels-photo-1001965.jpeg" class="card-img-top" alt="Hilton Checkers Los Angeles" width="200px" height="300px">
                                        <div class="card-body">
                                            <h5 class="news-title">Hilton Checkers Los Angeles ra mắt dịch vụ mới</h5>
                                            <p class="news-date">Ngày đăng: 10/10/2024</p>
                                            <p class="card-text">Khám phá sự tiện nghi và hiện đại của khách sạn Hilton với dịch vụ chăm sóc khách hàng mới tại trung tâm Los Angeles.</p>
                                            <a href="https://www.hilton.com/en/hotels/laxchhh-hilton-checkers-los-angeles/" class="btn btn-primary mt-2" target="_blank">Xem thêm</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- Tin tức 3 -->
                            <div class="col">
                                <div class="card news-item h-100">
                                    <a href="https://www.ritzcarlton.com/en/hotels/asia/shanghai-pudong" class="text-decoration-none" target="_blank">
                                        <img src="https://images.pexels.com/photos/261388/pexels-photo-261388.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="The Ritz-Carlton Shanghai Pudong" width="200px" height="300px">
                                        <div class="card-body">
                                            <h5 class="news-title">The Ritz-Carlton Shanghai Pudong đạt giải thưởng quốc tế</h5>
                                            <p class="news-date">Ngày đăng: 15/08/2024</p>
                                            <p class="card-text">The Ritz-Carlton Shanghai Pudong được vinh danh với giải thưởng khách sạn sang trọng bậc nhất khu vực châu Á.</p>
                                            <a href="https://www.ritzcarlton.com/en/hotels/asia/shanghai-pudong" class="btn btn-primary mt-2" target="_blank">Xem thêm</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- Tin tức 4 -->
                            <div class="col">
                                <div class="card news-item h-100">
                                    <a href="https://www.fourseasons.com/kyoto/" class="text-decoration-none" target="_blank">
                                        <img src="https://images.pexels.com/photos/262048/pexels-photo-262048.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Four Seasons Hotel Kyoto" width="200px" height="300px">
                                        <div class="card-body">
                                            <h5 class="news-title">Four Seasons Kyoto - Điểm đến thư giãn tại Nhật Bản</h5>
                                            <p class="news-date">Ngày đăng: 20/09/2024</p>
                                            <p class="card-text">Khám phá không gian yên tĩnh và sang trọng tại khách sạn Four Seasons Kyoto, điểm dừng chân lý tưởng giữa lòng Kyoto.</p>
                                            <a href="https://www.fourseasons.com/kyoto/" class="btn btn-primary mt-2" target="_blank">Xem thêm</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sidebar các bản tin -->
                    <div class="col-lg-4">
                        <h3 class="sidebar-title">Các Bản Tin Khác</h3>
                        <!-- Sidebar News Item -->
                        <div class="sidebar-news">
                            <a href="https://www.mandarinoriental.com/bangkok/chao-phraya-river/luxury-hotel" target="_blank">
                                {{-- <img src="https://via.placeholder.com/150x100" alt="Mandarin Oriental Bangkok"> --}}
                                <p class="sidebar-link">Mandarin Oriental Bangkok - Khách sạn cao cấp ven sông Chao Phraya.</p>
                            </a>
                        </div>
                        <div class="sidebar-news">
                            <a href="https://www.peninsula.com/en/tokyo/5-star-luxury-hotel-ginza" target="_blank">
                                {{-- <img src="https://via.placeholder.com/150x100" alt="The Peninsula Tokyo"> --}}
                                <p class="sidebar-link">The Peninsula Tokyo với phòng nghỉ sang trọng tại Ginza, Tokyo.</p>
                            </a>
                        </div>
                        <div class="sidebar-news">
                            <a href="https://www.shangri-la.com/singapore/shangrila/" target="_blank">
                                {{-- <img src="https://via.placeholder.com/150x100" alt="Shangri-La Hotel Singapore"> --}}
                                <p class="sidebar-link">Trải nghiệm thiên nhiên tươi đẹp tại Shangri-La Singapore.</p>
                            </a>
                        </div>
                        <div class="sidebar-news">
                            <a href="https://www.bulgarihotels.com/en_US/dubai" target="_blank">
                                {{-- <img src="https://via.placeholder.com/150x100" alt="Bulgari Resort Dubai"> --}}
                                <p class="sidebar-link">Bulgari Resort Dubai - Sự kết hợp giữa phong cách Ý và vẻ đẹp của Dubai.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>  
    @endsection