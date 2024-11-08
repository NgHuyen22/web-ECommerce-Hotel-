<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\BookingForm;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UpdatedRoomController extends Controller
{
    protected $rt;
    protected $r;
    protected $bf;

    public function __construct()
    {
        $this -> rt = new RoomType();
        $this -> r = new Room();
        $this -> bf = new BookingForm();
    }

    
    public function add_room_form(){

        return view('admin.update_room.add_roomType');
    }

    public function save_room(Request $rq){
        $gia_lp_cleaned = str_replace(['.' , 'VND'] , '' , $rq -> gia_lp );
        $data = [
            'ten_lp' => $rq -> ten_lp,
            'mo_ta' => $rq -> mo_ta,
            'tien_nghi' => $rq -> tien_nghi,
            'gia_lp' => intval($gia_lp_cleaned), //ep thành chuỗi số ngueyen
            'suc_chua' => $rq -> suc_chua,
            'dien_tich' => $rq -> dien_tich,
            'phan_hang' => $rq -> phan_hang,
            'search_count' =>0,
            'search_booking' =>0,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $exitingName = $this -> rt -> checkNameRT($rq ->ten_lp);
        if($exitingName == null){
            // sleep(3);
            $insert = $this -> rt -> insertRoomType($data);
            if($insert == true){
                // sleep(3);
                return redirect() -> route('admin.update_room')->with('success', 'Thêm thành công !');
            }else{
                return redirect() ->route('admin.add_room') -> withInput() ->with('error','Lỗi, vui lòng thử lại sau !');
            }   
        }else{
            return redirect() ->route('admin.add_room') -> withInput() ->with('error','Loại phòng đã tồn tại, vui lòng nhập tên khác !');
        }
      
    }

    public function add_room2($id_rt){
        
      
        return view('admin.update_room.add_room', compact('id_rt'));
    }

    public function save_room2(Request $rq){
        $id_rt =  $rq -> id_rt;
        $data =[
            'so_phong' => $rq -> so_phong,
            // 'tinh_trang' => "Trống",
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'loai_phong' => $rq -> id_rt,
        ];

            $exits = $this -> r -> checkRoom($rq -> so_phong , $rq -> id_rt);
            if($exits == null){
                $insertRoom = $this -> r ->insertRoom($data);
                if($insertRoom == true){

                    return redirect() -> route('admin.room_detail', ['id_rt' => $id_rt]) ->with('success', 'Thêm thành công !');
                }else{
                    return redirect() -> route('admin.add_room2', compact('id_rt')) ->with('error', 'Lỗi, vui lòng thử lại sau !');
                }
            }else{
                return redirect() ->route('admin.add_room2', compact('id_rt')) -> withInput() ->with('error','Phòng đã tồn tại, vui lòng nhập số phòng khác !');
            }
    }

    public function updated_form($id_rt){
        // $result = $this -> rt ->updateRoomType($id_rt);
        $room_type = $this -> rt ->getRoomTypeID($id_rt);
        return view('admin.update_room.updated_form' , compact('room_type'));
    }

    public function updated(Request $rq){
        //thay thế rỗng '' vào '.' và 'VND' dùng hàm str_replace. tham số đầu mảng cần thế , tham số 2 là giá trị thế , ts 3 là chuỗi nguồn
        $gia_lp_cleaned = str_replace(['.' , 'VND'] , '' , $rq -> gia_lp );

        $data = [
                'ten_lp' => $rq -> ten_lp,
                'mo_ta' => $rq -> mo_ta,
                'tien_nghi' => $rq -> tien_nghi,
                'gia_lp' => intval($gia_lp_cleaned), //ep thành chuỗi số ngueyen
                'suc_chua' => $rq -> suc_chua,
                'dien_tich' => $rq -> dien_tich,
                'updated_at' => now(),
        ];

            $result = $this -> rt ->updateRoomType($rq -> id_lp, $data);
            if($result == true){
                
                return redirect() -> route('admin.update_room') -> with('success','Cập nhật thành công ');
            }else{
                return redirect() ->route('admin.updated_form')-> withInput() -> with('error','Lỗi , vui lòng thử lại sau !');
            }
    }

    public function room_detail($id_rt){
        $room = $this -> r -> getRoom($id_rt);
        $room_type = $this -> rt -> getRoomTypeID($id_rt);
        // $countRoom = $this -> r -> countRoomTypeID($id_rt);
        $countRoom = $room -> total();
        return view('admin.update_room.room_detail', compact('room', 'room_type', 'countRoom') );
    }

    public function delete_room($id_r){
        $data =[
            'status' => 0
        ];
        $id_rt = $this -> r -> getIdRt($id_r);
        $result = $this -> r -> deleteRoom($id_r ,$data);
        sleep(2.1);
        return redirect() -> route('admin.room_detail',  ['id_rt' => $id_rt]);
    }

    public function delete_roomType($id_rt){
        $data =[
            'status' => 0
        ];
        $result = $this -> rt -> deleteRoomType($id_rt ,$data);
        if($result == true){

            return redirect() -> route('admin.update_room')->with('success' ,'Xóa thành công');
        }else{
            
            return redirect() -> route('admin.update_room')->with('error' ,'Lỗi , vui lòng thử lại sau !');
        }
       
    }

 

}
