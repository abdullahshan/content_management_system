@extends('layouts.backendapp')

@section('content')
    {{--  {{$id}}  --}}




                        <br>
                        <div class="d-flex justify-content-center">
                            <span style="font-size:20px;color:black;margin-bottom:17px;">Edit Share Holders To Custormer</span>
                           </div>
                        <hr>

                        

                        <form class="m-2 p-2" action="{{ route('contact.share_update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">



                                <input hidden type="number" name="cus_id" value="{{ $cus_id }}">


                                    <div class="col-lg-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" required value="{{ $data->name }}" name="name" class="form-control">
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="name" class="form-label">Phone</label>
                                        <input type="number" required value="{{ $data->phone }}" name="phone" class="form-control">

                                        @error('phone')
                                            <span style="color:red;" class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Email</label>
                                        <input type="email" value="{{ $data->email }}" name="email" class="form-control"required>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Father</label>
                                        <input type="text" value="{{ $data->father }}" name="father" class="form-control"required>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Mother</label>
                                        <input type="text" value="{{ $data->mother }}" name="mother" class="form-control"required>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Rank</label>
                                        <input type="text" value="{{ $data->rank }}" name="rank" class="form-control"required>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Service No:</label>
                                        <input type="text" value="{{ $data->service }}" name="service" class="form-control"required>
                                    </div>





                                    <div class="col-lg-6">
                                        <label for="nid_num" class="form-label">NID No</label>
                                        <input type="number" required value="{{ $data->nid_number }}" name="nid_num" class="form-control">
                                        @error('nid_num')
                                            <span style="color:red;" class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Address</label>
                                        <input type="text" value="{{ $data->address }}" name="address" class="form-control"required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Permanent_address</label>
                                        <input type="text" value="{{ $data->permanent_address }}" name="permanent_address" class="form-control"required>
                                    </div>




                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Nationality:</label>
                                        <input type="text" value="{{ $data->nationality }}" name="nationality" class="form-control"required>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Date of Birth</label>
                                        <input type="Date" value="{{ $data->barth_date }}" name="barth_date" class="form-control"required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Marriage Status:</label>
                                        <input type="text" value="{{ $data->marriage_status }}" name="marriage_status" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Marriage Date</label>
                                        <input type="date" value="{{ $data->marriage_date }}" name="marriage_date" class="form-control">
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label for="nid" class="form-label">Image</label>
                                        <input type="file" value="{{ $data->shair_image }}" name="shair_image" class="form-control">
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
