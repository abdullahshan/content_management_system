
@extends('layouts.frontendapp')

@section('content')

@forelse ($products as $product)
  <div class="card mt-4" style="width: 18rem;display:inline-block;margin-left:40px;">
    <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start" alt="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $product->title }}</h5>
      <p class="card-text">{!! Str::substr($product->content, 0, 20) !!}<b>...</b></p>
      <p class="card-text"><small class="text-body-secondary">{{ Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small></p>
      <a href="{{ route('frontend.view', $product) }}" class="btn btn-primary">View</a>
    </div>
  </div>
@empty
    
@endforelse

<center>
    {{  $products->withQueryString()->links() }}
</center>

@endsection
