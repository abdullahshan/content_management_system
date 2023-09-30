<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\plot;
use App\Models\road;
use Illuminate\Http\Request;

class plotController extends Controller
{
    public function add()
    {

        $getblocks = category::all();

        return view('backend.plot.add', compact('getblocks'));
    }



    /*Get plot for frontend with ajax*/
    public function getroad(Request $request)
    {

        $plot_id = $request->data;

        $plots = plot::where('road_id', $plot_id)->get();


        $html = '<option value="">Select </option>';
        foreach($plots as $road){

            $html.='<option value="'.$road->plot_num.'">'.$road->plot_num.'</option>';
        }

        echo $html;
    }




    /*Get plot for frontend with ajax*/
    public function plot_view(Request $request)
    {
        
        $plot_id = $request->data;

        $plots = plot::where('road_id', $plot_id)->get();


        $html = '<option value=""></option>';
        foreach($plots as $road){

            $html.='<option value="'.$road->plot_num.'">'.$road->plot_num.','.'</option>';
        }

        echo $html;
    }


     /*Get plot for frontend with ajax*/
     public function plot_info(Request $request)
     {
         
         $plot_info = $request->data;
 
         $plots = plot::where('plot_num', $plot_info)->first();

        
         return response()->json([

                'status'  => 200,
                'plot_info' =>  $plots,
         ]);
       
     }




 /*Get plot for frontend with ajax*/
    public function block_image(Request $request)
          {
    
         $image_id = $request->data;
      
              $plots = category::where('id', $image_id)->first();
     
             
              return response()->json([
     
                     'status'  => 200,
                     'block_info' =>  $plots,
              ]);
            
          }
 



    /*Plot Information store*/
    public function store(Request $request)
    {

        $request->validate([]);



        $plot = new plot();


        $plot->category_id = $request->block;
        $plot->road_id = $request->road;
        $plot->plot_num = $request->plot_num;
        $plot->plot_size = $request->plot_size;
        $plot->plot_type = $request->plot_type;
        $plot->plot_price = $request->plot_price * $request->plot_size;

        $plot->save();

        return back();
    }
}
