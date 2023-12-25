<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\customer;
use App\Models\plot;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request){

        $search = $request->name;
        $booking_trash = book::with('category','road')->onlyTrashed()->get();
        $getbooking_info = book::select('category_id', 'road_id', 'plot_num', 'id', 'phone', 'name', 'email', 'status', 'type')->with('category','road')->where('type', 'show')->get();
      
        $result = book::where('id',$search)->orWhere('phone', $search)->with('category')->first();

        if($result){


            return view('backend.contact.Search',compact('getbooking_info','booking_trash','result'));

        }else{

            return back();
        }


      }



      public function search_hide($id)
      {
  
          $type = book::where('id', $id)->first();
  
          $type->type = 'hide';
          $type->save();
  
            return redirect()->route('getbooking_info');
      }



    public function file_serch(Request $request){

        $data = $request->name;

        $serfile = customer::where('file_no',$data)->orWhere('phone',$data)->first();
        $customers_info = customer::with('book')->get();
if($serfile){
    
    return view('backend.contact.filesearch',compact('customers_info','serfile'));


}else{

    return back();
}
    }
   }

    