@extends('layouts.backendapp')


@section('content')

    <div class="row">
        <div class="col-lg-4">
           
            @if (isset($category))

            <div class="card">
               
                <div class="card-header"><h2>edit Category</h2></div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category) }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="text" value="{{ $category->title }}" name="title" class="form-control mt-2">
                        @error('title')
                           <span style="color:red;"> {{ $message }}</span>
                        @enderror
                        <input type="text" value="{{ $category->slug }}" name="slug" class="form-control mt-2 mb-2" >
                        <button name="submit" class="btn btn-primary">add-category</button>
                    </form>
                </div>
            </div>

            @else

            <div class="card">
                <div class="card-header"><h2>Add Category</h2></div>
        
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        @method('post')
                       <label for="">Title</label>
                        <input type="text"  name="title" class="form-control mt-2">
                        @error('title')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                        <input type="text"  name="slug" placeholder="slug" class="form-control mt-2 mb-2" >
                        <button name="submit" class="btn btn-primary">add-category</button>
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
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>

                   @forelse ($data as $key => $sdata)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $sdata->title }}</td>
                        <td>{{ $sdata->slug }}</td>
                        <td>
                            <div class="btn-group">

                                <a style="border-radius: 5px;" href="{{ route('category.edit', $sdata) }}" class="btn btn-primary btn-sm">edit</a>
                              
                              
                                <a style="border-radius: 5px;" href="#" class="btn btn-danger btn-sm deletebtn">delete</a>
                              
                              

                             <form action="{{ route('category.delete', $sdata) }}" method="POST">
                                @csrf
                                @method('delete')
                            
                            </form>
                
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



@push('customjs')

    <script>
            
        $('.deletebtn').click(function(){

            Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    
        $(this).next('form').submit();

  }
})
        });

    </script>
    
@endpush




