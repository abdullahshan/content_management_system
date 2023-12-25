<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\logo;
use App\Models\book;
use App\Models\customer;
use App\Models\mominee;
use App\Models\nomieenitoshair;
use App\Models\plot;
use App\Models\shair;
use Carbon\Carbon;
use GuzzleHttp\RetryMiddleware;

class applyController extends Controller
{
    public function apply($id)
    {

        $categories = category::with('roads')->where('status','=',1)->get();

      
        
        return view('backend.contact.newapply',['id'=>$id], compact('categories'));
    }




     /*booking from*/
     public function apply_store(Request $request,$id)
     {
 
      
        $customar = customer::find($id);
 
         $book = new book();
         $book->category_id = $request->block;
         $book->road_id = $request->road;
         $book->plot_num = $request->plot;
 
 
         $price = plot::where('category_id', $request->block)->where('road_id', $request->road)->where('plot_num', $request->plot)->first();
 
         $book->price = $price->plot_price;
         
         $book->status = '0';
         $book->type = 'hide';
 
         $book->save();

         $customar->book_id = $book->id;
         $customar->save();
 
         $id = $book->id;


         $book_info = book::select('category_id', 'road_id', 'plot_num')->where('id', $id)->first();



         $plot_info = plot::where('category_id', '=', $book_info->category_id)->where('road_id', '=', $book_info->road_id)->where('plot_num', '=', $book_info->plot_num)->first();
 
         // dd($plot_info);
 
         // dd($plot_info->status);
 
         $plot_info->status = '0';
 
         $plot_info->save();
 
         //  dd($plot_info->status);





         return redirect()->route('contact.customars');
     }


///////

    public function customer_form(){

        return view('backend.contact.customer_form');
}

public function customer_form_store(Request $request){

    
    $request->validate([
        
        'name' => 'required',
        'email' => 'required',
        'date' => 'required',
        
        'phone' => 'required|max:11',
        'father' => 'required',
        'mother' => 'required',
        'present_address' => 'required',
        'permanent_address' => 'required',
      
        'nid_no' => 'required|max:11',
        'nationality' => 'required',
        
    ]);


    $payment = new customer();

    
    $payment->applystatus = "0";
    $payment->book_id = "0";
    $payment->no_share = $request->share;
    $payment->name = $request->name;
    $payment->email = $request->email;
    $payment->rank = $request->rank;
    $payment->date_of_birth = $request->date;
    $payment->phone = $request->phone;
    $payment->nid_no = $request->nid_no;
    $payment->nationallity = $request->nationality;
    $payment->marriage = $request->marriage;
    $payment->phone_office = $request->phon_office;
    $payment->marriage_status = $request->marital_status;
    $payment->service = $request->service;

    $payment->father_name = $request->father;
    $payment->mother_name = $request->mother;
    $payment->presend_address = $request->present_address;
    $payment->permanent_address = $request->permanent_address;
    if($request->hasFile('ind_image')){
        $payment->nid_image = $this->ind_image($request);
    
        }
    if($request->hasFile('image')){
        $payment->image = $this->project_image($request);
        }

    $payment->save();

    // dd($payment->id);


    $file_no = customer::where('id', $payment->id)->first();

    $data =   'DC' . Carbon::parse($file_no->created_at)->format('Y-m') . '-' . $file_no->id;

    $file_no->file_no =  $data;
    $file_no->save();




    return  redirect()->route('contact.share',['id' => $file_no]);

     
}


//Upload image part//
private function project_image($request){

    if($request->hasFile('image')){
        $project_image = $request->file('image')->extension();

        $filename = uniqid(). '.' . $project_image;

        $image = $request->image->storeAs('upload/',$filename, 'public');

            return $image;
     }
}


//Upload image part//
private function ind_image($request){

    if($request->hasFile('ind_image')){
        $ind_image = $request->file('ind_image')->extension();

        $ind_file = uniqid()."ind_image" . '.' . $ind_image;

        $nid_image = $request->ind_image->storeAs('upload/',$ind_file, 'public');

            return $nid_image;
     }
}

public function nominee_form($id){
    
    
  
    $id = $id;
    
    $nomeni = mominee::with('customer')->where('customer_id','=',$id)->get();
    

    $customer = customer::where('id',$id)->first();

    $book_id = $customer->applystatus;

    return view('backend.contact.nominee',['id'=>$id],compact('book_id','nomeni'));
}

public function nomineetoshare_form($id){

    $id = $id;
    
    $nomeni = nomieenitoshair::with('shair')->where('customer_id','=',$id)->get();
    

    $customer = customer::where('id',$id)->first();

    $book_id = $customer->applystatus;

    $allshair = shair::where('customer_id','=',$id)->get();



    return view('backend.contact.nomieenitoshair',['id'=>$id],compact('allshair','book_id','nomeni'));
}


public function nominee_store(Request $request,$id){
    
    
        $request->validate([
            
            'phone' => 'required|max:11|min:11',
             'mobile' => 'required|max:11|min:11',
            
            ]);


        $nominee = new mominee();
        
        $nominee->customer_id = $id;
        $nominee->name = $request->name;
        $nominee->relation = $request->relation;
        $nominee->address = $request->address;
        $nominee->phone = $request->phone;
        $nominee->mobile = $request->mobile;
        $nominee->nid_no = $request->nid_no;
        if($request->hasFile('image')){
            $nominee->image = $this->project_image($request);

            }
        $nominee->save();


        return back();
}


public function nomineetoshare_store(Request $request, $id){

    $request->validate([
            
        'phone' => 'required|max:11',
         'mobile' => 'required|max:11|min:11',
        
        ]);


    $nominee = new nomieenitoshair();
    
    $nominee->customer_id = $id;
    $nominee->shair_id = $request->share_id;
    $nominee->name = $request->name;
    $nominee->relation = $request->relation;
    $nominee->address = $request->address;
    $nominee->phone = $request->phone;
    $nominee->mobile = $request->mobile;
    $nominee->nid_no = $request->nid_no;
    if($request->hasFile('image')){
        $nominee->image = $this->project_image($request);

        }
    $nominee->save();


    return back();

}

}
