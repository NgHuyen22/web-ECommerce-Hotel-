<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\admin\ChatService;
use App\Models\Users;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\BookingForm;

class HomeController extends Controller
{

    protected $hsv;
    protected $us;
    protected $rt;
    protected $r;
    protected $bf;
    public function __construct()
    {
        // $this -> hsv = new ChatService();
        $this -> us = new Users();
        $this -> rt = new RoomType();
        $this -> r = new Room();
        $this -> bf = new BookingForm();
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

    public function bm_index(){
        $unapproved = $this -> bf -> getUnapproved();
        $approved = $this -> bf -> getApproved();
        
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
        $all = collect(); // Khởi tạo Collection để lưu trữ tất cả các phòng trống
       
        foreach ($room_type as $item) {
            $rt = $this->r->getRoomRT($item); // Lấy danh sách phòng theo loại phòng hiện tại
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
       
        
       return view("admin.booking_management.bm_index", compact('unapproved', 'approved', 'countUn', 'count','all'));
    }
}
