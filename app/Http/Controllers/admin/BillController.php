<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Users;
use App\Models\BookingForm;
use App\Models\FormServiceDetail;
use Illuminate\Http\Request;
use PDF;
class BillController extends Controller
{
    protected $bill;
    protected $us;
    protected $fsv;
    protected $bf;
    public function __construct() {
        $this -> bill =  new Bill();
        $this -> us =  new Users();
        $this -> bf =  new BookingForm();
        $this -> fsv =  new FormServiceDetail();
    }

    public function accept_bill($id_hd) {
        return view('admin.bill_management.accept_bill', compact('id_hd'));
    }

    public function updated_bill($id_hd, Request $rq){
        $pttt = $rq ->pttt;
        $tien_kh_gui = 0;
        $tien_thua = 0;
        $ttbill = $this -> bill -> getTTBill($id_hd);
        if($pttt == "1"){
            if($rq->tien_kh_gui == null || $rq -> tien_thua == null)
                return redirect() -> route('admin.accept_bill',[$id_hd]) -> withInput() -> with('error', 'Vui lòng không bỏ trống thông tin.');
            else{
                $pttt = "Tiền mặt";
                $tien_kh_gui = $rq->tien_kh_gui;
                $tien_thua = $rq -> tien_thua;
                $data = [
                    'phuong_thuc_tt' => $pttt,
                    'tien_kh_gui' => $tien_kh_gui,
                    'tien_thua' => $tien_thua,
                    'trang_thai_hd' => 'Đã thanh toán',
                ];
                $updated = $this -> bill -> updatedBill($id_hd, $data);
                if($updated == true) {
                    $dksv = $this -> fsv -> getDKSV($ttbill -> don_dat_phong);
                    foreach($dksv as $sv){
                        $updated_fsv = $this -> fsv -> updatedFSV($sv -> id_ct);
                    }
                    $dataBF = [
                        'gn' => 0
                    ];

                    $updated_bf = $this -> bf -> approved($ttbill -> don_dat_phong,$dataBF);
                  
                    return redirect() -> route('admin.bill_index') -> with('success','Xác nhận thành công');
                }else {
                    return redirect() -> route('admin.bill_index') -> with('error','Lỗi, vui lòng thử lại sau !');
                }
            }
        }else{
            $pttt = "Chuyển Khoản";
            $data = [
                'phuong_thuc_tt' => $pttt,
                'tien_kh_gui' => $tien_kh_gui,
                'tien_thua' => $tien_thua,
                'trang_thai_hd' => 'Đã thanh toán',
            ];
            $updated = $this -> bill -> updatedBill($id_hd, $data);
            if($updated == true) {
                $dksv = $this -> fsv -> getDKSV($ttbill -> don_dat_phong);
                foreach($dksv as $sv){
                    $updated_fsv = $this -> fsv -> updatedFSV($sv -> id_ct);
                }
                $dataBF = [
                    'gn' => 0
                ];

                $updated_bf = $this -> bf -> approved($ttbill -> don_dat_phong,$dataBF);
              
                return redirect() -> route('admin.bill_index') -> with('success','Xác nhận thành công');
            }else {
                return redirect() -> route('admin.bill_index') -> with('error','Lỗi, vui lòng thử lại sau !');
            }
        }
       
    }

    public function getUser($id_kh){
        $ttkh = $this -> us -> getUser($id_kh);
        return view('admin.bill_management.getUser', compact('ttkh'));
    }

    public function deleteBill($id_hd) {

        $deleteBill = $this -> bill -> deleteBill($id_hd);
        if($deleteBill == true ) 
            return redirect() -> route('admin.bill_index') -> with('success', 'Thành công');
        else
            return redirect() -> route('admin.bill_index') -> with('error', 'Lỗi , vui lòng thử lại sau !!');        
    }

    public function print_bill(Request $rq, $id_hd) {
        $bill = Bill::find($id_hd);
        if (!$bill) {
            abort(404, 'Không tìm thấy hóa đơn');
        }

        $pdf = PDF::loadView('invoices.invoice_pdf', ['bill' => $bill]);
    }
}
