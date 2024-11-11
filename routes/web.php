<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\UpdatedRoomController;
use App\Http\Controllers\admin\BookingFormController;
use App\Http\Controllers\admin\ServiceMController;
use App\Http\Controllers\admin\SpecialOffersController;
use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\admin\Statistical;
use App\Http\Controllers\admin\ManageCotactInfo;
use App\Http\Controllers\admin\CTMInfoManagement;

use App\Http\Controllers\customer\about\C_ServiceController;
use App\Http\Controllers\customer\C_HomeController;
use App\Http\Controllers\customer\C_RoomController;
use App\Http\Controllers\customer\C_ContactController;
use App\Http\Controllers\customer\C_SpecialOffers;

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

        // Route::get('/',[HomeController::class,'index'])->name('admin.index') ;
        Route::match(['get','post'], '/',[HomeController::class,'statistical_management'])->name('admin.index') ;
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
        Route::prefix('/booking_management')->group(function(){
            Route::match(['get','post'],'/',[HomeController::class,'bm_index'])->name('admin.booking_management') ;

            // XEM LICH TRONG
            // Route::get('/see_empty_calendar',[BookingFormController::class,'calender'])->name('admin.calender') ;

            // DUYỆT ĐƠN 
            Route::post('/approved/{id_don}',[BookingFormController::class,'approved'])->name('admin.approved') ;

            //XOA ĐƠN
            Route::get('/delete/{id_don}',[BookingFormController::class,'delete'])->name('admin.delete') ;
            
            //CHI TIET DON DP
            Route::get('/booking_form_details/{id_don}',[BookingFormController::class,'bf_detail'])->name('admin.bf_detail') ;
            
            //XEM LICH DAT PHONG
            Route::match(['get', 'post'],'/view_booking_schedule',[BookingFormController::class,'view_booking_schedule'])->name('admin.view_booking_schedule') ;
            Route::match(['get', 'post'], '/admin/view_booking_schedule/{id_lp}', [BookingFormController::class, 'booking_schedule'])->name('admin.booking_schedule');
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

        //CAP NHAT UU DAI
        Route::prefix('/special_offers')->group(function(){
            Route::get('/',[HomeController::class,'spo_index'])->name('admin.special_offers') ;
            //DUNG AP DUNG UD VAO DV
            Route::get('/stop_applying_dv/{id_uddv}',[SpecialOffersController::class,'stop'])->name('admin.stop_applying_dv') ;
            //SUA UD
            Route::post('/edit_special_offers/{id_ud}',[SpecialOffersController::class,'edit_spo'])->name('admin.edit_special_offers') ;
            Route::post('/updated_special_offers',[SpecialOffersController::class,'updated']) -> name('admin.updated_special_offers');
            //XOA UD
            Route::get('/remove_special_offers/{id_ud}',[SpecialOffersController::class,'remove']) -> name('admin.remove_special_offers');
            //THEM UD
            Route::get('/add_incentives',[SpecialOffersController::class,'add_incentives']) -> name('admin.add_incentives');
            Route::post('/insert_incentives',[SpecialOffersController::class,'insert_incentives']) -> name('admin.insert_incentives');

        });

        //QL HOA DON
        Route::prefix('/bill_management') ->group(function() {
            Route::match(['get','post'], '/',[HomeController::class,'bill_index'])->name('admin.bill_index') ;
            //xac nhan thanh toan
            Route::match(['get','post'],'accept_bill/{id_hd}',[BillController::class,'accept_bill'])->name('admin.accept_bill') ;
            //cap nhat hd 
            Route::post('updated_bill/{id_hd}',[BillController::class,'updated_bill'])->name('admin.updated_bill') ;
            //xoa hd 
            Route::get('deleteBill/{id_hd}',[BillController::class,'deleteBill'])->name('admin.deleteBill');

        // QL CAC DANH GIA
        Route::prefix('/manage_reviews') ->group(function() {
            Route::match(['get','post'], '/',[HomeController::class,'manage_reviews'])->name('admin.manage_reviews') ;
            Route::match(['get','post'],'/see_review_details/{id_lp}',[HomeController::class,'see_review_details'])->name('admin.see_review_details') ;
            Route::match(['get','post'],'/hide_review/{id_dg}',[HomeController::class,'hide_review'])->name('admin.hide_review') ;
        });

        //QL Liên hệ
        Route::prefix('/manage_contact_information') ->group(function() {
            Route::match(['get','post'], '/',[HomeController::class,'manage_contact_information'])->name('admin.manage_contact_information') ;
            Route::match(['get','post'], '/reply_email',[ManageCotactInfo::class,'reply_email'])->name('admin.reply_email') ;
        });

        //THONG KE
        Route::prefix('/statistical_management') ->group(function() {
            // Route::match(['get','post'], '/',[HomeController::class,'statistical_management'])->name('admin.statistical_management') ;
            //TK DAT PHONG
            Route::get('/room_booking_details', [Statistical::class,'room_booking_details']) -> name('admin.room_booking_details');
            Route::get('/room_booking_schedule/{month}/{id_lp}', [Statistical::class,'calendar_room_booking']) -> name('admin.calendar_room_booking'); 

            //TK DAT DV
            Route::get('/service_booking_details', [Statistical::class,'service_booking_details']) -> name('admin.service_booking_details');
            Route::get('/service_booking_schedule/{month}/{id_dv}', [Statistical::class,'service_booking_schedule']) -> name('admin.service_booking_schedule');

            //TKE SL KHACH HANG
            Route::get('/slkh_index', [Statistical::class,'slkh_index']) -> name('admin.slkh_index');
            //TKE TONG DOANH THU
            Route::get('/total_revenue', [Statistical::class,'total_revenue']) -> name('admin.total_revenue');
            // Route::get('/slkh_details/{month}/{id_kh}', [Statistical::class,'slkh_details']) -> name('admin.slkh_details');
          
        });    
        
        //QLTT KHÁCH HÀNG
        Route::prefix('/customer_information_management') ->group(function() {
            Route::match(['get','post'], '/',[HomeController::class,'customer_information_management'])->name('admin.customer_information_management') ;
            Route::match(['get','post'], '/customer_type/{type}',[CTMInfoManagement::class,'customer_type'])->name('admin.customer_type') ;
            Route::match(['get','post'], '/delete_customer_info/{id_kh}',[CTMInfoManagement::class,'delete_customer_info'])->name('admin.delete_customer_info') ;
        });
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
        
                Route::match(['get', 'post'], '/',[C_HomeController::class,'index']) ->name('customer.index');
                Route::get('about/',[C_HomeController::class,'about']) ->name('customer.about');
                Route::get('/profile',[C_HomeController::class,'profile']) ->name('customer.view_profile');
                Route::post('/edit_profile/{id_kh}',[C_HomeController::class,'edit_profile']) ->name('customer.edit_profile');

                //PHONG
                //XEM PHONG
                Route::match(['get','post'],'/room',[C_HomeController::class,'room_index']) ->name('customer.room_index');
                Route::get('/room-detail/{id_rt}',[C_HomeController::class,'room_detail']) ->name('customer.room_detail');
                Route::match(['get','post'],'search',[C_HomeController::class,'search']) ->name('customer.search');
                Route::post('/search_price',[C_HomeController::class,'search_price']) ->name('customer.search_price');
                Route::match(['get','post'],'search_name',[C_HomeController::class,'search_name']) ->name('customer.search_name');
                Route::get('/room/increment-search/{id_lp}', [C_HomeController::class, 'incrementSearchCount'])->name('room.increment_search');
                

                //DAT PHONG
                Route::post('/booking_room',[C_RoomController::class,'booking_room']) ->name('customer.booking_room');
                Route::post('/booking_room/insert_form',[C_RoomController::class,'insert_form']) ->name('customer.insert_form');
                Route::get('/booking_room/insert_profile',[C_RoomController::class,'insert_profile']) -> name('customer.insert_profile');
                Route::post('/booking_room/insert_profile',[C_RoomController::class,'save_profile']) -> name('customer.save_profile');
        
                  // XEM LICH SU DAT PHONG
                    // Route::get('/profile/see_form',[C_RoomController::class,'see_form']) -> name('customer.see_form');
                    Route::get('/profile/see_form',[C_RoomController::class,'see_history']) -> name('customer.see_form');
                    Route::get('/cancle_form/{id_don}',[C_RoomController::class,'cancle']) -> name('customer.cancle_form');
                    Route::get('/cancle_service_form/{id_ct}',[C_ServiceController::class,'cancle_service']) -> name('customer.cancle_service');

                    //DANH GIA
                    Route::get('/evaluate', [C_RoomController::class, 'evaluate'])->name('customer.evaluate');
                    //SUA DG
                    Route::get('/update_review', [C_RoomController::class, 'update_review'])->name('customer.update_review');
                    //IN HD
                    Route::get('/in-hoa-don/{id_hd}', [BillController::class, 'print_bill'])->name('customer.print_bill');
                    
                    //DANG XUAT
                 Route::get('/logout',[C_HomeController::class,'logout']) ->name('customer.logout');

                // DỊCH VỤ
                Route::prefix('/service_type')->group(function(){
                    Route::get('/{id_ldv}',[C_ServiceController::class,'service_type']) ->name('customer.service_type');
                    Route::get('/{id_ldv}/service',[C_ServiceController::class,'service']) ->name('customer.service');
                    Route::post('/service/service_booking',[C_ServiceController::class,'service_booking']) ->name('customer.service_booking');
                   });

                //LIÊN HỆ
                Route::prefix('/contact')->group(function(){
                    Route::match(['get','post'], '/',[C_ContactController::class,'contact_index']) ->name('customer.contact_index');
                    Route::post('/insert_form_ct',[C_ContactController::class,'insert_form_ct']) ->name('customer.insert_form_ct');
                });

                //UU DAI 
                Route::prefix('/view_special_offers')->group(function(){
                    Route::match(['get','post'], '/',[C_SpecialOffers::class,'view_special_offers']) ->name('customer.view_special_offers');
                    // Route::post('/insert_form_ct',[C_ContactController::class,'insert_form_ct']) ->name('customer.insert_form_ct');
                });
                //TIN TỨC
                Route::prefix('/news')->group(function(){
                    Route::match(['get','post'], '/',[C_HomeController::class,'news']) ->name('customer.news');
                    // Route::post('/insert_form_ct',[C_ContactController::class,'insert_form_ct']) ->name('customer.insert_form_ct');
                });
});


        
