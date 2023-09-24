
@extends('layouts.frontendapp')

@section('content')

@forelse ($products as $product)
<div class="card mb-3 mt-2" style="max-width: 240px;margin:auto; display:inline-block;margin-left:2px;">
    <div class="row g-0">
      <div class="col-md-5">
        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $product->title }}</h5>
          <p class="card-text">{!! Str::substr($product->content, 0, 20) !!}... <a href="">View</a></p>
          <p class="card-text"><small class="text-body-secondary">{{ Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small></p>
        </div>
      </div>
    </div>
  </div>
@empty
    
@endforelse

@endsection