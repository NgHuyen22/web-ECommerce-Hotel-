<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        $id_ad = $request->session()->get('id_ad');
        $ten_ad = $request->session()->get('ten_ad');
        $id_ctm = $request->session()->get('id_ctm');
        $ten_ctm = $request->session()->get('ten_ctm');
    
        // Nếu cả hai không tồn tại, người dùng chưa đăng nhập
        if (!$id_ad && !$ten_ad && !$id_ctm && !$ten_ctm) {
            if ($request->expectsJson()) {
                return null;
            } else {
                // Kiểm tra đường dẫn URL để xác định chuyển hướng đúng
                if ($request->is('htqlks/customer*')) {
                    return redirect()->route('customer.login');
                } else {
                    return redirect()->route('admin.login');
                }
            }
        }

        return $next($request);
    }
}
