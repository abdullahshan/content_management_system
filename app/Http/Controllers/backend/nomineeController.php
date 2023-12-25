<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\mominee;
use App\Models\nomieenitoshair;
use Illuminate\Http\Request;

class nomineeController extends Controller
{
    public function nominee_edit(Request $request,$id){


       
        $cus_id = $request->cus_id;

        $nominee_data = mominee::find($id);

        return view('backend.contact.editnominee',compact('nominee_data','cus_id'));
    }



public function update_nominee(Request $request,$id){
    
    
            $request->validate([
                
                'phone' => 'required|max:11|min:11',
                 'mobile' => 'required|max:11|min:11',
                
                ]);
    
            $cus_id  = $request->cus_id;

    
            $nominee = mominee::find($id);
            
            $nominee->customer_id = $nominee->customer_id;
            $nominee->name = $request->name;
            $nominee->relation = $request->relation;
            $nominee->address = $request->address;
            $nominee->phone = $request->phone;
            $nominee->mobile = $request->mobile;
            $nominee->nid_no = $request->nid_no;
            if($request->hasFile('image')){
                $nominee->image = $this->project_image($request);
    
                }else{

                    $nominee->image = $nominee->image;
                }
            $nominee->save();
    
    
            return redirect()->route('contact.customer_info_edit',['id'=>$cus_id])->with('message','Customer Nominee Updated!');
    }

public function nominee_delete(Request $request,$id){

        $data = mominee::find($id);
        $data->delete();

        $cus_id = $request->cus_id;

    return redirect()->route('contact.customer_info_edit',['id'=>$cus_id]);
}


public function share_nominee_edit(Request $request, $id){


        $data = nomieenitoshair::find($id);
        $cus_id = $request->cus_id;


        return view('backend.contact.editnomineetoshare',compact('data','cus_id'));
}

public function share_nominee_delete(Request $request, $id){

    $data = nomieenitoshair::find($id);

    $cus_id = $request->cus_id;

    $data->delete();

    return redirect()->route('contact.customer_info_edit',['id'=> $cus_id]);
}




public function share_nominee_update(Request $request, $id){

    $request->validate([
            
        'phone' => 'required|max:11',
         'mobile' => 'required|max:11|min:11',
        
        ]);

        $cus_id = $request->cus_id;


    $nominee = nomieenitoshair::find($id);

    $nominee->customer_id = $nominee->customer_id;
    $nominee->shair_id = $nominee->shair_id;
    $nominee->name = $request->name;
    $nominee->relation = $request->relation;
    $nominee->address = $request->address;
    $nominee->phone = $request->phone;
    $nominee->mobile = $request->mobile;
    $nominee->nid_no = $request->nid_no;
    if($request->hasFile('image')){
        $nominee->image = $this->project_image($request);

        }else{

            $nominee->image = $nominee->image;

        }
    $nominee->save();


    return redirect()->route('contact.customer_info_edit',['id'=> $cus_id])->with('message','Share Nominee Info Updated!');
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
}
