
@extends('layouts.backendapp')

@section('content')
    

  <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('post')

            <div class="mb-3">
                <label for="name" class="form-label">Title</label>
                    <input type="text" value="{{ $product->title }}" name="title" class="form-control">
            @error('title')
            <span style="color:red;"> {{ $message }}</span>
                @enderror
            </div>

            <h4 style="font-size: 25px;">Choise category</h4>

            <br>
         @foreach ($categories as $category)
            <input type="checkbox" value="{{ $category->id }}" name="categories[]">
            <label for="cat{{ $category->id }}">{{ $category->title }}</label>
        @endforeach
             <br>
        @error('categories')
            <span style="color:red;"> {{ $message }}</span>
        @enderror

        <div style="margin: 10px 0px;">
            <label for="content" class="form-label">Write content</label>
            <textarea name="content" id="editor" class="form-control" style="max-height: 50px;">
                {{ $product->content }}
            </textarea>
            @error('content')
            <span style="color:red;"> {{ $message }}</span>
        @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            @error('image')
            <span style="color:red;"> {{ $message }}</span>
        @enderror

            <div class="mb-3">
                <label for="tag" class="form-label">Tags</label>
                <input type="text" placeholder="hash tags" name="hastag" class="form-control">
            </div>
            @error('hastag')
            <span style="color:red;"> {{ $message }}</span>
        @enderror

   <br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>



  @push('customjs')

  <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
    
@endpush


@endsection
