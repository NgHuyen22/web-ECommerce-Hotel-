<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BookingForm;
use App\Models\RoomType;
use App\Models\Bill;
use Illuminate\Http\Request;

class BookingFormController extends Controller
{
    protected $bf;
    protected $rt;
    protected $bill;
    public function __construct()
    {
        $this -> bf = new BookingForm();
        $this -> rt = new RoomType();
        $this -> bill = new Bill();
    }

    public function bf_detail($id_don){
        $details = $this -> bf -> getDetails($id_don);
        
        return view('admin.booking_management.bf_details', compact('details'));
    }

    public function approved($id_don, Request $rq){
    
        if($rq -> hidden_id_phong == null){
            return redirect() -> route('admin.booking_management') ->with('error', 'Vui lòng chọn phòng trước khi duyệt !');
        }else{
            $data = [
                'id_phong' => $rq -> hidden_id_phong,
                'tinh_trang' => 'Đã xác nhận',
           ];
        //    dd($data);
            $approved = $this -> bf -> approved($id_don,$data);
            if($approved == true){
                            $soNgay = $rq -> soNgay;
                            $gia_lp = $rq->gia;
                            $id_rt = $rq->id_rt;
                            $id_don = $rq->id_don;
                            $tong_tien = $soNgay * $gia_lp;
    
                                $dataBill =[
                                    'khach_hang' => $rq -> id_kh,
                                    'don_dat_phong' => $id_don,
                                    'phi_dv' => 0,
                                    'tre_han' => 0,
                                    'phi_them' => 0,
                                    'tong_tien' => $tong_tien,
                                    'phuong_thuc_tt' => NULL,
                                    'tien_kh_gui' => 0,
                                    'tien_thua' => 0,
                                    'trang_thai_hd' => "Chưa thanh toán",
                                    'status' => 1,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ];
    
                                $insertBill = $this -> bill -> insertBill($dataBill);
                            if($insertBill == true){
    
                                return redirect() -> route('admin.booking_management') ->with('success', 'Đã duyệt thành công');
                            }
                            
            }else{
                return redirect() -> route('admin.booking_management') ->with('error', 'Lỗi , vui lòng thử lại sau !');
            }
        }
 
    }

    public function delete($id_don){
        $deleted = $this-> bf -> deleteForm($id_don);
        if($deleted == true){
            return redirect() -> route('admin.booking_management') ->with('success','Xóa đơn thành công');
        }else{
            return redirect() -> route('admin.booking_management') ->with('error','Lỗi, vui lòng thử lại sau !');

        }
        
    }

    // public function calender(){
    //     return view();
    // }
}
