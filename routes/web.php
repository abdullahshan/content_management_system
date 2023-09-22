<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\productController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/deshboard', [backendController::class, 'index'])->name('deshboard');



/*Product Management*/

Route::prefix('product')->name('product.')->group(function(){

    Route::get('/add', [productController::class, 'add'])->name('add');
});

/*Category Management*/ 
Route::prefix('category')->name('category.')->group(function(){

    Route::get('/add', [categoryController::class, 'add'])->name('add');
    Route::post('/store', [categoryController::class, 'store'])->name('store');
    Route::delete('/delete/{category:slug}', [categoryController::class, 'delete'])->name('delete');


});
