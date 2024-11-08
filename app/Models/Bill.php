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
                            ->join("room_type as rt",'rt.id_lp','=','bf.id_loai_phong')
                            ->where('khach_hang', $id_kh)
                            ->orderBy('id_hd','desc') 
                            ->select('bill.*', 'bf.id_phong','rt.ten_lp','r.so_phong')
                            ->paginate(3);
                        
    }

    public function getBill_history($id_kh){
        return $result = DB::table("bill")
                            ->leftJoin('booking_form as bf', 'bf.id_don', '=', 'bill.don_dat_phong')
                            ->leftJoin('room as r', 'r.id_phong', '=', 'bf.id_phong')
                            ->join("room_type as rt",'rt.id_lp','=','bf.id_loai_phong')
                            ->where('khach_hang', $id_kh)
                            ->orderBy('id_hd','desc') 
                            ->select('bill.*', 'bf.id_phong','rt.ten_lp','r.so_phong')
                            ->get();
                        
    }

    // public function getBillDon($id_don){
    //     return $result = DB::table("bill")
    //                     ->where('don_dat_phong', $id_don)
    //                     ->select('id_hd','tong_tien')
    //                     ->first();
    // }
    public function getBillDon($id_don){
        return $result = DB::table("bill")
                        ->where('don_dat_phong', $id_don)
                        ->select('*')
                        ->first();
    }

    public function updatedBill($id_hd,$data){
        return $result = DB::table("bill")
                        ->where('id_hd', $id_hd)
                        ->update($data);
    }

    public function getAllBill($ngay_thanh_toan = null, $ngay_thanh_toan1 = null, $keywords = null){
         $result = DB :: table("bill")
                        ->join('users as us', 'us.id', '=', 'bill.khach_hang')
                        ->join('booking_form as bf', 'bf.id_don', '=', 'bill.don_dat_phong')
                        ->join('room as r', 'r.id_phong', '=', 'bf.id_phong')
                        ->join('room_type as rt', 'rt.id_lp', '=', 'r.loai_phong')
                        ->select('bill.*', 'bf.id_don','bf.id_kh','bf.id_loai_phong','bf.id_phong',
                        'bf.ngay_nhan_phong','bf.ngay_tra_phong','bf.so_ngay_o','bf.ghi_chu', 'r.so_phong', 'rt.id_lp','rt.ten_lp','rt.mo_ta','rt.tien_nghi','rt.gia_lp','rt.suc_chua', 
                        'us.id','us.ho_ten','us.gioi_tinh','us.sdt','us.email','us.dia_chi','us.DTL')
                        ->where('bill.trang_thai_hd', 'Chưa thanh toán')
                        ->where('bill.status',1);

                        if (!empty($ngay_thanh_toan) && !empty($ngay_thanh_toan1)) {
                            if ($ngay_thanh_toan === $ngay_thanh_toan1) {
                                $result->whereDate('bill.updated_at', '=', $ngay_thanh_toan);
                            } else {
                                $result->whereBetween('bill.updated_at', [$ngay_thanh_toan, $ngay_thanh_toan1]);
                            }
                        } elseif (!empty($ngay_thanh_toan)) {
                            $result->whereDate('bill.updated_at', '=', $ngay_thanh_toan);
                        } elseif (!empty($ngay_thanh_toan1)) {
                            $result->whereDate('bill.updated_at', '=', $ngay_thanh_toan1);
                        }
                        
                        
                        if (!empty($keywords)) {
                            $result->where(function ($query) use ($keywords) {
                                // Kiểm tra nếu chuỗi chứa số thì tìm trong các trường số
                                if (preg_match('/\d/', $keywords)) {
                                    // Loại bỏ các ký tự không phải số và dấu chấm
                                    $cleanKeywords = preg_replace('/[^0-9]/', '', $keywords);
                                    $query->orWhere('rt.gia_lp', '=', $cleanKeywords)
                                          ->orWhere('bill.phi_dv', '=', $cleanKeywords)
                                          ->orWhere('bill.phi_them', '=', $cleanKeywords)
                                          ->orWhere('bill.tong_tien', '=', $cleanKeywords)
                                          ->orWhere('r.so_phong', '=', $cleanKeywords)
                                          ->orWhere('bill.don_dat_phong', '=', $cleanKeywords);
                                } else {
                                    // Nếu không có số thì tìm trong họ tên
                                    $query->orWhere('us.ho_ten', 'like', '%' . $keywords . '%');
                                }
                            });
                        }
                        
                        
                 
                        return $result->paginate(5);
    }

    public function getAllBillAcp($ngay_thanh_toan = null, $ngay_thanh_toan1 = null,$keywords = null) {
      
        $result = DB::table("bill")
            ->join('users as us', 'us.id', '=', 'bill.khach_hang')
            ->join('booking_form as bf', 'bf.id_don', '=', 'bill.don_dat_phong')
            ->join('room as r', 'r.id_phong', '=', 'bf.id_phong')
            ->join('room_type as rt', 'rt.id_lp', '=', 'r.loai_phong')
            ->select('bill.*', 'bf.id_don','bf.id_kh','bf.id_loai_phong','bf.id_phong',
            'bf.ngay_nhan_phong','bf.ngay_tra_phong','bf.so_ngay_o','bf.ghi_chu', 'r.so_phong', 'rt.id_lp','rt.ten_lp','rt.mo_ta','rt.tien_nghi','rt.gia_lp','rt.suc_chua', 
            'us.id','us.ho_ten','us.gioi_tinh','us.sdt','us.email','us.dia_chi','us.DTL')
            ->where('bill.trang_thai_hd', 'Đã thanh toán')
            ->where('bill.status', 1);
    
   
            if (!empty($ngay_thanh_toan) && !empty($ngay_thanh_toan1)) {
                if ($ngay_thanh_toan === $ngay_thanh_toan1) {
                    $result->whereDate('bill.updated_at', '=', $ngay_thanh_toan);
                } else {
                    $result->whereBetween('bill.updated_at', [$ngay_thanh_toan, $ngay_thanh_toan1]);
                }
            } elseif (!empty($ngay_thanh_toan)) {
                $result->whereDate('bill.updated_at', '=', $ngay_thanh_toan);
            } elseif (!empty($ngay_thanh_toan1)) {
                $result->whereDate('bill.updated_at', '=', $ngay_thanh_toan1);
            }
            
            
            if (!empty($keywords)) {
                $result->where(function ($query) use ($keywords) {
                    // Kiểm tra nếu chuỗi chứa số thì tìm trong các trường số
                    if (preg_match('/\d/', $keywords)) {
                        // Loại bỏ các ký tự không phải số và dấu chấm
                        $cleanKeywords = preg_replace('/[^0-9]/', '', $keywords);
                        $query->orWhere('rt.gia_lp', '=', $cleanKeywords)
                              ->orWhere('bill.phi_dv', '=', $cleanKeywords)
                              ->orWhere('bill.phi_them', '=', $cleanKeywords)
                              ->orWhere('bill.tong_tien', '=', $cleanKeywords)
                              ->orWhere('r.so_phong', '=', $cleanKeywords)
                              ->orWhere('bill.don_dat_phong', '=', $cleanKeywords);
                    } else {
                        // Nếu không có số thì tìm trong họ tên
                        $query->orWhere('us.ho_ten', 'like', '%' . $keywords . '%');
                    }
                });
            }
            
            
        
 
        return $result->paginate(5);
    }
    

    public function deleteBill($id_hd) {
        return $result = DB :: table("bill")
                                ->where('id_hd', $id_hd)
                                ->update(['status' => 0]);
    }
    
    public function getTTBill($id_hd){
        return $result = DB :: table("bill")
                                ->where('id_hd', $id_hd)
                                ->first();
    }

    public function getTTBill2($id_hd){
        return $result = DB :: table("bill")
                                ->join('booking_form as bf','bf.id_don','=','don_dat_phong')
                                ->join('room_type as rt','rt.id_lp', 'bf.id_loai_phong')
                                ->join('room as r','r.loai_phong','=','rt.id_lp')
                                ->join('users as us','us.id' ,'=', 'bill.khach_hang')
                                ->select('bill.*','us.ho_ten','rt.id_lp','rt.gia_lp','rt.mo_ta','rt.tien_nghi','rt.suc_chua','r.so_phong','bf.ngay_nhan_phong','bf.ngay_tra_phong',
                                'bf.so_ngay_o')
                                ->where('id_hd', $id_hd)
                                ->first();
    }

    // public function getSVMonth($bien) {
    //     return $result = DB :: table("bill")
    //                      ->whereMonth('created_at',$bien)
    //                      ->get();
    // }
    public function getSVMonth($bien) {
        return $result = DB :: table("bill")
                         ->whereMonth('created_at',$bien)
                         ->where('trang_thai_hd','Đã thanh toán')
                         ->get();
    }

    public function totalRevenue() {
        return $result = DB :: table("bill")
        ->select(DB::raw('MONTH(updated_at) as month'), DB::raw('SUM(tong_tien) as tong_tien'))
                            ->groupBy(DB::raw('MONTH(updated_at)'))
                            ->get();
    }

}
