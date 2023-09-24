@extends('layouts.frontendapp')

@section('content')


<div class="container">
   
    <div class="card mb-3" style="max-width: 100%; margin-top:10px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{ $product->title }}</h5>
              <p class="card-text">{!! $product->content !!}</p>
              <p class="card-text"><small class="text-body-secondary">{{ Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small></p>
              <a href="{{ route('frontend', $product) }}" class="btn btn-primary">Back</a>
           
            </div>
          </div>
        </div>
      </div>
   
</div>


@endsection