@extends('layouts.backendapp')

@section('content')

<div class="container">
    <div class="row">
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-2 rounded">
        <div class="card">
            <div class="card-header">
                <h1 style="font-size: 20px;">User Update</h1>
            </div>
          
                <div class="card-body">
                    <form action="{{ route('update_store', $data->id) }}" method="POST">
                        @method('post')
                        @csrf
                        <label for="">Name</label>
                        <input type="text" value="{{ $data->name }}" class="form-control" name="name">
                        <label for="">Email</label>
                        <input type="text" value="{{ $data->email }}" class="form-control" name="email">
                        <label for="">Password   </label>
                        <input type="text" class="form-control" name="password">
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
           </div>
        </div>
    </div>
</div>

@endsection