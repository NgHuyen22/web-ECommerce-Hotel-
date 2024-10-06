<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpecialOffers extends Model
{
    use HasFactory;

    protected $sp_o = "special_offers";

    public function getSpecialOffers($id_ldv){
        return $result = DB::table("special_offers as sp_o")
                            ->join("service_incentives as sv_i", 'sv_i.id_ud' , '=' , 'sp_o.id_ud')
                            ->join("service as sv" , 'sv.id_dv' ,'=', 'sv_i.id_dv')
                            ->join("service_type as svt" , 'svt.id_ldv', '=', 'sv.loai_dv')
                            ->select('svt.id_ldv', 'svt.ten_ldv', 'sv.id_dv', 'sv.don_gia_dv' ,'sv.ten_dv', 'sp_o.*')
                            ->where('svt.id_ldv', $id_ldv)
                            ->first();       
    }
    public function getListSpecialOffers($id_ldv){
        return $result = DB::table("special_offers as sp_o")
                            ->join("service_incentives as sv_i", 'sv_i.id_ud' , '=' , 'sp_o.id_ud')
                            ->join("service as sv" , 'sv.id_dv' ,'=', 'sv_i.id_dv')
                            ->join("service_type as svt" , 'svt.id_ldv', '=', 'sv.loai_dv')
                            ->select('svt.id_ldv', 'svt.ten_ldv', 'sv.id_dv', 'sv.don_gia_dv' ,'sv.ten_dv', 'sp_o.*')
                            ->where('svt.id_ldv', $id_ldv)
                            ->get();       
    }
}
