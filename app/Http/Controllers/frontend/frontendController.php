<?php

namespace App\Http\Controllers\frontend;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\category;
use App\Models\road;

use function Laravel\Prompts\alert;

class frontendController extends Controller
{
        public function index(){

            $categories = category::with('roads')->get();
            $roads = road::with('plots')->get();

            return view('frontend.index',compact('categories','roads'));
        }

/*Product View*/ 
    public function view(product $product){

        $id = $product->id;
        $product = product::find($id);

        return view('frontend.view', compact('product'));
    }


/*Ajax for road*/ 
public function getroad(Request $request){

        $data = $request->data;

        $roads = road::where('category_id',$data)->get();
        

        $html = '<option value="">Select Road</option>';
        foreach($roads as $road){

            $html.='<option value="'.$road->road_num.'">'.$road->road_num.'</option>';
        }

        echo $html;
       
}

/*booking from*/ 
public function book(Request $request){


        $book = new book();
        $book->block = $request->block;
        $book->road = $request->road;
        $book->plot_num = $request->plot;
        $book->save();

        $book_id = $book->id;
        return redirect()->route('book_info', ['id' => $book_id]);
}


/*Book Information*/ 
public function book_info(){


        return view('frontend.booinfo');
}


/*Book Information Second time*/ 
public function book_info_second($id,Request $request){


    $booinfo = book::where('id',$id)->first();

    $booinfo->name = $request->name;
    $booinfo->phone = $request->phone;
    $booinfo->email = $request->email;
    $booinfo->address = $request->address;
    $booinfo->message = $request->message;

    $booinfo->save();


    return redirect()->route('frontend');
}


}
