<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evaluate extends Model
{
    use HasFactory;
    protected $table ="evaluate";
    public function insertEV($data){
        return $result = DB::table($this -> table) 
                            ->insert($data);
    }

    public function getEV() {
        return $result = DB::table($this -> table) 
                            ->where('status', 1)
                            ->get();
    }

    public function getEVRoom($id_rt, $rating = null) {
        $query = DB::table('evaluate as ev')
                    ->join('users as us', 'us.id', '=', 'ev.khach_hang')
                    ->select('ev.*', 'us.ho_ten')
                    ->where('loai_phong', $id_rt)
                    ->where('ev.status', 1);
        
        if ($rating) {
            $query->where('ev.diem', '=', $rating);
        }
    
        return $query->get();
    }
    

    public function updateEV($data,$booking_id) {
        return $result = DB::table($this -> table) 
                            ->where('don', $booking_id)
                            ->update($data);
    }
    public function getNumberEV() {
        return $result = DB::table("evaluate as ev") 
                            ->join('room_type as rt' , 'rt.id_lp','=','ev.loai_phong')
                            ->where('rt.status', 1)
                            ->where('ev.status', 1)
                            ->select('ev.loai_phong','rt.ten_lp', DB::raw('COUNT(ev.id_danh_gia) as so_luot'),DB::raw('AVG(ev.diem) as danh_gia'))
                            ->groupBy('ev.loai_phong','rt.ten_lp')
                            ->get();
    }

    public function hiddenEV($data, $id_dg) {
        return $result = DB::table($this ->table)
                                ->where('id_danh_gia', $id_dg)
                                ->update($data);
    }
}
