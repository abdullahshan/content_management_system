@extends('layouts.backendapp')


@section('content')




<div class="mt-2">
    <h4 style="font-size:20px;position: absulate; margin-left: 10px; display:inline-block">
     
        <a class="btn btn-primary" href="#">Customer Info</a>
        <a class="btn btn-primary" href="{{ route('contact.share', $customer->id) }}">Add Share</a>
        <a class="btn btn-primary" href="{{ route('contact.nominee_form', $customer->id) }}">Customer Nominee</a>
        <a class="btn btn-primary" href="{{ route('contact.nomineetoshare_form', $customer->id) }}">Share Nominee</a>

    </h4>

</div>

@if (Session::has('message'))

<br>
<span class="d-flex justify-content-center" style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
@endif

<br>
<br>


    <h1 style="font-size: 25px;"><b>Customer</b></h1>


    <table class="table">
        <tr>
             <th>Image</th>
         
            <th>File No</th>
            <th>Project</th>
            <th>Name</th>
            <th>Mobaile</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>




        <tr>
             <td>
                        <span><img style="max-height: 100px;" src="{{ asset('storage/' . $customer->image) }}"
                                alt="image"></span>
                    </td>
         
            <td>
                {{ $customer->file_no }}
            </td>
            <td>{{ 'Dakhinacity' }}</td>
            <td>{{ $customer->name }}</td>
            <td>0{{ $customer->phone }}</td>
            <td>{{ $customer->email }}</td>
            <td>
                <div class="btn-group">


                    <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_edit', $customer->id) }}"
                        class="btn btn-warning btn-sm">Edit</a>


                    <a style="border-radius: 5px;margin-left:2px;" href="#" class="btn btn-danger btn-sm deletebtn">Delete</a>

                    
                    <form hidden action="{{ route('contact.customer_delete', $customer->id) }}" method="POST">
                        @csrf
                        @method('delete')

                    </form>

                </div>
            </td>
        </tr>


    </table>


    <div class="row">

        <div class="">
            <h1 style="font-size: 25px;"><b>Nominee</b></h1>

            <table class="table table-responsive">
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Relation</b></th>
                    <th><b>Phone</b></th>
                    <th><b>Alt.Phone</b></th>
                    <th><b>Address</b></th>
                    <th><b>Actions</b></th>
                </tr>
                @forelse ($customer->mominee as $s_nominee)
                    <tr>
                        <td>{{ $s_nominee->name }}</td>
                        <td>{{ $s_nominee->relation }}</td>
                        <td>{{ $s_nominee->phone }}</td>
                        <td>0{{ $s_nominee->mobile }}</td>
                        <td>0{{ $s_nominee->address }}</td>


                        <td class="d-flex justify-content-center">
                            <form action="{{ route('contact.nominee_edit', $s_nominee->id) }}"
                                method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('post')

                                <input type="number" hidden value="{{ $customer->id}}" name="cus_id">
                                <button type="submit" class="btn btn-warning btn-sm">edit</button>
                               
                            </form>

                            &nbsp;

                        <a style="border-radius: 5px;margin-left:2px;" href="#" class="btn btn-danger btn-sm deletebtn">delete</a>


                            <form hidden action="{{ route('contact.nominee_delete', $s_nominee->id) }}"
                                method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('post')

                                <input type="number" hidden value="{{ $customer->id}}" name="cus_id">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                               
                            </form>
                           
                        </td>

                    </tr>
                @empty
                @endforelse
            </table>
        </div>

        <div class="">


            <table class="table table-responsive">

                @forelse ($customer->shair as $key=> $s_share)
            </table>
            <table class="table table-responsive">
                <tr>
                    <th><span style="font-size:25px;color:black;">Share No {{ ++$key }}</span></th>
                </tr>
            </table>
            <table class="table table-responsive">
                <tr>
                    <th><b>Image</b></th>
                    <th><b>Name</b></th>
                    <th><b>Mobile</b></th>
                    <th><b>Actions</b></th>

                </tr>
                <tr>
                    <td>
                        <span><img style="max-height: 100px;" src="{{ asset('storage/' . $s_share->nid_image) }}"
                                alt="image"></span>
                    </td>
                    <td>{{ $s_share->name }}</td>
                    <td>0{{ $s_share->phone }}</td>

                    <td class="d-flex justify-content-center">
                        <form action="{{ route('contact.share_edite', $s_share->id) }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('post')

                            <input type="number" hidden value="{{ $customer->id}}" name="cus_id">
                            <button type="submit" class="btn btn-warning btn-sm">edit</button>
                           
                        </form>

                        &nbsp;


                        <a style="border-radius: 5px;margin-left:2px;" href="#" class="btn btn-danger btn-sm deletebtn">delete</a>


                        <form hidden action="{{ route('contact.share_delete', $s_share->id) }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('post')

                            <input type="number" hidden value="{{ $customer->id}}" name="cus_id">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                           
                        </form>
                       
                    </td>


                </tr>

            </table>
            <table class="table table-responsive">
                <tr>
                    <td>
                        @forelse ($customer->nomieenitoshair as $s_nominee)
                            @if ($s_share->id == $s_nominee->shair_id)
                                <div class="">
                                    <h1 style="font-size: 25px;"><b>Nominee</b></h1>

                                    <table class="table table-responsive">
                                        <tr>
                                            <th><b>Name</b></th>
                                            <th><b>Relation</b></th>
                                            <th><b>Phone</b></th>
                                            <th><b>Alt.Phone</b></th>
                                            <th><b>Address</b></th>
                                            <th><b>Actions</b></th>

                                        </tr>

                                        <tr>
                                            <td>{{ $s_nominee->name }}</td>
                                            <td>{{ $s_nominee->relation }}</td>
                                            <td>{{ $s_nominee->phone }}</td>
                                            <td>0{{ $s_nominee->mobile }}</td>
                                            <td>0{{ $s_nominee->address }}</td>

                                            <td class="d-flex justify-content-center">
                                                <form action="{{ route('contact.share_nominee_edit', $s_nominee->id) }}"
                                                    method="POST" enctype="multipart/form-data">

                                                    @csrf
                                                    @method('post')

                                                    <input type="number" hidden value="{{ $customer->id}}" name="cus_id">
                                                    <button type="submit" class="btn btn-warning btn-sm">edit</button>
                                                   
                                                </form>

                                                &nbsp;



                                <a style="border-radius: 5px;margin-left:2px;" href="#" class="btn btn-danger btn-sm deletebtn">Delete</a>


                                                <form hidden action="{{ route('contact.share_nominee_delete', $s_nominee->id) }}"
                                                    method="POST" enctype="multipart/form-data">

                                                    @csrf
                                                    @method('post')

                                                    <input type="number" hidden value="{{ $customer->id}}" name="cus_id">
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                   
                                                </form>
                                               
                                            </td>

                                        </tr>

                                    </table>
                                </div>
                            @else
                            @endif

                            <br>
                        @empty
                        @endforelse

                    </td>
                </tr>

            @empty
                @endforelse
            </table>
           
        </div>
    </div>



@endsection



@push('customjs')

    <script>
            
        $('.deletebtn').click(function(){

            Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    
        $(this).next('form').submit();

  }
})
        });

    </script>
    
@endpush
