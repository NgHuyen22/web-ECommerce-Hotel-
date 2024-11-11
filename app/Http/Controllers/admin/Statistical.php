<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\BookingForm;
use App\Models\Service;
use App\Models\Bill;
use App\Models\RoomType;

class Statistical extends Controller
{
    protected $bf;
    protected $sv;
    protected $bill;
    protected $rt;
    public function __construct()
    {
        $this -> bf = new BookingForm();
        $this -> sv = new Service();
        $this -> bill = new Bill();
        $this -> rt = new RoomType();
    }


    public function room_booking_details(Request $rq) {
        $booking_month = $this->bf->getBFAllMonth();
        // dd($booking_month);
        $roomType = $this->rt->getRoomType();
        $month = $this->bf->getAllMonth();
        $roomStatsByMonth = [];
        
        if ($booking_month->isNotEmpty()) {
            // Nhóm các đặt phòng theo tháng
            $groupedByMonth = $booking_month->groupBy('month');
    
               foreach ($groupedByMonth as $monthKey => $bookings) {
                // Lấy danh sách id của phòng đã đặt trong tháng hiện tại
                $bookedRoomIds = $bookings->pluck('id_dv')->unique()->toArray();
    
                // Tìm các phòng không được đặt
                $unbookedRooms = $roomType->filter(function ($room) use ($bookedRoomIds) {
                    return !in_array($room->id_lp, $bookedRoomIds);
                });       
                    // $maxBookingRoom = $bookings->sortByDesc('so_luot_dat')->first();
                    // $minBookingRoom = $bookings->sortBy('so_luot_dat')->first();
                  // Tìm số lượng đặt lớn nhất và nhỏ nhất
            $maxBookingCount = $bookings->max('so_luot_dat');
            $minBookingCount = $bookings->min('so_luot_dat');

            // Lọc ra danh sách các phòng có số lượng đặt bằng với maxBookingCount và minBookingCount
            $maxBookingRoom = $bookings->filter(function ($booking) use ($maxBookingCount) {
                return $booking->so_luot_dat == $maxBookingCount;
            });

            $minBookingRoom = $bookings->filter(function ($booking) use ($minBookingCount) {
                return $booking->so_luot_dat == $minBookingCount;
            });
                // Lưu thông tin theo từng tháng, bao gồm tháng
                $roomStatsByMonth[] = [
                    'month' => $monthKey,
                    'maxBookingRoom' => $maxBookingRoom,
                    'minBookingRoom' => $minBookingRoom,
                    'unbookedRooms' => $unbookedRooms,
                ];
            }
        } else {
            $roomStatsByMonth = null;
        }
    
        // dd($roomStatsByMonth);
        return view('admin.tk_data.room_booking_details', compact('booking_month', 'month', 'roomStatsByMonth'));
    }
    
    public function calendar_room_booking($month, $id_lp) {    
        $getDT = $this->bf->getDT($month, $id_lp)->map(function ($item) {
            $item->tong_dt = number_format($item->tong_dt, 0, ',', '.');
            return $item;
        });
        return view('admin.tk_data.calendar_room_booking', compact('month', 'getDT'));
    }

    public function service_booking_details() {
        $service_month = $this -> sv -> getSVAllMonth();
        $service = $this -> sv -> getAllService();
        $month = $this -> sv -> getAllMonth();
        $roomStatsByMonth = [];
        
        if ($service_month->isNotEmpty()) {
            // Nhóm các đặt phòng theo tháng
            $groupedByMonth = $service_month->groupBy('month');
    
            foreach ($groupedByMonth as $monthKey => $bookings) {
                // Lấy danh sách id của phòng đã đặt trong tháng hiện tại
                $bookedRoomIds = $bookings->pluck('id_dv')->unique()->toArray();
    
                // Tìm các phòng không được đặt
                $unbookedRooms = $service->filter(function ($room) use ($bookedRoomIds) {
                    return !in_array($room->id_dv, $bookedRoomIds);
                });       
                    // $maxBookingRoom = $bookings->sortByDesc('so_luot_dat')->first();
                    // $minBookingRoom = $bookings->sortBy('so_luot_dat')->first();
                  // Tìm số lượng đặt lớn nhất và nhỏ nhất
            $maxBookingCount = $bookings->max('so_luot_dat');
            $minBookingCount = $bookings->min('so_luot_dat');

            // Lọc ra danh sách các phòng có số lượng đặt bằng với maxBookingCount và minBookingCount
            $maxBookingRoom = $bookings->filter(function ($booking) use ($maxBookingCount) {
                return $booking->so_luot_dat == $maxBookingCount;
            });

            $minBookingRoom = $bookings->filter(function ($booking) use ($minBookingCount) {
                return $booking->so_luot_dat == $minBookingCount;
            });

                
                // Lưu thông tin theo từng tháng, bao gồm tháng
                $roomStatsByMonth[] = [
                    'month' => $monthKey,
                    'maxBookingRoom' => $maxBookingRoom,
                    'minBookingRoom' => $minBookingRoom,
                    'unbookedRooms' => $unbookedRooms,
                ];
            }
        } else {
            $roomStatsByMonth = null;
        }
        // dd($roomStatsByMonth);
    //    return view('admin.tk_data.service_booking_details',compact('service_month','month'));
       return view('admin.tk_data.service_booking_details', compact('service_month', 'month', 'roomStatsByMonth'));
    }

    public function service_booking_schedule($month,$id_dv) {

        $getDT = $this-> sv -> getDT($month, $id_dv)->map(function ($item) {
            $item->tong_dt = number_format($item->tong_dt, 0, ',', '.');
            return $item;
        });
        
        return view('admin.tk_data.service_booking_schedule', compact('month', 'getDT'));
        
    }

    public function slkh_index() {
        // $currentMonth = now()->month;
        $getUS =$this -> bf -> getUS();
        $month = $this -> bf -> getAllMonth();
        return view('admin.tk_data.slkh_index', compact('getUS', 'month'));
    }

    public function slkh_details($month, $id_kh) {
       $getBF = $this -> bf -> getBF($month, $id_kh);
       return view('admin.tk_data.slkh_details', compact('getBF','month'));
    }

    public function total_revenue() {

        // $total =  $this -> bill -> totalRevenue() ->map(function ($item) {
        //     $item->tong_tien = number_format($item->tong_tien, 0, ',', '.');
        //     return $item;
        // });
        $tongDT =  $this -> bill -> totalRevenue() -> toArray();

        return view('admin.tk_data.index_ statistical', compact('tongDT'));

    }
}
