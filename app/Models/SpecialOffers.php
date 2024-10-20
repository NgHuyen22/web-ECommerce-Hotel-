<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpecialOffers extends Model
{
    use HasFactory;

    protected $spo = "special_offers";

    public function getSpecialOffers($id_ldv){
        return $result = DB::table("special_offers as sp_o")
                            ->join("service_incentives as sv_i", 'sv_i.id_ud' , '=' , 'sp_o.id_ud')
                            ->join("service as sv" , 'sv.id_dv' ,'=', 'sv_i.id_dv')
                            ->join("service_type as svt" , 'svt.id_ldv', '=', 'sv.loai_dv')
                            ->select('svt.id_ldv', 'svt.ten_ldv', 'sv.id_dv', 'sv.don_gia_dv' ,'sv.ten_dv', 'sp_o.*')
                            ->where('svt.id_ldv', $id_ldv)
                            ->where('sp_o.status', 1)
                            ->first();       
    }
    public function getListSpecialOffers($id_ldv){
        return $result = DB::table("special_offers as sp_o")
                            ->join("service_incentives as sv_i", 'sv_i.id_ud' , '=' , 'sp_o.id_ud')
                            ->join("service as sv" , 'sv.id_dv' ,'=', 'sv_i.id_dv')
                            ->join("service_type as svt" , 'svt.id_ldv', '=', 'sv.loai_dv')
                            ->select('svt.id_ldv', 'svt.ten_ldv', 'sv.id_dv', 'sv.don_gia_dv' ,'sv.ten_dv', 'sp_o.*')
                            ->where('svt.id_ldv', $id_ldv)
                            ->where('sp_o.status', 1)
                            ->get();       
    }

    public function getUD(){
        return $result = DB::table($this -> spo)
                            ->where('status', 1)
                            ->get();
    }

    public function getUdId($id_ud){
        return $result = DB::table($this -> spo)
                            ->where('id_ud',$id_ud)
                            ->first();
    }

    public function updateUD($id_ud,$data){
        return $result = DB::table($this -> spo)
                             ->where('id_ud',$id_ud)
                             ->update($data);
                        
    }

    public function  deleteUD($id_ud){
        return $result = DB::table($this -> spo)
                             ->where('id_ud',$id_ud)
                             ->update(['status' => 0]);
    }

    public function insertUD($data){
        return $result = DB::table($this -> spo)
                            ->insert($data);
    }

    public function getUdFirst(){
        return $result = DB::table($this -> spo)
                            ->where('status',1)
                            ->orderBy('id_ud','desc')
                            ->value('id_ud');
                            // ->first();
    }
}
