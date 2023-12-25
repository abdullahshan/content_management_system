@extends('layouts.frontendapp')

@section('content')


    <?php 

    $id = $_GET['id'];

    

?>

    <div class="container">
        <div class="row">
            <div class="card col-lg-6 shadow border rounded bg-light" style="margin: auto; margin-top:10px;">
                <div class="card-header bg-warning m-1 border rounded">
                    <h3 class="d-flex justify-content-center">Booking From</h3>
                </div>
                <div class="card-body">
                  <form action="{{ route('book_info_second', ['id' => $id]) }}" method="POST">
                    @method('post')
                    @csrf
                    <label for="name" class="fomr-label">Name</label>
                    <input type="text" value="{{old('name')}}" name="name" placeholder="name" required class="form-control"><br>
                    <label for="name" class="fomr-label">Phone</label>
                    <input type="number" value="{{old('phone')}}" name="phone" placeholder="phone" required class="form-control">
                    @error('phone')
                    <span style="color:red;"> {{ $message }}</span>
                @enderror
                <br>
                    <label for="name" class="fomr-label">Email</label>
                    <input type="email" value="{{old('email')}}" name="email" placeholder="email" required class="form-control"><br>
                    <label for="name" class="fomr-label">Address</label>
                    <input type="text" value="{{old('address')}}" name="address" placeholder="address" required class="form-control"><br>
                    <label for="name" class="fomr-label">Message</label>
                    <textarea name="message" placeholder="message" required class="form-control"></textarea>
                    <br>
                    <button style="width:100%" class="btn btn-primary" type="submit">Send</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

@endsection