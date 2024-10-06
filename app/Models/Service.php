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
  
}
