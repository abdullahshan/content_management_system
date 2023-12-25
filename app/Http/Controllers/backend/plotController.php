<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\plot;
use App\Models\road;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

use function Symfony\Component\String\b;

class plotController extends Controller
{
    public function add()
    {

        $getblocks = category::all();

        return view('backend.plot.add', compact('getblocks'));
    }


    

    /*Get plot for frontend with ajax*/
    public function get_plot(Request $request)
    {

        $plot_id = $request->data;

        $block_id = road::with('category')->where('id',$plot_id)->first();

        $plots = plot::where('category_id',$block_id->category->id)->where('road_id', $plot_id)->where('status','=',1)->get();


        $html = '<option value="">Select</option>';
        foreach($plots as $road){

            $html.='<option value="'.$road->plot_num.'">'.$road->plot_num.'</option>';
        }

        echo $html;
    }




    /*Get plot for frontend with ajax*/
    public function plot_view(Request $request)
    {
        
        $plot_id = $request->data;

        $block_id = road::with('category')->where('id',$plot_id)->first();

        $plots = plot::where('category_id',$block_id->category->id)->where('road_id',$plot_id)->where('status','=',1)->get();

       $count = count($plots);

        $html = '<option value=""></option>';

        foreach($plots as $road){

            $html.='<option value="'.$road->id.'">'.$road->plot_num.','.' '.'</option>';
        }

        echo "<b>Available Plots :</b> ($count) = " .$html;
      
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
        
        $request->validate([
            
            'block' => 'required',
            'road' => 'required',
            'plot_num' => 'required',
            'plot_size' => 'required',
            'facing' => 'required',
            'plot_type' => 'required',
            'plot_price' => 'required',

                ]);

        $plot = new plot();


        $plot->category_id = $request->block;
        $plot->road_id = $request->road;
        $plot->plot_num = $request->plot_num;
        $plot->plot_size = $request->plot_size;
        $plot->plot_type = $request->plot_type;
        $plot->per_plot_price = $request->plot_price;
        $plot->facing = $request->facing;
        $plot->plot_price = $request->plot_price * $request->plot_size;

        $plot->save();

        return redirect()->route('plot.add')->with('message','Plot Successfully Aded!');
    }




    public function edit_plot(Request $request,$id)
    {

        $getblocks = category::all();

        $data = plot::find($id);

        $road_id = $request->road_id;

        return view('backend.plot.add', compact('getblocks','data','road_id'));
    }



     /*Plot Information store*/
     public function update_plot(Request $request, $id)
     {
         
         $request->validate([
             
             'block' => 'required',
             'road' => 'required',
             'plot_num' => 'required',
             'plot_size' => 'required',
             'facing' => 'required',
             'plot_type' => 'required',
             'plot_price' => 'required',
 
                 ]);

        $road_id = $request->road_id;
 
         $plot = plot::find($id);

 
         $plot->category_id = $request->block;
         $plot->road_id = $request->road;
         $plot->plot_num = $request->plot_num;
         $plot->plot_size = $request->plot_size;
         $plot->plot_type = $request->plot_type;
         $plot->per_plot_price = $request->plot_price;
         $plot->facing = $request->facing;
         $plot->plot_price = $request->plot_price * $request->plot_size;
 
         $plot->save();
 
         return redirect()->route('category.avilabele_plot',['id'=>$road_id])->with('message','Plot Successfully Updated!');
     }


     
}
