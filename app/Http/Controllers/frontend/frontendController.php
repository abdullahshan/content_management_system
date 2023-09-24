<?php

namespace App\Http\Controllers\frontend;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class frontendController extends Controller
{
        public function index(){

            $products = product::where('status','=',1)->orderBy('id','DESC')->paginate(4);

            return view('frontend.index',compact('products'));
        }

/*Product View*/ 
    public function view(product $product){

        $id = $product->id;
        $product = product::find($id);

        return view('frontend.view', compact('product'));
    }
}
