<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\plot;
use App\Models\road;
use PhpParser\Node\Expr\FuncCall;

class categoryController extends Controller
{

/*Category add*/
    public function add(){

        $data = category::all();

        return view('backend.category.add',compact('data'));
    }


/*category status*/ 

public function status(category $category){

        $data = $category;

        if ($data->status == '1') {

            $data->status = '0';

        } elseif($data->status == '0'){
            
            $data->status = '1';
        }

        $data->save();

        return back();
        
}   


/*Category Store*/
    public function store(Request $request){

        $request->validate([
            'title' => 'required|max:225|unique:categories',
            'image' => 'required',
        ], [
            'title.required' => 'please enter your category title',
            'image.required' => 'please upload image',
        ]
        );

    $data = new category();

    $data->title = $request->title;
    $data->slug  = $this->genarateslug($request->title, $request->slug);
    
    if($request->hasFile('image')){
        $data->image = $this->project_image($request);
        }

    
    $data->save();

    return redirect()->route('category.add')->with('message','Block Successfully Aded!');

}


/*Category Delete*/
    public function delete(category $category){

       $data = $category;
       $data->delete();
     
       return redirect()->route('category.add');
}


/*Category Edit*/
    public function edit(Request $request,category $category){

        $category = $category;

        $data = category::all();

        return view('backend.category.add',compact('category','data'));
    }

/*Category Update*/
    public function update(Request $request, category $category){

        $data = $category;
        $data->title = $request->title;
        $data->slug = $this->genarateslug($request->title, $request->slug);
        $data->save();

        return redirect()->route('category.add')->with("success","update successfully done!");


    }

/*Block road view*/ 
public function get_road($id){


        $roads = road::where('category_id',$id)->get();
        return view('backend.category.view_road',compact('roads'));
}

public function delete_plot($id){

    $data = plot::find($id);

    $data->delete();
    return back();
}


public function delete_sell_plot($id){

    $data = plot::find($id);

    $data->delete();
    return back();
}


public function delete_road($id){


    $data = road::find($id);

    $data->delete();

    return back();
}

/*get plot_with raod*/ 
public function get_plot($id){

        $road = road::with('category')->first();

       $plots = plot::where('category_id',$road->category->id)->where('road_id',$id)->where('status',0)->get();
    
       return view('backend.category.plot_view', compact('plots'),['id'=>$id]);
    }
/*Avilable plot*/ 
public function avilabele_plot($id){

    $road = road::with('category')->first();

    $avilable_plots = plot::where('category_id',$road->category->id)->where('road_id',$id)->where('status',1)->get();
 

    return view('backend.category.plot_view',compact('avilable_plots'),['id'=>$id]);
}


private function genarateslug($title,$slug){

        if($slug == null){
            $slug = $title;
        }else{
            $slug = $slug;
        }
        $count = category::where('slug', 'LIKE', '%' .  $slug . '%')->count();

        if($count > 0){

            $unique_slug = $slug . '-' . $count++;
            return $unique_slug;
        }else{
            return $slug;
        }
}



//Upload image part//
private function project_image($request){

    if($request->hasFile('image')){
        $project_image = $request->file('image')->extension();

        $filename = uniqid()."product_image" . '.' . $project_image;

        $image = $request->image->storeAs('upload/',$filename, 'public');

            return $image;
     }
}


 }
