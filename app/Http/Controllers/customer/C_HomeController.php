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
use App\Models\Evaluate;

use Termwind\Components\Dd;
use function PHPUnit\Framework\isEmpty;

class C_HomeController extends Controller
{

        protected $us;
        protected $rt;
        protected $r;
        protected $bf;
        protected $svt;
        protected $sht;
        protected $ev;
        public function __construct()
        {
            // $this -> hsv = new ChatService();
            $this -> us = new Users();
            $this -> rt = new RoomType();
            $this -> r = new Room();
            $this -> bf = new BookingForm();
            $this -> svt = new ServiceType();
            $this -> sht = new SearchHistory();
            $this -> ev = new Evaluate();
        }
        // public function index(Request $rq){
        //     // $rq -> ngay_nhan_phong, $rq->ngay_tra_phong, $rq -> adult, $rq -> children;

        //     $user =  $this -> us ->getUser(session('id_ctm'));   
        //     $mostSearch =RoomType :: getMostSearchedRooms();
        //     return view('customer.dashboard',compact('user','mostSearch'));
        // }
    // public function index(Request $rq){
    //         $user =  $this -> us ->getUser(session('id_ctm'));   
    //         $similarRoom = collect();
    //         $similarSearch = collect();
    //         $roomType = collect();
    //         $roomData = collect();
    //         $listSimilarCTM = array();
    //         $roomTypeSearch = collect();
    //         $recommendedRooms = collect();
    //         $combinedRooms = collect();
    //         $finalRooms = collect();
    //         // if(session('id_ctm')){
    //                 $mostSearch =RoomType :: getMostSearchedRooms();
    //                 $contentSugg =   $this -> bf ->getSearchRoom(session('id_ctm'));
    //                 // $contentSugg = BookingForm::where('id_kh', session('id_ctm'))->select('id_loai_phong')->distinct() ->get();
    //                 if ($contentSugg->isNotEmpty()) {
                        
    //                     foreach ($contentSugg as $id_lp) {              
    //                         $listSimilarCTM = $this -> bf ->getBooking($id_lp->id_loai_phong,session('id_ctm')) ->toArray();
    //                         $roomData = $this->rt->getRoomTypeID1($id_lp->id_loai_phong);            
    //                         if ($roomData) {
    //                             $roomType = $roomType->merge(collect([$roomData])); 
    //                         }
    //                     }

    //                     if(!empty($listSimilarCTM)){
    //                         foreach($listSimilarCTM as $list){
    //                             $roomUs =  $this ->bf ->getListRoom($list->id_kh, $list ->id_loai_phong)->take(4)->toArray();
    //                         }

    //                         if(!empty($roomUs)){
    //                             foreach($roomUs as $list){
    //                                 $recommendedRooms = RoomType::search('')
    //                                 ->whereIn('id_lp', [$list->id_loai_phong])
    //                                 ->get();
    //                             }
    //                         }
    //                     }

    //                     if ($roomType->isNotEmpty()) {
    //                         $excludedIds = $roomType->pluck('id_lp')->toArray();
                            
    //                         foreach ($roomType as $room) {
    //                             $similarRoom = $similarRoom->merge(
    //                                 $this->rt->getRoomContent($room->phan_hang, $excludedIds)
    //                             );
    //                         }
    //                         $similarRoom = $similarRoom->unique('id_lp')->take(4);
    //                     }
    //                 }
                    
                    
    //                 $searchSugg =   $this -> sht ->getSearchRoom(session('id_ctm'));
                    
    //                 if($searchSugg -> isNotEmpty()){   
    //                     foreach ($searchSugg as $room) {              
    //                         $roomSearch = $this->rt->getRoomTypeID1($room->id_lp);            
    //                         if ($roomSearch) {
    //                             $roomTypeSearch = $roomTypeSearch->merge(collect([$roomSearch])); 
    //                         }
    //                     }

    //                     if ($roomTypeSearch->isNotEmpty()) {
    //                         // Tạo mảng chứa các id_lp từ roomType
    //                         $excludedIdsSearch = $roomTypeSearch->pluck('id_lp')->toArray();
    //                         // Gộp nội dung phòng vào similarRoom
    //                         foreach ($roomTypeSearch as $room) {
    //                             // Lấy các phòng khác cùng phân hạng nhưng không bao gồm các id_lp trong excludedIds
    //                             $similarSearch = $similarSearch->merge(
    //                                 $this->rt->getRoomContent($room->phan_hang, $excludedIdsSearch)
    //                             );
    //                         }
    //                         $similarSearch = $similarSearch->unique('id_lp');
    //                         if($similarRoom -> isNotEmpty()){
    //                             $similarSearch = $similarSearch->whereNotIn('id_lp', $similarRoom->pluck('id_lp')->toArray())->take(4);
    //                         }
                            
    //                     }
    //                 }

    //                 $mergeRooms = false;
    //                 if ($similarRoom->count() > 0  &&  $similarSearch->count() > 0) {
    //                     $mergeRooms = true;
    //                     $combinedRooms = $similarRoom->merge($similarSearch)->whereNotIn('id_lp', $recommendedRooms->pluck('id_lp')->toArray())->unique('id_lp');
    //                 }
    //                 $finalRooms = $recommendedRooms->merge($combinedRooms)->unique('id_lp');
    //                 $mostSearch =RoomType :: getMostSearchedRooms()  ->take(4);

    //         return view('customer.dashboard',compact('user','mostSearch','similarRoom','similarSearch','mostSearch','mergeRooms','combinedRooms','recommendedRooms','finalRooms'));

    // }
    public function index(Request $rq)
    {
        $user =  $this->us->getUser(session('id_ctm'));   
        $similarRoom = collect();
        $similarSearch = collect();
        $roomType = collect();
        $roomData = collect();
        $listSimilarCTM = array();
        $roomTypeSearch = collect();
        $recommendedRooms = collect();
        $combinedRooms = collect();
    
        $mostSearch = RoomType::getMostSearchedRooms();
        $contentSugg = $this->bf->getSearchRoom(session('id_ctm'));

        if ($contentSugg->isNotEmpty()) {
            foreach ($contentSugg as $id_lp) {              
                $listSimilarCTM = collect($this->bf->getBooking($id_lp->id_loai_phong, session('id_ctm'))->toArray());
                $roomData = $this->rt->getRoomTypeID1($id_lp->id_loai_phong);            
                if ($roomData) {
                    $roomType = $roomType->merge(collect([$roomData])); 
                }
            }
    
            if ($listSimilarCTM->isNotEmpty()) {
                $allRoomUs = collect();
                foreach ($listSimilarCTM as $list) {
                    $roomUs = collect($this->bf->getListRoom($list->id_kh, $list->id_loai_phong)->take(4)->toArray());
                
                    if ($roomUs->isNotEmpty()) {
                        $allRoomUs = $allRoomUs->merge($roomUs);
                    }
                }
           
       
                if ($allRoomUs->isNotEmpty()) {
                    foreach ($allRoomUs as $list) {
                        $recommendedRooms = collect(RoomType::search('')
                            ->whereIn('id_lp', [$list->id_loai_phong])
                            ->get());
                    }
                }
            }
    
            if ($roomType->isNotEmpty()) {
                $excludedIds = $roomType->pluck('id_lp')->toArray();
    
                foreach ($roomType as $room) {
                    $similarRoom = $similarRoom->merge(
                        collect($this->rt->getRoomContent($room->phan_hang, $excludedIds))
                    );
                }
                $similarRoom = $similarRoom->unique('id_lp')->take(4);
            }
        }

        $searchSugg = $this->sht->getSearchRoom(session('id_ctm'));
    
        if ($searchSugg->isNotEmpty()) {   
            foreach ($searchSugg as $room) {              
                $roomSearch = $this->rt->getRoomTypeID1($room->id_lp);            
                if ($roomSearch) {
                    $roomTypeSearch = $roomTypeSearch->merge(collect([$roomSearch])); 
                }
            }
    
            if ($roomTypeSearch->isNotEmpty()) {
                $excludedIdsSearch = $roomTypeSearch->pluck('id_lp')->toArray();
    
                foreach ($roomTypeSearch as $room) {
                    $similarSearch = $similarSearch->merge(
                        collect($this->rt->getRoomContent($room->phan_hang, $excludedIdsSearch))
                    );
                }
                $similarSearch = $similarSearch->unique('id_lp');
                if ($similarRoom->isNotEmpty()) {
                    $similarSearch = $similarSearch->whereNotIn('id_lp', $similarRoom->pluck('id_lp')->toArray())->take(4);
                }
            }
        }
    
        $mergeRooms = false;
        if ($similarRoom->count() > 0 || $similarSearch->count() > 0) {
            $mergeRooms = true;
            $combinedRooms = $similarRoom->merge($similarSearch)
                ->whereNotIn('id_lp', $recommendedRooms->pluck('id_lp')->toArray())
                ->unique('id_lp');
        }
        $finalRooms = $recommendedRooms->merge($combinedRooms)->unique('id_lp')->sortBy('id_lp');
        $mostSearch = RoomType::getMostSearchedRooms()->take(4);
    
        $evaluate = $this -> ev -> getEVUS() ->sortByDesc('diem') -> take(3);

        return view('customer.dashboard', compact('user', 'mostSearch', 'similarRoom', 'similarSearch', 
        'mergeRooms', 'combinedRooms', 'recommendedRooms', 'finalRooms','evaluate'));
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

        public function edit_profile($id_kh,Request $rq) {
            
            $rq->validate([
                'ho_ten' => 'string|max:50|regex:/^[a-zA-ZÀ-ỹ\s]+$/u',
                'sdt' => 'regex:/^[0-9]{10}$/', // Chỉ chấp nhận 10 chữ số
                'email' => 'regex:/^[\w\.&*-]+@([\w-]+\.)+[\w-]{2,4}$/',
                'dia_chi' => 'max:250',
            ], [
               'ho_ten.string' => 'Họ tên phải là chuỗi ký tự.',
               'ho_ten.regex' => 'Họ tên không được chứa số.',
               'ho_ten.max' => 'Họ tên tối đa 50 kí tự',
                'sdt.regex' => 'Số điện thoại không chứa ký tự và phải có 10 chữ số.',
                'email.regex' => 'Email không hợp lệ !',
                'dia_chi.max' => 'Địa chỉ tối đa 250 kí tự.',              
            ]);

            $data = [
                'ho_ten' => $rq ->ho_ten,
                'gioi_tinh' => $rq ->gioi_tinh,
                'sdt' => $rq ->sdt,
                'email' => $rq ->email,
                'dia_chi' => $rq ->dia_chi,
                'updated_at' => now()
            ];
            $editProfile = $this -> us -> editProfile($id_kh,$data);
            if($editProfile) {
                return redirect() ->route('customer.view_profile')->with('success',"Cập nhật thông tin thành công");
            }else{
                return redirect() ->route('customer.view_profile')->with('error',"Lỗi, vui lòng thử lại sau !!");         
            }
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
            
            $mostSearch =RoomType :: getMostSearchedRooms() ->take(3);
            $mostBooking = RoomType :: getMostBookingRoom();
            // if($rq -> value == 1) {
            //     $price = 500000;
            //     $ranges = 800000;
            //     $getPrice = $this -> rt ->getPrice($price, $ranges);
            //     if($getPrice -> isNotEmpty()){
            //         $countP = $getPrice -> total();   
            //     }
            // }
            // elseif($rq -> value == 2) {
            //     $price = 1000000;
            //     $ranges = 1500000;
            //     $getPrice = $this -> rt ->getPrice($price, $ranges);
            //     if($getPrice -> isNotEmpty()){
            //         $countP = $getPrice -> total();   
            //     }
            // }
            // else{
                
            //     $ranges = 1500000;
            //     $getPrice = $this -> rt ->getPrice2($ranges);
            //     if($getPrice -> isNotEmpty()){
            //         $countP = $getPrice -> total();   
            //     }
            // }
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
            elseif($rq -> value == 3){
                
                $ranges = 1500000;
                $getPrice = $this -> rt ->getPrice2($ranges);
                if($getPrice -> isNotEmpty()){
                    $countP = $getPrice -> total();   
                }
            }else{
                $getPrice = $this -> rt ->getAllPrice();
                if($getPrice -> isNotEmpty()){
                    $countP = $getPrice -> total();   
                }
                
            }

            $selectedValue = $rq->value;
            return view('customer.room.room_index', compact('keywords', 'roomTypes', 'mostSearch', 'count', 'mostBooking', 'room_type', 'similarPricedRooms', 'getPrice','countP','selectedValue'));
            
        }
             
        public function room_detail($id_rt) {
            $getEV = $this -> ev -> getEVRoom($id_rt);  
            $getLimitEV = collect();
            $avg = 0 ;
            if($getEV ->isNotEmpty()) {
                $avg = $getEV -> avg('diem');
                $getLimitEV = $getEV -> sortByDesc('diem') ->take(2);
            }
            
            $getUserLogin = $this->us->getUser(session('id_ctm'));
            $getUser = $this->us->getUser(session('idCtm_notLogin'));
            $room_calendar = $this -> rt -> room($id_rt);
            $bookings = $this -> bf -> checkBooking1($id_rt);
        // dd($bookings);
            $countFormLogin = 0;
            $countForm = 0;
            if ($getUserLogin != null) {
                $getFormLogin = $this->bf->getForm($getUserLogin->id);
                if ($getFormLogin->total() > 0) {
                    $countFormLogin = $getFormLogin->total();
                }
            }

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
            // dd($calendar);
            return view('customer.room.room-details', compact('room_detail', 'countRoom', 'countRoomNull',
                                                                                 'countFormLogin', 'countForm','room_calendar','bookings','getEV','avg','getLimitEV'));
        }

    //  public function search(Request $rq) {
    //         $keywords = $rq->keywords;  
    //         $count = 0;
    //         $similarPricedRooms = collect();
    //         // $roomTypes = $this -> rt -> getAllRoom($keywords);
    //         $roomTypes =RoomType ::search($keywords) ->get();
         
    //         $room_type = $this -> rt -> getAllRoom();
    //         if($roomTypes -> isNotEmpty()){
    //             $count = $roomTypes -> count();         
    //             foreach ($roomTypes as $roomType) {
    //                 $similarPricedRooms = $similarPricedRooms->merge(
    //                     $this->rt->getRoomsBySimilarPrice($roomType->phan_hang, $roomType -> id_lp)
    //                 );
    //             }
    //             // dd($similarPricedRooms);
    //         }    
            
    //         $mostSearch =RoomType :: getMostSearchedRooms();
    //         $mostBooking = RoomType :: getMostBookingRoom();

            
    //         return view('customer.room.room_index',compact('keywords', 'roomTypes','mostSearch','count','mostBooking','room_type','similarPricedRooms'));
    // }
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
                    if(session('id_ctm')){

                        SearchHistory::create([
                            'id_lp' => $roomType->id_lp,
                            'id_kh' => session('id_ctm'), 
                            'keywords' => $keywords,  
                        ]);
                    }

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
    public function news() {
        return view('customer.annother.news');
    }
        
}