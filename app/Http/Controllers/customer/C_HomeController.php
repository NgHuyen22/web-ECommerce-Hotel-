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
use App\Models\SearchHistory;

use function PHPUnit\Framework\isEmpty;

class C_HomeController extends Controller
{

        protected $us;
        protected $rt;
        protected $r;
        protected $bf;
        protected $svt;
        protected $sht;
        public function __construct()
        {
            // $this -> hsv = new ChatService();
            $this -> us = new Users();
            $this -> rt = new RoomType();
            $this -> r = new Room();
            $this -> bf = new BookingForm();
            $this -> svt = new ServiceType();
            $this -> sht = new SearchHistory();
        }
        // public function index(Request $rq){
        //     // $rq -> ngay_nhan_phong, $rq->ngay_tra_phong, $rq -> adult, $rq -> children;

        //     $user =  $this -> us ->getUser(session('id_ctm'));   
        //     $mostSearch =RoomType :: getMostSearchedRooms();
        //     return view('customer.dashboard',compact('user','mostSearch'));
        // }
        public function index(Request $rq){
            $user =  $this -> us ->getUser(session('id_ctm'));   
            $similarRoom = collect();
            $roomType = collect();
            // dd(session('id_ctm'));
            $mostSearch =RoomType :: getMostSearchedRooms();
            $contentSugg =   $this -> bf ->getSearchRoom(session('id_ctm'));
            // $contentSugg = BookingForm::where('id_kh', session('id_ctm'))->select('id_loai_phong')->distinct() ->get();
            if($contentSugg -> isNotEmpty()){   
                foreach ($contentSugg as $id_lp) {              
                    $roomData = $this->rt->getRoomTypeID($id_lp->id_loai_phong);
                }
                if ($roomData) {
                    $roomType = $roomType->merge(collect([$roomData])); 
                    if($roomType -> isNotEmpty()) {
                        foreach($roomType as $room){

                            $similarRoom = $similarRoom->merge(
                                    $this->rt->getRoomContent($room -> phan_hang, $room->id_lp)
                                );
                        }
                        // dd($similarPricedRooms);
                    }
                }
               
            }  

            return view('customer.dashboard',compact('user','mostSearch','similarRoom'));
        }

        public function logout(){
            session()->forget('id_ctm');
            session()->forget('ten_ctm');
            // Auth::logout();
            return redirect()->route('customer.login');
        }

        public function about() {
             return view('customer.about.about');
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

        public function room_index( Request $rq){
            // $room_type = $this -> rt -> getAllRoom();
           
            // // dd($room_type);
            // return view('customer.room.room_index',  compact('room_type'));

            $keywords = $rq->keywords;  
            $count = 0;
            $countP = 0;
            $similarPricedRooms = collect();
            $roomTypes = $this -> rt -> getAllRoom($keywords);
        //  dd($roomTypes);
            $room_type = $this -> rt -> getAllRoom();
            if($roomTypes -> isNotEmpty()){
                $count = $roomTypes -> total();         
                foreach ($roomTypes as $roomType) {
                    $similarPricedRooms = $similarPricedRooms->merge(
                        $this->rt->getRoomsBySimilarPrice($roomType->phan_hang, $roomType -> id_lp)
                    );
                }
                // dd($similarPricedRooms);
            }  
            
            $mostSearch =RoomType :: getMostSearchedRooms();
            $mostBooking = RoomType :: getMostBookingRoom();
            if($rq -> value == 1) {
                $price = 500000;
                $ranges = 800000;
                $getPrice = $this -> rt ->getPrice($price, $ranges);
                if($getPrice -> isNotEmpty()){
                    $countP = $getPrice -> total();   
                }
            }
            elseif($rq -> value == 2) {
                $price = 1000000;
                $ranges = 1500000;
                $getPrice = $this -> rt ->getPrice($price, $ranges);
                if($getPrice -> isNotEmpty()){
                    $countP = $getPrice -> total();   
                }
            }
            else{
                
                $ranges = 1500000;
                $getPrice = $this -> rt ->getPrice2($ranges);
                if($getPrice -> isNotEmpty()){
                    $countP = $getPrice -> total();   
                }
            }

            $selectedValue = $rq->value;
            return view('customer.room.room_index', compact('keywords', 'roomTypes', 'mostSearch', 'count', 'mostBooking', 'room_type', 'similarPricedRooms', 'getPrice','countP','selectedValue'));
            
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
            $calendar = $this -> bf -> getCalendar($id_rt);
            dd($calendar);
            return view('customer.room.room-details', compact('room_detail', 'countRoom', 'countRoomNull', 'countFormLogin', 'countForm'));
        }

     public function search(Request $rq) {
            $keywords = $rq->keywords;  
            $count = 0;
            $similarPricedRooms = collect();
            // $roomTypes = $this -> rt -> getAllRoom($keywords);
            $roomTypes =RoomType ::search($keywords) ->get();
         
            $room_type = $this -> rt -> getAllRoom();
            if($roomTypes -> isNotEmpty()){
                $count = $roomTypes -> count();         
                foreach ($roomTypes as $roomType) {
                    $similarPricedRooms = $similarPricedRooms->merge(
                        $this->rt->getRoomsBySimilarPrice($roomType->phan_hang, $roomType -> id_lp)
                    );
                }
                // dd($similarPricedRooms);
            }    
            
            $mostSearch =RoomType :: getMostSearchedRooms();
            $mostBooking = RoomType :: getMostBookingRoom();

            
            return view('customer.room.room_index',compact('keywords', 'roomTypes','mostSearch','count','mostBooking','room_type','similarPricedRooms'));
    }

    public function search_name(Request $rq) {
        $keywords = $rq->keywords;
        $roomTypes = RoomType::search($keywords)->get();
        return response()->json(['roomTypes' => $roomTypes]);
    }

    public function search_price(Request $rq) {

        if($rq -> value == 1) {
            $price = 500000;
            $ranges = 800000;
            $getPrice = $this -> rt ->getPrice($price, $ranges);
            
        }
        elseif($rq -> value == 2) {
            $price = 1000000;
            $ranges = 1500000;
            $getPrice = $this -> rt ->getPrice($price, $ranges);
            
        }
        else{
            
            $ranges = 1500000;
            $getPrice = $this -> rt ->getPrice2($ranges);
          
        }

        return redirect()->route('customer.room_index')->with('getPrice', $getPrice);

    }

        public function incrementSearchCount($id_lp) {
            $roomType = RoomType::findOrFail($id_lp);
            $roomType->increment('search_count');
            return redirect()->route('customer.room_detail', $roomType->id_lp);
        }
        
}