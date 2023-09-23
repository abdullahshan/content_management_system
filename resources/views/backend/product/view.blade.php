@extends('layouts.backendapp')


@section('content')


<div class="row">
    <div class="card">
        <div class="card-header">
            <h2>All Product</h2>
        </div>
        <div class="card-body">
                <table class="table table-responsive">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                        <tr>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td><img style="max-height: 100px;" src="{{ asset('storage/'. $product->image) }}" alt=""></td>
                                    <td>{!! $product->content !!}</td>
                                    <td><a class="{{ $product->status == '0' ? "btn btn-info" : "btn btn-primary" }}" href="">{{ $product->status == '0' ? "Pending" : "Aprroved" }}</a></td>
                                    <td>{{ Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</td>
                                    <td>
                                    <a href="" class="btn btn-primary">edit</a>
                                    <a href="{{ route('product.delete', $product) }}" class="btn btn-danger">delete</a>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tr>
                </table>
        </div>
    </div>
</div>


@endsection