<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FormServiceDetail extends Model
{
    use HasFactory;
    protected $fsd ="form_service_details";

    public function insert($data){
        return $result = DB::table($this -> fsd)
                            ->insert($data);
    }

    public function getApproved($keywords){
        $result = DB::table('form_service_details as fsd') 
                        ->join("service as sv", "sv.id_dv" ,"=", "fsd.id_dv")
                        ->leftjoin("service_type as svt","svt.id_ldv", "=", "sv.loai_dv")
                        ->join("booking_form as bf", "bf.id_don", "=", 'fsd.id_ddp')
                        ->join("room_type as rt","rt.id_lp","=","bf.id_loai_phong")
                        ->join("room as r","bf.id_phong","=","r.id_phong")
                        ->select("fsd.*","sv.ten_dv","sv.don_gia_dv","svt.id_ldv","svt.ten_ldv","bf.id_loai_phong","bf.id_phong","r.so_phong","rt.ten_lp")
                        ->where("fsd.status",1);
                        if (!empty($keywords)) {
                            $result->where(function ($query) use ($keywords) {
                                $query->orWhere('svt.ten_ldv', 'like', '%' . $keywords . '%')
                                            ->orWhere('rt.ten_lp', 'like', '%' . $keywords . '%')
                                            ->orWhere('sv.don_gia_dv', '=', $keywords)
                                            ->orWhere('r.so_phong', 'like', '='. $keywords)
                                            ->orWhereRaw("DATE_FORMAT(fsd.created_at, '%Y-%m-%d') like ?", ['%' . $keywords . '%']) 
                                            ->orWhereRaw("DATE_FORMAT(fsd.updated_at, '%Y-%m-%d') like ?", ['%' . $keywords . '%'])
                                            ->orWhereRaw("DATE_FORMAT(fsd.ngay_su_dung, '%Y-%m-%d') like ?", ['%' . $keywords . '%']); 
                            });
                        }
                
            return $result ->paginate(5);     
    }
    // public function multiplication($id_ddp){
    //     return $result = DB::table("form_service_details as fsd")
    //                         ->join("service as sv", "sv.id_dv" ,"=", "fsd.id_dv")
    //                         ->where("fsd.id_ddp",$id_ddp)
    //                         ->where("fsd.gn",1)
    //                         // ->where("fsd.tinh_trang_ct","Đã xác nhận")
    //                         ->select("fsd.*","sv.ten_dv","sv.don_gia_dv")
    //                         ->get(); 
    // }
    public function multiplication($id_ddp){
        return $result = DB::table("form_service_details as fsd")
                            ->join("service as sv", "sv.id_dv", "=", "fsd.id_dv")
                            ->leftJoin('service_incentives as svi', 'svi.id_dv', '=', 'sv.id_dv')
                            ->leftJoin('special_offers as spo', 'spo.id_ud', '=', 'svi.id_ud') 
                            ->where("fsd.id_ddp",$id_ddp) 
                            ->where("fsd.gn", 1)
                            ->select("fsd.*", "sv.ten_dv", "sv.don_gia_dv", "spo.ten_ud", "spo.giam","spo.sl_ap_dung")
                            ->get(); 
    }

    public function getMultiplication($id_ddp){
        return $result = DB::table("form_service_details as fsd")
                            ->join("service as sv", "sv.id_dv", "=", "fsd.id_dv")
                            ->leftJoin('service_incentives as svi', 'svi.id_dv', '=', 'sv.id_dv')
                            ->leftJoin('special_offers as spo', 'spo.id_ud', '=', 'svi.id_ud') 
                            ->where("fsd.id_ddp",$id_ddp) 
                            // ->where("fsd.gn", 1)
                            ->select("fsd.*", "sv.ten_dv", "sv.don_gia_dv", "spo.ten_ud", "spo.giam","spo.sl_ap_dung")
                            ->get(); 
    }

    public function getIDSV($id_dv){
        return $result = DB::table("form_service_details as fsd")
                            ->join("service as sv", "sv.id_dv", "=", "fsd.id_dv")
                            ->leftJoin('service_incentives as svi', 'svi.id_dv', '=', 'sv.id_dv')
                            ->leftJoin('special_offers as spo', 'spo.id_ud', '=', 'svi.id_ud') // Đảm bảo cột đúng
                            ->where("svi.id_dv", $id_dv)
                            ->where("fsd.gn", 1)
                            ->select("fsd.id_dv", "sv.ten_dv", "sv.don_gia_dv", "spo.ten_ud", "spo.giam")
                            ->get();

    }
    public function getServiceUD($id_don){
        return $result = DB::table("form_service_details as fsd")
                            ->leftJoin("service as sv", "sv.id_dv" ,"=", "fsd.id_dv")
                            ->leftJoin("service_type as svt",'svt.id_ldv', "=", "sv.loai_dv")
                            ->leftJoin('service_incentives as svi','svi.id_dv', '=','sv.id_dv')
                            ->leftJoin('special_offers as spo' ,'spo.id_ud','=', 'svi.id_ud')
                            ->join("booking_form as bf", "bf.id_don", "=", 'fsd.id_ddp')
                            ->join("room_type as rt","rt.id_lp","=","bf.id_loai_phong")
                            ->join("room as r","bf.id_phong","=","r.id_phong")
                            ->select("fsd.*","sv.ten_dv","sv.don_gia_dv","svt.id_ldv","svt.ten_ldv","bf.id_loai_phong","bf.id_phong","r.so_phong","rt.ten_lp",'spo.*','svi.id_uddv')
                            ->where("fsd.id_ddp",$id_don)
                            ->orderBy('fsd.id_ct','desc') 
                            // ->where("fsd.status",1)
                            // ->where("fsd.gn",1)
                            ->paginate(3);
                            // ->get();
                      
    }
    
    public function getService($id_don){
        return $result = DB::table("form_service_details as fsd")
                            ->join("service as sv", "sv.id_dv" ,"=", "fsd.id_dv")
                            ->leftJoin("service_type as svt","svt.id_ldv", "=", "sv.loai_dv")
                            ->join("booking_form as bf", "bf.id_don", "=", 'fsd.id_ddp')
                            ->join("room_type as rt","rt.id_lp","=","bf.id_loai_phong")
                            ->join("room as r","bf.id_phong","=","r.id_phong")
                            ->select("fsd.*","sv.ten_dv","sv.don_gia_dv","svt.id_ldv","svt.ten_ldv","bf.id_loai_phong","bf.id_phong","r.so_phong","rt.ten_lp")
                            ->where("fsd.id_ddp",$id_don)
                            ->orderBy('fsd.id_ct','desc') 
                            // ->where("fsd.status",1)
                            // ->where("fsd.gn",1)
                            ->paginate(3);
                            // ->get();
                      
    }
    public function getService_history($id_don){
        return $result = DB::table("form_service_details as fsd")
                            ->join("service as sv", "sv.id_dv" ,"=", "fsd.id_dv")
                            ->leftJoin("service_type as svt","svt.id_ldv", "=", "sv.loai_dv")
                            ->join("booking_form as bf", "bf.id_don", "=", 'fsd.id_ddp')
                            ->join("room_type as rt","rt.id_lp","=","bf.id_loai_phong")
                            ->join("room as r","bf.id_phong","=","r.id_phong")
                            ->select("fsd.*","sv.ten_dv","sv.don_gia_dv","svt.id_ldv","svt.ten_ldv","bf.id_loai_phong","bf.id_phong","r.so_phong","rt.ten_lp")
                            ->where("fsd.id_ddp",$id_don)
                            ->orderBy('fsd.id_ct','desc') 
                            ->get();
                            // ->where("fsd.status",1)
                            // ->where("fsd.gn",1)
                            // ->paginate(3);
                            // ->get();                 
    }

    public function cancleService($id_ct){
        return $result = DB::table($this -> fsd)
                            ->where('id_ct', $id_ct)
                            ->delete();
    }

    public function getUnapprove(){
        return $result = DB::table("form_service_details as fsd")
                            ->join("service as sv", "sv.id_dv" ,"=", "fsd.id_dv")
                            ->leftjoin("service_type as svt","svt.id_ldv", "=", "sv.loai_dv")
                            ->join("booking_form as bf", "bf.id_don", "=", 'fsd.id_ddp')
                            ->join("room_type as rt","rt.id_lp","=","bf.id_loai_phong")
                            ->join("room as r","bf.id_phong","=","r.id_phong")
                            ->select("fsd.*","sv.ten_dv","sv.don_gia_dv","svt.id_ldv","svt.ten_ldv","bf.id_loai_phong","bf.id_phong","r.so_phong","rt.ten_lp")
                            ->where("fsd.tinh_trang_ct",'Chưa xác nhận')
                            ->where("fsd.status",1)
                            ->where("fsd.gn",1)
                            ->paginate(4);
    }
    // public function getApproved(){
    //     return $result = DB::table("form_service_details as fsd")
    //                         ->join("service as sv", "sv.id_dv" ,"=", "fsd.id_dv")
    //                         ->leftjoin("service_type as svt","svt.id_ldv", "=", "sv.loai_dv")
    //                         ->join("booking_form as bf", "bf.id_don", "=", 'fsd.id_ddp')
    //                         ->join("room_type as rt","rt.id_lp","=","bf.id_loai_phong")
    //                         ->join("room as r","bf.id_phong","=","r.id_phong")
    //                         ->select("fsd.*","sv.ten_dv","sv.don_gia_dv","svt.id_ldv","svt.ten_ldv","bf.id_loai_phong","bf.id_phong","r.so_phong","rt.ten_lp")
    //                         ->where("fsd.tinh_trang_ct",'Đã xác nhận')
    //                         ->where("fsd.status",1)
    //                         // ->where("fsd.gn",1)
    //                         ->paginate(4);
    // }
    public function deleteForm($id_ct){
        return $result = DB::table($this -> fsd)                          
                        ->where('id_ct', $id_ct)
                        ->update(['status' => 0]);
    }

    public function getDKSV($id_ddp){
        return $result = DB::table($this -> fsd)       
                                ->where('id_ddp',$id_ddp)
                                ->where('status', 1)
                                ->where('gn', 1)
                                -> get();
    }

    public function updatedFSV($id_ct){
        return $result = DB::table($this -> fsd)      
                            ->where('id_ct', $id_ct)
                            ->update(['gn' => 0]);    
    }
}
