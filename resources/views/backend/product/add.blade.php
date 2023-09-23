@extends('layouts.backendapp')

@section('content')

@push('customcss')
<style>
    #datepicker{
        
        position: absolute;
}
</style>
@endpush


<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    

<script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>
   
  <p> <input type="text" id="datepicker"></p>
   



@endsection