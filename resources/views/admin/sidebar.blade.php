<nav id="sidebar" class="sidebar js-sidebar" >
    <div class="sidebar-content js-simplebar sidebar2">
        <a class="sidebar-brand" href="index.html">
            <img src="{{asset("image/logo.png")}}" alt="hotel_icon" srcset="" class="icon"> 
            {{-- <span class="align-middle" style="margin-left: 1rem">ADMIN</span> --}}
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Hệ thống
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link sb_link" href="{{route('admin.index')}}">
      <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Trang chủ</span>
    </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-profile.html">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Xem thông tin</span>
                </a>
            </li> --}}

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.logout')}}">
                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Đăng xuất</span>
                </a>
            </li>


         
            <li class="sidebar-header">
                    Quản lý
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.service_management')}}">
                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Quản lý dịch vụ</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.booking_management')}}">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Quản lý đặt phòng</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.update_room') }}">
                  <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Cập nhật phòng</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.bill_index')}}">
                    <i class="fa-regular fa-money-bill-1"></i> <span class="align-middle">Cập nhật hóa đơn</span>
                </a>
            </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.special_offers')}}">
                    <i class="fa-regular fa-star"></i><span class="align-middle">Cập nhật ưu đãi</span>
                </a>
            </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="ui-cards-sbs.html">
                    <i class="fa-regular fa-comment"></i> <span class="align-middle">Quản lý các đánh giá</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-cards.html">
                    <i class="fa-regular fa-address-book"></i><span class="align-middle">Quản lý liên hệ</span>
                </a>
            </li>


            <li class="sidebar-item">
             <a class="sidebar-link" href="icons-feather.html">
                <i class="fa-solid fa-users"></i><span class="align-middle">QLTT khách hàng</span>
            </a>
            </li>

            <li class="sidebar-header">
                Thống kê
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Thống kê</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="" class="btn btn-primary">Upgrade to Pro</a>
                </div>
            </div>
        </div>
    </div>
</nav>