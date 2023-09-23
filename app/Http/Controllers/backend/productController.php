<?php

namespace App\Http\Controllers\backend;

use Spatie\Tags\Tag;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    public function add(){

        $categories = category::all();

        return view('backend.product.add',compact('categories'));

    }

    
/*Product Store*/
    public function store(Request $request){


            $categories = $request->categories;

            $data = new product();
            $data->title = $request->title;
            $data->slug = $this->genarateslug($request->title, $request->slug);
            $data->user_id = Auth::user()->id;

            if($request->hasFile('image')){
                $data->image = $this->project_image($request);
            }
            $data->content = $request->content;
            $data->save();
            $data->categories()->attach($categories);

            if($request->hastag){

                $tag = str($request->hastag)->explode(',');
                foreach ($tag as $tags){
                  $mytag = Tag::findOrCreate(['name' => trim($tags)]);
                  $data->attachTag($mytag);
                }
              }
              return redirect()->route('product.add');
    }


/*View Product*/ 
    public function view(){

        $id = Auth::user()->id;

        if(Auth::user()->type = "user"){
            $products = product::where('user_id','=', $id)->where('status','=',1)->get();
        }else{
            $products = product::all();
        }


        return view('backend.product.view',compact('products'));
    }


     //post insert image part//

     private function project_image($request){

        if($request->hasFile('image')){
            $project_image = $request->file('image')->extension();
    
            $filename =  "product_image" . '.' . $project_image;
    
         $image =   $request->image->storeAs('upload/',$filename, 'public');
    
                return $image;
         }
    }

/*Delete Category*/ 
    public function delete(product $product){

            $data = $product;
            $data->delete();

            return redirect()->route('product.view');
    }



/*for slug*/
    private function genarateslug($title,$slug){

        if($slug == null){
            $slug = $title;
        }else{
            $slug = $slug;
        }
        $count = product::where('slug', 'LIKE', '%' .  $slug . '%')->count();

        if($count > 0){

            $unique_slug = $slug . '-' . $count++;
            return $unique_slug;
        }else{
            return $slug;
        }
}

}
