<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;


class BookingForm extends Model
{
    // use HasFactory;
    use Searchable;
    
    protected $table = "booking_form";
    protected $primaryKey = 'id_don';

    public function toSearchableArray()
       {
            return [
                'id_don' => $this->id_don,
                'id_kh' => $this->id_kh,
                'id_loai_phong' => $this->id_loai_phong,
            ];
       }
       
    public function insertForm($data){
        return $result = DB::table($this -> table) -> insert($data);
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
        return $result = DB::table($this->table)
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
            return $result = DB::table($this->table)
                                ->where('id_don', $id_don)
                                ->delete();
                                // ->update(['status' => 0]);
    }

    public function getIdDon($id_kh){
        return $result = DB::table($this->table)
                            ->where('id_kh', $id_kh)
                            ->where('tinh_trang','Đã xác nhận')
                            // ->where('gn', 1)
                            ->pluck('id_don');
                            
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

       // public function getUnapproved($ngay_nhan_phong = null , $ngay_tra_phong = null){
    //      $result = DB::table("booking_form as bf")
    //                     ->join('users as us', 'us.id' , '=', 'bf.id_kh')
    //                     ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
    //                     ->leftJoin('room as r','r.id_phong','=','bf.id_phong')
    //                     ->select('bf.*','us.ho_ten','rt.ten_lp', 'rt.gia_lp' ,'r.so_phong')
    //                     ->where('tinh_trang','Chưa xác nhận')
    //                     ->where('bf.status',1);
                        
    //                     if (!empty($ngay_nhan_phong) && !empty($ngay_tra_phong)) {
    //                         $result->whereBetween('bf.ngay_nhan_phong', [$ngay_nhan_phong, $ngay_tra_phong])
    //                                 ->orWhereBetween('bf.ngay_tra_phong', [$ngay_nhan_phong, $ngay_tra_phong]);
    //                     }

    //                      elseif (!empty($ngay_nhan_phong)) {
    //                         $result->whereDate('bf.ngay_nhan_phong', '=', $ngay_nhan_phong);
    //                     }

    //                      elseif (!empty($ngay_tra_phong)) {
    //                         $result->whereDate('bf.ngay_tra_phong', '=', $ngay_tra_phong);
    //                     }
    //                     return $result  -> paginate(4);
                    
    // }
    // public function getApproved($ngay_nhan_phong = null , $ngay_tra_phong = null){
    //          $result = DB::table("booking_form as bf")
    //                         ->join('users as us', 'us.id' , '=', 'bf.id_kh')
    //                         ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
    //                         ->leftJoin('room as r','r.id_phong','=','bf.id_phong')
    //                         ->select('bf.*','us.ho_ten','rt.ten_lp', 'rt.gia_lp' ,'r.so_phong')
    //                         ->where('tinh_trang','Đã xác nhận')
    //                         ->where('bf.status',1);
    //                         if (!empty($ngay_nhan_phong) && !empty($ngay_tra_phong)) {
    //                             $result->whereBetween('bf.ngay_nhan_phong', [$ngay_nhan_phong, $ngay_tra_phong])
    //                                     ->orWhereBetween('bf.ngay_tra_phong', [$ngay_nhan_phong, $ngay_tra_phong]);
    //                         }

    //                          elseif (!empty($ngay_nhan_phong)) {
    //                             $result->whereDate('bf.ngay_nhan_phong', '=', $ngay_nhan_phong);
    //                         }

    //                          elseif (!empty($ngay_tra_phong)) {
    //                             $result->whereDate('bf.ngay_tra_phong', '=', $ngay_tra_phong);
    //                         }
    //                         return $result  -> paginate(4);
                        
    // }

    public function getUnapproved($ngay_nhan_phong = null , $ngay_tra_phong = null){
        $result = DB::table("booking_form as bf")
                    ->join('users as us', 'us.id', '=', 'bf.id_kh')
                    ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                    ->leftJoin('room as r', 'r.id_phong', '=', 'bf.id_phong')
                    ->select('bf.*', 'us.ho_ten', 'rt.ten_lp', 'rt.gia_lp', 'r.so_phong')
                    ->where('bf.tinh_trang', 'Chưa xác nhận')
                    ->where('bf.status', 1);
                    
        if (!empty($ngay_nhan_phong) && !empty($ngay_tra_phong)) {
            $result->whereBetween('bf.ngay_nhan_phong', [$ngay_nhan_phong, $ngay_tra_phong])
                   ->whereBetween('bf.ngay_tra_phong', [$ngay_nhan_phong, $ngay_tra_phong]);
        } elseif (!empty($ngay_nhan_phong)) {
            $result->whereDate('bf.ngay_nhan_phong', '=', $ngay_nhan_phong);
        } elseif (!empty($ngay_tra_phong)) {
            $result->whereDate('bf.ngay_tra_phong', '=', $ngay_tra_phong);
        }
    
        return $result->paginate(4);
    }
    
    public function getApproved($ngay_nhan_phong = null , $ngay_tra_phong = null){
        $result = DB::table("booking_form as bf")
                    ->join('users as us', 'us.id', '=', 'bf.id_kh')
                    ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                    ->leftJoin('room as r', 'r.id_phong', '=', 'bf.id_phong')
                    ->select('bf.*', 'us.ho_ten', 'rt.ten_lp', 'rt.gia_lp', 'r.so_phong')
                    ->where('bf.tinh_trang', 'Đã xác nhận')
                    ->where('bf.status', 1);
                    
        if (!empty($ngay_nhan_phong) && !empty($ngay_tra_phong)) {
            $result->whereBetween('bf.ngay_nhan_phong', [$ngay_nhan_phong, $ngay_tra_phong])
                   ->whereBetween('bf.ngay_tra_phong', [$ngay_nhan_phong, $ngay_tra_phong]);
        } elseif (!empty($ngay_nhan_phong)) {
            $result->whereDate('bf.ngay_nhan_phong', '=', $ngay_nhan_phong);
        } elseif (!empty($ngay_tra_phong)) {
            $result->whereDate('bf.ngay_tra_phong', '=', $ngay_tra_phong);
        }
    
        return $result->paginate(4);
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
        return $result = DB::table($this->table)
                            ->where('id_don', $id_don)
                            ->update($data);
    }
    
    public function deleteForm($id_don){
        return $result = DB::table($this->table)
                            ->where('id_don', $id_don)
                            ->update(['status' => 0]);
    }

    public function getBFMonth($bien) {
        return $result = DB::table('booking_form as bf')
                            ->join('room_type as rt', 'rt.id_lp' ,'=' , 'bf.id_loai_phong')
                            ->join('bill as b', 'b.don_dat_phong','=','bf.id_don')
                            ->where('bf.tinh_trang','Đã xác nhận')
                            ->where('b.trang_thai_hd', 'Đã thanh toán')
                            ->whereMonth('b.updated_at',$bien)
                            ->select(
                                'bf.id_don','bf.created_at','bf.updated_at',
                                'bf.id_loai_phong','bf.so_ngay_o','rt.gia_lp')
                            ->get();
    }

    public function getBFAllMonth() {
        return $result = DB::table('booking_form as bf')
                            ->join('room_type as rt', 'rt.id_lp' ,'=' , 'bf.id_loai_phong')
                            ->join('bill as b', 'b.don_dat_phong','=','bf.id_don')
                            ->where('bf.tinh_trang','Đã xác nhận')
                            ->where('b.trang_thai_hd', 'Đã thanh toán')
                            ->select (
                                DB::raw('MONTH(b.updated_at) as month'),
                                'rt.id_lp',
                                'rt.ten_lp',                         
                                DB::raw('SUM(rt.gia_lp * bf.so_ngay_o) as tong_dt'),
                                DB::raw('COUNT(bf.id_don) as so_luot_dat'),
                            )
                            ->groupBy(DB::raw('MONTH(b.updated_at)'), 'rt.id_lp','rt.ten_lp')
                            ->get();
                         
    }

    // public function getDT($month,$id_lp) {
    //  return $result = DB::table('booking_form as bf')
    //                         ->join('room_type as rt', 'rt.id_lp' ,'=' , 'bf.id_loai_phong')
    //                         ->join('bill as b', 'b.don_dat_phong','=','bf.id_don')
    //                         ->where('bf.tinh_trang','Đã xác nhận')
    //                         ->where('b.trang_thai_hd', 'Đã thanh toán')
    //                         ->whereMonth('b.updated_at', $month) 
    //                         ->where('bf.id_loai_phong',$id_lp)
    //                         ->select('rt.ten_lp','rt.gia_lp','bf.so_ngay_o','b.updated_at')
    //                         ->get();
            
    // }
    public function getDT($month, $id_lp) {
        return DB::table('booking_form as bf')
            ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
            ->join('bill as b', 'b.don_dat_phong', '=', 'bf.id_don')
            ->where('bf.tinh_trang', 'Đã xác nhận')
            ->where('b.trang_thai_hd', 'Đã thanh toán')
            ->whereMonth('b.updated_at', $month)
            ->where('bf.id_loai_phong', $id_lp)
            ->select(
                'rt.ten_lp',
                DB::raw('DATE(b.updated_at) as ngay_thanh_toan'),
                DB::raw('SUM(rt.gia_lp * bf.so_ngay_o) as tong_dt')
            )
            ->groupBy('ngay_thanh_toan','rt.ten_lp')
            ->get();
    }
    

    public function getAllMonth() {
        return $result = DB::table('booking_form as bf')
                            ->join('bill as b', 'b.don_dat_phong','=','bf.id_don')
                            ->where('bf.tinh_trang','Đã xác nhận')
                            ->where('b.trang_thai_hd', 'Đã thanh toán')
                            ->select (
                                DB::raw('MONTH(b.updated_at) as month'),
                             
                            )
                            ->groupBy(DB::raw('MONTH(b.updated_at)'))
                            ->paginate(1);
    }
   

    public function getUSMonth($bien) {
        return $result = DB::table('booking_form as bf')
                    ->join('users as us', 'us.id', '=', 'bf.id_kh')
                    ->where('bf.tinh_trang', 'Đã xác nhận')
                    ->whereMonth('bf.updated_at',$bien)
                    ->select('us.*', 
                            'bf.id_kh', 
                            DB::raw('MIN(bf.id_don) as id_don'), 
                            DB::raw('MIN(bf.id_loai_phong) as id_loai_phong'), 
                            DB::raw('MIN(bf.id_phong) as id_phong'), 
                            DB::raw('MIN(bf.ngay_nhan_phong) as ngay_nhan_phong'), 
                            DB::raw('MIN(bf.ngay_tra_phong) as ngay_tra_phong'), 
                            DB::raw('MIN(bf.so_ngay_o) as so_ngay_o'), 
                            'bf.tinh_trang')
                            ->groupBy('bf.id_kh', 'us.id', 'us.ho_ten', 'us.gioi_tinh', 'us.sdt', 'us.email', 'us.dia_chi', 'us.DTL', 'us.password', 'us.role', 'us.token', 'us.created_at', 'us.updated_at', 'bf.tinh_trang','us.status')
                    ->get();
    }

    public function getIDUSMonth($bien) {
        return $result = DB::table($this->table)
                    ->whereMonth('updated_at',$bien)
                    ->where('tinh_trang', 'Đã xác nhận')
                    ->distinct()
                    ->pluck('id_kh');
           
    }


    public function getUS() {
        return $result = DB::table('booking_form as bf')
                                    ->join('users as us', 'us.id', '=', 'bf.id_kh')
                                    ->join('bill as b', 'b.don_dat_phong', '=', 'bf.id_don')
                                    ->where('bf.tinh_trang', 'Đã xác nhận')  
                                    ->select(
                                        'us.id',
                                        'us.ho_ten',
                                        DB::raw('MONTH(b.updated_at) as month'),
                                        DB::raw('COUNT(bf.id_don) as total_bookings')
                                    )
                                ->groupBy(DB::raw('MONTH(b.updated_at)'),'us.id', 'us.ho_ten')
                                ->get();
    }

    public function getBF($month,$id_kh){
        return $result = DB::table('booking_form as bf')
                            ->leftjoin('users as us', 'us.id', '=', 'bf.id_kh')
                             ->join('bill as b', 'b.don_dat_phong', '=', 'bf.id_don')
                             ->join('room_type as rt', 'rt.id_lp' ,'=' , 'bf.id_loai_phong')
                            //  ->leftjoin('room as r', 'r.loai_phong' ,'=' , 'rt.id_lp')
                             ->where('bf.tinh_trang', 'Đã xác nhận') 
                             ->whereMonth('b.updated_at',$month) 
                             ->select('us.ho_ten','bf.*','rt.ten_lp')
                             ->get();
    }

    public function getCalendar($id_rt) {
        return $result = DB::table($this->table)
                            ->where('status',1)
                            ->where('gn',1)
                            ->where('id_loai_phong', $id_rt)
                            ->select('ngay_nhan_phong','ngay_tra_phong','id_loai_phong')
                            ->get();
    }

    public function getSearchRoom($id_kh){
        return $result = DB::table($this->table)
                            ->where('id_kh', $id_kh)
                            ->select('id_loai_phong')
                            ->where('tinh_trang','Đã xác nhận')
                            ->distinct()
                            ->whereBetween('created_at', [
                                now()->subMonths(2)->startOfMonth(),
                                now()->endOfMonth()
                            ])
                            ->orderBy('created_at', 'desc')
                            ->limit(4)
                            ->get();
                          
    }

    public function getBooking($id_lp, $id_kh) {
        return $result = DB::table($this->table)
                                ->where('id_loai_phong',$id_lp)
                                ->whereNot('id_kh', $id_kh)
                                ->select('id_kh', 'id_loai_phong')
                                ->get()
                                ->unique('id_kh');
                                
    }

    public function getListRoom($id_kh, $id_lp) {
        $id_kh = is_array($id_kh) ? $id_kh : [$id_kh];
        $id_lp = is_array($id_lp) ? $id_lp : [$id_lp];
        return $result = DB::table($this->table)
                            ->where('id_kh', $id_kh)
                            ->where('id_loai_phong', '!=', $id_lp)
                            ->where('tinh_trang', 'Đã xác nhận')
                            ->select('id_loai_phong')
                            ->get()
                            ->unique('id_loai_phong');
    }
    // public function getListRoom($id_kh, $id_lp) {
    //     return DB::table($this->table)
    //                 ->whereIn('id_kh', $id_kh)  // Sử dụng whereIn để lọc theo nhiều id_kh
    //                 ->whereNotIn('id_loai_phong', $id_lp)  // Sử dụng whereNotIn để loại trừ các id_loai_phong trong mảng $id_lp
    //                 ->where('tinh_trang', 'Đã xác nhận')
    //                 ->select('id_loai_phong')
    //                 ->get()
    //                 ->unique('id_loai_phong');
    // }
    
    public function checkBooking($id_lp){
        return $result = DB::table("booking_form as bf")
                       ->join('users as us', 'us.id' , '=', 'bf.id_kh')
                       ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                       ->join('room as r','r.id_phong','=','bf.id_phong')
                       ->select('bf.*','us.ho_ten','rt.ten_lp', 'rt.gia_lp' ,'r.so_phong')
                       ->where('tinh_trang','Đã xác nhận')
                       ->where('bf.id_loai_phong',$id_lp)
                       ->where('bf.status',1)
                       ->where('bf.gn',1)
                       ->get();
    }
    public function checkBooking1($id_lp){
        return $result = DB::table("booking_form as bf")
                       ->join('users as us', 'us.id' , '=', 'bf.id_kh')
                       ->join('room_type as rt', 'rt.id_lp', '=', 'bf.id_loai_phong')
                       ->join('room as r','r.id_phong','=','bf.id_phong')
                       ->select('bf.*','us.ho_ten','rt.ten_lp', 'rt.gia_lp' ,'r.so_phong')
                       ->where('tinh_trang','Đã xác nhận')
                       ->where('bf.id_loai_phong',$id_lp)
                       ->where('bf.status',1)
                    //    ->where('bf.gn',1)
                       ->get();
    }

    // public function getAllBF() {
    //     return $result = DB::table($this -> table)
    //                         ->where('status',1)
    //                         ->select('id_kh',DB::raw('COUNT(id_don) as so_lan_dat'))
    //                         ->groupBy('id_kh')
    //                         ->get();

    // }
    public function getAllBF() {
        return $result = DB::table("booking_form as bf")
                            ->join('users as us','us.id', '=', 'bf.id_kh')
                            ->where('us.status',1)
                            ->select(
                                'id_kh',
                                'ho_ten',
                                'gioi_tinh',
                                'sdt',
                                'email',
                                'dia_chi'
                            ,DB::raw('COUNT(id_don) as so_lan_dat')
                            ,DB::raw('MAX(bf.created_at) as last_booking_date')
                            )
                            ->groupBy('id_kh','ho_ten','gioi_tinh','sdt','email','dia_chi')
                            ->paginate(5);

    }
    public function getAllBFType1() {
        return $result = DB::table("booking_form as bf")
                            ->join('users as us','us.id', '=', 'bf.id_kh')
                            ->where('us.status',1)
                            ->select(
                                'id_kh',
                                'ho_ten',
                                'gioi_tinh',
                                'sdt',
                                'email',
                                'dia_chi'
                            ,DB::raw('COUNT(id_don) as so_lan_dat')
                            ,DB::raw('MAX(bf.created_at) as last_booking_date')
                            )
                            ->groupBy('id_kh','ho_ten','gioi_tinh','sdt','email','dia_chi')
                            ->havingRaw('so_lan_dat > 0 AND so_lan_dat <= 1')
                            ->paginate(5);

    }
    public function getAllBFType2() {
        return $result = DB::table("booking_form as bf")
                            ->join('users as us','us.id', '=', 'bf.id_kh')
                            ->where('us.status',1)
                            ->select(
                                'id_kh',
                                'ho_ten',
                                'gioi_tinh',
                                'sdt',
                                'email',
                                'dia_chi'
                            ,DB::raw('COUNT(id_don) as so_lan_dat')
                            ,DB::raw('MAX(bf.created_at) as last_booking_date')
                            )
                            ->groupBy('id_kh','ho_ten','gioi_tinh','sdt','email','dia_chi')
                            ->havingRaw('so_lan_dat > 1 AND so_lan_dat <= 3')
                            ->paginate(5);

    }
    public function getAllBFType3() {
        return $result = DB::table("booking_form as bf")
                            ->join('users as us','us.id', '=', 'bf.id_kh')
                            ->where('us.status',1)
                            ->select(
                                'id_kh',
                                'ho_ten',
                                'gioi_tinh',
                                'sdt',
                                'email',
                                'dia_chi'
                            ,DB::raw('COUNT(id_don) as so_lan_dat')
                            ,DB::raw('MAX(bf.created_at) as last_booking_date')
                            )
                            ->groupBy('id_kh','ho_ten','gioi_tinh','sdt','email','dia_chi')
                            ->havingRaw('so_lan_dat > 3')
                            ->paginate(5);

    }

}
