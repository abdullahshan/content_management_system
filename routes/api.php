<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\productController;
use App\Http\Controllers\api\v1\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('registar/',[RegisterController::class,'registar'])->name('registar');
Route::post('login/', [RegisterController::class, 'loginUser']);
Route::get('logout/',[RegisterController::class,'logout'])->name('logout');



Route::get('product{id?}',[productController::class,'products'])->name('product.view');

Route::middleware('auth:sanctum')->group( function () {
    
    Route::post('product/store',[productController::class,'product_store'])->name('product.store');
});




