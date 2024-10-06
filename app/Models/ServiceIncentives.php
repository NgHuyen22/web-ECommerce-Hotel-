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
}
