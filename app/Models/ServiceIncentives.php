<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ServiceIncentives extends Model
{
    use HasFactory;

    protected $svi = "service_incentives";
    public function getSVI($id_dv){
        return $result = DB::table('service_incentives as svi')
                           ->join('special_offers as spo' ,'spo.id_ud','=', 'svi.id_ud')
                           ->where('svi.id_dv', $id_dv)
                           ->select('spo.*','svi.id_uddv','svi.id_dv')
                           ->get();
    }

    public function getUdDv(){
        return $result = DB::table('service_incentives as svi')
                           ->join('service as sv', 'sv.id_dv', '=', 'svi.id_dv')
                           ->select('svi.*','sv.ten_dv')
                           ->where('sv.status',1)
                           ->get();
    }

    public function deleteUDDV($id_uddv){
        return $result = DB::table($this ->svi)
                            ->where('id_uddv', $id_uddv)
                            ->delete();
    }

    public function  getUd($id_ud){
        return $result = DB::table('service_incentives as svi')
                            ->join('service as sv', 'sv.id_dv', '=', 'svi.id_dv')
                            ->select('svi.*','sv.ten_dv')
                            ->where('sv.status',1)
                            ->where('svi.id_ud',$id_ud)
                            ->get();
    }

    public function getTTServices($id_dv){
        return $result = DB::table('service_incentives as svi')
                           ->join('special_offers as spo' ,'spo.id_ud','=', 'svi.id_ud')
                           ->join('service as sv' ,'svi.id_dv','=', 'sv.id_dv')
                           ->where('svi.id_dv', $id_dv)
                           ->select('spo.*','svi.id_uddv','svi.id_dv','sv.ten_dv')
                           ->get();
    }

    public function insertUddv($data){
        return $result = DB::table($this ->svi)
                            ->insert($data);
    }
    
}
