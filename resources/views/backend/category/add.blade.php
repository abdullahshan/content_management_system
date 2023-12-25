@extends('layouts.backendapp')

  
@section('content')


    <div class="row">
        <div class="col-lg-4">
           
            @if (isset($category))

            <div class="card">
               
                <div class="card-header">
                <h2 style="font-size: 20px;"><b>Edit Category</b></h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <input type="text" value="{{ $category->title }}" name="title" class="form-control mt-2">
                        @error('title')
                           <span style="color:red;"> {{ $message }}</span>
                        @enderror

                        <input type="text" value="{{ $category->slug }}" name="slug" class="form-control mt-2">
                        @error('title')
                           <span style="color:red;"> {{ $message }}</span>
                        @enderror

                        <input type="file" class="form-control mt-2 mb-2" name="image" >
                        <button name="submit" class="btn btn-primary">add-category</button>
                    </form>
                </div>
            </div>

            @else

            <div class="card">
                @if (Session::has('message'))
                <span class="d-flex justify-content-center" style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
                @endif
                <div class="card-header">
                <h2 style="font-size: 20px;"><b>Add Block</b></h2>
                </div>
        
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                       <label for="">Title</label>
                        <input type="text"  name="title" class="form-control mt-2">
                        @error('title')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror


                     <div class="mb-3">
                        <label for="file" class="form-label"><b>Image</b></label>
                        <input type="file" name="image" class="form-control">
                    </div>
                 
                    @error('image')
                    <span style="color:red;"> {{ $message }}</span>
                @enderror
                <br>

                        <button name="submit" class="btn btn-primary mt-2">Add Block</button>
                    </form>
                </div>
             
            </div>
            @endif

        </div>
    
        <div class="col-lg-8">
            <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Category title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                   @forelse ($data as $key => $sdata)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $sdata->title }}</td>
                        <td>
                            <img style="max-height: 100px;" src="{{asset('storage/'.$sdata->image)}}" alt="image">
                        </td>

                            @if ($sdata->status == 1)
                            <td>
                               <span class="btn btn-success btn-sm"> {{ "active" }}</span>
                             </td>
                            @else
                               <td>
                               <span class="btn btn-danger btn-sm"> {{ "De-active" }}</span>
                            </td>
                            @endif
                            
                            <td>
             
                            <div class="btn-group">

                                <a style="border-radius: 5px;" href="{{ route('category.edit', $sdata) }}" class="btn btn-primary btn-sm">edit</a>
                              

                                <a style="border-radius: 5px;margin-left:2px;" href="{{ route('category.get_road', $sdata->id) }}" class="btn btn-primary btn-sm">View</a>

                              
                                <a style="border-radius: 5px;margin-left:2px;" href="{{ route('category.status',$sdata)}}">

                                    @if ($sdata->status == 1)
                                       <span class="{{ $sdata->status == 1? "btn btn-danger":" " }}"> {{ "De-active" }}</span>
                                    @else
                                   <span class="{{ $sdata->status == 0? "btn btn-success":" " }}"> {{ "Active" }}</span>
                                    @endif

                                </a>
                
                          
                            </div>
                        </td>
                    </tr>
                   @empty
                       <tr>
                        <td colspan="4" style="color:red; font-size:30px;">Data not found!</td>
                       </tr>
                   @endforelse
            </table>
        </div>
    </div>

@endsection











