@extends('layouts.backendapp')


@section('content')


<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 style="font-size: 20px;"><b>All Product</b></h2>
        </div>
        <div class="card-body">
                <table class="table table-responsive">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Date</th>
                            @can('role status')
                            <th>Status</th>
                            @endcan
                            <th>Action</th>
                        </tr>

                        <tr>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td><img style="max-height: 50px;" src="{{ asset('storage/'. $product->image) }}" alt=""></td>
                                    <td>{!! Str::substr($product->content, 0, 15) !!}<b>...</b></td>                                  
                                    <td>{{ $product->date == null ? Carbon\Carbon::parse($product->created_at)->diffForHumans() : Carbon\Carbon::parse($product->date)->diffForHumans() }}</td>
                                        @can('role status')
                                        <td>
                                            <a href="{{ route('product.product.status', $product) }}" class="{{ $product->status == '0' ? "btn btn-info" : "btn btn-primary" }}">{{ $product->status == '0' ? "Pending" : "Aprroved" }}</a>
                                        </td> 
                                        @endcan
                                    <td>
                                    <a href="{{ route('product.edit', $product) }}" class="btn btn-info">view</a>
                                    <a href="{{ route('product.edit', $product) }}" class="btn btn-primary">edit</a>
                                    <a href="{{ route('product.delete', $product) }}" class="btn btn-danger">delete</a>                                
                                    </td>
                                </tr>
                                @forelse ($product->categories as $categorie)
                                       
                                <tr>
                                    <td><b><span>&#8618;</span></b></td>
                                    <td>{{ $categorie->title }}</td>
                                </tr>
                          
                        @empty
                            
                        @endforelse
                            @empty
                                
                            @endforelse
                        </tr>
                </table>
             
                <center class="mt-5">
                    {{  $products->withQueryString()->links() }}
                </center>
        </div>
    </div>
</div>


@endsection