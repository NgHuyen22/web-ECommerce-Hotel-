<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ServiceType extends Model
{
    use HasFactory;

    protected $svt ="service_type";
    public function getServiceType(){
        return $result = DB::table($this -> svt) 
                            ->where('status',1)
                            ->get();
    }
    public function getServiceTypeID($id_ldv){
        return $result = DB::table($this -> svt) 
                            ->where('status',1)
                            ->where('id_ldv', $id_ldv)
                            ->first();
    }

    public function getService(){
        return $result = DB::table($this -> svt)                          
                            ->where('status',1)
                            ->get();
    }

    public function updateSV($id_ldv, $data){
        return $result = DB::table($this -> svt)                          
                            ->where('id_ldv', $id_ldv)
                            ->update($data);
    }

    public function deleteSVT($id_ldv){
        return $result = DB::table($this -> svt)                          
                            ->where('id_ldv', $id_ldv)
                            ->update(['status' => 0]);
    }

    public function checkNameSVT($ten_ldv){
        return $result = DB::table($this-> svt)
                            ->where('ten_ldv', $ten_ldv)
                            ->where('status', 1)
                            ->first();
    }

    public function insertSVT($data){
        return $result = DB::table($this-> svt)
                              -> insert($data);
    }

    public function getNameSVT($id_ldv){
        return $result = DB::table($this-> svt)
                            -> where('id_ldv', $id_ldv)
                            ->value('ten_ldv');
                            // ->first();
    }

    public function getNameSVTList(){
        return $result = DB::table($this-> svt)
                            ->where('status', 1)
                            ->select('id_ldv','ten_ldv')
                            ->get();
                  
    }
}
