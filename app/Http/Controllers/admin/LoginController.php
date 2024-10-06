<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Services\customer\Ctm_LoginService;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{
    //
    protected $login;
    protected $us;
    protected $ctm_loginService;
    public function __construct()
    {
        // $this -> login = new LoginService();
        $this->us = new Users;
        // $this ->ctm_loginService = new Ctm_LoginService();
    }

    public function add_admin()
    {
        return view('admin.addUser');
    }
    public function insert(Request $rq)
    {
        $getEmail = $this->us->checkUser($rq->email);

        if ($getEmail != null) {
            return redirect()->route('customer.index')->with('error', 'Email đã tồn tại !!');
        } else {
            $data = [
                'ho_ten' => $rq->ho_ten,
                'gioi_tinh' => $rq->gioi_tinh,
                'sdt' => $rq->sdt,
                'email' => $rq->email,
                'dia_chi' => $rq->dia_chi,
                'pass' => bcrypt($rq->pass),
                'role' => 0,
            ];
            $result = $this->us->insertAd($data);
            if ($result == true) {
                echo "thêm thành công";
            }
        }
    }
    public function login()
    {
        return view('admin.login');
    }

    public function check_login(Request $rq)
    {
        // $a = request()->all();
        // dd($a);
        $data = $rq->validate([
            'email' => 'required',
            'pass' => 'required'
        ]);

        $check_email = $rq->email;

        $check_pass = ($rq->pass);

        if (!empty($check_email) && !empty($check_pass)) {
            if (!empty($rq->remember)) {
                session(['email_ad' => $check_email]);
                session(['pass_ad' => $check_pass]);
            }
            $getEmail = $this->us->checkUser($rq->email);

            if ($getEmail && Hash::check($check_pass, $getEmail->password)) {
                // $exitstingUser = $this->us->checkLogin($check_email,$check_pass);
                // if($exitstingUser){
                if ($getEmail->role == 0) {
                    // Auth::login($exitstingUser);
                    // session(['role_ad' => $exitstingUser->role]);
                    session(['id_ad' => $getEmail->id]);
                    session(['ten_ad' => $getEmail->ho_ten]);
                    // dd(session()->all());
                    return redirect()->route('admin.index');
                } else {
                    return redirect()->route('admin.login')-> withInput() -> with('error', 'Bạn không có quyền truy cập !!');
                }
            } else {
                return redirect()->route('admin.login')-> withInput() -> with('error', 'Thông tin đăng nhập không chính xác, vui lòng xem lại !!');
            }
        }
    }

    public function register()
    {
        return view('customer.register');
    }
    public function check_register(Request $rq){

        $rq->validate([
                'ho_ten' => 'required',
                'gioi_tinh' => 'required',
                'sdt' => 'required|numeric',
                'email' => 'required|email',
                'dia_chi' => 'required',
                'pass' => 'required',
                'confirm_pass' => 'required|same:pass'
        ],[
            'sdt.required' => 'Vui lòng nhập SDT!',
            'sdt.numeric' => 'SDT chỉ được nhập số !',
            'email.required' => 'Vui lòng nhập địa chỉ email !',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ !',
            'confirm_pass.required' => 'Vui lòng nhập lại mật khẩu !',
            'confirm_pass.same' => 'Mật khẩu xác nhận không khớp !',
        ]);
        $getEmail = $this->us->checkUser($rq->email);
        // dd($getEmail);
        if ($getEmail != null) {
            return redirect()->route('customer.register')->withInput() ->with('error', 'Email đã tồn tại !!');
        } else {
            $data = [
                'ho_ten' => $rq->ho_ten,
                'gioi_tinh' => $rq->gioi_tinh,
                'sdt' => $rq->sdt,
                'email' => $rq->email,
                'dia_chi' => $rq->dia_chi,
                'pass' => bcrypt($rq->pass),
                'role' => 1,
                'token'  => $rq->_token,
            ];

            $result = $this->us->insertKH($data);
            if ($result == true) {
                return redirect()->route('customer.register')->with('success', 'Đăng ký tài khoản thành công !!');
            }else{
                return redirect()->route('customer.register')->withInput()->with('error','Tạo tài khoản không thành công, hãy thử lại !!');
            }
        }
    }

    public function ctm_login()
    {
        return view('customer.login');
    }

    public function check_ctm_login(Request $rq)
    {
        $data = $rq->validate([
            'email' => 'required',
            'pass' => 'required'
        ]);

        $check_email = $rq->email;

        $check_pass = ($rq->pass);
        // dd($check_pass);
        if (!empty($check_email) && !empty($check_pass)) {
            if (!empty($rq->remember)) {
                session(['email_ctm' => $check_email]);
                session(['pass_ctm' => $check_pass]);
            }
            // $exitstingUser = $this->us->checkLoginCtm($check_email,$check_pass);
            $getEmail = $this->us->checkUser($rq->email);

            if ($getEmail && Hash::check($check_pass, $getEmail->password)) {
                // if ($getEmail->role == 1) {
                    // Auth::login($exitstingUser);
                    // session(['role_ad' => $exitstingUser->role]);
                    session(['id_ctm' => $getEmail->id]);
                    session(['ten_ctm' => $getEmail->ho_ten]);
                    // dd(session()->all());
                    return redirect()->route('customer.index');
                // } else {
                //     return redirect()->route('customer.login')->with('error', 'Bạn không có quyền truy cập !!');
                // }
            } else {
                return redirect()->route('customer.login')-> withInput()  -> with('error', 'Thông tin đăng nhập không chính xác, vui lòng xem lại !!');
            }
        }
    }

    public function pass_forgotten()
    {
        return view('customer.pass_forgotten');
    }

    // public function check_passForgotten(Request $rq)
    // {
    //     $rq->validate([
    //         'email' => 'required|email', // Bạn có thể thêm kiểm tra định dạng email
    //     ], [
    //         'email.required' => 'Vui lòng không bỏ trống',
    //         'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
    //     ]);

    //     $token = strtoupper(Str::random(10)); 
    //     $customer = Users::where('email', $rq->email)->first();
    //     // dd($customer ->token);
    //     if ($customer != null) {
    //         // Gửi email

    //         $tokenUp = $this->us->updateUS($rq->email, $token);

    //         try{
    //                 Mail::send('customer.check_forgotten_pass', ['customer' => $customer, 'token' => $customer->token], function ($email) use ($customer) {
    //                     $email->subject('HTQLKS - Xác nhận tài khoản');
    //                     $email->to($customer->email, $customer->ho_ten);
    //                 });

    //                 return redirect()->route('customer.pass_forgotten')->with('success', 'Thành công, vui lòng kiểm tra email !!');
    //             }catch(\Exception $e){

    //                 return redirect()->route('customer.pass_forgotten')->with('error', 'Hệ thống đang gặp sự cố, hãy thử lại sau vài phút !!');
    //             }
    //         // Kiểm tra xem có lỗi khi gửi email hay không
    //         // if (count(Mail::failures()) > 0) {

    //     } else {
    //         return redirect()->route('customer.pass_forgotten')->with('error', 'Email không tồn tại, vui lòng kiểm tra lại !!');
    //     }
    // }
    public function check_passForgotten(Request $rq)
    {
        $rq->validate([
            'email' => 'required|email', // Kiểm tra định dạng email
        ], [
            'email.required' => 'Vui lòng không bỏ trống !',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ !',
        ]);

        $token = strtoupper(Str::random(10)); // Tạo token ngẫu nhiên
        $customer = Users::where('email', $rq->email)->first();
        if ($customer != null) {
            // Cập nhật token cho người dùng
            $this->us->updateUS($rq->email, $token); // Lưu token vào CSDL
            // dd($customer->token);

            // Gửi email
            try {
             
                Mail::send('customer.check_forgotten_pass', ['customer' => $customer, 'token' => $token], function ($email) use ($customer) {
                    $email->subject('HTQLKS - Xác nhận tài khoản từ HazBin Hotel');
                    $email->to($customer->email, $customer->ho_ten);
                });

                return redirect()->route('customer.pass_forgotten')->with('success', 'Thành công, vui lòng kiểm tra email !!');
            } catch (\Exception $e) {
                return redirect()->route('customer.pass_forgotten')->with('error', 'Hệ thống đang gặp sự cố, hãy thử lại sau vài phút !!');
            }
        } else {
            return redirect()->route('customer.pass_forgotten')->withInput() -> with('error', 'Email không tồn tại, vui lòng kiểm tra lại !!');
        }
    }

    public function get_pass($id_ctm, $token)
    {
        $customer = Users::where('id', $id_ctm)->first();

        if ($customer && $customer->token == $token) {
            return view('customer.getPass'); // Hiển thị trang đặt lại mật khẩu
        } else {
            return redirect()->route('customer.pass_forgotten')->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
        }
    }

    public function check_getPass(Request $rq,$id_ctm,$token){
            $rq->validate([
                    'pass' => 'required',
                    'confirm_pass' => 'required',
            ]);
            if(($rq->pass != null) && ($rq->confirm_pass != null)){
                if($rq->pass != $rq->confirm_pass ){
                    return redirect()->route('customer.getPass', ['id_ctm' => $id_ctm, 'token' => $token])
                    ->withInput() ->with('error', 'Mật khẩu xác nhận lại không chính xác !!');
                }else{
                    return redirect()->route('customer.getPass', ['id_ctm' => $id_ctm, 'token' => $token])->with('success','Cập nhật lại mật khẩu thành công !!');
                }
            }
    }
}
