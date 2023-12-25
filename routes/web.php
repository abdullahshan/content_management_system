<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\plotController;
use App\Http\Controllers\backend\roadController;
use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\searchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\userController;
use App\Http\Controllers\backend\customerController;
use App\Http\Controllers\backend\applyController;
use App\Http\Controllers\backend\nomineeController;
use App\Http\Controllers\backend\reportController;
use App\Http\Controllers\backend\shareConroller;

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

Route::get('/',[frontendController::class,'index'])->name('frontend');

// Route::get('/',function(){
    
//     Artisan::call('storage:link');
// });


/*frontend plot get for dropdown*/ 
Route::post('/getroad',[plotController::class,'get_plot'])->name('getroad');
/*frontend plot get for Aviable*/ 
Route::post('/plot_view',[plotController::class,'plot_view'])->name('plot_view');
/*frontend plot info*/ 
Route::post('/plot_info',[plotController::class,'plot_info'])->name('plot_info');
/*frontend image get with block*/ 
Route::post('/block_image',[plotController::class,'block_image'])->name('block_image');

/*booking Information all from frontend*/ 
Route::post('/book',[frontendController::class,'book'])->name('book');
Route::get('/book_info',[frontendController::class,'book_info'])->name('book_info');
Route::post('/book_info_second/{id}',[frontendController::class,'book_info_second'])->name('book_info_second');
Route::post('/getblock',[frontendController::class,'getroad'])->name('getroad');
/*for backend road get*/ 
Route::post('/road',[frontendController::class,'getroad'])->name('getroad');


/*nothing do*/
Route::post('/report_find',[frontendController::class,'report_find'])->name('report_find');



Auth::routes();


/*for frontend road get*/ 


Route::middleware(['auth','isVan'])->group(function () {
    

 Route::middleware('role:superadministrator')->get('/user',[userController::class,'user'])->name('user');
 Route::middleware('role:superadministrator')->get('/user_van/{id}',[userController::class,'user_van'])->name('user_van');
 Route::middleware('role:superadministrator')->get('/user_delete/{id}',[userController::class,'user_delete'])->name('user_delete');
 Route::middleware('role:superadministrator')->get('/user_update/{id}',[userController::class,'user_update'])->name('user_update');
 Route::middleware('role:superadministrator')->post('/update_store/{id}',[userController::class,'update_store'])->name('update_store');

 
 Route::get('/deshboard', [backendController::class, 'index'])->name('deshboard');

/*Booking Information get from database*/ 
Route::get('/getbooking_info',[frontendController::class,'getbooking_info'])->name('getbooking_info');
Route::get('/status_change/{id}',[frontendController::class,'status_change'])->name('status_change.home');
Route::get('/cancle/{id}',[frontendController::class,'cancle'])->name('cancle.home');
Route::get('/hide/{id}',[frontendController::class,'hide'])->name('hide');
Route::delete('/delete/{id}', [frontendController::class, 'delete'])->name('delete');







Route::middleware('auth')->prefix('contact')->name('contact.')->group(function(){

Route::get('edit/{id}',[frontendController::class,'edit'])->name('edit');
Route::post('update/{id}',[frontendController::class,'update'])->name('update');
Route::get('share/{id}',[frontendController::class,'share'])->name('share');
Route::post('share_store/{id}',[frontendController::class,'share_store'])->name('share_store');
Route::post('share_edite/{id}',[shareConroller::class,'share_edite'])->name('share_edite');
Route::post('share_update/{id}',[shareConroller::class,'share_update'])->name('share_update');
Route::post('share_delete/{id}',[shareConroller::class,'share_delete'])->name('share_delete');



Route::get('/customars',[frontendController::class,'customars'])->name('customars');
Route::get('/customer_view/{id}',[frontendController::class,'customer_view'])->name('customer_view');
Route::get('/customer_profile/{id}',[frontendController::class,'customer_profile'])->name('customer_profile');

Route::get('/customer_info_edit/{id}',[customerController::class,'customer_info_edit'])->name('customer_info_edit');
Route::get('/customer_edit/{id}',[frontendController::class,'customer_edit'])->name('customer_edit');
Route::post('/customeredit_store/{id}',[customerController::class,'customeredit_store'])->name('customeredit_store');
Route::delete('/customer_delete/{id}',[customerController::class,'customer_delete'])->name('customer_delete');

Route::get('/customer_payment/{id}',[frontendController::class,'customer_payment'])->name('customer_payment');
Route::post('/payment_store/{id}',[frontendController::class,'payment_store'])->name('payment_store');
Route::get('/full_payment/{id}',[frontendController::class,'full_payment'])->name('full_payment');
Route::post('/full_payment_store/{id}',[frontendController::class,'full_payment_store'])->name('full_payment_store');

Route::post('/edit_kisty_store/{id}',[frontendController::class,'edit_kisty_store'])->name('edit_kisty_store');
Route::post('/edit_kisty/{id}',[frontendController::class,'edit_kisty'])->name('edit_kisty');
Route::post('/Kisty_amount/{id}',[frontendController::class,'Kisty_amount'])->name('Kisty_amount');
Route::post('/kisty_update/{id}',[frontendController::class,'kisty_update'])->name('kisty_update');
Route::post('/invoice/{id}',[frontendController::class,'invoice'])->name('invoice');
Route::post('/invoice_view/{id}',[frontendController::class,'invoice_view'])->name('invoice_view');




Route::get('/deshboard/customer_form',[applyController::class,'customer_form'])->name('customer_form');
Route::post('/deshboard/customer_form_store',[applyController::class,'customer_form_store'])->name('customer_form_store');

Route::post('/deshboard/nominee',[applyController::class,'nominee'])->name('nominee');
Route::get('/deshboard/nominee_form/{id}',[applyController::class,'nominee_form'])->name('nominee_form');
Route::post('/deshboard/nominee_store/{id}',[applyController::class,'nominee_store'])->name('nominee_store');
Route::get('/deshboard/nomineetoshare_form/{id}',[applyController::class,'nomineetoshare_form'])->name('nomineetoshare_form');
Route::post('/deshboard/nomineetoshare_store/{id}',[applyController::class,'nomineetoshare_store'])->name('nomineetoshare_store');
Route::post('/deshboard/share_nominee_edit/{id}',[nomineeController::class,'share_nominee_edit'])->name('share_nominee_edit');
Route::post('/deshboard/share_nominee_update/{id}',[nomineeController::class,'share_nominee_update'])->name('share_nominee_update');
Route::post('/deshboard/share_nominee_delete/{id}',[nomineeController::class,'share_nominee_delete'])->name('share_nominee_delete');



Route::post('/nominee_edit/{id}',[nomineeController::class,'nominee_edit'])->name('nominee_edit');
Route::post('/update_nominee/{id}',[nomineeController::class,'update_nominee'])->name('update_nominee');
Route::post('/nominee_delete/{id}',[nomineeController::class,'nominee_delete'])->name('nominee_delete');



Route::get('/deshboard/apply/{id}',[applyController::class,'apply'])->name('apply');
Route::post('/deshboard/apply_store/{id}',[applyController::class,'apply_store'])->name('apply_store');

Route::post('/deshboard/apply_store_second/{id}',[applyController::class,'apply_store_second'])->name('apply_store_second');
Route::get('/deshboard/apply_form',[applyController::class,'apply_form'])->name('apply_form');



Route::get('/profile_pdf/{id}',[frontendController::class,'profile_pdf'])->name('profile_pdf');
Route::get('/payment_pdf/{id}',[frontendController::class,'payment_list'])->name('payment_list');
Route::post('/invoice_genarate',[frontendController::class,'invoice_genarate'])->name('invoice_genarate');


Route::get('/report',[frontendController::class,'report'])->name('report');
Route::post('/search_report',[frontendController::class,'search_report'])->name('search_report');
Route::get('/down_money',[reportController::class,'down_money'])->name('down_money');
Route::get('/booking_money',[reportController::class,'booking_money'])->name('booking_money');
Route::get('/due_installment',[reportController::class,'due_installment'])->name('due_installment');


Route::get('/discount',[frontendController::class,'discount'])->name('discount');
Route::post('/discount_store/{id}',[frontendController::class,'discount_store'])->name('discount_store');

});





/*Block Route All*/ 
    Route::middleware('auth')->prefix('category')->name('category.')->group(function(){

        Route::get('/status/{category:slug}', [categoryController::class, 'status'])->name('status');

        Route::get('/add', [categoryController::class, 'add'])->name('add');
        Route::post('/store', [categoryController::class, 'store'])->name('store');
        Route::delete('/delete/{category:slug}', [categoryController::class, 'delete'])->name('delete');
        Route::get('/edit/{category:slug}', [categoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category:slug}', [categoryController::class, 'update'])->name('update');
        Route::get('/get_road/{id}', [categoryController::class, 'get_road'])->name('get_road');
        Route::get('/get_plot/{id}', [categoryController::class, 'get_plot'])->name('get_plot');
        Route::get('/avilabele_plot/{id}', [categoryController::class, 'avilabele_plot'])->name('avilabele_plot');
        Route::delete('/delete_road/{id}', [categoryController::class, 'delete_road'])->name('delete_road');
        Route::get('/delete_plot/{id}', [categoryController::class, 'delete_plot'])->name('delete_plot');
        Route::post('/edit_plot/{id}', [plotController::class, 'edit_plot'])->name('edit_plot');
        Route::post('/update_plot/{id}', [plotController::class, 'update_plot'])->name('update_plot');
        Route::delete('/delete_plot/{id}', [categoryController::class, 'delete_plot'])->name('delete_plot');
        Route::get('/delete_sell_plot/{id}', [categoryController::class, 'delete_sell_plot'])->name('delete_sell_plot');

        Route::get('/edit_road/{id}', [roadController::class, 'edit_road'])->name('edit_road');
        Route::post('/update_road/{id}', [roadController::class, 'update_road'])->name('update_road');
    });



/*Road Route*/
Route::middleware('auth')->prefix('road')->name('road.')->group(function(){

    Route::get('/add', [roadController::class, 'add'])->name('add');
    Route::post('/store', [roadController::class, 'store'])->name('store');
    Route::get('/view', [roadController::class, 'view'])->name('view');
    Route::get('/delete/{product:slug}', [roadController::class, 'delete'])->name('delete');
    Route::get('/edit/{product:slug}', [roadController::class, 'edit'])->name('edit');
    Route::post('/update/{product:slug}', [roadController::class, 'update'])->name('update');
    Route::get('/status/{product:slug}',[roadController::class,'status'])->name('product.status');
    

});




/*plot Route*/ 
Route::middleware('auth')->prefix('plot')->name('plot.')->group(function(){

    Route::get('add',[plotController::class,'add'])->name('add');
    Route::post('store',[plotController::class,'store'])->name('store');

});



/*Search Route*/ 
Route::middleware('auth')->post('/search',[searchController::class,'search'])->name('search');
Route::middleware('auth')->get('/search_hide/{id}',[searchController::class,'search_hide'])->name('search_hide');
Route::middleware('auth')->post('/file_serch',[searchController::class,'file_serch'])->name('file_serch');



});