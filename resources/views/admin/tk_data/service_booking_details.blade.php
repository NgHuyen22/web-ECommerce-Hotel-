@extends('layouts.admin_home')
    @section('service_booking_details')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('admin/ad_css/statistical/service_booking_details.css')}}">
        </head>
        <body>
          
            @if ($month->isNotEmpty())
            {{-- Phân trang --}}
            <nav aria-label="Page navigation example">
                <ul class="pagination custom-pagination">
                    {{-- Nút "Previous" --}}
                    @if ($month->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link prev" href="{{ $month->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif
            
                    {{-- Nút "Next" --}}
                    @if ($month->hasMorePages())
                        <li class="page-item">
                            <a class="page-link next" href="{{ $month->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link next" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            
    

            @php
                $totalTongDon = 0; 
            @endphp

            @foreach ($month as $monthData)
                <h4 style="color: rgb(248, 98, 98);text-align:center;margin-top: 2rem;margin-bottom: 3rem; font-weight: bold">Tháng {{ $monthData->month }}</h4>
                <table class="table update_room--table">
                    <thead>
                        <tr>
                            <th scope="col" class="align-middle" style="text-align:center">STT</th>
                            <th scope="col" class="align-middle" style="text-align:center">ID Dịch Vụ</th>
                            <th scope="col" class="align-middle" style="text-align:center">Tên Dịch Vụ</th>
                            <th scope="col" class="align-middle" style="text-align:center">Loại Dịch Vụ</th>
                            <th scope="col" class="align-middle" style="text-align:center">Tổng Doanh Thu</th>
                            <th scope="col" class="align-middle" style="text-align:center">Số Lượt Đặt</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody class="update_room--tbody">
                        @php $count = 1; $stt = 0; @endphp
                        @foreach ($service_month as $service)
                            @if ($service->month == $monthData->month)
                                <tr>
                                    <th scope="row" class="align-middle" style="text-align:center">{{ $count++ }}</td>
                                    <td class="align-middle" style="text-align:center;">{{ $service->id_dv }}</td>
                                    <td class="align-middle" style="text-align:center;">{{ $service->ten_dv }}</td>
                                    <td class="align-middle" style="text-align:center;">{{ $service->ten_ldv }}</td>
                                    <td class="align-middle" style="text-align:center;color:#efad6c;font-weight:bold">{{ number_format($service->tong_dt, 0, ',', '.') }} VND</td>        
                                    <td class="align-middle" style="text-align:center;">{{ $service->so_luot_dat }}</td>
                                    <td class="align-middle" style="text-align:center;"><a class="detail" href="{{ route('admin.service_booking_schedule',[ $monthData->month, $service->id_dv ]) }}">Chi tiết</a></td>
                                </tr>

                                @php
                                    $stt = $count -1;
                                @endphp
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <p class="total_bill"><span style="font-weight: bold; color: rgb(204, 53, 53)">Tổng : </span> {{ $stt }}</p>
                
                {{-- @foreach ($roomStatsByMonth as $stats)
                    @if ($stats['month'] == $monthData->month)
                        <div class="room-stats summary_info">
                            <h5 style="color: rgb(34, 139, 34);font-weight: bold;margin-bottom: 1rem">Thông tin tóm tắt :</h5>
                            <p ><strong style=" color: #d9534f; font-weight: bold;">Dịch vụ đặt nhiều nhất:</strong> {{ $stats['maxBookingRoom']->ten_dv ?? 'Không có' }} (Số lượt đặt: {{ $stats['maxBookingRoom']->so_luot_dat ?? 0 }})</p>
                            <p><strong style=" color: #d9534f; font-weight: bold;">Dịch vụ đặt ít nhất:</strong > {{ $stats['minBookingRoom']->ten_dv ?? 'Không có' }} (Số lượt đặt: {{ $stats['minBookingRoom']->so_luot_dat ?? 0 }})</p>
                            <p><strong style=" color: #d9534f; font-weight: bold;">Dịch vụ không được đặt:</strong> 
                                @if ($stats['unbookedRooms']->isNotEmpty())
                                    {{ $stats['unbookedRooms']->pluck('ten_dv')->join(', ') }}
                                @else
                                    Không có
                                @endif
                            </p>
                        </div>
                    @endif
                @endforeach --}}

                @foreach ($roomStatsByMonth as $stats)
                    @if ($stats['month'] == $monthData->month)
                        <div class="room-stats summary_info">
                            <h5 style="color: rgb(34, 139, 34); font-weight: bold; margin-bottom: 1rem">Thông tin tóm tắt :</h5>

                            <!-- Dịch vụ đặt nhiều nhất -->
                            <p><strong style="color: #d9534f; font-weight: bold;">Dịch vụ đặt nhiều nhất:</strong></p>
                            <ul>
                                @if ($stats['maxBookingRoom']->isNotEmpty())
                                    @foreach ($stats['maxBookingRoom'] as $maxRoom)
                                        <li>{{ $maxRoom->ten_dv }} (Số lượt đặt: {{ $maxRoom->so_luot_dat }})</li>
                                    @endforeach
                                @else
                                    <li>Không có</li>
                                @endif
                            </ul>

                            <!-- Dịch vụ đặt ít nhất -->
                            <p><strong style="color: #d9534f; font-weight: bold;">Dịch vụ đặt ít nhất:</strong></p>
                            <ul>
                                @if ($stats['minBookingRoom']->isNotEmpty())
                                    @foreach ($stats['minBookingRoom'] as $minRoom)
                                        <li>{{ $minRoom->ten_dv }} (Số lượt đặt: {{ $minRoom->so_luot_dat }})</li>
                                    @endforeach
                                @else
                                    <li>Không có</li>
                                @endif
                            </ul>

                            <!-- Dịch vụ không được đặt -->
                            <p><strong style="color: #d9534f; font-weight: bold;">Dịch vụ không được đặt:</strong>
                                @if ($stats['unbookedRooms']->isNotEmpty())
                                    {{ $stats['unbookedRooms']->pluck('ten_dv')->join(', ') }}
                                @else
                                    Không có
                                @endif
                            </p>
                        </div>
                    @endif
                @endforeach

            @endforeach
        @else
           <tr>
                <td colspan="4" class="no_data">Không có dữ liệu ..</td>
           </tr>
        @endif

        <div class="back_room">
            <a href="{{ route('admin.index')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
         </div>

        </body>
        </html>
    @endsection