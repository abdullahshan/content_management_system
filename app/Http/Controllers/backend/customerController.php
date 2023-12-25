<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
     public function customer_info_edit(Request $request, $id){

        $cus_id = $request->cus_id;

        $customer = customer::with('nomieenitoshair','book', 'shair', 'mominee')->where('id', $id)->first();


        return view('backend.contact.customer_info_edit',compact('customer'),['id'=>$cus_id]);

    }

    public function customer_delete(Request $request, $id){

        $data = customer::find($id);

        $cus_id = $request->cus_id;

        $data->delete();
        return redirect()->route('contact.customars',['id'=>$cus_id]);
    }
    
    
      public function customeredit_store(Request $request, $id)
    {

        $data = customer::find($id);


        $id = $request->id;
        $data->book_id = $data->book_id;
        $data->no_share = $request->share;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->date_of_birth = $request->date;
        $data->phone = $request->phone;
        $data->nid_no = $request->nid_no;
        $data->nationallity = $request->nationality;
        $data->marriage = $request->marriage;
        $data->phone_office = $request->phon_office;
        $data->marriage_status = $request->marital_status;
        $data->service = $request->service;
        $data->father_name = $request->father;
        $data->mother_name = $request->mother;
        $data->presend_address = $request->present_address;
        $data->permanent_address = $request->permanent_address;
        if ($request->hasFile('ind_image')) {
            $data->nid_image = $this->ind_image($request);
        }else{

            $data->nid_image = $data->nid_image;
        }
        if ($request->hasFile('image')) {
            $data->image = $this->project_image($request);
        }else{

            $data->image = $data->image;
        
        }

        $data->save();

        $customers_info = customer::with('book')->where('book_id', '!=', '0')->get();

               return redirect()->route('contact.customer_info_edit',['id'=> $id])->with('message','Customer Info Updated!');

    }
    
      //Upload image part//
    private function project_image($request)
    {

        if ($request->hasFile('image')) {
            $project_image = $request->file('image')->extension();

            $filename = uniqid() . '.' . $project_image;

            $image = $request->image->storeAs('upload/', $filename, 'public');

            return $image;
        }
    }


    //Upload image part//
    private function ind_image($request)
    {

        if ($request->hasFile('ind_image')) {
            $ind_image = $request->file('ind_image')->extension();

            $ind_file = uniqid() . "ind_image" . '.' . $ind_image;

            $nid_image = $request->ind_image->storeAs('upload/', $ind_file, 'public');

            return $nid_image;
        }
    }
}
