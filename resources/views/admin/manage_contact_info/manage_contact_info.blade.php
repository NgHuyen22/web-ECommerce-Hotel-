@extends('layouts.admin_home')
    @section('manage_contact_information')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('admin/ad_css/manage_contact_info/manage_contact_info.css')}}">
        </head>
        <body>
            @if (Session::has('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            text: "{{ Session::get('error') }}",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    </script>
                @endif

                @if(Session::has('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            text: "{{ Session::get('success') }}",
                            showConfirmButton: false,
                            timer: 2500
                        });
                    </script>
                @endif
                
            <ul class="nav nav-tabs tab_list" id="myTab" role="tablist">
                {{-- 1 --}}
                <li class="nav-item" role="presentation">
                  <button class="nav-link active nav_item_button" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                       Chưa xử lý
                    </button>
                </li> 
                {{-- 2 --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link nav_item_button1" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                       Đã xử lý
                    </button>
                </li>
            </ul>
             <div class="tab-content booking_form_list" id="myTabContent">
                <div class="tab-pane fade show active not_processed" id="home" role="tabpanel" aria-labelledby="home-tab"> 
                    <table class="table_npr">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">STT</th>
                                <th scope="col" style="text-align:center;">Họ Tên</th>
                                <th scope="col" style="text-align:center;">Giới Tính</th>
                                <th scope="col" style="text-align:center;">Địa Chỉ</th>
                                <th scope="col" style="text-align:center;">SDT</th>
                                <th scope="col" style="text-align:center;">Email</th>
                                <th scope="col" style="text-align:center;">Nội Dung Liên Hệ</th>
                                <th scope="col" style="text-align:center;">Ngày Tạo</th>
                                <th scope="col" colspan="3"></th>
                              </tr>
                        </thead>
                        <tbody>
                            @if($getContact ->count() > 0)
                                @php $count = 1; @endphp
                                @foreach ( $getContact as $ct )
                                    <tr>
                                        <td style="display: none" id="id_contact">{{ $ct -> id}}</td>
                                        <th scope="row" class="align-middle" style="text-align:justify">{{ $count++ }}</th>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> ho_ten }}</td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> gioi_tinh == 1 ? 'Nữ':'Nam' }}</td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> dia_chi}}</td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> sdt}}</td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> email}}</td>
                                        <td class="align-middle"style="text-align:center ;">
                                            <button class="detail" onclick="showEvaluateIsset('{{ $ct->noi_dung_ll }}')">
                                                Chi tiết
                                            </button>
                                        </td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> created_at}}</td>
                                        <td class="align-middle"style="text-align:center ;width: 10rem;">
                                            <div class="tool">
                                                <button type="submit" class="reply" onclick="showReply()">
                                                   Phản hồi
                                                </button> 
                                            @if(\Carbon\Carbon::parse($ct->created_at)->format('Y-m-d') == $current)
                                               <div class="new">
                                                    <p>Mới</p>
                                               </div>
                                            @endif
                                            </div>
                                        </td>   
                                        
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan ="11" class="align-middle text-center">Không có dữ liệu..</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if($getContact ->count() > 0)
                        <nav aria-label="Page navigation example">
                            <ul class="pagination room_pagination">
                                <!-- Previous Page Link -->
                                @if ($getContact->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $getContact->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @endif
                        
                                <!-- Pagination Elements -->
                                @foreach ($getContact->appends(request()->query())->links()->elements[0] as $page => $url)
                                    @if ($page == $getContact->currentPage())
                                        <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                        
                                <!-- Next Page Link -->
                                @if ($getContact->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $getContact->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif   
                </div>
    
                <div class="tab-pane fade not_processed" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table_npr">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">STT</th>
                                <th scope="col" style="text-align:center;">Họ Tên</th>
                                <th scope="col" style="text-align:center;">Giới Tính</th>
                                <th scope="col" style="text-align:center;">Địa Chỉ</th>
                                <th scope="col" style="text-align:center;">SDT</th>
                                <th scope="col" style="text-align:center;">Email</th>
                                <th scope="col" style="text-align:center;">Nội Dung Liên Hệ</th>
                                <th scope="col" style="text-align:center;">Ngày Tạo</th>
                              </tr>
                        </thead>
                        <tbody>
                            @if($getContact2 ->count() > 0)
                                @php $count = 1; @endphp
                                @foreach ( $getContact2 as $ct )
                                    <tr>
                                        <td style="display: none" id="id_contact">{{ $ct -> id}}</td>
                                        <th scope="row" class="align-middle" style="text-align:justify">{{ $count++ }}</th>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> ho_ten }}</td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> gioi_tinh == 1 ? 'Nữ':'Nam' }}</td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> dia_chi}}</td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> sdt}}</td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> email}}</td>
                                        <td class="align-middle"style="text-align:center    ;">
                                            <button class="detail" onclick="showEvaluateIsset('{{ $ct->noi_dung_ll }}')">
                                                Chi tiết
                                            </button>
                                        </td>
                                        <td class="align-middle"style="text-align:center    ;">{{ $ct -> created_at}}</td>
                                        <td class="align-middle"style="text-align:center    ;">                               
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan ="11" class="align-middle text-center">Không có dữ liệu..</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    @if($getContact2 ->count() > 0)
                        <nav aria-label="Page navigation example">
                            <ul class="pagination room_pagination">
                                <!-- Previous Page Link -->
                                @if ($getContact2->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $getContact2->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @endif
                        
                                <!-- Pagination Elements -->
                                @foreach ($getContact2->appends(request()->query())->links()->elements[0] as $page => $url)
                                    @if ($page == $getContact2->currentPage())
                                        <li class="page-item active"><a class="page-link page-link-css" href="#">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                        
                                <!-- Next Page Link -->
                                @if ($getContact2->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $getContact2->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif   
                </div>
             </div>

             <div class="back_room">
                <a href="{{ route('admin.index')}}"><i class="fa-solid fa-arrow-left back-icon" style=""></i></a>
            </div>

             <div id="evaluateModal" class="modal" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Phản Hồi Thông Tin Liên Hệ</h5>
                            <button type="button" class="close" onclick="hideEvaluate()">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p style="font-style: italic; color: rgb(229, 227, 227);">Nội dung phản hồi sẽ được gửi qua email đến khách hàng !!</p>                 
                            <textarea id="comment" type="text" placeholder="Nhập  nội dung phản hồi"></textarea>
                            <span id="created_at_ev"></span>
                            <div class="tool" id="tool">
                                <button id="" class="tool_button" onclick="send()">Gửi</button>
                            </div>
                        </div>

                        </div>                                
                    </div>
                </div>
            </div>

            <div id="evaluateModalIs" class="modal" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Chi Tiết Nội Dung Liên Lạc Từ Khách Hàng</h5>
                            <button type="button" class="close" onclick="hideEvaluateIs()">&times;</button>
                        </div>
                        <div class="modal-body">
                            <textarea id="commentIs" type="text"  readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>    

            <script>
                function showReply() {
                    document.getElementById("evaluateModal").style.display = "block";
                }

                function hideEvaluate() {
                    document.getElementById("evaluateModal").style.display = "none";
                }

                function send() {
                    const noi_dung = document.getElementById('comment').value;
                    const id_contact = document.getElementById('id_contact').innerText;
                    window.location.href = `{{ route('admin.reply_email') }}?id_contact=${encodeURIComponent(id_contact)}&reply=${encodeURIComponent(noi_dung)}`;
                }

                function showEvaluateIsset(noi_dung_ll) {
                    document.getElementById("evaluateModalIs").style.display = "block";
                    document.getElementById("commentIs").value = noi_dung_ll;
                }

                function hideEvaluateIs() {
                    document.getElementById("evaluateModalIs").style.display = "none";
                }
            </script>
        </body>
        </html>
    @endsection