<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
     

    public function getRoom($id_rt){
        return $result = DB::table("room as r") 
                            ->join('room_type as rt', 'rt.id_lp', '=', 'r.loai_phong')  // Sửa đúng cột join
                            ->select('rt.*', 'r.id_phong', 'r.so_phong')
                            ->where('r.status', 1)
                            ->where('rt.status', 1)
                            ->where('r.loai_phong', $id_rt)
                            // ->get();
                            ->paginate(3);
    }   

    public function countRoomTypeID($id_rt){
        return $result = DB::table('room')
                            ->where('status' , 1)
                            ->where('loai_phong' , $id_rt)
                            ->count('id_phong');    
    } 
    public function countRoomNull($id_rt){
        return $result = DB::table('room')
                            ->where('status' , 1)
                            ->where('loai_phong' , $id_rt)
                            // ->where('tinh_trang', "Trống")
                            ->count();    
    } 
    
    public function deleteRoom($id_r, $data){
        return $result = DB :: table('room')
                                ->where('id_phong', $id_r)
                                ->where('status', 1)
                                ->update($data);
                                // ->delete();
    }

    public function getIdRt($id_r){
        return $result = DB::table('room') 
                                ->where('id_phong', $id_r)
                                ->where('status', 1)
                                ->value('loai_phong');
                                
    }

    public function checkRoom($so_phong, $id_rt){
        return $result = DB::table('room')
                                ->where('so_phong', $so_phong)
                                ->where('status', 1)
                                ->where('loai_phong', $id_rt)
                                ->first();
    }

    public function insertRoom($data){
        return $result = DB::table('room')
                            ->insert($data);
    }

    public function getIDR($id_rt){
        return $result = DB::table('room')
                            ->where('loai_phong',$id_rt)
                            ->where('status', 1)
                
                            ->count();
    }

    public function getRoomRT($id_rt){
        return $result = DB::table('room')
                        ->where('loai_phong',$id_rt)
                     
                        ->where('status', 1)
                        ->select('so_phong','id_phong', 'loai_phong') 
                        ->get(); 
    }

}