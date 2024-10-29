<?php

namespace App\Http\Controllers\customer\about;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Menu;
use App\Models\BookingForm;
use App\Models\SpecialOffers;
use App\Models\FormServiceDetail;
use App\Models\ServiceIncentives;
use App\Models\Bill;
use Carbon\Carbon;

class C_ServiceController extends Controller
{
    protected $sv;
    protected $svt;
    protected $mn;
    protected $sp_o;
    protected $bf;
    protected $fsd;
    protected $svi;
    protected $bill;
    public function __construct()
    {
            $this -> sv = new Service();
            $this -> svt = new ServiceType();
            $this -> mn = new Menu();
            $this -> sp_o = new SpecialOffers();
            $this -> bf = new BookingForm();
            $this -> fsd = new FormServiceDetail();
            $this -> bill = new Bill();
    }

    
    public function service_type(Request $rq , $id_ldv){
        $ldv = $this -> svt -> getServiceTypeID($id_ldv);
        $special_offers = $this -> sp_o -> getSpecialOffers($id_ldv);
        return view('customer.service_type.service_type',compact('ldv','special_offers'));
    }

    public function service($id_ldv){
        $id_form = $this -> bf -> getIDForm2(session('id_ctm'));
        // $hasRoom = count($id_form) > 0;
        // dd($hasRoom);
        $service = $this -> sv -> getService($id_ldv);
        $special_offers = $this -> sp_o -> getListSpecialOffers($id_ldv);
        
        // dd($id_form);
        // $menu = 0;
        // if(count($service) > 0){
        //     foreach ($service as $row) {
        //         $menu = $this->mn->getMenuSV($row->id_dv);
        //         $menuFood = $this -> mn -> getMenuFood($row ->id_dv);
        //     //   dump($menu);
        //     }
        
        // }else{
        //     $menu = null;
        // }
        
        return view('customer.service_type.service',compact('service','id_ldv','special_offers','id_form'));
    }

    // public function service_booking(Request $rq){
     
    //         $ngay_su_dung = Carbon::createFromFormat('d-m-Y', $rq->ngay_su_dung)->format('Y-m-d') ;
    //         $data_so_luong = $rq ->hidden_so_luong;
    //         $ghi_chu = $rq ->ghi_chu;
    //         $data_id_dv = $rq ->hidden_id_dv;
    //         if(count($data_id_dv) == count($data_so_luong)){
    //             $dataService = [];
    //             foreach($data_id_dv as $key => $id_dv){
    //                 $dataService[] = [
    //                         'id_ddp' => $rq -> id_don,
    //                         'id_dv' => $id_dv,
    //                         'ngay_su_dung' => $ngay_su_dung,
    //                         'so_luong_ct' => $data_so_luong[$key],
    //                         'ghi_chu_ct' => $ghi_chu,
    //                         'tinh_trang_ct' => "Đã xác nhận",
    //                         'status' => 1,
    //                         'gn' => 1,
    //                         'created_at' => now(),
    //                         'updated_at' => now(),
    //                 ];
    //             }

    //             $insertCTD = $this -> fsd -> insert($dataService);
    //             if($insertCTD == true){
    //                 $getIdDonLg = $this->bf->getIdDon(session('id_ctm'));                   
    //                 if ($getIdDonLg -> isNotEmpty()) {
    //                     $allgia = collect();
    //                     foreach ($getIdDonLg as $id_don) {
    //                         $gia_sl = $this -> fsd ->  multiplication($id_don);   
    //                         if(!$gia_sl -> isEmpty()){
    //                             $allgia = $allgia-> merge($gia_sl);
    //                             $price = $allgia -> map(function($item){
    //                                 if ($item->so_luong_ct >= $item->sl_ap_dung) {
    //                                     $discount = $item->don_gia_dv * $item->so_luong_ct * ($item->giam / 100);
    //                                     return $item->don_gia_dv * $item->so_luong_ct - $discount;
    //                                 } else {   
    //                                     return $item->don_gia_dv * $item->so_luong_ct;
    //                                 }                    
    //                              });                                     
    //                              $total = $price -> sum();
    //                              $bill = $this -> bill -> getBillDon($id_don);
    //                              if($bill != null){       
    //                                 $tong_tien_up = $bill -> tong_tien + $total;          
    //                                 $dataUpdated = [
    //                                     'phi_dv' => $total,
    //                                     'tong_tien' => $tong_tien_up,
                                        
    //                                 ];
    //                                 $updatedBill = $this -> bill -> updatedBill($bill -> id_hd, $dataUpdated);
    //                              }
    //                         }                             
    //                     }      
    //                 }
    //                  return redirect() -> route('customer.see_form')->with('success',"Đã đăng ký dịch vụ!");
    //             }
    //         }
    // }
    // public function service_booking(Request $rq){    
    //         $ngay_su_dung = Carbon::createFromFormat('d-m-Y', $rq->ngay_su_dung)->format('Y-m-d') ;
    //         $data_so_luong = $rq ->hidden_so_luong;
    //         $ghi_chu = $rq ->ghi_chu;
    //         $data_id_dv = $rq ->hidden_id_dv;
    //         if(count($data_id_dv) == count($data_so_luong)){
    //             $dataService = [];
    //             foreach($data_id_dv as $key => $id_dv){
    //                 $dataService[] = [
    //                         'id_ddp' => $rq -> id_don,
    //                         'id_dv' => $id_dv,
    //                         'ngay_su_dung' => $ngay_su_dung,
    //                         'so_luong_ct' => $data_so_luong[$key],
    //                         'ghi_chu_ct' => $ghi_chu,
    //                         'tinh_trang_ct' => "Đã xác nhận",
    //                         'status' => 1,
    //                         'gn' => 1,
    //                         'created_at' => now(),
    //                         'updated_at' => now(),
    //                 ];
    //             }

    //             $insertCTD = $this -> fsd -> insert($dataService);
    //             if($insertCTD == true){
    //                 $getIdDonLg = $this->bf->getIdDon(session('id_ctm'));                   
    //                 if ($getIdDonLg -> isNotEmpty()) {
    //                     $allgia = collect();
    //                     foreach ($getIdDonLg as $id_don) {
    //                         $gia_sl = $this -> fsd ->  multiplication($id_don);   
    //                         if(!$gia_sl -> isEmpty()){
    //                             $allgia = $allgia-> merge($gia_sl);
    //                             $price = $allgia -> map(function($item){
    //                                 if ($item->so_luong_ct >= $item->sl_ap_dung) {
    //                                     $discount = $item->don_gia_dv * $item->so_luong_ct * ($item->giam / 100);
    //                                     return $item->don_gia_dv * $item->so_luong_ct - $discount;
    //                                 } else {   
    //                                     return $item->don_gia_dv * $item->so_luong_ct;
    //                                 }                    
    //                              });            
                                        
    //                             }
    //                         }        
                          
    //                              $total = $price -> sum();            
    //                              dd($total);     
    //                              $fsv = $this -> fsd -> getDKSV($id_don);
    //                              if($fsv -> isNotEmpty()){ 
    //                                  foreach($fsv as $form){
    //                                      $updatedFSV = $this -> fsd -> updatedFSV($form -> id_ct);
    //                                  }   
    //                              }
                                    
    //                                 $bill = $this -> bill -> getBillDon($id_don);
                                    
    //                              if($bill != null){         
    //                                 $dataUpdated = [
    //                                     'phi_dv' => $bill -> phi_dv + $total, 
    //                                     'tong_tien' => $bill->tong_tien + $total,
    //                                 ];
    //                                 $updatedBill = $this -> bill -> updatedBill($bill -> id_hd, $dataUpdated);
    //                             }  
    //                 }
    //                  return redirect() -> route('customer.see_form')->with('success',"Đã đăng ký dịch vụ!");
    //             }
    //         }
    // }
    public function service_booking(Request $rq){    
            $ngay_su_dung = Carbon::createFromFormat('d-m-Y', $rq->ngay_su_dung)->format('Y-m-d') ;
            $data_so_luong = $rq ->hidden_so_luong;
            $ghi_chu = $rq ->ghi_chu;
            $data_id_dv = $rq ->hidden_id_dv;
            if(count($data_id_dv) == count($data_so_luong)){
                $dataService = [];
                foreach($data_id_dv as $key => $id_dv){
                    $dataService[] = [
                            'id_ddp' => $rq -> id_don,
                            'id_dv' => $id_dv,
                            'ngay_su_dung' => $ngay_su_dung,
                            'so_luong_ct' => $data_so_luong[$key],
                            'ghi_chu_ct' => $ghi_chu,
                            'tinh_trang_ct' => "Đã xác nhận",
                            'status' => 1,
                            'gn' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                    ];
                }

                $insertCTD = $this -> fsd -> insert($dataService);
                if($insertCTD == true){
                    // $getIdDonLg = $this->bf->getIdDon(session('id_ctm'));                   
                    // if ($getIdDonLg -> isNotEmpty()) {
                        $allgia = collect();
                        // foreach ($getIdDonLg as $id_don) {
                            $gia_sl = $this -> fsd ->  multiplication($rq->id_don);   
                            if(!$gia_sl -> isEmpty()){
                                $allgia = $allgia-> merge($gia_sl);
                                $price = $allgia -> map(function($item){
                                    if ($item->so_luong_ct >= $item->sl_ap_dung) {
                                        $discount = $item->don_gia_dv * $item->so_luong_ct * ($item->giam / 100);
                                        return $item->don_gia_dv * $item->so_luong_ct - $discount;
                                    } else {   
                                        return $item->don_gia_dv * $item->so_luong_ct;
                                    }                    
                                 });            
                                        
                                }
                            // }        
                          
                            // dd($price);     
                                 $total = $price -> sum();            
                                 $fsv = $this -> fsd -> getDKSV($rq->id_don);
                                 if($fsv -> isNotEmpty()){ 
                                     foreach($fsv as $form){
                                         $updatedFSV = $this -> fsd -> updatedFSV($form -> id_ct);
                                     }   
                                 }
                                    
                                    $bill = $this -> bill -> getBillDon($rq->id_don);
                                    
                                 if($bill != null){         
                                    $dataUpdated = [
                                        'phi_dv' => $bill -> phi_dv + $total, 
                                        'tong_tien' => $bill->tong_tien + $total,
                                    ];
                                    $updatedBill = $this -> bill -> updatedBill($bill -> id_hd, $dataUpdated);
                        // }  
                    }
                     return redirect() -> route('customer.see_form')->with('success',"Đã đăng ký dịch vụ!");
                }
            }
    }
    

    public function cancle_service($id_ct){
        // dd($id_ct);
            $cancleSV = $this -> fsd -> cancleService($id_ct);
            if($cancleSV == true){
          
                        return redirect() -> route('customer.see_form') -> with('success','Hủy đơn thành công !');
                 
            }else{
                return redirect() -> route('customer.see_form') -> with('error','Lỗi , vui lòng thử lại sau !');
    
            }
        
    }
}
