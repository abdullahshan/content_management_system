@extends('layouts.backendapp')

@section('content')


<style>
    #datepicker{
        
        position: absolute;
}
</style>



<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    

<script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>
   
  <p> <input type="text" id="datepicker"></p>
   <br>

  <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')
    <div class="mb-3">
      <label for="name" class="form-label">Title</label>
      <input type="text" name="title" class="form-control">
    </div>
    <h4 style="font-size: 25px;">Choise category</h4>
    <br>
        @foreach ($categories as $category)
       
        <input type="checkbox" value="{{ $category->id }}" name="categories[]">
        <label for="cat{{ $category->id }}">{{ $category->title }}</label>

        @endforeach

    <div style="margin: 10px 0px;">
        <label for="content" class="form-label">Write content</label>
        <textarea name="content" id="editor" class="form-control" style="height: 50px;">
        </textarea>
         </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
      </div>
      <div class="mb-3">
        <label for="tag" class="form-label">Tags</label>
        <input type="text" placeholder="hash tags" name="hastag" class="form-control">
      </div>
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