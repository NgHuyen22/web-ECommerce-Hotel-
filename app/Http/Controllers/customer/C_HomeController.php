<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\admin\ChatService;
use App\Models\Users;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\BookingForm;
use App\Models\ServiceType;

use function PHPUnit\Framework\isEmpty;

class C_HomeController extends Controller
{

        protected $us;
        protected $rt;
        protected $r;
        protected $bf;
        protected $svt;
        public function __construct()
        {
            // $this -> hsv = new ChatService();
            $this -> us = new Users();
            $this -> rt = new RoomType();
            $this -> r = new Room();
            $this -> bf = new BookingForm();
            $this -> svt = new ServiceType();
        }
        public function index(){
            // $getServiceType = $this -> svt -> getServiceType();
            
            $user =  $this -> us ->getUser(session('id_ctm'));   
            return view('customer.dashboard',compact('user'));
        }
        public function logout(){
            session()->forget('id_ctm');
            session()->forget('ten_ctm');
            // Auth::logout();
            return redirect()->route('customer.login');
        }

        public function profile(){
            $getUserLogin = $this->us->getUser(session('id_ctm'));
            $countFormLogin = 0;

            if ($getUserLogin != null) {
                $getFormLogin = $this->bf->getForm($getUserLogin->id);
                if ($getFormLogin->total() > 0) {
                    $countFormLogin = $getFormLogin->total();
                }
            }
            
            $user =  $this -> us ->getUser(session('id_ctm'));
            return view('customer.view_profile.profile',compact('user','countFormLogin'));
        } 

        public function room_index(){
           
            $room_type = $this -> rt -> getAllRoom();
            // dd($room_type);
            return view('customer.room.room_index',  compact('room_type'));
        }
             
        public function room_detail($id_rt) {
            $getUserLogin = $this->us->getUser(session('id_ctm'));
            $getUser = $this->us->getUser(session('idCtm_notLogin'));
        
            // Khởi tạo biến mặc định
            $countFormLogin = 0;
            $countForm = 0;
        
            // Nếu có người dùng đăng nhập
            if ($getUserLogin != null) {
                $getFormLogin = $this->bf->getForm($getUserLogin->id);
                if ($getFormLogin->total() > 0) {
                    $countFormLogin = $getFormLogin->total();
                }
            }
        
            // Nếu người dùng chưa đăng nhập tồn tại
            if ($getUser) {
                $getForm = $this->bf->getForm($getUser->id);
                if ($getForm->total() > 0) {
                    $countForm = $getForm->total();
                }
            }
        
            $countRoom = $this->r->countRoomTypeID($id_rt);
            $countRoomNull = $this->r->countRoomNull($id_rt);
            
            $room_detail = $this->rt->getRoomTypeID($id_rt);
        
            return view('customer.room.room-details', compact('room_detail', 'countRoom', 'countRoomNull', 'countFormLogin', 'countForm'));
        }
        
}