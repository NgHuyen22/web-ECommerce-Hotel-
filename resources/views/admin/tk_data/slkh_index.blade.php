@extends('layouts.admin_home')
    @section('slkh_index')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('admin/ad_css/statistical/slkh_index.css')}}">
        </head>
        <body>
        
            @if ($month->isNotEmpty())
            <div class="tool"> 
                <nav aria-label="Page navigation example">
                    <ul class="pagination custom-pagination">
         
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
                
                {{-- <button type="button" class="btn btn-dark ctm_list">Danh sách khách hàng thân thuộc</button> --}}
            </div>
            
            @foreach ($month as $monthData)
                <h4 style="color: rgb(248, 98, 98);text-align:center;margin-top: 2rem;margin-bottom: 3rem; font-weight: bold">Tháng {{ $monthData->month }}</h4>
                <table class="table update_room--table">
                    <thead>
                        <tr>
                            <th scope="col" class="align-middle" style="text-align:center">STT</th>
                            <th scope="col" class="align-middle" style="text-align:center">ID Khách Hàng</th>
                            <th scope="col" class="align-middle" style="text-align:center">Tên Khách Hàng</th>
                            <th scope="col" class="align-middle" style="text-align:center">Số lần đặt phòng</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody class="update_room--tbody">
                        @php $count = 1; @endphp
                        @foreach ($getUS as $us)
                            @if ($us->month == $monthData->month)
                                <tr>
                                    <th scope="row" class="align-middle" style="text-align:center">{{ $count++ }}</td>
                                    <td class="align-middle" style="text-align:center;">{{ $us->id }}</td>
                                    <td class="align-middle" style="text-align:center;;color:#efad6c;font-weight:bold">{{ $us->ho_ten }}</td>
                                    <td class="align-middle" style="text-align:center;">{{ $us->total_bookings }}</td>
                                    {{-- <td class="align-middle" style="text-align:center;"><a class="detail" href="{{ route('admin.slkh_details',[ $monthData->month, $us->id ]) }}">Chi tiết</a></td> --}}
                                </tr>     
                            @endif
                        @endforeach
                    </tbody>
                </table>
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