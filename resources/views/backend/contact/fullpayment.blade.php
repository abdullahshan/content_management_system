@extends('layouts.backendapp')


@section('content')

{{--  {{ $endmoney }}  --}}

<div class="container">
    <div class="row justify-content-center">

      <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h1 style="font-size:20px;">Total Amount : {{ $total_price }} <a class="btn btn-primary" href="{{ route('contact.customer_payment', $id) }}">With Installment</a> </h1>
        </div>
        <div class="card-body">
          <form action="{{ route('contact.full_payment_store',$id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('post')
            <label for=""  class="label-control">Amount</label>
       
            <input type="number" value="{{ $total_price }}" name="booking_money" class="form-control">
         
           
            {{--  <label for=""  class="label-control">Down payment</label>  --}}
          
            <label for="" class="form-label">Cheque NO/Cash</label>
            <input required type="text" name="cheque_bacash" value="{{old('cheque_bacash')}}" class="form-control">
            <label for="bank">Bank Name</label>
             <label for="bank">Branch</label>
            <input value="{{old('brance')}}" type="text" name="brance" class="form-control">
            <input type="text" name="bank" value="{{old('nid_no')}}" class="form-control">
            <label for="" class="form-label">Cheque Date</label>
            <input required type="date" value="{{old('cheque_date')}}" name="cheque_date" class="form-control">
            <label for="" class="form-label">Received Date</label>
            <input required type="date" value="{{old('reveived_date')}}" name="reveived_date" class="form-control">
            <label for="bank">Discount Persentage</label>
            <input type="number" value="{{old('nid_no')}}" name="discount" class="form-control">
            <br>
  
            <button class="btn btn-primary form-control" type="submit">submit</button>
          </form>
        </div>
      </div>
      </div>

    </div>
</div>

@endsection