<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use Carbon\Carbon;
use Exception;

class ManageCotactInfo extends Controller
{
    protected $ct;
    public function __construct()
    {
        $this -> ct = new Contact();
    }

    public function reply_email(Request $rq) {
        $noi_dung = $rq->query('reply');
        $id_contact = $rq->query('id_contact');
        $info = $this -> ct -> info($id_contact);
        try {
            Mail::send('admin.manage_contact_info.contact_mail', [
                'noi_dung' => $noi_dung,
                'info' => $info,
            ], function ($email) use ($info) {
                $email->subject('HazBin - Thông báo phản hồi liên hệ tại HazBin Hotel');
                $email->to($info->email);
            });
        } catch (Exception $e) {
            return redirect() -> route('admin.manage_contact_information') ->with('error', 'Hệ thống đang gặp sự cố, hãy thử lại sau! Lỗi: ' . $e->getMessage());
        }
      
        $updated = $this -> ct -> updatedCT($id_contact);
        if($updated){
            return redirect() -> route('admin.manage_contact_information')->with('success', 'Phản hồi thành công, vui lòng kiểm tra email !');
        }
    }

    

}
