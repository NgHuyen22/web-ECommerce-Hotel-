<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceIncentives;
use App\Models\SpecialOffers;
use App\Models\Service;

class SpecialOffersController extends Controller
{
    protected $uddv ;
    protected $ud ;
    protected $sv ;
    public function __construct()
    {
        $this -> uddv = new ServiceIncentives();
        $this -> ud = new SpecialOffers();
        $this -> sv = new Service();
    }

    public function stop($id_uddv){

        $delete = $this -> uddv -> deleteUDDV($id_uddv);
        if($delete == true){
            return redirect() -> route('admin.special_offers') -> with('success', 'Thành công');
        }else{
            return redirect() -> route('admin.special_offers') -> with('error', 'Lỗi, vui lòng thử lại sau');

        }
    }

    public function edit_spo(Request $rq ,$id_ud){
        $ud = $this -> ud -> getUdId($id_ud) ;
        $uddv = $this -> uddv -> getUd($id_ud) ;
        $array_idsv = $rq ->input('id_dv', []);
        
        $allTTServices = collect();
        foreach($array_idsv as $id_dv){
            // $ttdv = $this -> sv -> getTTService($id_dv);
            $ttdv = $this -> uddv -> getTTServices($id_dv);
            if($ttdv != null)
             $allTTServices -> push($ttdv);
        }
        
        $services = $this -> sv -> getAllService();
       return view('admin.Update _offers.edit_specialOffers', compact('id_ud', 'ud','services', 'uddv','allTTServices'));
    }

    public function updated(Request $rq){
      
        $data = [
            'ten_ud' => $rq -> ten_ud,
            'giam' => $rq -> giam,
            'sl_ap_dung' => $rq -> sl_ap_dung,
            'tg_ap_dung' => $rq -> tg_ap_dung,
            'tg_ket_thuc' => $rq -> tg_ket_thuc,
            'updated_at' => now()
        ];
        $array_idsv = $rq -> input('id_dv',[]);

        $update = $this -> ud -> updateUD($rq->id_ud, $data);

        if($update == true ){
      
            if(!empty($array_idsv) ){
                foreach($array_idsv as $id_dv){
                    $dataDv = [
                        'id_ud' => $rq->id_ud,
                        'id_dv' => $id_dv
                    ];
               
                    $insertUddv = $this -> uddv -> insertUddv($dataDv);
                }

                if($insertUddv == true){
                    return redirect() -> route('admin.special_offers')->with('success','Cập nhật thành công');
                }else{
                    
                    return redirect() -> route('admin.special_offers')->with('success','Lỗi cập nhập dịch vụ áp dụng , vui lòng thử lại !');
                }
            }else{
                return redirect() -> route('admin.special_offers')->with('success','Cập nhật thành công');
            }
        }else{     
            return redirect() -> route('admin.special_offers')->with('error','Lỗi, vui lòng thử lại sau !');
        }
        
    }

    public function remove($id_ud){
        $delete = $this -> ud -> deleteUD($id_ud);
        if($delete = true){
            return redirect() -> route('admin.special_offers') -> with('success','Xóa thành công');
        }else{
            
            return redirect() -> route('admin.special_offers') -> with('error','Lỗi, vui lòng thử lại sau !');
        }
    }

    public function add_incentives(){
        $services = $this -> sv -> getAllService();
        return view('admin.Update _offers.add_incentives',compact('services'));
    }

    public function insert_incentives(Request $rq){
        $array_idsv = $rq -> input('id_dv',[]);
        
        $data = [
            'ten_ud' => $rq -> ten_ud,
            'giam' => $rq -> giam,
            'sl_ap_dung' => $rq -> sl_ap_dung,
            'tg_ap_dung' => $rq -> ngay_ap_dung,
            'tg_ket_thuc' => $rq -> ngay_ket_thuc,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $insert = $this -> ud -> insertUD($data);
        if($insert == true ){
            $getUdFirst = $this -> ud -> getUdFirst();
            if(!empty($array_idsv) ){
                foreach($array_idsv as $id_dv){
                    $dataDv = [
                        'id_ud' => $getUdFirst,
                        'id_dv' => $id_dv
                    ];
               
                    $insertUddv = $this -> uddv -> insertUddv($dataDv);
                }

                if($insertUddv == true){
                    return redirect() -> route('admin.special_offers')->with('success','Thêm thành công');
                }else{
                    
                    return redirect() -> route('admin.special_offers')->with('success','Lỗi thêm dịch vụ áp dụng , vui lòng thử lại !');
                }
            }else{
                return redirect() -> route('admin.special_offers')->with('success','Thêm thành công');
            }
        }else{     
            return redirect() -> route('admin.special_offers')->with('error','Lỗi, vui lòng thử lại sau !');
        }

    }
}
