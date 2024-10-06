<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\UpdatedRoomController;
use App\Http\Controllers\admin\BookingFormController;
use App\Http\Controllers\admin\ServiceMController;
use App\Http\Controllers\customer\about\C_ServiceController;

use App\Http\Controllers\customer\C_HomeController;
use App\Http\Controllers\customer\C_RoomController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('htqlks/add_admin',[LoginController::class,'add_admin']) ;
// Route::post('htqlks/add_admin',[LoginController::class,'insert']) ;

Route::get('/htqlks/admin/login',[LoginController::class,'login']) -> name('admin.login');
Route::post('/htqlks/admin/login',[LoginController::class,'check_login']);

Route::group(['middleware' => 'auth'], function(){
    Route::prefix('hazbinhotel/htqlks/admin')->group(function(){

        Route::get('/',[HomeController::class,'index'])->name('admin.index') ;
        // Route::get('/chatbox',[HomeController::class,'chatbox']) ->name('chatbox');
        Route::get('/logout',[HomeController::class,'logout']) ->name('admin.logout');
 
        // QL DỊCH VỤ
            Route::prefix('/service_management')->group(function(){
                Route::get('/', [ServiceMController::class, 'sm_index']) -> name('admin.service_management');
                Route::get('/service_type', [ServiceMController::class, 'service_type']) -> name('admin.service_type');
           
                //THÊM  LDV
                Route::get('/services_type/add', [ServiceMController::class, 'add_ldv']) -> name('admin.add_ldv');
                Route::post('/services_type/insert_ldv', [ServiceMController::class, 'insert_ldv']) -> name('admin.insert_ldv');
                
                //SỬA LDV
                Route::post('/service_type/edit_svt/id_svt={id_ldv}', [ServiceMController::class, 'edit_svt']) -> name('admin.edit_svt');
                Route::post('/service_type/updated_svt', [ServiceMController::class, 'updated_svt']) -> name('admin.updated_svt');

                //XÓA LDV
                Route::get('/service_type/delete/{id_ldv}',[ServiceMController::class,'delete_svt'])->name('admin.delete_svt') ;
                
                // XÓA DON DV
                Route::get('/service_type/delete_form_sv/id_ct={id_ct}',[ServiceMController::class,'delete_form_sv'])->name('admin.delete_form_sv') ;

                 //DỊCH VỤ
                //  Route::post('/services_type/{id_ldv}', [ServiceMController::class, 'getServices']) -> name('admin.getServices');
                 Route::match(['get', 'post'], 'services/id_svt={id_ldv}', [ServiceMController::class, 'getServices'])->name('admin.getServices');
                 
                 //THEM DV
                 Route::get('/services/id_svt={id_ldv}/add', [ServiceMController::class, 'add_dv']) -> name('admin.add_dv');
                 Route::post('/services/id_svt={id_ldv}/insert', [ServiceMController::class, 'insert_dv']) -> name('admin.insert_dv');

                //  // Route trung gian
                Route::get('/services/id_svt={id_ldv}/redirect', [ServiceMController::class, 'redirectToPost'])->name('admin.redirectToPost');
                // Route::post('services_type/{id_ldv}/getRD', [ServiceMController::class, 'redirectRD'])->name('admin.getRD');

                //SUA DV
                Route::post('/services/id_svt={id_ldv}/edit_dv/id_sv={id_dv}', [ServiceMController::class, 'edit_dv']) -> name('admin.edit_dv');
                Route::post('/services//updated_sv/id_sv={id_dv}', [ServiceMController::class, 'updated_sv']) -> name('admin.updated_sv');
                
                //XÓA DV
                Route::get('/services/id_svt={id_ldv}/delete/id_sv={id_dv}', [ServiceMController::class, 'delete_sv']) -> name('admin.delete_sv');

            });

        //QL DAT PHONG 
        Route::prefix('hazbinhotel/htqlks/admin/booking_management')->group(function(){
            Route::get('/',[HomeController::class,'bm_index'])->name('admin.booking_management') ;

            // XEM LICH TRONG
            // Route::get('/see_empty_calendar',[BookingFormController::class,'calender'])->name('admin.calender') ;

            // DUYỆT ĐƠN 
            Route::post('/approved/{id_don}',[BookingFormController::class,'approved'])->name('admin.approved') ;

            //XOA ĐƠN
            Route::get('/delete/{id_don}',[BookingFormController::class,'delete'])->name('admin.delete') ;
            
            //CHI TIET DON DP
            Route::get('/booking_form_details/{id_don}',[BookingFormController::class,'bf_detail'])->name('admin.bf_detail') ;

        });
        // CAP NHAT PHONG
        Route::prefix('/updated_room')->group(function(){
            Route::get('/',[HomeController::class,'update_room'])->name('admin.update_room') ;

            //THEM LOAI PHONG
            Route::get('/add_roomType',[UpdatedRoomController::class,'add_room_form'])->name('admin.add_room') ;
            Route::post('/add_roomType',[UpdatedRoomController::class,'save_room']) -> name('admin.save_room');

            //CHINH SUA LOAI PHONG
            Route::post('/updated_form/id_rt={id_rt}',[UpdatedRoomController::class,'updated_form'])->name('admin.updated_form') ;
            Route::post('/updated_form',[UpdatedRoomController::class,'updated']) -> name('admin.updated');

            //XOA LOAI PHONG
            Route::get('/delete_roomType/id_rt={id_rt}', [UpdatedRoomController::class, 'delete_roomType']) -> name('admin.delete_roomType');

            //CHI TIET PHONG
            Route::get('/room_detail/id_rt={id_rt}',[UpdatedRoomController::class,'room_detail']) -> name('admin.room_detail');

            //THEM PHONG
            Route::get('/add_room/roomType_id={id_rt}',[UpdatedRoomController::class,'add_room2']) -> name('admin.add_room2');
            Route::post('/add_room/roomType_id={id_rt}',[UpdatedRoomController::class,'save_room2']) -> name('admin.save_room2');

            // XOA PHONG
            Route::get('/delete_room/id_rt={id_r}', [UpdatedRoomController::class, 'delete_room']) -> name('admin.delete_room');
        });
    });


});



// customer
    Route::prefix('hazbinhotel/htqlks/customer')->group(function(){

        //DANG_KY
        Route::get('/register',[LoginController::class,'register'])->name('customer.register');
        Route::post('register',[LoginController::class,'check_register']);
        
        //QUEN MAT KHAU
        Route::get('/password-forgotten',[LoginController::class,'pass_forgotten'])->name('customer.pass_forgotten');
        Route::post('/password-forgotten',[LoginController::class,'check_passForgotten']);
        
        Route::get('/get-password/{id_ctm}/{token}',[LoginController::class,'get_pass'])->name('customer.getPass');
        Route::post('/get-password/{id_ctm}/{token}',[LoginController::class,'check_getPass']);

        //DANG NHAP
        Route::get('/login',[LoginController::class,'ctm_login'])->name('customer.login');
        Route::post('/login',[LoginController::class,'check_ctm_login']);
        
        
        // Route::group(['middleware' => 'auth'], function(){
            // Route::prefix('/htqlks/customer')->group(function(){
        
                Route::get('/',[C_HomeController::class,'index']) ->name('customer.index');
                Route::get('/profile',[C_HomeController::class,'profile']) ->name('customer.view_profile');
        //PHONG
                //XEM PHONG
                Route::get('/room',[C_HomeController::class,'room_index']) ->name('customer.room_index');
                Route::get('/room-detail/{id_rt}',[C_HomeController::class,'room_detail']) ->name('customer.room_detail');
        
                //DAT PHONG
                Route::post('/booking_room',[C_RoomController::class,'booking_room']) ->name('customer.booking_room');
                Route::post('/booking_room/insert_form',[C_RoomController::class,'insert_form']) ->name('customer.insert_form');
                Route::get('/booking_room/insert_profile',[C_RoomController::class,'insert_profile']) -> name('customer.insert_profile');
                Route::post('/booking_room/insert_profile',[C_RoomController::class,'save_profile']) -> name('customer.save_profile');
        
                    // XEM LICH SU DAT PHONG
                    Route::get('/profile/see_form',[C_RoomController::class,'see_form']) -> name('customer.see_form');
                    Route::get('/cancle_form/{id_don}',[C_RoomController::class,'cancle']) -> name('customer.cancle_form');
                    Route::get('/cancle_service_form/{id_ct}',[C_ServiceController::class,'cancle_service']) -> name('customer.cancle_service');
                    
                    //DANG XUAT
                 Route::get('/logout',[C_HomeController::class,'logout']) ->name('customer.logout');

                // DỊCH VỤ
                Route::prefix('/service_type')->group(function(){
                    Route::get('/{id_ldv}',[C_ServiceController::class,'service_type']) ->name('customer.service_type');
                    Route::get('/{id_ldv}/service',[C_ServiceController::class,'service']) ->name('customer.service');
                    Route::post('/service/service_booking',[C_ServiceController::class,'service_booking']) ->name('customer.service_booking');
                   });
});


        
