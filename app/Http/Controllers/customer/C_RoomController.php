<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\BookingForm;
use App\Models\Bill;
use App\Models\Evaluate;
use App\Models\FormServiceDetail;
use App\Models\ServiceIncentives;

use Carbon\Carbon;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class C_RoomController extends Controller
{

    protected $us;
    protected $bf;
    protected $bill;
    protected $rt;
    protected $r;
    protected $fsd;
    protected $svi;
    protected $ev;
    public function __construct()
    {
        $this -> us = new Users();
        $this -> rt = new RoomType();
        $this -> r = new Room();
        $this -> bf = new BookingForm();
        $this -> bill = new Bill();
        $this -> fsd = new FormServiceDetail();
        $this -> svi = new ServiceIncentives();
        $this -> ev = new Evaluate();
    }

        public function booking_room(Request $rq){
           $id_rt =  $rq -> id_rt;
           $ten_lp = $rq -> ten_lp;
           $countIDRT = $this -> r -> getIDR($id_rt);
           
           $sl = (int)$rq -> so_luong;
           
           $getNameRT = $this -> rt -> getRoomTypeID($id_rt);
           $ngayNhan = Carbon::createFromFormat('d-m-Y', $rq->ngay_nhan_phong)->format('Y-m-d');
           $ngayTra = Carbon::createFromFormat('d-m-Y', $rq->ngay_tra_phong)->format('Y-m-d');
           
           
        //    $check = $this -> bf -> checkBF($id_rt,$ngayNhan,$ngayTra);
           $checkSl = $this -> bf -> checkBF($id_rt,$ngayNhan,$ngayTra);
           $spt =  $countIDRT - $checkSl;
            // Kiểm tra xem số lượng đặt có vượt quá số lượng phòng có sẵn không
            if ($checkSl + $sl > $countIDRT) {
                return redirect()->route('customer.room_detail', [$id_rt]) ->withInput() -> with('error', 'Không đủ phòng, vui lòng đặt sl ít hơn hoặc đặt vào thời gian khác!');
            }
           
        //    if($check){
        //         return redirect()->route('customer.room_detail',[$id_rt]) ->with('error','Phòng đã đầy, vui lòng chọn khoảng thời gian khác !');
        //    }
           else{
                $getUser = $this -> us -> getUser(session('id_ctm'));
                if($getUser != null){
                    return redirect()->back()->with([
                        'id_kh' => $getUser -> id,
                        'ho_ten' => $getUser -> ho_ten,
                        'gioi_tinh' => $getUser -> gioi_tinh,
                        'sdt' => $getUser -> sdt,
                        'email' => $getUser -> email,
                        'id_loai_phong' => $id_rt,
                        'ngay_nhan_phong' => Carbon::createFromFormat('d-m-Y', $rq->ngay_nhan_phong)->format('d-m-Y'),
                        'ngay_tra_phong' =>Carbon::createFromFormat('d-m-Y', $rq->ngay_tra_phong)->format('d-m-Y'),
                        'so_ngay_o' => Carbon::parse($rq->ngay_nhan_phong) -> diffInDays(Carbon::parse($rq->ngay_tra_phong)),
                        'ghi_chu' => $rq->ghi_chu,
                        'so_luong' => $sl,
                        'so_phong_trong' => $spt
                    ]);


                //phan insert bk form
                    // for ($i = 0; $i < $sl; $i++) {
                    //     $data =[

                    //         'id_kh' => $getUser->id,
                    //         'id_loai_phong' => $id_rt,
                    //         'id_phong' => NULL,
                    //         'ngay_nhan_phong' => Carbon::createFromFormat('d-m-Y', $rq->ngay_nhan_phong)->format('Y-m-d'),
                    //         'ngay_tra_phong' => Carbon::createFromFormat('d-m-Y', $rq->ngay_tra_phong)->format('Y-m-d'),    
                    //         'so_ngay_o' => Carbon::parse($rq->ngay_nhan_phong) -> diffInDays(Carbon::parse($rq->ngay_tra_phong)),
                    //         'tinh_trang' => "Chưa xác nhận",
                    //         'ghi_chu' => $rq -> ghi_chu,
                    //         'status' => 1,

                    //     ];
                    //     $insertForm = $this -> bf -> insertForm($data);
                    // }
                    // if($insertForm == true){
                    //     $getForm = $this->bf->getFormFirst($getUser->id);
                        
                    //         // gui email báo thành công 
                    //         try{
                    //             Mail::send('customer.booking_room.notice_of_bf', ['customer' => $getUser ,'getForm' => $getForm,'id_rt' =>  $id_rt,'getNameRT' => $getNameRT ], function ($email) use ($getUser) {
                    //                 $email->subject('HTQLKS - Thông báo đặt phòng tại HazBin Hotel');
                    //                 $email->to($getUser->email, $getUser->ho_ten);
                    //             });
                    //             // Log::info('Email đã được gửi tới: ' . $getUser->email);
                    //         }catch(Exception $e){
                    //             // Log::error('Lỗi khi gửi email: ' . $e->getMessage());
                    //             return redirect()->route('customer.room_detail',['id_rt' => $id_rt])  ->with('error', 'Hệ thống đang gặp sự cố, hãy thử lại sau !! Lỗi: ' . $e->getMessage());;
                    //         }
                    //         // Session::put('ten_lpForm', $ten_lp);
                    //         return redirect() -> route('customer.see_form') -> with('success', 'Đặt phòng thành công !') ;
                    //                                                                                 //   ->with('ten_lpLogin' , $getNameRT -> ten_lp)
                    //                                                                                 //   ->with('so_luong' , $sl);
                    // }else{
                    //     // sleep(2.3);
                    //     return redirect() -> route('customer.room_detail',[['id_rt' => $id_rt]]) -> withInput() ->with('error', 'Lỗi, vui lòng thử lại sau !');
                    // }
                }else{
                    $ngayNhan = Carbon::createFromFormat('d-m-Y', $rq->ngay_nhan_phong)->format('Y-m-d');
                    $ngayTra = Carbon::createFromFormat('d-m-Y', $rq->ngay_tra_phong)->format('Y-m-d');
                    $soNgay = Carbon::parse($rq->ngay_nhan_phong) -> diffInDays(Carbon::parse($rq->ngay_tra_phong));
                    $note = $rq -> ghi_chu;      
                    $sl = (int)$rq -> so_luong;
                    
                    return redirect()->route('customer.insert_profile')
                                ->with('ngayNhan', $ngayNhan)
                                ->with('ngayTra', $ngayTra)
                                ->with('soNgay', $soNgay)
                                ->with('note', $note)
                                ->with('so_luong', $sl)
                                ->with('id_rt',$id_rt);
                }
            }
        }

    public function insert_form(Request $rq){
            $sl = (int)$rq -> so_luong;
            $ngayNhan = Carbon::createFromFormat('d-m-Y', $rq->ngay_nhan_phong)->format('Y-m-d');
            $ngayTra = Carbon::createFromFormat('d-m-Y', $rq->ngay_tra_phong)->format('Y-m-d');
            $soNgay = Carbon::parse($rq->ngay_nhan_phong) -> diffInDays(Carbon::parse($rq->ngay_tra_phong));
            $ghi_chu = $rq -> ghi_chu;      
            $id_rt = $rq -> id_loai_phong;
            $id_kh = $rq-> id_kh;
            $getUser = $this -> us -> getUser($id_kh);

            $getNameRT = $this -> rt -> getRoomTypeID($id_rt);
                   for ($i = 0; $i < $sl; $i++) {
                        $data =[

                            'id_kh' => $id_kh,
                            'id_loai_phong' => $id_rt,
                            'id_phong' => NULL,
                            'ngay_nhan_phong' => $ngayNhan,
                            'ngay_tra_phong' => $ngayTra,   
                            'so_ngay_o' => $soNgay,
                            'tinh_trang' => "Chưa xác nhận",
                            'ghi_chu' => $ghi_chu,
                            'status' => 1,
                            'gn' => 1,

                        ];  
                        $insertForm = $this -> bf -> insertForm($data);
                        $roomType = RoomType::findOrFail($id_rt);
                        $roomType->increment('search_booking');
                    }
                    if($insertForm == true){
                        $getForm = $this->bf->getFormFirst($id_kh);
                
                        // $gia_lp = $this -> rt -> giaLP($id_rt);
                        // $gia_lp = (int) $gia_lp;
                        // $tong_tien = $soNgay * $gia_lp;
                        
                        // $id_form = $this -> bf -> getIDForm($id_kh, $id_rt,$ngayNhan, $ngayTra);
                        // foreach($id_form as $form){
                        //     $dataBill =[
                        //         'khach_hang' => $id_kh,
                        //         'don_dat_phong' => $form -> id_don,
                        //         'phi_dv' => 0,
                        //         'tre_han' => 0,
                        //         'phi_them' => 0,
                        //         'tong_tien' => $tong_tien,
                        //         'phuong_thuc_tt' => NULL,
                        //         'tien_kh_gui' => 0,
                        //         'tien_thua' => 0,
                        //         'trang_thai_hd' => "Chưa thanh toán",
                        //         'status' => 1,
                        //         'created_at' => now(),
                        //         'updated_at' => now(),
                        //     ];

                            // $insertBill = $this -> bill -> insertBill($dataBill);
                        // }
                        

                            try{
                                Mail::send('customer.booking_room.notice_of_bf', ['customer' => $getUser ,'getForm' => $getForm,'id_rt' =>  $id_rt,'getNameRT' => $getNameRT ], function ($email) use ($getUser) {
                                    $email->subject('HazBin - Thông báo đặt phòng tại HazBin Hotel');
                                    $email->to($getUser->email, $getUser->ho_ten);
                                });

                            }catch(Exception $e){
                                // Log::error('Lỗi khi gửi email: ' . $e->getMessage());
                                return redirect()->route('customer.room_detail',['id_rt' => $id_rt])  ->with('error', 'Hệ thống đang gặp sự cố, hãy thử lại sau !! Lỗi: ' . $e->getMessage());;
                            }
                            return redirect() -> route('customer.see_form') -> with('success', 'Đặt phòng thành công !') ;
                                                                                                    //   ->with('ten_lpLogin' , $getNameRT -> ten_lp)
                                                                                                    //   ->with('so_luong' , $sl);
                    }else{
                        // sleep(2.3);
                        return redirect() -> route('customer.room_detail',[['id_rt' => $id_rt]]) -> withInput() ->with('error', 'Lỗi, vui lòng thử lại sau !');
                    }
    }

    public function see_form(){
      
        $sl = session('so_luong');
        $getUserLogin = $this -> us -> getUser(session('id_ctm'));
        $getUser = $this -> us -> getUser(session('idkh_notRegister'));
        $allServicesLg = collect();
        $allgia = collect();
        $getFormLogin = null;
        $getForm = null;
        $countLogin = 0;
        $count = 0;

        $getIdDonLg= null;
        $getIdDon = null;
        $countServiceLg = 0;
        $countService = 0;

        $getBillLogin = null;
        $getBill = null;
        $countBillLg = 0;
        $countBill = 0;
    
        // Nếu người dùng đăng nhập tồn tại
            if ($getUserLogin != null) {
                $getFormLogin = $this->bf->getForm($getUserLogin->id);
                if(!$getFormLogin -> isEmpty()){
                    $countLogin = $getFormLogin ->total();
                  
                }
                $getBillLogin = $this->bill->getBill(session('id_ctm'));
      
                if(!$getBillLogin -> isEmpty()){
                    $countBillLg = $getBillLogin->total();
                }
                $getIdDonLg = $this->bf->getIdDon(session('id_ctm'));
   
                    // if ($getIdDonLg != null) {
                    //     $allServices = collect();
                    //    $allgia = collect();
                    //    $allGiaSl = collect();
                    //    $allServicesLg = collect();

                    //     foreach ($getIdDonLg as $id_don) {
                        
                    //         $gia_sl = $this -> fsd ->  multiplication($id_don);
            
                    //         if(!$gia_sl -> isEmpty()){
                    //             $allGiaSl = $allgia-> merge($gia_sl);
                    //         }
                            
                
                    //         $getServiceLg = $this->fsd->getService($id_don);

                    //         if (!$getServiceLg->isEmpty()) {
                    //             $allServicesLg = $allServices->merge($getServiceLg->items());
                    //         }
                        
                    //     }
                    

                    //     $price = $allGiaSl -> map(function($item){
                    //         return $item->don_gia_dv * $item->so_luong_ct;
                    //     });
                        
                    //     $total = $price -> sum();
                    
                        
                    //     if(!$allServicesLg -> isEmpty()){
                    //         $countServiceLg = $allServicesLg ->count();
                    //     }
                    
                    
                    //     $currentPage = LengthAwarePaginator::resolveCurrentPage(); // Trang hiện tại
                    //     $perPage = 3; // Số lượng bản ghi trên mỗi trang
                    //     $currentItems = $allServices->slice(($currentPage - 1) * $perPage, $perPage)->all(); // Lấy bản ghi cho trang hiện tại
                    
                    //     // Bước 3: Tạo LengthAwarePaginator
                    //     $paginator = new LengthAwarePaginator($currentItems, $allServices->count(), $perPage, $currentPage, [
                    //         'path' => LengthAwarePaginator::resolveCurrentPath(), // Đường dẫn hiện tại
                    //         'query' => request()->query(), // Tham số truy vấn
                    //     ]);
                    
                    //     // Gán paginator cho biến
                    //     $allServicesLgperPage = $paginator; 
                    // }
                $uuDai = collect();
                if ($getIdDonLg != null) {
                    $allServicesLg = collect();
                    $allgia = collect();
                //    $allGiaSl = collect();
                //    $allServicesLg = collect();

                    foreach ($getIdDonLg as $id_don) {

                        // $getServiceLg = $this->fsd->getServiceUD($id_don);
                        $getServiceLg = $this->fsd->getService($id_don);
                        $gia_sl = $this -> fsd ->  multiplication($id_don);
                        if(!$gia_sl -> isEmpty()){
                            $allgia = $allgia-> merge($gia_sl);
                        }
                        if (!$getServiceLg->isEmpty()) {
                            $allServicesLg = $allServicesLg->merge($getServiceLg->items());
                        }
                        // else{
                        //     $getServiceLg = $this->fsd->getService($id_don);
                        //     if (!$getServiceLg->isEmpty()) {
                        //         $allServicesLg = $allServicesLg->merge($getServiceLg->items());
                        //     }
                        // }
                    
                    }
                    // dd($allServicesLg);

                    if(!$allServicesLg -> isEmpty()){
                        $countServiceLg = $allServicesLg ->count();
                    }
                
             
                    $currentPage = LengthAwarePaginator::resolveCurrentPage(); // Trang hiện tại
                    $perPage = 3; // Số lượng bản ghi trên mỗi trang
                    $currentItems = $allServicesLg->slice(($currentPage - 1) * $perPage, $perPage)->all(); // Lấy bản ghi cho trang hiện tại
                
                    // Tạo LengthAwarePaginator
                    $paginator = new LengthAwarePaginator($currentItems, $allServicesLg->count(), $perPage, $currentPage, [
                        'path' => LengthAwarePaginator::resolveCurrentPath(), // Đường dẫn hiện tại
                        'query' => request()->query(), // Tham số truy vấn
                    ]);
                
                  
                    $allServicesLgperPage = $paginator; 
                }

        }
      
        
    
        // Nếu người dùng chưa đăng nhập tồn tại
        if ($getUser != null) {
            $getForm = $this->bf->getForm($getUser->id);
            if($getForm != null){
                $count = $getForm->total();
            }
            $getBill = $this->bill->getBill(session('idkh_notRegister'));
            if($getBill != null){
                $countBill = $getBill->total();
            }
            // $getIdDon = $this->bf->getIdDon(session('id_ctm'));

            // if ($getIdDon != null) {
            //     $allServices = collect(); // Tạo Collection rỗng để gộp kết quả
    
            //     foreach ($getIdDon as $id_don) {
            //         $getService = $this->fsd->getService($id_don);
    
            //         if (!$getService->isEmpty()) {
            //             $allServices = $allServices->merge($getService);
            //         }
            //     }
            //     if($allServices -> isEmpty()){
            //         $countService = $allServices ->total();
            //     }
                
            // }
    }
    
        return view('customer.booking_history.see_form', compact('getUserLogin', 'getFormLogin', 'countLogin', 'count', 'getUser', 'getForm', 'getBillLogin', 'countBillLg', 'getBill', 'countBill','allServicesLg','countServiceLg','countService','allServicesLgperPage','allgia'));

    }

    public function see_history() {
        $getEV = $this -> ev -> getEV();
        $sl = session('so_luong');
        $getUserLogin = $this -> us -> getUser(session('id_ctm'));
        $getUser = $this -> us -> getUser(session('idkh_notRegister'));
        $allServicesLg = collect();
        $allgia = collect();
        $getFormLogin = null;
        $getForm = null;
        $countLogin = 0;
        $count = 0;

        $getIdDonLg= null;
        $getIdDon = null;
        $countServiceLg = 0;
        $countService = 0;

        $getBillLogin = null;
        $getBill = null;
        $countBillLg = 0;
        $countBill = 0;
    
        // Nếu người dùng đăng nhập tồn tại
            if ($getUserLogin != null) {
                
                $getFormLogin = $this->bf->getForm_history($getUserLogin->id);
                
                if(!$getFormLogin -> isEmpty()){
                    $countLogin = $getFormLogin ->total();
                }
                
                $getBillLogin = $this->bill->getBill_history(session('id_ctm'));
      
                if(!$getBillLogin -> isEmpty()){
                    $countBillLg = $getBillLogin->count();
                }
                $getIdDonLg = $this->bf->getIdDon(session('id_ctm'));
       
                $uuDai = collect();
                if ($getIdDonLg != null) {
                    $allServicesLg = collect();
                    $allgia = collect();
                //    $allGiaSl = collect();
                //    $allServicesLg = collect();
                    foreach ($getIdDonLg as $id_don) {

                        // $getServiceLg = $this->fsd->getServiceUD($id_don);
                        $getServiceLg = $this->fsd->getService_history($id_don);
                        $gia_sl = $this -> fsd ->  getMultiplication($id_don);
                        if(!$gia_sl -> isEmpty()){
                            $allgia = $allgia-> merge($gia_sl);
                        }
                        if (!$getServiceLg->isEmpty()) {
                            $allServicesLg = $allServicesLg->merge($getServiceLg);
                        }
                    }

                    if(!$allServicesLg -> isEmpty()){
                        $countServiceLg = $allServicesLg ->count();
                    }
                
             
                    $currentPage = LengthAwarePaginator::resolveCurrentPage(); // Trang hiện tại
                    $perPage = 3; // Số lượng bản ghi trên mỗi trang
                    $currentItems = $allServicesLg->slice(($currentPage - 1) * $perPage, $perPage)->all(); // Lấy bản ghi cho trang hiện tại
                
                    // Tạo LengthAwarePaginator
                    $paginator = new LengthAwarePaginator($currentItems, $allServicesLg->count(), $perPage, $currentPage, [
                        'path' => LengthAwarePaginator::resolveCurrentPath(), // Đường dẫn hiện tại
                        'query' => request()->query(), // Tham số truy vấn
                    ]);
                
                  
                    $allServicesLgperPage = $paginator; 
                }

            }
      
        

        // Nếu người dùng chưa đăng nhập tồn tại
        if ($getUser != null) {
            $getForm = $this->bf->getForm($getUser->id);
            if($getForm != null){
                $count = $getForm->total();
            }
            $getBill = $this->bill->getBill(session('idkh_notRegister'));
            if($getBill != null){
                $countBill = $getBill->total();
            }
        }

        $current = Carbon::now()->format('Y-m-d');
        return view("customer.booking_history.see_history", compact('getUserLogin', 'getFormLogin', 'countLogin', 'count', 'getUser', 'getForm', 
                                                                                                            'getBillLogin', 'countBillLg', 'getBill', 
                                                                                                            'countBill','allServicesLg','countServiceLg',
                                                                                                            'countService','allServicesLgperPage','allgia','current','getEV'));
    }

    public function cancle($id_don){
        // $deleteBill = $this -> bill -> cancleBill($id_don);
        // if($deleteBill == true){
                $cancle = $this -> bf -> cancleForm($id_don);
                if($cancle == true){
                    return redirect() -> route('customer.see_form') -> with('success','Hủy đơn thành công !');
                }else{
                    return redirect() -> route('customer.see_form') -> with('error','Lỗi , vui lòng thử lại sau !');
                }
        // }else{
        //     return redirect() -> route('customer.see_form') -> with('error','Lỗi , vui lòng thử lại sau !');

        // }
    }

    public function insert_profile(){
        return view('customer.booking_room.insert_profile');
    }

    public function save_profile(Request $rq){
        $token = strtoupper(Str::random(10)); 
        $dataPro5 = [
            'ho_ten' => $rq->ho_ten,
            'gioi_tinh' => $rq->gioi_tinh,
            'sdt' => $rq -> sdt,
            'email' => $rq -> email,
            'dia_chi' => $rq -> dia_chi,
            'role' =>  1,
            'status' =>  1,
            'token' =>  $token,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $id_rt = $rq -> id_rt;
        $sl = (int)$rq -> sl;
        
        $getNameRT = $this -> rt -> getRoomTypeID($id_rt);
        $checkUser = $this -> us ->checkUser($rq ->email);
        if($checkUser != null){
            $id_kh = $this -> us -> getID($rq -> email);
            session(['idkh_notLogin' => $id_kh]);
            session(['emailkh_notLogin' => $rq ->email]);
            
            $updateUser = $this -> us -> updateUser($rq -> email , $dataPro5);
            if($updateUser == true){
                for ($i = 0; $i < $sl; $i++) {
                    $dataBF = [
                        'id_kh' => $id_kh,
                        'id_loai_phong' => $id_rt,
                        'ngay_nhan_phong' => $rq -> ngayNhan,
                        'ngay_tra_phong' => $rq -> ngayTra,
                        'so_ngay_o' => $rq -> soNgay,
                        'tinh_trang' => "Chưa xác nhận",
                        'ghi_chu' => $rq -> note,
                        'status' => 1,
                        'gn' => 1,
                    ];
       
                    $insertForm = $this -> bf -> insertForm($dataBF);
                }

                if($insertForm == true){
                    $getUser = $this -> us -> checkUser($rq -> email);
                    $getForm = $this->bf->getFormFirst($id_kh);
             
                    session(['idCtm_notLogin' => $id_kh]);
                    try{
                        Mail::send('customer.booking_room.notice_of_bf', ['customer' => $getUser ,'getForm' => $getForm,'id_rt' =>  $id_rt,'getNameRT' => $getNameRT ], function ($email) use ($getUser) {
                            $email->subject('HTQLKS - Thông báo đặt phòng tại HazBin Hotel');
                            $email->to($getUser->email, $getUser->ho_ten);
                        });
                        // Log::info('Email đã được gửi tới: ' . $getUser->email);
                    }catch(Exception $e){
                        // Log::error('Lỗi khi gửi email: ' . $e->getMessage());
                        return redirect()->route('customer.room_detail',['id_rt' => $id_rt])  ->with('error', 'Hệ thống đang gặp sự cố, hãy thử lại sau !! Lỗi: ' . $e->getMessage());;
                    }
                    return redirect() -> route('customer.see_form') ->with('success', 'Đặt phòng thành công !') ;
                                                                                                // ->with('ten_lp' , $getNameRT -> ten_lp)
                                                                                                // ->with('so_luong' , $sl);
                }else{
                    
                    return redirect() -> route('customer.insert_profile') ->with('error', 'Lỗi tạo đơn đặt phòng, vui lòng thử lại!');
                }
            }else{
                
                return redirect() -> route('customer.insert_profile') ->with('error', 'Lỗi cập nhật thông tin KH, vui lòng thử lại!');
            }
        }else{

            $id_rt = $rq -> id_rt;
            $getNameRT = $this -> rt -> getRoomTypeID($id_rt);
        //    dd($getNameRT);
            $insertUser = $this -> us -> insertUser($dataPro5);
            if($insertUser == true){
                // $updatePass = $this -> us -> updatePass($rq -> email);
                $id_kh = $this -> us -> getID($rq -> email);
                
                session(['idkh_notRegister' => $id_kh]);
                session(['emailkh_notRegister' => $rq ->email]);
                for ($i = 0; $i < $sl; $i++) {
                    $dataBF = [
                        'id_kh' => $id_kh,
                        'id_loai_phong' => $id_rt,
                        'id_phong' => NULL,
                        'ngay_nhan_phong' => $rq -> ngayNhan,
                        'ngay_tra_phong' => $rq -> ngayTra,
                        'so_ngay_o' => $rq -> soNgay,
                        'tinh_trang' => "Chưa xác nhận",
                        'ghi_chu' => $rq -> note,
                        'status' => 1,
                        'gn' => 1,
                    ];
                    
                    $insertForm = $this -> bf -> insertForm($dataBF);
                }

                $getUser = $this -> us -> checkUser($rq -> email);
                $getForm = $this->bf->getFormFirst($id_kh);
         
                if($insertForm == true){
                    
                    try{
                        Mail::send('customer.booking_room.notice_of_bf', ['customer' => $getUser ,'getForm' => $getForm,'id_rt' =>  $id_rt,'getNameRT' => $getNameRT ], function ($email) use ($getUser) {
                            $email->subject('HTQLKS - Thông báo đặt phòng tại HazBin Hotel');
                            $email->to($getUser->email, $getUser->ho_ten);
                        });
                        // Log::info('Email đã được gửi tới: ' . $getUser->email);
                    }catch(Exception $e){
                        // Log::error('Lỗi khi gửi email: ' . $e->getMessage());
                        return redirect()->route('customer.room_detail',['id_rt' => $id_rt])  ->with('error', 'Hệ thống đang gặp sự cố, hãy thử lại sau !! Lỗi: ' . $e->getMessage());;
                    }
                    return redirect() -> route('customer.see_form') -> with('success', 'Đặt phòng thành công !') ;
                                                                                            //   ->with('getNameRT' , $getNameRT -> ten_lp)
                                                                                            //   ->with('so_luong' , $sl);
                    }else{
                        
                        return redirect() -> route('customer.insert_profile') ->with('error', 'Lỗi tạo đơn đặt phòng, vui lòng thử lại!');
                    }
                }else{
                    
                    return redirect() -> route('customer.insert_profile') ->with('error', 'Lỗi cập nhật thông tin KH, vui lòng thử lại!');
                }
            }
        }

        public function evaluate(Request $rq){
            $rating = $rq->query('rating');
            $comment = $rq->query('comment');
            $user_id = $rq->query('user_id');
            $booking_id = $rq->query('booking_id');
            $room_id = $rq->query('room_id');
            $data = [
                'noi_dung' => $comment,
                'diem' => $rating,
                'khach_hang' =>$user_id,
                'don' => $booking_id,
                'loai_phong' =>$room_id,
                'so_lan_sua' => 0,
                'status' =>1
            ];
            $insertEV = $this -> ev -> insertEV($data);
            if($insertEV){
                return redirect() -> route('customer.see_form') ->with('success','Cảm ơn đánh giá của bạn !!');
            }else{
                return redirect() -> route('customer.see_form') ->with('error','Lỗi, vui lòng thử lại sau !!');
            }
        }

        public function update_review(Request $rq) {
            $comment = $rq->query('comment');
            $booking_id = $rq->query('booking_id');
            $data = [
                'noi_dung' => $comment,
                'so_lan_sua' => 1,
                'updated_at' => now()
            ];
            $updateEV = $this -> ev -> updateEV($data,$booking_id);
            if($updateEV){
                return redirect() -> route('customer.see_form') ->with('success','Cập nhật đánh giá thành công');
            }else{
                return redirect() -> route('customer.see_form') ->with('error','Lỗi, vui lòng thử lại sau !!');
            }
        }
        
    }

