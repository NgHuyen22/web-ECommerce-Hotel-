<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Contact;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class C_ContactController extends Controller
{
    protected $us;
    protected $ct;
    public function __construct()
    {
        $this -> us = new Users();
        $this -> ct = new Contact();
    }

    public function contact_index() {
        $user = $this -> us -> getUser(session('id_ctm'));
       return view('customer.contact.contact',compact('user'));
    }
    
    public function insert_form_ct(Request $rq) {
        $data = [
            'ho_ten' => $rq->ho_ten,
            'gioi_tinh' => $rq->gioi_tinh,
            'dia_chi' => $rq->dia_chi,
            'sdt' => $rq->sdt,
            'email' => $rq->email,
            'noi_dung_ll' =>$rq->noi_dung,
            'status' => 1,
            'created_at' => now(),
            'updated_at' =>now()
        ];
        $insert = $this -> ct -> insertCT($data);
        if($insert == true) {
            try {
                Mail::send('customer.contact.contact_mail', [
                    'ho_ten' => $rq->ho_ten,
                    'gioi_tinh' => $rq->gioi_tinh,
                    'dia_chi' => $rq->dia_chi,
                    'sdt' => $rq->sdt,
                    'noi_dung' => $rq->noi_dung,
                ], function ($email) use ($rq) {
                    $email->subject('HazBin - Thông báo phản hồi liên hệ tại HazBin Hotel');
                    $email->to($rq->email, $rq->ho_ten);
                });
            } catch (Exception $e) {
                return redirect() -> route('customer.contact_index') ->with('error', 'Hệ thống đang gặp sự cố, hãy thử lại sau! Lỗi: ' . $e->getMessage());
            }
            return redirect() -> route('customer.contact_index')->with('success','Thành công, vui lòng kiểm tra email');
        }else{
            return redirect() -> route('customer.contact_index')->withInput()->with('error','Lỗi, vui lòng thử lại sau !!');
        }
        
    }
}
