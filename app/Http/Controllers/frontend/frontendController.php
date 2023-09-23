<?php

namespace App\Http\Controllers\frontend;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class frontendController extends Controller
{
        public function index(){

            $products = product::where('status','=',0)->get();

            return view('frontend.index',compact('products'));
        }
}
