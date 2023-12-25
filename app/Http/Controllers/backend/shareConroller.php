<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\shair;
use Illuminate\Http\Request;

class shareConroller extends Controller
{
    public function share_edite(Request $request, $id){

        $data = shair::find($id);

        $cus_id = $request->cus_id;


        return view('backend.contact.editshare',compact('data','cus_id'));
    }

    
     /*Share_Update store*/
     public function share_update(Request $request, $id)
     {
        


         $request->validate([
             
             'phone' => 'required|max:11|min:11',
             'nid_num' => 'required|max:11',
             
                 ]);

        $cus_id = $request->cus_id;
 
     
        $shair = shair::find($id);
    
         $shair->customer_id =  $shair->customer_id;
         $shair->name = $request->name;
         if ($request->hasFile('shair_image')) {
             $shair->nid_image = $this->shair_image($request);
         }else{

            $shair->nid_image = $shair->nid_image;
         }
         $shair->phone = $request->phone;
         $shair->nid_number = $request->nid_num;
         $shair->address = $request->address;
         $shair->permanent_address = $request->permanent_address;
         $shair->email = $request->email;
         $shair->father = $request->father;
         $shair->mother = $request->mother;
         $shair->service = $request->service;
         $shair->nationality = $request->nationality;
         $shair->barth_date = $request->barth_date;
         $shair->marriage_date = $request->marriage_date;
         $shair->marriage_status = $request->marriage_status;
         $shair->rank = $request->rank;
         
         $shair->save();

         return redirect()->route('contact.customer_info_edit',['id'=> $cus_id])->with('message','Share Info Updated!');
     }



    public function share_delete(Request $request,$id){

        $data = shair::find($id);
        $data->delete();

        $cus_id = $request->cus_id;
        return redirect()->route('contact.customer_info_edit',['id'=> $cus_id]);
    }


      //Upload image part//
    private function shair_image($request)
    {

        if ($request->hasFile('shair_image')) {
            $project_image = $request->file('shair_image')->extension();

            $filename = uniqid() . "shair_image" . '.' . $project_image;

            $image = $request->shair_image->storeAs('upload/', $filename, 'public');

            return $image;
        }
    }




}
