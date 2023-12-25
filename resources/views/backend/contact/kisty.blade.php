@extends('layouts.backendapp')

@section('content')

<div class="container">
 <div class="row justify-content-center">
    <div class="col-lg-8 mt-2">
        <div class="card border rounded shadow">
            <div class="card-header">
                <h1 style="font-size:20px;"> {{ $data->description }} Amount Total = @if ($data->due != null)
                    {{ $data->amount - $data->due }}
                @else
                {{ $data->amount }}
                @endif </h1> 
            </div>
            <div class="card-body">
    
                <form action="{{ route('contact.kisty_update',$id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    
                    <label for="" class="form-label">Pay Amount</label>
                    <input type="text" value="{{old('due')}}" name="due" class="form-control">
                    
                    
                    <label for="" class="form-label">Cash/check No:</label>
                    <input required type="text" value="{{old('cheque_no')}}" name="cheque_no" class="form-control"> 
                    <label for="" class="form-label">Bank Name</label>
                    <input type="text" value="{{old('bank')}}" name="bank" class="form-control">
                     <label for="bank">Branch</label>
                    <input value="{{old('brance')}}" type="text" name="brance" class="form-control">
                    <input type="text" hidden value="{{ $cus_id }}" name="cus_id">
                    <label for="" class="form-label">Cheque Date</label>
                    <input required type="date" value="{{old('cheque_date')}}" name="cheque_date" class="form-control">
                    <label for="" class="form-label">Received Date</label>
                    <input required type="date" value="{{old('recieved_date')}}" name="recieved_date" class="form-control">
                   
                  
                   <br>
                   <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
 </div>
</div>

@endsection