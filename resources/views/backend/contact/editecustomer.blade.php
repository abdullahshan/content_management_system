@extends('layouts.backendapp')


@section('content')


{{--  {{$id}}  --}}
   

<div class="container">
    <div class="row">
        <div class="card">
         @if (Session::has('message'))
         <span class="d-flex justify-content-center" style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
         @endif
            <div class="card-header">
                <h4 style="font-size:20px;">Edit or Update Cus_Info</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('contact.customeredit_store', $id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                   
                  <div class="row">
                     <div class="col-lg-6">
                        <label for="booking_money">Number of Share</label>
                        <input type="number" value="{{ $cusdata->no_share }}" class="form-control" name="share">
                        @error('share')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                        <br>
                        <label for="down_payment" class="form-label">Name</label>
                        <input type="text" value="{{ $cusdata->name }}" class="form-control" value="" name="name">
                        @error('name')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                        <br>
                        <label for="down_payment" class="form-label">Email</label>
                        <input type="email" value="{{ $cusdata->email }}" class="form-control" name="email">
                        @error('email')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                        <br>
                        <label for="cash_ba_check">Date of birth</label>
                        <input type="date" value="{{ $cusdata->date_of_birth }}" class="form-control" name="date">
                        @error('date')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                        <br>
                       
                        <label for="number">Mobaile Number</label>
                        <input type="number" value="{{ $cusdata->phone }}" class="form-control" value="" name="phone">
                        @error('phone')
                               <span style="color:red;"> {{ $message }}</span>
                            @enderror
                        <br>
                        <label for="cash_ba_check">Phone Office</label>
                        <input type="number" value="{{ $cusdata->phone_office }}" class="form-control" name="phon_office">
                        @error('phon_office')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     <br>
                        <label for="memo_no">Father Name</label>
                        <input type="text" value="{{ $cusdata->father_name }}" class="form-control" name="father">
                        @error('father')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                        <br>
                        <label for="memo_no">Mother Name</label>
                        <input type="text" value="{{ $cusdata->mother_name }}" class="form-control" name="mother">
                        @error('mother')
                               <span style="color:red;"> {{ $message }}</span>
                            @enderror
                        <br>
                       
                        <label for="memo_no">Present Address</label>
                        <input type="text" value="{{ $cusdata->presend_address }}" class="form-control" name="present_address">
                        @error('present_address')
                               <span style="color:red;"> {{ $message }}</span>
                            @enderror
                        <br>
                      
                       </div>
   
   
                       <div class="col-lg-6">

                        <label for="memo_no">Permanent Address</label>
                        <input type="text" value="{{ $cusdata->permanent_address }}" class="form-control" name="permanent_address">
                        @error('permanent_address')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     <br>
    
                     <label for="cash_ba_check">Service No</label>
                     <input type="number" class="form-control" value="{{ $cusdata->service }}" name="service">
                     @error('service')
                     <span style="color:red;"> {{ $message }}</span>
                  @enderror
                        <br>
    
                        <label for="cash_ba_check">National ID No</label>
                        <input type="number" class="form-control"  value="{{ $cusdata->nid_no }}" name="nid_no">
                        @error('nid_no')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                        <br>
                        <label for="cash_ba_check">Nationality</label>
                        <input type="text" class="form-control" value="{{ $cusdata->nationallity }}" name="nationality">
                        @error('nationality')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                        <br>
                        <label for="cash_ba_check">Marital Status</label>
                        <input type="text" class="form-control" value="{{ $cusdata->marriage_status }}" name="marital_status">
                        @error('marital_status')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     <br>
                     <label for="cash_ba_check">Marriage Day</label>
                     <input type="text" class="form-control" value="{{ $cusdata->marriage }}" name="marriage">
                     @error('marriage')
                     <span style="color:red;"> {{ $message }}</span>
                  @enderror
                  <br>
    
                  <label for="file">Image</label>
                  <input type="file" class="form-control" name="image">
                  @error('image')
                  <span style="color:red;"> {{ $message }}</span>
               @enderror
                  <br>
    
                  <label for="date">NID With Image</label>
                  <input type="file" class="form-control" name="ind_image">
                  @error('ind_image')
                  <span style="color:red;"> {{ $message }}</span>
               @enderror

               <br>
               <br>
                 
               <button style="width: 100%" type="submit" class="btn btn-primary">submit</button>

                       </div>
                      
                   </form>
               </div>
                  </div>
                 
        </div>
    </div>
</div>




@endsection