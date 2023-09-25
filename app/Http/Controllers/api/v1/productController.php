<?php

namespace App\Http\Controllers\api\v1;

use Spatie\Tags\Tag;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{

/*Product view*/
    public function products($id = null){


        if($id){
            
            $posts = product::where('id',$id)->get();

        }else{

            $posts = product::get();
        }
      

       return response($posts);
    }


/*Product Stor*/ 
    public function product_store(Request $request){

        $categories = $request->categories;

        $data = new product();
        $data->title = $request->title;
        $data->slug = $this->genarateslug($request->title, $request->slug);
        $data->user_id = Auth::user()->id;

        if($request->hasFile('image')){
            $data->image = $this->project_image($request);
        }
        $data->content = $request->content;
        $data->date = $request->date;
        $data->save();
        $data->categories()->attach($categories);

        if($request->hastag){

            $tag = str($request->hastag)->explode(',');
            foreach ($tag as $tags){
              $mytag = Tag::findOrCreate(['name' => trim($tags)]);
              $data->attachTag($mytag);
            }
          }


    return response()->json([
            
        'product' => $data,
    ]);
          
        
}


private function project_image($request){

    if($request->hasFile('image')){
        $project_image = $request->file('image')->extension();

        $filename =  "product_image" . '.' . $project_image;

     $image =   $request->image->storeAs('upload/',$filename, 'public');

            return $image;
     }
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


  

