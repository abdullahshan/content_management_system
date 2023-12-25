@extends('layouts.backendapp')

@section('content')
    {{--  {{$id}}  --}}


    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-lg-12">
                <div class="card border rounded">
                    @if (Session::has('message'))
                        <span class="d-flex justify-content-center"
                            style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
                    @endif
                    <div class="mt-2">
                        <h4 style="font-size:20px;position: absulate; margin-left: 10px; display:inline-block">

                            <a class="btn btn-primary" href="">Customer Info</a>
                            <a class="btn btn-primary" href="{{ route('contact.share', $id) }}">Add Share</a>
                            <a class="btn btn-primary" href="{{ route('contact.nominee_form', $id) }}">Customer Nominee</a>
                            <a class="btn btn-primary" href="{{ route('contact.nomineetoshare_form', $id) }}">Share Nominee</a>

                        </h4>

                        @if ($book_id == '0')
                            <a class="btn btn-primary" href="{{ route('contact.apply', $id) }}">Choose Plot</a>
                        @else
                        @endif

                        <span style="font-size:25px;">
                            Add Share To Custormer
                        </span>
                    </div>

                    <br>

                    <div class="card-body">



                        <table class="table table-responsive">

                            @forelse ($shareall as $s_share)
                                <div class="row">


                                    <table class="table table-responsive">
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>NID No</th>
                                            <th>Address</th>
                                        </tr>
                                        <tr>
                                            <td>  <img src="{{ asset('storage/' . $s_share->nid_image) }}" alt="Girl in a jacket"
                                                width="40" height="40"></td>
                                                <td>{{ $s_share->name }}</td>
                                                <td>{{ $s_share->phone }}</td>
                                                <td>{{ $s_share->nid_number }}</td>
                                                <td>{{ $s_share->address }}</td>
                                                
                                        </tr>
                                    </table>

        

                                </div>
                            @empty
                            @endforelse
                        </table>


                        <br>
                        <div class="d-flex justify-content-center">
                            <span style="font-size:20px;color:black;margin-bottom:17px;">Add Share Holders To Custormer</span>
                           </div>
                        <hr>


                        <form class="m-2 p-2" action="{{ route('contact.share_store', $id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">


                                    <div class="col-lg-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" required value="{{old('name')}}" name="name" class="form-control">
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="name" class="form-label">Phone</label>
                                        <input type="number" required value="{{old('phone')}}" name="phone" class="form-control">

                                        @error('phone')
                                            <span style="color:red;" class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Email</label>
                                        <input type="email" value="{{old('email')}}" name="email" class="form-control"required>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Father</label>
                                        <input type="text" value="{{old('father')}}" name="father" class="form-control"required>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Mother</label>
                                        <input type="text" value="{{old('mother')}}" name="mother" class="form-control"required>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Rank</label>
                                        <input type="text" value="{{old('rank')}}" name="rank" class="form-control"required>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Service No:</label>
                                        <input type="text" value="{{old('service')}}" name="service" class="form-control"required>
                                    </div>





                                    <div class="col-lg-6">
                                        <label for="nid_num" class="form-label">NID No</label>
                                        <input type="number" required value="{{old('nid_num')}}" name="nid_num" class="form-control">
                                        @error('nid_num')
                                            <span style="color:red;" class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Address</label>
                                        <input type="text" value="{{old('address')}}" name="address" class="form-control"required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Permanent_address</label>
                                        <input type="text" value="{{old('permanent_address')}}" name="permanent_address" class="form-control"required>
                                    </div>




                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Nationality:</label>
                                        <input type="text" value="{{old('nationality')}}" name="nationality" class="form-control"required>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Date of Birth</label>
                                        <input type="Date" value="{{old('barth_date')}}" name="barth_date" class="form-control"required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Marriage Status:</label>
                                        <input type="text" value="{{old('marriage_status')}}" name="marriage_status" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Marriage Date</label>
                                        <input type="date" value="{{old('marriage_date')}}" name="marriage_date" class="form-control">
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Image</label>
                                        <input type="file" value="{{old('shair_image')}}" name="shair_image" class="form-control">
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-6">
                                        <button style="d-flex;justify-content:center;width:100%" type="submit"
                                            class="btn btn-primary mt-5" style="margin-top: 10px;">Save & Next</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
