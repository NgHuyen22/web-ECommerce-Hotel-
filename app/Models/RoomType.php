<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class RoomType extends Model
{
    use Searchable;
    
       protected $table ="room_type" ;
       protected $primaryKey = 'id_lp';
    //    public function toSearchableArray()
    //    {
    //         return [
    //             'id_lp' => $this->id_lp,
    //             'ten_lp' => $this->ten_lp,
    //             'mo_ta' => $this->mo_ta,
    //             // 'tien_nghi' => $this->tien_nghi,
    //             'gia_lp' => $this->gia_lp,
    //             // 'suc_chua' => $this->suc_chua,
    //             // 'dien_tich' => $this->dien_tich,
    //             'search_count' => 0,
    //             'search_booking' => 0,
    //             // 'status' => $this->status,
    //             // 'created_at' => $this->created_at,
    //             // 'updated_at' => $this->updated_at,
    //         ];
    //    }
       public function toSearchableArray()
       {
            return [
                'id_lp' => $this->id_lp,
                'ten_lp' => $this->ten_lp,
                'mo_ta' => $this->mo_ta,
                'tien_nghi' => $this->tien_nghi,
                // 'gia_lp' => $this->gia_lp,
                // 'suc_chua' => $this->suc_chua,
                // 'dien_tich' => $this->dien_tich,
                'search_count' => 0,
                'search_booking' => 0,
                // 'status' => $this->status,
            ];
       }
    public function getRoomType(){
        return $result = DB::table($this -> table) 
                                ->where('status' , 1)
                                ->get();
    }

    public function getRoomsBySimilarPrice($level, $id_lp){
        return $result = DB::table($this -> table) 
        // return self::where('gia_lp', '<=', $price)
                        ->where('phan_hang', $level)
                        ->where('id_lp', '!=', $id_lp)
                        ->get();
    }

    public function getRoomTypeID($id_rt){
        return $result = DB::table($this -> table) 
                                ->where('status' , 1)
                                ->where('id_lp' , $id_rt)
                                ->first();
    }
    public function getRoomTypeID1($id_rt){
        $id_rt = is_array($id_rt) ? $id_rt : [$id_rt];
        return $result = DB::table($this -> table) 
                                ->where('status' , 1)
                                ->whereIn('id_lp', $id_rt) 
                                ->first();
    }

    public function getAllRoom($keywords = null){
         $result = DB::table($this -> table) 
                                ->where('status' , 1);
                                // ->get();
                                // ->paginate(3);
                                if (!empty($keywords)) {
                                    $result->where(function ($query) use ($keywords) {
                                        // Kiểm tra nếu chuỗi có chứa số
                                        if (preg_match('/\d/', $keywords)) {
                                            // Loại bỏ các ký tự không phải số và dấu chấm
                                            $cleanKeywords = preg_replace('/[^0-9]/', '', $keywords);
                                            $query->orWhere('gia_lp', '=', $cleanKeywords)
                                                  ->orWhereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') like ?", ['%' . $cleanKeywords . '%']) 
                                                  ->orWhereRaw("DATE_FORMAT(updated_at, '%Y-%m-%d') like ?", ['%' . $cleanKeywords . '%']);
                                        } else {
                                            // Nếu không có số thì tìm trong các trường văn bản
                                            $query->orWhere('ten_lp', 'like', '%' . $keywords . '%')
                                                  ->orWhere('tien_nghi', 'like', '%' . $keywords . '%');
                                        }
                                    });
                                }

                          return $result ->paginate(6);     
    }

    public function updateRoomType($id_rt ,$data){
        return $result = DB::table($this -> table) 
                                ->where('status' , 1)
                                ->where('id_lp' , $id_rt)
                                ->update($data);
                                
    }
    public function countRoomType(){
        return $result = DB::table($this -> table)
                            ->where('status' , 1)
                            ->count('id_lp');    
    }


    public function checkNameRT($ten_lp){
        return $result = DB::table($this->table)
                            ->where('ten_lp', $ten_lp)
                            ->where('status', 1)
                            ->first();
    }

    public function insertRoomType($data){
       return  $result = DB::table($this->table)
                                ->insert($data);
    }

    public function deleteRoomType($id_rt, $data){
        return $result = DB :: table($this -> table)
                                ->where('id_lp', $id_rt)
                                ->where('status', 1)
                                ->update($data);
                                // ->delete();
    }

    public function giaLP($id_rt){
        return $result = DB :: table($this -> table)
                            ->where('id_lp', $id_rt)
                            ->where('status', 1)
                            ->value('gia_lp');
                           
    }

    public function getRoomContent($phan_hang,$id_rt) {
        $excludedIds = is_array($id_rt) ? $id_rt : [$id_rt];
        return $result = DB :: table($this -> table)
                                    ->where('phan_hang',$phan_hang)
                                    // ->where('id_lp', '!=', $id_rt)
                                    ->whereNotIn('id_lp', $excludedIds) 
                                    ->where('status', 1)
                                    ->distinct()
                                    ->get();
    }
    public static function getMostSearchedRooms()
    {
        return self::orderBy('search_count', 'desc')
                        ->where('status', 1)
                        ->where('search_count', '>=', 4) 
                       
                        ->get();
    }
    
    public static function getMostBookingRoom()
    {
        return RoomType::orderBy('search_booking', 'desc')
                        ->where('status', 1)
                        ->where('search_booking', '>=', 2) 
                        ->take(3)
                        ->get();
    }

    public function getPrice($price, $ranges) {

        $minPrice = min($price, $ranges);
        $maxPrice = max($price, $ranges);

        $result = DB::table($this->table)
            ->where('status',1)
            ->whereBetween('gia_lp', [$minPrice, $maxPrice]);
            // ->get();
            return $result ->paginate(6);     
    }

    public function getPrice2($ranges) {
        $result = DB::table($this->table)
            ->where('status',1)
            ->where('gia_lp','>=',$ranges);
            return $result ->paginate(6);     
    }
    
    public function room($id_lp) {
       return $result = DB::table('room_type as rt')
                    ->leftJoin('room as r', 'r.loai_phong' ,'=', 'rt.id_lp')
                    ->where('rt.id_lp',$id_lp)
                    ->where('rt.status', 1)
                    ->where('r.status', 1)
                    ->select('r.id_phong','r.so_phong','rt.ten_lp')
                    ->get();
    }

}