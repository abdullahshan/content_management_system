@extends('layouts.backendapp')

@section('content')

<div class="d-flex justify-content-center">
    <span style="font-size:20px;color:black;margin-bottom:17px;">Edit Nominee for ShareHolder</span>
   </div>
<hr>


                        <form class="mb-5" action="{{ route('contact.share_nominee_update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div class="row">

                                <input hidden type="text" name="cus_id" value="{{ $cus_id }}">

                                <div class="col-lg-6">
                                    <div class="">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" required value="{{ $data->name }}" name="name" class="form-control">
                                    </div>


                                    <div class="">
                                        <label for="name" class="form-label">phone</label>
                                        <input type="number" required value="{{ $data->phone }}" name="phone" class="form-control">
                                        @error('phone')

                                            <span style="color:red;">{{ $message }}</span>

                                            @endif
                                        </div>

                                        <div class="">
                                            <label for="name" class="form-label">Nid No</label>
                                            <input type="number" required value="{{ $data->nid_no }}" name="nid_no" class="form-control">
                                        </div>


                                        <div class="">
                                            <label for="name" class="form-label">Image</label>
                                            <input type="file"  name="image" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">

                                        <div class="">
                                            <label for="name" class="form-label">Relation</label>
                                            <input type="text" required value="{{ $data->relation }}" name="relation" class="form-control">
                                        </div>

                                        <div class="">
                                            <label for="name" class="form-label">Alt.phone</label>
                                            <input type="number" required value="{{ $data->mobile }}" name="mobile" class="form-control">
                                            @error('mobile')

                                                <span style="color:red;">{{ $message }}</span>

                                                @endif
                                            </div>

                                            <div class="">
                                                <label for="name" class="form-label">Address</label>
                                                <input type="text" required value="{{ $data->address }}" name="address" class="form-control">
                                            </div>

                                            <div class="">

                                                <button style="margin-top:29px; width:100%;" type="submit"
                                                    class="btn btn-primary">Save&Next</button>
                                            </div>


                                        </div>



                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
