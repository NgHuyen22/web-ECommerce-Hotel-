<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\admin\ChatService;
use App\Models\Users;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\BookingForm;
use App\Models\SpecialOffers;
use App\Models\ServiceIncentives;
use App\Models\Bill;

class HomeController extends Controller
{

    protected $hsv;
    protected $us;
    protected $rt;
    protected $r;
    protected $bf;
    protected $spo;
    protected $svi;
    protected $bill;
    public function __construct()
    {
        // $this -> hsv = new ChatService();
        $this -> us = new Users();
        $this -> rt = new RoomType();
        $this -> r = new Room();
        $this -> bf = new BookingForm();
        $this -> spo = new SpecialOffers();
        $this -> svi = new ServiceIncentives();
        $this -> bill = new Bill();
    }
    public function index(){
        // $user =  $this -> us ->getUser(session('id_ad'));
        
            return view('admin.dashboard');
    }

    // CAP NHAT PHONG
    public function update_room(Request $rq){
        $keywords = $rq -> keywords;
        $room_type = $this -> rt ->getAllRoom($keywords);
        // $countRT = $this -> rt ->countRoomType();
        $countRT = $room_type -> total();
        return view('admin.update_room.update_room', compact('room_type', 'countRT'));
    }


    public function chatbox(){
        // $question = $this -> hsv -> getChatQuestion();
        // dd($question);
        // return view('admin.chatbox.chat',$question);
    }
    

    // DANG XUAT
    public function logout(){
        session()->forget('id_ad');
        session()->forget('ten_ad');
        // Auth::logout();
        return redirect()->route('admin.login');
    }

    // public function bm_index(){
    //     $unapproved = $this -> bf -> getUnapproved();
        
    //     $approved = $this -> bf -> getApproved();
        
    //     $countUn = 0;
    //     $count = 0;
    //     if(!$unapproved -> isEmpty()){
    //         $countUn = $unapproved -> perPage();
    //     }
    //     if(!$approved -> isEmpty()){
    //         $count = $approved -> perPage();
    //     }
       
        
    //    return view("admin.booking_management.bm_index", compact('unapproved', 'approved', 'countUn', 'count'));
    // }

    public function bm_index(Request $rq){
        $ngay_nhan_phong = $rq->ngay_nhan_phong;
        $ngay_tra_phong = $rq -> ngay_tra_phong;
        $unapproved = $this -> bf -> getUnapproved($ngay_nhan_phong,$ngay_tra_phong);
        $approved = $this -> bf -> getApproved($ngay_nhan_phong, $ngay_tra_phong);
        
        $ngayNhan = $this -> bf -> getNgayNhan();
        $ngayTra = $this -> bf -> getNgayTra();
        $room_type = $this->bf->getRT();
       
        $all_rt = collect(); 
        
        // foreach ($room_type as $item) {
        //     $rt = $this->r->getRoomRT($item);
        //     if (!$rt->isEmpty()) {
        //         $all_rt = $all_rt->merge($rt);
        //     }
        // }
        $room_type = $this->bf->getRT(); // Lấy danh sách loại phòng chưa xác nhận
        $ngayNhan = $this -> bf -> getNgayNhan()->unique();
        $ngayTra = $this -> bf -> getNgayTra() -> unique();
        $all = collect();
       
        foreach ($room_type as $item) {
            $rt = $this->r->getRoomRT($item); 
            if (!$rt->isEmpty()) {
                if(!$ngayNhan -> isEmpty() || !$ngayTra -> isEmpty()){
                   
                    foreach($ngayNhan as $nn){
                        foreach($ngayTra as $nt){

                            $bookedRooms = $this->bf->checkBFNull($item, $nn, $nt); 
                          
                            $allRooms = $rt->pluck('so_phong'); // Lấy danh sách tất cả phòng của loại phòng hiện tại
                            $bookedRoomNumbers = $bookedRooms->pluck('so_phong'); // Lấy danh sách số phòng đã được đặt
                            $availableRooms = $allRooms->diff($bookedRoomNumbers); 
                            foreach ($availableRooms as $roomNumber) {
                                $room = $rt->firstWhere('so_phong', $roomNumber); // Lấy thông tin phòng
                                    if ($room && !$all->contains($room)) { // Kiểm tra xem phòng đã có trong Collection chưa
                                        $all->push($room); // Thêm phòng trống vào Collection
                                    }
                            }
                        }

                    }
                }
               
            }
        }    

        // dd($all);
      
        $countUn = 0;
        $count = 0;
        if(!$unapproved -> isEmpty()){
            $countUn = $unapproved -> perPage();
        }
        if(!$approved -> isEmpty()){
            $count = $approved -> perPage();
        }
       
        
       return view("admin.booking_management.bm_index", compact('unapproved', 'approved', 'countUn', 'count','all','ngay_nhan_phong','ngay_tra_phong'));
    }

    // public function spo_index(){
    //     $getUD = $this -> spo -> getUD();
    //     $getUdDv = $this -> svi -> getUdDv();
   
    //     return view('admin.Update _offers.update_offers_index', compact('getUD','getUdDv'));
    // }
    public function spo_index(){
        $getUD = $this -> spo -> getUD();
        $getUdDv = $this -> svi -> getUdDv();
   
        return view('admin.Update _offers.update_offers_index', compact('getUD','getUdDv'));
    }

    public function bill_index(Request $rq) {
            $count = 0;
            $countAcp = 0;
           
            $ngay_thanh_toan = $rq->ngay_thanh_toan;
            $ngay_thanh_toan1 = $rq->ngay_thanh_toan1;
            $keywords = $rq -> keywords;
            $allBill = $this -> bill -> getAllBill($ngay_thanh_toan, $ngay_thanh_toan1,$keywords);
  
            if($allBill -> isNotEmpty()){
                $count = $allBill -> total();
            }

            $allBill_acp = $this -> bill -> getAllBillAcp($ngay_thanh_toan, $ngay_thanh_toan1,$keywords);
            // dd($allBill_acp);
            if ($allBill_acp -> isNotEmpty()) {
                $countAcp = $allBill_acp -> total();
            }

            return view('admin.bill_management.bill_index', compact('allBill', 'count', 'allBill_acp', 'countAcp','ngay_thanh_toan1','ngay_thanh_toan'));
    }
}
