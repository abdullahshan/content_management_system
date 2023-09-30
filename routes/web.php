<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\plotController;
use App\Http\Controllers\backend\roadController;
use App\Http\Controllers\frontend\frontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::post('/road',[frontendController::class,'getroad'])->name('getroad');
Route::post('/getroad',[plotController::class,'getroad'])->name('getroad');
Route::post('/plot_view',[plotController::class,'plot_view'])->name('plot_view');
Route::post('/plot_info',[plotController::class,'plot_info'])->name('plot_info');
Route::post('/block_image',[plotController::class,'block_image'])->name('block_image');
Route::post('/book',[frontendController::class,'book'])->name('book');
Route::get('/book_info',[frontendController::class,'book_info'])->name('book_info');
Route::post('/book_info_second/{id}',[frontendController::class,'book_info_second'])->name('book_info_second');



Auth::routes();


Route::get('/deshboard', [backendController::class, 'index'])->name('deshboard');
Route::post('/getblock',[frontendController::class,'getroad'])->name('getroad');



/*Category Management*/ 
    Route::prefix('category')->name('category.')->group(function(){

        Route::get('/add', [categoryController::class, 'add'])->name('add');
        Route::post('/store', [categoryController::class, 'store'])->name('store');
        Route::delete('/delete/{category:slug}', [categoryController::class, 'delete'])->name('delete');
        Route::get('/edit/{category:slug}', [categoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category:slug}', [categoryController::class, 'update'])->name('update');
    
    });



/*Product Management*/
Route::prefix('road')->name('road.')->group(function(){

    Route::get('/add', [roadController::class, 'add'])->name('add');
    Route::post('/store', [roadController::class, 'store'])->name('store');
    Route::get('/view', [roadController::class, 'view'])->name('view');
    Route::get('/delete/{product:slug}', [roadController::class, 'delete'])->name('delete');
    Route::get('/edit/{product:slug}', [roadController::class, 'edit'])->name('edit');
    Route::post('/update/{product:slug}', [roadController::class, 'update'])->name('update');
    Route::get('/status/{product:slug}',[roadController::class,'status'])->name('product.status');
    

});




/*plot Route*/ 
Route::prefix('plot')->name('plot.')->group(function(){

    Route::get('add',[plotController::class,'add'])->name('add');
    Route::post('store',[plotController::class,'store'])->name('store');

});

