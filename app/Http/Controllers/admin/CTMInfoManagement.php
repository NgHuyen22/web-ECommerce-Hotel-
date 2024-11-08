<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\BookingForm;
use Carbon\Carbon;
use Exception;

class CTMInfoManagement extends Controller
{
    protected $us;
    protected $bf;
    public function __construct()
    {
        $this -> us = new Users();
        $this -> bf = new BookingForm();
    }

    public function customer_type($type){
        
        if($type ==0){
            $customer = $this -> bf -> getAllBF() ;         
        }
        elseif($type == 1){
            $customer = $this -> bf -> getAllBFType1() ;
        }
        elseif($type == 2){
            $customer = $this -> bf -> getAllBFType2() ;         
        }else{    
            $customer = $this -> bf -> getAllBFType3() ;         
        }
        return view('admin.customer_information_management.ctm_management',compact('customer','type'));
    
    }

    public function delete_customer_info($id_kh){
        $deleteCTM = $this -> us -> deleteCTM($id_kh);
        if($deleteCTM){
            return redirect() -> route('admin.customer_information_management') ->with('success','Xóa thành công');
        }else{
            return redirect() -> route('admin.customer_information_management') ->with('error','Lỗi, vui lòng thử lại sau !!');
        }
    }
}
