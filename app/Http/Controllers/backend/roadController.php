<?php

namespace App\Http\Controllers\backend;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\road;

class roadController extends Controller
{
    public function add(){

            $categories = category::all();

            return view('backend.road.add',compact('categories'));
    }


 public function store(Request $request){

            $vilidator = $request->validate([
                'category_id' => 'required|integer',
                'road_num'    => 'required|integer',
            ],[

                'road_num.required' => 'This field is requred!',
                'road_num.integer' => 'This is not a integer value!',
            ]); 

            $data = new road();
            $data->category_id = $request->category_id;
            $data->road_num = $request->road_num;
            $data->save();


        return redirect()->route('road.add')->with('message','Road Successfully Aded!');
          
    }
    
    
    public function edit_road($id){

        $data  = road::find($id);

        $categories = category::all();

        return view('backend.road.add',compact('data','categories'),['id'=>$id]);


    }

    

    

 public function update_road(Request $request, $id){


    $data = road::find($id);
    
    $road_id = $request->road_id;

    $data->category_id = $request->category_id;
    $data->road_num = $request->road_num;
    $data->save();


return redirect()->route('category.get_road',['id'=>$road_id])->with('message','Road Successfully Updated!');
  
}

}
