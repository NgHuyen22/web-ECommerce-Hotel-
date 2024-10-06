<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    use HasFactory;
    
    public function insertBill($dataBill){
        return $result = DB::table("bill")
                            ->insert($dataBill);
    }

    public function  cancleBill($id_don){
        return $result = DB::table("bill")
                            ->where('don_dat_phong',$id_don)
                            ->where('trang_thai_hd', 'Chưa thanh toán')
                            ->delete();

   }

    public function getBill($id_kh){
        return $result = DB::table("bill")
                            ->leftJoin('booking_form as bf', 'bf.id_don', '=', 'bill.don_dat_phong')
                            ->leftJoin('room as r', 'r.id_phong', '=', 'bf.id_phong')
                            ->where('khach_hang', $id_kh)
                            ->orderBy('id_hd','desc') 
                            ->select('bill.*', 'bf.id_phong','r.so_phong')
                            ->paginate(3);
    }

    public function getBillDon($id_don){
        return $result = DB::table("bill")
                        ->where('don_dat_phong', $id_don)
                        ->select('id_hd','tong_tien')
                        ->first();
    }

    public function updatedBill($id_hd,$data){
        return $result = DB::table("bill")
                        ->where('id_hd', $id_hd)
                        ->update($data);
    }
}
