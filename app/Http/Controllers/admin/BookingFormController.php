<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BookingForm;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Bill;
use Illuminate\Http\Request;

class BookingFormController extends Controller
{
    protected $bf;
    protected $rt;
    protected $r;
    protected $bill;
    public function __construct()
    {
        $this -> bf = new BookingForm();
        $this -> rt = new RoomType();
        $this -> r = new Room();
        $this -> bill = new Bill();
    }

    public function bf_detail($id_don){
        $details = $this -> bf -> getDetails($id_don);
        
        return view('admin.booking_management.bf_details', compact('details'));
    }

    public function approved($id_don, Request $rq){
    
        if($rq -> hidden_id_phong == null){
            return redirect() -> route('admin.booking_management') ->with('error', 'Vui lòng chọn phòng trước khi duyệt !');
        }else{
            $data = [
                'id_phong' => $rq -> hidden_id_phong,
                'tinh_trang' => 'Đã xác nhận',
           ];
        //    dd($data);
            $approved = $this -> bf -> approved($id_don,$data);
            if($approved == true){
                            $soNgay = $rq -> soNgay;
                            $gia_lp = $rq->gia;
                            $id_rt = $rq->id_rt;
                            $id_don = $rq->id_don;
                            $tong_tien = $soNgay * $gia_lp;
    
                                $dataBill =[
                                    'khach_hang' => $rq -> id_kh,
                                    'don_dat_phong' => $id_don,
                                    'phi_dv' => 0,
                                    'tre_han' => 0,
                                    'phi_them' => 0,
                                    'tong_tien' => $tong_tien,
                                    'phuong_thuc_tt' => NULL,
                                    'tien_kh_gui' => 0,
                                    'tien_thua' => 0,
                                    'trang_thai_hd' => "Chưa thanh toán",
                                    'status' => 1,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ];
    
                                $insertBill = $this -> bill -> insertBill($dataBill);
                            if($insertBill == true){
    
                                return redirect() -> route('admin.booking_management') ->with('success', 'Xác nhận thành công');
                            }
                            
            }else{
                return redirect() -> route('admin.booking_management') ->with('error', 'Lỗi , vui lòng thử lại sau !');
            }
        }
 
    }

    public function delete($id_don){
        $deleted = $this-> bf -> deleteForm($id_don);
        if($deleted == true){
            return redirect() -> route('admin.booking_management') ->with('success','Xóa đơn thành công');
        }else{
            return redirect() -> route('admin.booking_management') ->with('error','Lỗi, vui lòng thử lại sau !');

        }
        
    }

    public function view_booking_schedule(Request $rq){
        // $id_lp = $rq->get('id_lp');
        // $id_lp = $rq->id_lp;
        // $rooms = $this -> rt -> room($id_lp);
        // $bookings = $this -> bf -> checkBooking($id_lp);
        $roomTypes = $this -> rt -> getRoomType();
        // if ($rq->ajax()) {
        //     return response()->json([
        //         'rooms' => $rooms,
        //         'bookings' => $bookings,
        //     ]);
        // }
        // return view('admin.booking_management.calendar', compact('rooms', 'bookings','roomTypes'));
        return view('admin.booking_management.calendar', compact('roomTypes'));
    }
    public function booking_schedule( $id_lp){
        $rooms = $this -> rt -> room($id_lp);
        $bookings = $this -> bf -> checkBooking($id_lp);
        $roomTypes = $this -> rt -> getRoomType();

        return view('admin.booking_management.calendar', compact('rooms', 'bookings','roomTypes','id_lp'));
    }
    // public function view_booking_schedule() {
    //     // Lấy danh sách phòng và thông tin đặt phòng
    //     $rooms = $this->rt->room(3); // Lấy danh sách phòng loại 3
    //     $bookings = $this->bf->checkBooking(3); // Lấy thông tin đặt phòng loại 3
    //     // dd($bookings);
    //     // Khởi tạo danh sách sự kiện cho FullCalendar
    //     $totalRooms = $rooms->count();
    //     $events = [];
    //     foreach ($bookings as $booking) {
    //         // Kiểm tra số lượng phòng đã đặt cho khoảng thời gian này
    //         $bookedRooms = $bookings->where('ngay_nhan_phong', '<=', $booking->ngay_tra_phong)
    //                                 ->where('ngay_tra_phong', '>=', $booking->ngay_nhan_phong)
    //                                 ->count();

    //         $availableRooms = $totalRooms - $bookedRooms;
            
    //         // Kiểm tra nếu phòng đã đầy hay còn trống
    //         $color = $bookedRooms >= $totalRooms ? '#ff0000' : '#36cdef';
    
    //         // Thêm sự kiện vào danh sách
    //         $events[] = [
    //             'title' => $availableRooms > 0 ? "Còn trống: $availableRooms phòng" : "Đã đầy",
    //             'start' => $booking->ngay_nhan_phong,
    //             'end' => date('Y-m-d', strtotime($booking->ngay_tra_phong . ' +1 day')), // Để bao gồm cả ngày trả phòng
    //             'color' => $color,
    //         ];
    //     }
    
    //     return view('admin.booking_management.calendar', compact('events'));
    // }

    // public function view_booking_schedule() {
    //     // Lấy danh sách phòng và thông tin đặt phòng
    //     $rooms = $this->rt->room(1); // Lấy danh sách phòng loại 3
    //     $bookings = $this->bf->checkBooking(1); // Lấy thông tin đặt phòng loại 3
    //     // dd($bookings);
    //     // Khởi tạo danh sách sự kiện cho FullCalendar
    //     $totalRooms = $rooms->count();
    //     $events = [];
    //     $processedDates = []; // Mảng để lưu các khoảng ngày đã xử lý
    
    //     foreach ($bookings as $booking) {
    //         // Định dạng khoảng thời gian
    //         $startDate = $booking->ngay_nhan_phong;
    //         $endDate = $booking->ngay_tra_phong;
    //         $dateRangeKey = "$startDate:$endDate";
    
    //         // Bỏ qua nếu khoảng thời gian này đã được xử lý
    //         if (isset($processedDates[$dateRangeKey])) {
    //             continue;
    //         }
    
    //         // Kiểm tra số lượng phòng đã đặt cho khoảng thời gian này
    //         $bookedRooms = $bookings->where('ngay_nhan_phong', '<=', $endDate)
    //                                 ->where('ngay_tra_phong', '>=', $startDate)
    //                                 ->count();
    
    //         $availableRooms = $totalRooms - $bookedRooms;
            
    //         // Kiểm tra nếu phòng đã đầy hay còn trống
    //         $color = $availableRooms > 0 ? '#36cdef' : '#ff0000';
    
    //         // Thêm sự kiện vào danh sách
    //         $events[] = [
    //             'title' => $availableRooms > 0 ? "Còn trống: $availableRooms phòng" : "Đã đầy",
    //             'start' => $startDate,
    //             'end' => date('Y-m-d', strtotime($endDate . ' +1 day')), // Để bao gồm cả ngày trả phòng
    //             'color' => $color,
    //         ];
    
    //         // Đánh dấu khoảng thời gian này đã được xử lý
    //         $processedDates[$dateRangeKey] = true;
    //     }
    // // dd($events);
    //     return view('admin.booking_management.calendar', compact('events'));
    // }
    
    
}
