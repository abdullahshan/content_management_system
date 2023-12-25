@extends('layouts.backendapp')

@section('content')


{{--  {{$id}}  --}}


<div class="container">
    <div class="row bg-white justify-content-center">
       <div class="col-lg-12">
      
    
        <div class="card">

     
            <div class="card-header">
                @if (Session::has('message'))
                <span class="d-flex justify-content-center" style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
                @endif
              
                    <h4 style="font-size:20px; display:inline-block;">
                        
                    <a class="btn btn-primary" href="">Update info</a>
                    <a class="btn btn-primary" href="{{ route('contact.share', $id) }}">Add Shair</a></h4> 
                   
                    <a class="btn btn-primary" href="{{ route('contact.nominee_form', $id) }}">Customer Nominee</a>
                    <a class="btn btn-primary" href="{{ route('contact.nomineetoshare_form', $id) }}">Share Nominee</a>
                    
                      
                        @if ($book_id == '0')
                        <a class="btn btn-primary" href="{{ route('contact.apply',$id) }}">Choose Plot</a>
                            
                        @else
                            
                        @endif
                        <span style="font-size:25px;">
                            Add Nominee To Share
                        </span>
            </div>

        <br>
         
            <div class="card-body">
                
                
                
                              <table class="table table-responsive">
                       
                        @forelse ($nomeni as $s_share)
                    <div class="row">

                    </table>
                    <table class="table table-responsive">
                        <tr>
                            <td> <span style="font-size:20px;color:black">Share Holder Name : {{ $s_share->shair->name }}</span></td>
                        </tr>
                    </table>
                    <table class="table table-responsive">
                        <tr>
                            <th>Image</th>
                            <th>
                                Name
                            </th>
                            <th>Relation</th>
                            <th>Phone</th>
                            <th>Alt.Phone</th>
                            <th>Address</th>
                           
                        </tr>
                       
                        <tr>
                            <td> <img src="{{ asset('storage/' . $s_share->image) }}" alt="Girl in a jacket"
                                width="40" height="40"></td>
                            <td>{{ $s_share->name }}</td>
                            <td>
                                {{ $s_share->relation }}
                            </td>
                            <td>
                                0{{ $s_share->phone }}
                            </td>
                            <td>
                                0{{ $s_share->mobile }}
                            </td>
                            <td>
                                {{ $s_share->address }}
                            </td>
                        </tr>
                    

                 
              
                        @empty
                        @endforelse
                    </table>
                

                    <br><br>

                    <div class="d-flex justify-content-center">
                        <span style="font-size:20px;color:black;margin-bottom:17px;">Add Nominee To Share</span>
                       </div>
                    <hr>  
               
         
               <form action="{{ route('contact.nomineetoshare_store', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')
             
              
                <div class="row">

                    <div class="col-lg-6">
                        <div class="">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" required value="{{old('name')}}" name="name" class="form-control">
                        </div>


                        <div class="">
                            <label for="name" class="form-label">phone</label>
                            <input type="number" required value="{{old('phone')}}" name="phone" class="form-control">
                            @error('phone')

                                <span style="color:red;">{{ $message }}</span>

                                @endif
                            </div>

                            <div class="">
                                <label for="name" class="form-label">Nid No</label>
                                <input type="number" required value="{{old('nid_no')}}" name="nid_no" class="form-control">
                            </div>


                            <div class="">
                                <label for="name" class="form-label">Image</label>
                                <input type="file"  name="image" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">

                            <div class="">
                                <label for="name" class="form-label">Relation</label>
                                <input type="text" required value="{{old('relation')}}" name="relation" class="form-control">
                            </div>

                            <div class="">
                                <label for="name" class="form-label">Alt.phone</label>
                                <input type="number" required value="{{old('mobile')}}" name="mobile" class="form-control">
                                @error('mobile')

                                    <span style="color:red;">{{ $message }}</span>

                                    @endif
                                </div>

                                <div class="">
                                    <label for="name" class="form-label">Address</label>
                                    <input type="text" required value="{{old('address')}}" name="address" class="form-control">
                                </div>

                                <div class="">
                                    <label for="name" class="form-label">Share Holers</label>

                                    <select class="form-control" name="share_id" required id="">
                                        <option disabled selected value="">leclect one</option>
                                        @forelse ($allshair as $s_share)
                                       
                                        <option value="{{ $s_share->id }}">{{ $s_share->name }}</option>
                                        @empty
                                            
                                        @endforelse
                                       
                                    </select>
                                   </div>


                            </div>



                        </div>


                    
                </div>

             
               
                <div class="d-flex justify-content-center mb-3">
                    
                    <button  style="width:50%" type="submit" class="btn btn-primary">Save&Next</button>
               </div>
               
               </form>
            </div>
        </div>
       </div>
    </div>
</div>

@endsection