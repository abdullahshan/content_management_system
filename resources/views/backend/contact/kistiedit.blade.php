@extends('layouts.backendapp')

@section('content')

<div class="container">
 <div class="row justify-content-center">
    <div class="col-lg-8 mt-2">
        <div class="card border rounded shadow">
            <div class="card-header">
                <h1 style="font-size:20px;">Edit {{ $data->description }} Total ={{ $data->amount}} </h1>
            </div>
            <div class="card-body">

                {{--  {{ route('contact.kisty_update',$id) }}  --}}
    
                <form action="{{ route('contact.edit_kisty_store', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    
                    <label for="" class="form-label">Pay Amount</label>
                    <input type="number" value="{{ $data->due }}" name="due" class="form-control">
                    
                    
                    <label for="" class="form-label">Cash/check No:</label>
                    <input required type="text" value="{{ $data->cheque_ba_cash }}" name="cheque_no" class="form-control"> 
                    <label for="" class="form-label">Bank Name</label>
                    <input type="text" value="{{ $data->bank }}" name="bank" class="form-control">
                     <label for="bank">Branch</label>
                    <input value="{{ $data->brance }}" type="text" name="brance" class="form-control">
                    <input type="text" hidden value="{{ $cus_id }}" name="cus_id">
                    <label for="" class="form-label">Cheque Date</label>
                    <input required type="date" value="{{ $data->cheque_date }}" name="cheque_date" class="form-control">
                    <label for="" class="form-label">Received Date</label>
                    <input required type="date" value="{{ $data->receive_data }}" name="recieved_date" class="form-control">
                   
                  
                   <br>
                   <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
 </div>
</div>

@endsection