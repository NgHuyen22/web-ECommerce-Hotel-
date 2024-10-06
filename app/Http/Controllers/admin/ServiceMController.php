<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FormServiceDetail;
use App\Models\ServiceType;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceMController extends Controller
{
    protected $fsd ;
    protected $svt ;
    protected $sv ;
    public function __construct()
    {
        $this -> fsd = new FormServiceDetail();
        $this -> svt = new ServiceType();
        $this -> sv = new Service();
    }
    public function sm_index(Request $rq){
        $keywords = $rq -> keywords;
        $approved = $this -> fsd ->getApproved($keywords);
        $countSV = 0;
        $svt = $this -> svt -> getService();
        
        if(!$svt -> isEmpty()){

            $countSV = $svt -> count();
         
        }
        // $unapproved = $this -> fsd -> getUnapprove();
        // $approved = $this -> fsd -> getApproved();
    
        return view('admin.service_management.sm_index', compact('approved','countSV'));
    }

    public function service_type(){
        $getService = $this -> svt-> getService();
        // dd($getService);
        $countSV = 0;
        if(!$getService -> isEmpty()){

            $countSV = $getService ->count();
        }
        return view('admin.service_management.service_type',compact('getService','countSV'));
    }

    public function add_ldv(){
        return view('admin.service_management.add_ldv');
    }
    public function edit_svt($id_ldv, Request $rq){
        // $services = $this -> sv -> getService($id_ldv);
        $id_ldv = $rq-> id_ldv;
        $ten_ldv = $rq-> ten_ldv;
        $created_at = $rq-> created_at;
        $updated_at = $rq-> updated_at;
        $mo_ta_ldv = $rq-> mo_ta_ldv;
       return view('admin.service_management.edit_svt', compact('id_ldv','ten_ldv','mo_ta_ldv','created_at','updated_at'));
    }

    public function updated_svt(Request $rq){
        $data =[
            'ten_ldv' => $rq->ten_ldv,
            'mo_ta_ldv' => $rq->mo_ta_ldv,
            'status' => 1,
            'updated_at' => now(),
        ];

        $updated = $this -> svt -> updateSV($rq->id_ldv, $data);
        if($updated == true){
            return redirect() -> route('admin.service_type') -> with('success', 'Cập nhật thảnh công');
        }else{
            return redirect() -> route('admin.service_type') -> with('error', 'Lỗi, vui lòng thử lại sau !');

        }
    }

    public function delete_svt($id_ldv){
        $deleted = $this-> svt -> deleteSVT($id_ldv);
        if($deleted == true){
            return redirect() -> route('admin.service_type') ->with('success','Xóa đơn thành công');
        }else{
            return redirect() -> route('admin.service_type') ->with('error','Lỗi, vui lòng thử lại sau !');

        }
    }

    public function insert_ldv(Request $rq){
        $data = [
            'ten_ldv' => $rq -> ten_ldv,
            'mo_ta_ldv' => $rq -> mo_ta_ldv,
            'status' => 1,
        ];

        $exitingName = $this -> svt -> checkNameSVT($rq ->ten_ldv);
        if($exitingName == null){
             $insert = $this -> svt -> insertSVT($data);
            if($insert == true){
                return redirect() -> route('admin.service_type')->with('success', 'Thêm thành công !');
            }else{
                return redirect() ->route('admin.service_type') -> withInput() ->with('error','Lỗi, vui lòng thử lại sau !');
            }   
        }else{
            return redirect() ->route('admin.service_type') -> withInput() ->with('error','Loại dịch vụ đã tồn tại, vui lòng nhập tên khác !');
        }

    }

    public function delete_form_sv($id_ct){
     
        $deleted = $this-> fsd -> deleteForm($id_ct);
        if($deleted == true){
            return redirect() -> route('admin.service_management') ->with('success','Xóa đơn thành công');
        }else{
            return redirect() -> route('admin.service_management') ->with('error','Lỗi, vui lòng thử lại sau !');

        }
    }

    public function getServices($id_ldv){
        $getService = $this -> sv ->getService1($id_ldv);
   
        if(!$getService -> isEmpty()){
            $count = $getService -> total();

        }
        
        return view('admin.service_management.getServices.sv_index', compact('getService', 'count','id_ldv'));
    }

    public function add_dv(Request $rq ,$id_ldv){ 
        return  view('admin.service_management.getServices.add_sv' , compact('id_ldv'));
    }

    public function redirectToPost($id_ldv){
        $success = session('success');
        $error = session('error');
        return view('admin.service_management.getServices.redirect_form', ['id_ldv' => $id_ldv, 'success' => $success, 'error' => $error]);
        
    }
    
    
    public function insert_dv(Request $rq ,$id_ldv){ 
        $don_gia_cleand = str_replace(['.', 'VND'],'', $rq -> don_gia_dv);
        $data = [
            'ten_dv' => $rq -> ten_dv,
            'loai_dv' => $id_ldv,
            'don_gia_dv' => $don_gia_cleand,
            'mo_ta_dv' => $rq -> mo_ta_dv,
            'menu' => $rq -> menu,
            'status' => 1,
        ];
        
        $exitingName = $this -> sv -> checkNameSV($rq ->ten_dv);
        if($exitingName == null){
            $insert = $this -> sv -> insertSV($data);
            if($insert == true){
                return redirect()->route('admin.getServices', [$id_ldv])->with('success', 'Thêm thành công !');
            }else{
                return redirect() ->route('admin.add_dv',[$id_ldv]) -> withInput() ->with('error','Lỗi, vui lòng thử lại sau !');
            }   
        }else{
            return redirect() ->route('admin.add_dv',[$id_ldv]) -> withInput() ->with('error','Dịch vụ đã tồn tại, vui lòng nhập tên khác !');
        }
    }

    // public function redirectRD(Request $request, $id_ldv){
    //     if ($request->has('success')) {
    //         session()->flash('success', $request->input('success'));
    //     }
    
    //     if ($request->has('error')) {
    //         session()->flash('error', $request->input('error'));
    //     }
    //     $getService = $this -> sv ->getService1($id_ldv);
    //     if(!$getService -> isEmpty()){
    //         $count = $getService -> total();

    //     }
    //     return view('admin.service_management.getServices.sv_index', compact('getService', 'count','id_ldv'));
        
    // }

    public function edit_dv(Request $rq){
        $getNameSVT = $this -> svt -> getNameSVTList();
        $nameSVT = $this -> svt -> getNameSVT($rq->loai_dv);
        $id_dv = $rq -> id_dv;
        $ten_dv = $rq -> ten_dv;
        $loai_dv = $rq -> loai_dv;
        $don_gia_dv = $rq -> don_gia_dv;
        $mo_ta_dv = $rq -> mo_ta_dv;
        $menu = $rq -> menu;
        $created_at = $rq -> created_at;
        $updated_at = $rq -> updated_at;
        return view('admin.service_management.getServices.edit_sv' , compact('id_dv','ten_dv', 'loai_dv', 'don_gia_dv' , 'mo_ta_dv' , 'menu', 'created_at','updated_at','getNameSVT','nameSVT'));
    }

    public function updated_sv(Request $rq, $id_dv){
        $don_gia_cleand = str_replace(['.', 'VND'], '', $rq -> don_gia_dv);

        $data = [
            'ten_dv' => $rq -> ten_dv,
            'loai_dv' => $rq -> loai_dv,
            'don_gia_dv' => $don_gia_cleand,
            'mo_ta_dv' => $rq -> mo_ta_dv,
            'menu' => $rq -> menu,
            'status' => 1,
            'updated_at' => now()
        ];

        $updated = $this -> sv -> updatedSV($id_dv, $data);
        if($updated == true){
                
            return redirect() -> route('admin.getServices',[$rq->loai_dv]) -> with('success','Cập nhật thành công ');
        }else{
            return redirect() ->route('admin.getServices',[$rq->loai_dv])-> withInput() -> with('error','Lỗi , vui lòng thử lại sau !');
        }
    }

    public function delete_sv($loai_dv,$id_dv){
    
        $data=[
            'status' => 0,
        ];
        $delete = $this -> sv -> updatedSV($id_dv, $data);
        if($delete == true){
                
            return redirect() -> route('admin.getServices',[$loai_dv]) -> with('success','Xóa thành công ');
        }else{
            return redirect() ->route('admin.getServices',[$loai_dv])-> withInput() -> with('error','Lỗi , vui lòng thử lại sau !');
        }
    }
}
