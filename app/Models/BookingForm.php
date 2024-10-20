<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingForm extends Model
{
    use HasFactory;
    
    protected $bf = "booking_form";
    public function insertForm($data){
        return $result = DB::table($this -> bf) -> insert($data);
    }

    public function checkBF($id_rt,$ngayNhan, $ngayTra){
        return $result = DB::table('booking_form as bf') 
                           ->join('room as r','r.id_phong','=','bf.id_phong')
                        //    ->join('room_type as rt','rt.id_lp','=','r.loai_phong')
                           ->select('bf.*','r.so_phong','r.status','r.loai_phong')
                           ->where('r.status',1)
                           ->where('bf.status',1)
                            ->where('bf.tinh_trang','Đã xác nhận')
                           ->where('r.loai_phong',$id_rt)
                        //    ->where('bf.ngay_nhan_phong',$ngayNhan)
                        //    ->where('bf.ngay_tra_phong',$ngayTra)
                        //    ->count('loai_phong');
                            ->where(function($query) use ($ngayNhan, $ngayTra){
                                $query -> whereBetween('bf.ngay_nhan_phong', [$ngayNhan, $ngayTra])
                                            -> orWhereBetween('bf.ngay_tra_phong',[$ngayNhan, $ngayTra])
                                            ->orWhere(function ($query) use ($ngayNhan, $ngayTra) {
                                            $query->where('bf.ngay_nhan_phong', '<=', $ngayNhan)
                                                        ->where('bf.ngay_tra_phong', '>=', $ngayTra);

                                            });
                            })
                            ->count();
    }
    // public function checkBFNull($id_rt, $ngayNhan, $ngayTra){
    //     return DB::table('booking_form as bf')
    //              ->join('room as r', 'r.id_phong', '=', 'bf.id_phong')
    //              ->select('r.so_phong')
    //              ->where('r.status', 1)
    //              ->where('bf.status', 1)
    //              ->where('bf.tinh_trang', 'Đã xác nhận')
    //              ->where('r.loai_phong', $id_rt)
    //              ->where(function ($query) use ($ngayNhan, $ngayTra) {
    //                  $query->whereBetween('bf.ngay_nhan_phong', [$ngayNhan, $ngayTra])
    //                        ->orWhereBetween('bf.ngay_tra_phong', [$ngayNhan, $ngayTra])
    //                        ->orWhere(function ($query) use ($ngayNhan, $ngayTra) {
    //                             $query->where('bf.ngay_nhan_phong', '<=', $ngayNhan)
    //                                   ->where('bf.ngay_tra_phong', '>=', $ngayTra);
    //                        });
    //              })
    //              ->get(); 
    //  }
    public function checkBFNull($id_rt, $ngayNhan, $ngayTra) {
        return DB::table('booking_form as bf')
                 ->join('room as r', 'r.id_phong', '=', 'bf.id_phong')
                 ->select('r.so_phong')
                 ->where('r.status', 1)
                 ->where('bf.status', 1)
                 ->where('bf.tinh_trang', 'Đã xác nhận')
                 ->where('r.loai_phong', $id_rt)  // Sử dụng mảng nếu cần
                 ->where(function ($query) use ($ngayNhan, $ngayTra) {
                     $query->whereBetween('bf.ngay_nhan_phong', [$ngayNhan, $ngayTra])
                           ->orWhereBetween('bf.ngay_tra_phong', [$ngayNhan, $ngayTra])
                           ->orWhere(function ($query) use ($ngayNhan, $ngayTra) {
                                $query->where('bf.ngay_nhan_phong', '<=', $ngayNhan)
                                      ->where('bf.ngay_tra_phong', '>=', $ngayTra);
                           });
                 })
                 ->get(); 
    }
    

    
    
 

    public function getForm($id_kh){
        return $result = DB::table('booking_form as bf') 
                                ->leftjoin('room as r','r.id_phong','=','bf.id_phong')
                                ->join('room_type as rt','bf.id_loai_phong','=','rt.id_lp')
                                ->select('bf.*','r.so_phong','r.loai_phong','rt.ten_lp','rt.gia_lp')
                                // ->where('r.status',1)
                                // ->where('bf.status',1)
                                ->where('bf.id_kh', $id_kh)
                                ->orderBy('id_don','desc') 
                                ->paginate(3);
    }

    public function getForm_history($id_kh){
        return $result = DB::table('booking_form as bf') 
                                ->leftjoin('room as r','r.id_phong','=','bf.id_phong')
                                ->join('room_type as rt','bf.id_loai_phong','=','rt.id_lp')
                                ->select('bf.*','r.so_phong','r.loai_phong','rt.ten_lp','rt.gia_lp')
                                // ->where('r.status',1)
                                // ->where('bf.status',1)
                                ->where('bf.id_kh', $id_kh)
                                ->orderBy('id_don','desc') 
                                ->paginate(1);
    }
 
    
                            
    public function getFormFirst($id_kh){
          return $result = DB::table('booking_form as bf') 
                                ->leftjoin('room as r','r.id_phong','=','bf.id_phong')
                                ->select('bf.*','r.so_phong','r.loai_phong')
                                ->where('bf.status',1)
                                ->where('bf.id_kh', $id_kh)
                                // ->get();
                                ->orderBy('bf.id_don','desc') 
                                ->first();
                               
    }

    public function getIDForm($id_kh, $id_rt,$ngayNhan, $ngayTra){
        return $result = DB::table($this->bf)
                            ->where('status',1)
                            ->where('tinh_trang','Đã xác nhận')
                            ->where('id_kh',$id_kh)
                            ->where('id_loai_phong',$id_rt)
                            ->where('ngay_nhan_phong',$ngayNhan)
                            ->where('ngay_tra_phong',$ngayTra)
                            ->get();
    }
    public function getIDForm2($id_kh){
        return $result = DB::table('booking_form as bf')
                            ->join('room as r','r.id_phong','=','bf.id_phong')
                            ->select('r.so_phong','bf.*')
                            ->where('bf.status',1)
                            ->where('bf.tinh_trang','Đã xác nhận')
                            ->where('bf.id_kh',$id_kh)
                           ->where('bf.gn',1)
                            ->get();
    }
    public function cancleForm($id_don){
            return $result = DB::table($this->bf)
                                ->where('id_don', $id_don)
                                ->delete();
                                // ->update(['status' => 0]);
    }

    public function getIdDon($id_kh){
        return $result = DB::table($this->bf)
                            ->where('id_kh', $id_kh)
                            ->where('tinh_trang','Đã xác nhận')
                            ->where('gn', 1)
                            ->pluck('id_don');
                            
    }

    public function getUnapproved(){
         $result = DB::table("booking_form as bf")
                        ->join('users as us', 'us.id' , '=', 'bf.id_kh')
                        ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                        ->leftJoin('room as r','r.id_phong','=','bf.id_phong')
                        ->select('bf.*','us.ho_ten','rt.ten_lp', 'rt.gia_lp' ,'r.so_phong')
                        ->where('tinh_trang','Chưa xác nhận')
                        ->where('bf.status',1);
                        
                        if (!empty($ngay_nhan_phong) && !empty($ngay_tra_phong)) {
                            $result->whereBetween('bf.ngay_nhan_phong', [$ngay_nhan_phong, $ngay_tra_phong])
                                    ->orWhereBetween('bf.ngay_tra_phong', [$ngay_nhan_phong, $ngay_tra_phong]);
                        }

                         elseif (!empty($ngay_nhan_phong)) {
                            $result->whereDate('bf.ngay_nhan_phong', '=', $ngay_nhan_phong);
                        }

                         elseif (!empty($ngay_tra_phong)) {
                            $result->whereDate('bf.ngay_tra_phong', '=', $ngay_tra_phong);
                        }
                        return $result  -> paginate(4);
                    
    }
    public function getRT(){
        return $result = DB::table("booking_form as bf")
                        ->join('users as us', 'us.id' , '=', 'bf.id_kh')
                        ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                        ->leftJoin('room as r','r.id_phong','=','bf.id_phong')
                        ->where('tinh_trang','Chưa xác nhận')
                        ->where('bf.status',1)
                        ->pluck('bf.id_loai_phong');
                        
                    
    }
    public function getApproved($ngay_nhan_phong = null , $ngay_tra_phong = null){
             $result = DB::table("booking_form as bf")
                            ->join('users as us', 'us.id' , '=', 'bf.id_kh')
                            ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                            ->leftJoin('room as r','r.id_phong','=','bf.id_phong')
                            ->select('bf.*','us.ho_ten','rt.ten_lp', 'rt.gia_lp' ,'r.so_phong')
                            ->where('tinh_trang','Đã xác nhận')
                            ->where('bf.status',1);
                            if (!empty($ngay_nhan_phong) && !empty($ngay_tra_phong)) {
                                $result->whereBetween('bf.ngay_nhan_phong', [$ngay_nhan_phong, $ngay_tra_phong])
                                        ->orWhereBetween('bf.ngay_tra_phong', [$ngay_nhan_phong, $ngay_tra_phong]);
                            }

                             elseif (!empty($ngay_nhan_phong)) {
                                $result->whereDate('bf.ngay_nhan_phong', '=', $ngay_nhan_phong);
                            }

                             elseif (!empty($ngay_tra_phong)) {
                                $result->whereDate('bf.ngay_tra_phong', '=', $ngay_tra_phong);
                            }
                            return $result  -> paginate(4);
                        
        }

        public function getNgayNhan(){
            return $result = DB::table("booking_form as bf")
                        ->join('users as us', 'us.id' , '=', 'bf.id_kh')
                        ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                        ->leftJoin('room as r','r.id_phong','=','bf.id_phong')
                        ->where('tinh_trang','Chưa xác nhận')
                        ->where('bf.status',1)
                        ->pluck('bf.ngay_nhan_phong');
        }

        public function getNgayTra(){
            return $result = DB::table("booking_form as bf")
                        ->join('users as us', 'us.id' , '=', 'bf.id_kh')
                        ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                        ->leftJoin('room as r','r.id_phong','=','bf.id_phong')
                        ->where('tinh_trang','Chưa xác nhận')
                        ->where('bf.status',1)
                        ->pluck('bf.ngay_tra_phong');
        }
    public function getDetails($id_don){
        return $result = DB::table("booking_form as bf")
                            ->join('users as us', 'us.id' , '=', 'bf.id_kh')
                            ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                            ->leftJoin('room as r','r.id_phong','=','bf.id_phong')
                            ->select('bf.*','us.ho_ten','rt.ten_lp', 'rt.gia_lp' ,'r.so_phong')
                            ->where('id_don', $id_don)
                            ->first();
    }

    public function approved($id_don, $data){
        return $result = DB::table($this->bf)
                            ->where('id_don', $id_don)
                            ->update($data);
    }
    
    public function deleteForm($id_don){
        return $result = DB::table($this->bf)
                            ->where('id_don', $id_don)
                            ->update(['status' => 0]);
    }

}
