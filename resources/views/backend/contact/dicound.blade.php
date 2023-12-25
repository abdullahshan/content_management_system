@extends('layouts.backendapp')


@section('content')


    <div class="container">
    <div class="row justify-content-center mt-2">
      <div class="col-lg-6 shadow">
        <div class="card">
          <div class="card-header">
              <h1>Payment Mode</h1>
          </div>
          <div class="card-body">
            <form action="{{ route('contact.discount_store', $data->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('post')
              <label for="" class="form-label">Booking Persentage</label>
              <input type="text" placeholder="Enter bookin persentage" value="{{ $data->booking }}" name="booking" class="form-control">
              <br>
              <label for="" class="form-label">Down Persentage</label>
              <input value="{{ $data->down }}" placeholder="Enter down persentage" type="text" class="form-control" name="down">

              <br>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
      </div>
    </div>
      </div>
    </div>


@endsection