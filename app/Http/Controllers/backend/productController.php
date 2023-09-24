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

        $request->validate([
            'title' => 'required|max:225|string',
            'categories' => 'required',
            'content' => 'required|max:1000',
            'hastag' => 'required|max:50',
        ], [
            'title.required' => 'please enter your category title',
            'categories.required' => 'please enter your categories',
            'content.required' => 'please enter your category content',
            'hastag.required' => 'please enter your category hastag',
        ]
        );

         
            $data = new product();
            $data->title = $request->title;
            $data->slug = $this->genarateslug($request->title, $request->slug);
            $data->user_id = Auth::user()->id;

            if($request->hasFile('image')){
            $data->image = $this->project_image($request);
            }

            $data->content = $request->content;
            $data->save();

            $categories = $request->categories;
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

        if(Auth::user()->type == "user"){
            $products = product::where('user_id','=', $id)->where('status','=','1')->paginate(5);
        }else{
            $products = product::orderBy('id','DESC')->paginate(5);
        }

        return view('backend.product.view',compact('products'));
    }


/*Delete Category*/ 
    public function delete(product $product){

        $data = $product;
        $data->delete();

        return redirect()->route('product.view');
}


/*Product Edit*/ 
    public function edit(product $product){

        $id = $product->id;

        $product = product::find($id);

        $categories = category::all();

        return view('backend.product.edit',compact('product','categories'));

    }


/*Update Product*/ 
    public function update(Request $request, product $product){

        $request->validate([
            'title' => 'required|max:225|string',
            'content' => 'required|max:1000',
        ], [
            'title.required' => 'please enter your category title',
            'content.required' => 'please enter your category content',
        ]
        );

         
            $product = $product;
            
            $product->title = $request->title;
            $product->slug = $this->genarateslug($request->title, $request->slug);
            $product->user_id = Auth::user()->id;

            if($request->hasFile('image')){
            $product->image = $this->project_image($request);
            }

            $product->content = $request->content;
            $product->save();

            $categories = $request->categories;
            $product->categories()->attach($categories);

            if($request->hastag){

                $tag = str($request->hastag)->explode(',');
                foreach ($tag as $tags){
                  $mytag = Tag::findOrCreate(['name' => trim($tags)]);
                  $product->attachTag($mytag);
                }
              }

              return redirect()->route('product.view');
    }


//Upload image part//
     private function project_image($request){

        if($request->hasFile('image')){
            $project_image = $request->file('image')->extension();
    
            $filename = uniqid()."product_image" . '.' . $project_image;
    
            $image = $request->image->storeAs('upload',$filename, 'public');
    
                return $image;
         }
    }


/*Product Stutas*/ 
    public function status(product $product){

        $slug = $product->slug;

        $product = product::where('slug', '=', $slug)->first();

        $status = $product->status;

        if($status == '0'){
            $product->status = '1';

        }elseif($product->status == '1'){
           $product->status = '0';
        }

        $product->save();
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
