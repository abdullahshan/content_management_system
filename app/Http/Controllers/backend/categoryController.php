<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class categoryController extends Controller
{

/*Category add*/
    public function add(){

        $data = category::all();

        return view('backend.category.add',compact('data'));
    }


/*Category Store*/
    public function store(Request $request){

        $request->validate([
            'title' => 'required|max:225|string',
        ], [
            'title.required' => 'please enter your category title',
        ]
        );

    $data = new category();

    $data->title = $request->title;
    $data->slug  = $this->genarateslug($request->title, $request->slug);

    $data->save();

    return back();

}


/*Category Delete*/
    public function delete(category $category){

       $data = $category;
       $data->delete();
       return back();
}


/*Category Edit*/
    public function edit(category $category){

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
 }
