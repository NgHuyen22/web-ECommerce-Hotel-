<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;

    protected $sv = "service";
    public function getService($id_ldv){
        return $result = DB::table($this -> sv)
                            ->where('status', 1)
                            ->where('loai_dv', $id_ldv)
                            ->get();
    }

    public function getService1($id_ldv){
        return $result = DB::table('service as sv')
                            ->join('service_type as svt', 'svt.id_ldv', '=', 'sv.loai_dv')
                            ->select('sv.*','svt.ten_ldv')
                            ->where('sv.status', 1)
                            ->where('loai_dv', $id_ldv)
                            ->paginate(2);
    }

    public function insertSV($data){
        return $result = DB::table($this -> sv)
                            ->insert($data);
    }

    public function checkNameSV($ten_dv){
        return $result = DB::table($this-> sv)
                            ->where('ten_dv', $ten_dv)
                            ->where('status', 1)
                            ->first();
    }

    public function updatedSV($id_dv, $data){
        return $result = DB::table($this -> sv)
                            ->where('id_dv', $id_dv)
                            ->update($data);
    }

    public function getAllService() {
        return $result = DB::table($this -> sv)
                            ->where('status', 1)
                            ->get();
    }
    
    public  function getTTService($id_dv){
        return $result = DB::table($this -> sv)
                            ->where('id_dv', $id_dv)
                            ->first();
    }

    // public function getSVMonth($bien) {
    //         return $result = DB::table('form_service_details as fsd')
    //             ->join('bill as b', 'b.don_dat_phong','=','fsd.id_ddp')
    //             ->where('fsd.tinh_trang_ct','Đã xác nhận')
    //             ->whereMonth('fsd.created_at',$bien)
    //             ->select('bill.id_hd','bill.don_dat_phong','bill.phi_dv','fsd.id_dv','fsd.created_at')
    //             ->get();
    // }

    // public function getSVAllMonth() {
    //     return $result = DB::table('form_service_details as fsd')
    //                         ->join('service as sv', 'sv.id_dv' ,'=' , 'fsd.id_dv')
    //                         ->join('service_type as svt', 'sv.loai_dv' ,'=' , 'svt.id_ldv')
    //                         ->join('bill as b', 'b.don_dat_phong','=','fsd.id_ddp')
    //                         ->where('fsd.tinh_trang_ct','Đã xác nhận')
    //                         ->where('b.trang_thai_hd', 'Đã thanh toán')
    //                         // ->whereMonth('b.updated_at', $month) 
    //                         ->select (
    //                             DB::raw('MONTH(b.updated_at) as month'),
    //                             'sv.id_dv',                         
    //                             'sv.ten_dv',                         
    //                             'svt.ten_ldv',
    //                             DB::raw('SUM() as tong_dt'),
    //                             DB::raw('COUNT(fsd.id_ct) as tong_don'),
    //                         )
    //                         ->groupBy(DB::raw('MONTH(b.updated_at)'), 'sv.id_dv','sv.ten_dv','svt.ten_ldv')
    //                         ->get();
                         
    // }
    public function getSVAllMonth() {
        return $result = DB::table('form_service_details as fsd')
                            ->join('service as sv', 'sv.id_dv' ,'=' , 'fsd.id_dv')
                            ->join('service_type as svt', 'sv.loai_dv' ,'=' , 'svt.id_ldv')
                            ->leftjoin('service_incentives as svi','svi.id_dv','=','sv.id_dv')
                            ->leftjoin('special_offers as spo','spo.id_ud','=','svi.id_ud')
                            ->join('bill as b', 'b.don_dat_phong','=','fsd.id_ddp')
                            ->where('fsd.tinh_trang_ct','Đã xác nhận')
                            ->where('b.trang_thai_hd', 'Đã thanh toán')
                            // ->whereMonth('b.updated_at', $month) 
                            ->select (
                                DB::raw('MONTH(b.updated_at) as month'),
                                'sv.id_dv',                         
                                'sv.ten_dv',                         
                                'svt.ten_ldv',
                                DB::raw('SUM(
                                    CASE
                                        WHEN fsd.so_luong_ct = spo.sl_ap_dung THEN sv.don_gia_dv * fsd.so_luong_ct * (1 - spo.giam / 100)
                                        ELSE sv.don_gia_dv * fsd.so_luong_ct
                                    END
                                ) as tong_dt'),
                                DB::raw('COUNT(fsd.id_ct) as tong_don'),
                            )
                            ->groupBy(DB::raw('MONTH(b.updated_at)'), 'sv.id_dv','sv.ten_dv','svt.ten_ldv')
                            ->get();               
    }

    public function getAllMonth() {
        return $result = DB::table('form_service_details as fsd')
                            ->join('bill as b', 'b.don_dat_phong','=','fsd.id_ddp')
                            ->where('fsd.tinh_trang_ct','Đã xác nhận')
                            ->where('b.trang_thai_hd', 'Đã thanh toán')
                            ->select (
                                DB::raw('MONTH(b.updated_at) as month'),
                            )
                            ->groupBy(DB::raw('MONTH(b.updated_at)'))                    
                            ->paginate(1);
    }

    public function getDT($month, $id_dv) {
        return DB::table('form_service_details as fsd')
                ->join('service as sv', 'sv.id_dv' ,'=' , 'fsd.id_dv')
                ->join('service_type as svt', 'sv.loai_dv' ,'=' , 'svt.id_ldv')
                ->leftjoin('service_incentives as svi','svi.id_dv','=','sv.id_dv')
                ->leftjoin('special_offers as spo','spo.id_ud','=','svi.id_ud')
                ->join('bill as b', 'b.don_dat_phong','=','fsd.id_ddp')
                ->where('fsd.tinh_trang_ct','Đã xác nhận')
                ->where('b.trang_thai_hd', 'Đã thanh toán')
                    ->whereMonth('b.updated_at', $month)
                    ->where('fsd.id_dv', $id_dv)
                    ->select(
                        'sv.ten_dv',
                        DB::raw('DATE(b.updated_at) as ngay_thanh_toan'),
                        DB::raw('SUM(
                            CASE
                                WHEN fsd.so_luong_ct = spo.sl_ap_dung THEN sv.don_gia_dv * fsd.so_luong_ct * (1 - spo.giam / 100)
                                ELSE sv.don_gia_dv * fsd.so_luong_ct
                            END
                        ) as tong_dt')
                    )
                    ->groupBy('ngay_thanh_toan','sv.ten_dv')
                    ->get();
    }
    
  
}
