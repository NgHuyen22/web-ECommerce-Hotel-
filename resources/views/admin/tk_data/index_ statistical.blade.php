@extends('layouts.admin_home')
    @section('index_statistical')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('admin/ad_css/statistical/index.css')}}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


    </head>
    <body>  
        <main class="content">
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3">Thống Kê Số Liệu <span style="color:rgb(237, 88, 88)">{{ $currentMonth}} -  {{ $currentYear}}</span></h1>
                <div class="row">
                    <div class="col-xl-6 col-xxl-5 d-flex">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Đặt Phòng</h5>
                                                </div>
    
                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="check-square"></i> 
                                                    </div>
                                                </div>
                                            </div>
                                            <h2 class="mt-1 mb-3">
                                                {{-- @if($totalRevenue < 1000000)
                                                    ${{ number_format($totalRevenue, 0, ',', '.') }}
                                                    @elseif($totalRevenue >= 1000000 && $totalRevenue < 1000000000)
                                                    ${{ number_format($totalRevenue / 1000000, 1, ',', '.') }} Triệu
                                                @else
                                                    ${{ number_format($totalRevenue / 1000000000, 1, ',', '.') }} Tỷ
                                                @endif --}}
                                                
                                                ${{ number_format($totalRevenue, 0, ',', '.') }}
                                            </h2>
                                            <div class="mb-0">
                                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a href="{{ route('admin.room_booking_details')}}" class="detail">Xem chi tiết</a></span>
                                                {{-- <span class="text-muted">Since last week</span> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Khách hàng</h5>
                                                </div>
    
                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{$totalCTM}}</h1>
                                            <div class="mb-0">
                                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                     <a href="{{ route('admin.slkh_index')}}" class="detail">Xem chi tiết</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Đặt Dịch Vụ</h5>
                                                </div>
    
                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="shopping-cart"></i>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <h2 class="mt-1 mb-4">
                                                {{-- @if($totalSV < 1000000) 
                                                    ${{ number_format($totalSV, 0, ',', '.') }}
                                                    @elseif($totalSV >= 1000000 && $totalSV < 1000000000)
                                                    ${{ number_format($totalSV / 1000000, 1, ',', '.') }} Triệu
                                                @else
                                                    ${{ number_format($totalSV / 1000000000, 1, ',', '.') }} Tỷ
                                                @endif --}}

                                                ${{ number_format($totalSV, 0, ',', '.') }}
                                            </h2>

                                            <div class="mb-0">
                                                {{-- <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                                                <span class="text-muted">Since last week</span> --}}
                                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a href="{{ route('admin.service_booking_details')}}" class="detail">Xem chi tiết</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Tổng doanh thu</h5>
                                                </div>
    
                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="dollar-sign"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h2 class="mt-1 mb-4">
                                                ${{ number_format($total, 0, ',', '.') }}
                                            </h2>
                                            <div class="mb-0">
                                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a href="#" class="detail"></a>.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-7">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Tỷ lệ đặt phòng lặp lại</h5>
                            </div>
                            <div class="card-body d-flex">
                                <div class="align-self-center w-100">
                                    <div class="py-3">
                                        <div class="chart chart-xs">
                                            <canvas id="chartjs-dashboard-pie-2"></canvas>
                                        </div>
                                    </div>
                        
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Khách quay lại</td>
                                                <td class="text-end">{{$repeat_ctm}}  
                                                 
                                                        ({{ ($rateReturnCTM) }}%)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Khách không quay lại</td>
                                                    <td class="text-end">{{$total_ctm_lastMonth - $repeat_ctm}}
                                                        ({{ (100 - $rateReturnCTM) }}%)
          
                                                </td>
                                            </tr>   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}Ư

                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tổng doanh thu</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-line"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <script>
                    // Truyền dữ liệu từ PHP sang JavaScript dưới dạng JSON
                    var revenueData = @json($total);
                
                    console.log("Dữ liệu revenueData:", revenueData);
                    console.log("Kiểu dữ liệu revenueData:", typeof revenueData);
                
                    // Kiểm tra nếu revenueData là mảng và không rỗng
                    if (Array.isArray(revenueData) && revenueData.length > 0) {
                        const labels = revenueData.map(data => `Tháng ${data.month}`);
                        const data = revenueData.map(data => parseInt(data.tong_tien));
                
                        const ctx = document.getElementById('chartjs-dashboard-line').getContext('2d');
                        const myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Tổng doanh thu',
                                    data: data,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    } else {
                        console.error("Dữ liệu revenueData không phải là mảng hợp lệ hoặc rỗng:", revenueData);
                    }
                </script>
                 --}}
                <div class="wrapper_chart" >
                    <canvas id="chart-options-example"></canvas>
                </div>
                <script>
                    // document.addEventListener('DOMContentLoaded', function () {
                        var totalData = @json($tongDT);
                        console.log("Dữ liệu totalData:", totalData);

                        if (Array.isArray(totalData)) {
                            const labels = totalData.map(item => "Tháng " + item.month); 
                            const dataValues = totalData.map(item => parseInt(item.tong_tien)); 
                            const dataChartOptionsExample = {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Doanh Thu',
                                        data: dataValues,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgb(255, 144, 144)',
                                            'rgb(153, 210, 244)',
                                            'rgb(248, 199, 255)',
                                            'rgb(255, 240, 129)',
                                            '#ffcdcd',
                                            'rgb(183, 255, 148)'
                                        ],
                                        borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgb(252, 120, 120)',
                                            'rgb(101, 189, 240)',
                                            'rgb(234, 166, 243)',
                                            'rgb(237, 223, 112)',
                                            '#fbbaba',
                                            'rgb(157, 237, 118)'
                                        ],
                                        borderWidth: 1,
                                    }],
                                },
                                options: {
                                    scales: {
                                        x: {
                                            ticks: { color: '#4285F4' },
                                        },
                                        y: {
                                            ticks: { color: '#f44242' },
                                        },
                                    },
                                },
                            };
                            
                            const chartElement = document.getElementById('chart-options-example');
                            if (chartElement) {
                                new Chart(chartElement, dataChartOptionsExample);
                            } else {
                                console.error('Canvas element with id "chart-options-example" not found');
                            }
                        } else {
                            console.error('totalData is not an array or is null:', totalData);
                        }
                </script>
                

                {{-- <div class="row">
                   
                </div>
                 --}}
{{--                 
                <script>
                  document.addEventListener("DOMContentLoaded", function () {
                    const ctx = document.getElementById('chartjs-dashboard-pie-2').getContext('2d');
                    const rateReturnCTM = {{ json_encode($rateReturnCTM) }};
                    const nonReturnCTM = 100 - rateReturnCTM;
                    console.log(rateReturnCTM, nonReturnCTM);

                    // Phá hủy biểu đồ cũ nếu đã tồn tại
                    if (window.pieChart2) {
                        window.pieChart2.destroy();
                    }

                    // Khởi tạo biểu đồ mới với dữ liệu và màu sắc đã yêu cầu
                    window.pieChart2 = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Khách quay lại', 'Khách không quay lại'],
                            datasets: [{
                                data: [rateReturnCTM, nonReturnCTM],
                                backgroundColor: ['#007bff', '#dc3545'], // Xanh cho khách quay lại, đỏ cho khách không quay lại
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            const data = tooltipItem.dataset.data;
                                            const total = data.reduce((acc, value) => acc + value, 0);
                                            const value = data[tooltipItem.dataIndex];
                                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;

                                            // Trả về giá trị phần trăm kèm dấu '%'
                                            return `${tooltipItem.label}: ${percentage}%`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
                </script> --}}
                
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const ctx = document.getElementById('chartjs-dashboard-pie-2').getContext('2d');
                        const rateReturnCTM = {{ json_encode($rateReturnCTM) }}; // Tỷ lệ khách quay lại
                        const rateNonReturnCTM = 100 - rateReturnCTM; // Tỷ lệ khách không quay lại
                        console.log(rateNonReturnCTM);
                        // Phá hủy biểu đồ cũ nếu đã tồn tại
                        if (window.pieChart2) {
                            window.pieChart2.destroy();
                        }
                
                        // Khởi tạo biểu đồ mới với dữ liệu và màu sắc đã yêu cầu
                        window.pieChart2 = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Khách quay lại', 'Khách không quay lại'],
                                datasets: [{
                                    data: [rateReturnCTM, rateNonReturnCTM],
                                    backgroundColor: ['#007bff', '#dc3545'], // Xanh cho khách quay lại, đỏ cho khách không quay lại
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, ctx) {
                                            const total = ctx.dataset.data.reduce((acc, value) => acc + value, 0);
                                            const percentage = ((value / total) * 100).toFixed(1); // Tính phần trăm
                                            const label = ctx.chart.data.labels[ctx.dataIndex]; // Lấy nhãn tương ứng
                                            return `${label}: ${percentage}%`; // Hiển thị nhãn với tỷ lệ phần trăm
                                        },
                                        color: '#fff', // Màu chữ
                                        font: {
                                            weight: 'bold', // Độ đậm của chữ
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (tooltipItem) {
                                                const data = tooltipItem.dataset.data;
                                                const total = data.reduce((acc, value) => acc + value, 0);
                                                const value = data[tooltipItem.dataIndex];
                                                const percentage = ((value / total) * 100).toFixed(1); // Tính phần trăm
                                                return `${tooltipItem.label}: ${percentage}%`; // Hiển thị phần trăm trong tooltip
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'top',
                                    }
                                }
                            }
                        });
                    });
                </script>
                
    
                
                {{-- <div class="row">
                    <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
    
                                <h5 class="card-title mb-0">Latest Projects</h5>
                            </div>
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="d-none d-xl-table-cell">Start Date</th>
                                        <th class="d-none d-xl-table-cell">End Date</th>
                                        <th>Status</th>
                                        <th class="d-none d-md-table-cell">Assignee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Project Apollo</td>
                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                        <td><span class="badge bg-success">Done</span></td>
                                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                    </tr>
                                    <tr>
                                        <td>Project Fireball</td>
                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                        <td class="d-none d-md-table-cell">William Harris</td>
                                    </tr>
                                    <tr>
                                        <td>Project Hades</td>
                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                        <td><span class="badge bg-success">Done</span></td>
                                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                    </tr>
                                    <tr>
                                        <td>Project Nitro</td>
                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                        <td><span class="badge bg-warning">In progress</span></td>
                                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                    </tr>
                                    <tr>
                                        <td>Project Phoenix</td>
                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                        <td><span class="badge bg-success">Done</span></td>
                                        <td class="d-none d-md-table-cell">William Harris</td>
                                    </tr>
                                    <tr>
                                        <td>Project X</td>
                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                        <td><span class="badge bg-success">Done</span></td>
                                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                    </tr>
                                    <tr>
                                        <td>Project Romeo</td>
                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                        <td><span class="badge bg-success">Done</span></td>
                                        <td class="d-none d-md-table-cell">Christina Mason</td>
                                    </tr>
                                    <tr>
                                        <td>Project Wombat</td>
                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                        <td><span class="badge bg-warning">In progress</span></td>
                                        <td class="d-none d-md-table-cell">William Harris</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
    
                                <h5 class="card-title mb-0">Monthly Sales</h5>
                            </div>
                            <div class="card-body d-flex w-100">
                                <div class="align-self-center chart chart-lg">
                                    <canvas id="chartjs-dashboard-bar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
    
            </div>
        </main>
    </body>
    </html>
    @endsection