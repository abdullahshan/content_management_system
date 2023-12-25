@extends('layouts.backendapp')


@section('content')

{{--  {{ $endmoney }}  --}}

<div class="container">
    <div class="row justify-content-center">

      <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h1 style="font-size:20px;">Total Amount : {{ $total_price }} <a class="btn btn-primary" href="{{ route('contact.full_payment', $id) }}">Full Payment</a> </h1>
        </div>
        <div class="card-body">
          <form action="{{ route('contact.payment_store',$id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('post')
            <label for=""  class="label-control">Booking money</label>
       
            <input type="number" value="{{ $booking_money }}" name="booking_money" class="form-control">
         
            {{--  <label for=""  class="label-control">Down payment</label>  --}}
  
            <input hidden type="number" value="{{ $dwn }}" name="year" class="form-control">
            <label for="" class="form-label">Cheque NO/Cash</label>
            <input value="{{old('cheque_bacash')}}" required type="text" name="cheque_bacash" class="form-control">
            <label for="bank">Bank Name</label>
            <input value="{{old('bank')}}" type="text" name="bank" class="form-control">
             <label for="bank">Branch</label>
            <input value="{{old('brance')}}" type="text" name="brance" class="form-control">
            <label for="" class="form-label">Cheque Date</label>
            <input value="{{old('cheque_date')}}" required type="date" name="cheque_date" class="form-control">
            <label for="" class="form-label">Received Date</label>
            <input value="{{old('reveived_date')}}" required type="date" name="reveived_date" class="form-control">
            <label for="" class="form-label">Total Installment</label>
            <input required type="number" name="year" value="{{old('year')}}" class="form-control">
            @if (Session::has('message'))
            <span style="color: red">{{ Session::get('message') }}</span>
            @endif
            <br>
  
            <button class="btn btn-primary form-control" type="submit">submit</button>
          </form>
        </div>
      </div>
      </div>

    </div>
</div>

@endsection