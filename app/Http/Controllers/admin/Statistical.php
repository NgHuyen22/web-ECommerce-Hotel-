<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\BookingForm;
use App\Models\Service;
use App\Models\Bill;

class Statistical extends Controller
{
    protected $bf;
    protected $sv;
    protected $bill;
    public function __construct()
    {
        $this -> bf = new BookingForm();
        $this -> sv = new Service();
        $this -> bill = new Bill();
    }


    public function room_booking_details(Request $rq) {
        $booking_month = $this -> bf -> getBFAllMonth();
        // dd($booking_month);
        $month = $this -> bf -> getAllMonth();
        return view('admin.tk_data.room_booking_details', compact('booking_month','month'));
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
        // dd($service_month);
        $month = $this -> sv -> getAllMonth();
       return view('admin.tk_data.service_booking_details',compact('service_month','month'));
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
