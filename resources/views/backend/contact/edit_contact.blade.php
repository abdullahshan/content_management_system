@extends('layouts.backendapp')


@section('content')


{{--  {{$id}}  --}}
   
   <style>.form-control{
       padding:2px;
       margin:2px;
    </style>
<div class="container">
    <div class="row border rounded shadow">
        <div class="card border rounded shadow">
         @if (Session::has('message'))
         <span class="d-flex justify-content-center" style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
         @endif
            <div class="card-header border rounded">
                <div class="mt-2">
                <h4 style="font-size:20px;position: absulate; margin-left: 10px; display:inline-block">
                    
                     <a class="btn btn-primary" href="">Customer Info</a>
                    <a class="btn btn-primary" href="">Add Share</a>
                    <a class="btn btn-primary" href="">Customer Nominee</a>
                    <a class="btn btn-primary" href="">Share Nominee</a>

                     <span style="font-size:25px;">
                        Customer Info
                    </span>
                    </h4>
                   
            </div>
            </div>
            
            <br>
            
                      <div class="card-body">
                <form action="{{ route('contact.update', $id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                  
            <div class="row justify-content-center">

                        
                    <div class="col-lg-6">
                        <label for="down_payment">Name</label>
                        <input type="text" class="form-control" value="{{$bookinfo->name}}" name="name">
                        @error('name')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     </div>
                <div class="col-lg-6">
                  <label for="cash_ba_check">Service No</label>
                  <input type="number" class="form-control" value="{{old('service')}}" name="service">
                  @error('service')
                  <span style="color:red;"> {{ $message }}</span>
               @enderror
               </div>
               
                 <div class="col-lg-6">
                           <label for="cash_ba_check">Rank</label>
                           <input type="text" class="form-control" value="{{old('rank')}}" name="rank">
                           @error('rank')
                           <span style="color:red;"> {{ $message }}</span>
                        @enderror
                        </div>
                        
                         <div class="col-lg-6">
                        <label for="down_payment">Email</label>
                        <input type="email" class="form-control" value="{{$bookinfo->email}}" name="email">
                        @error('email')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     </div>
                     
                    <div class="col-lg-6">
                        <label for="number">Mobaile Number</label>
                        <input type="number" class="form-control" value="{{ $bookinfo->phone }}" name="phone">
                        @error('phone')
                               <span style="color:red;"> {{ $message }}</span>
                        @enderror
                    </div>
                      
                      <div class="col-lg-6">
                        <label for="cash_ba_check">Alt. Mobile Number</label>
                        <input type="number" class="form-control" value="{{old('phon_office')}}" name="phon_office">
                        @error('phon_office')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     </div>
                        
                     
                   
                       

                       
                    
                    <div class="col-lg-6">
                        <label for="memo_no">Father Name</label>
                        <input type="text" value="{{old('father')}}" class="form-control" name="father">
                        @error('father')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     </div>
                        
                        <div class="col-lg-6">
                        <label for="memo_no">Mother Name</label>
                        <input type="text" value="{{ old('mother') }}" class="form-control" name="mother">
                        @error('mother')
                               <span style="color:red;"> {{ $message }}</span>
                            @enderror
                            </div>
                      
                      <div class="col-lg-6">
                        <label for="memo_no">Present Address</label>
                        <input type="text" value="{{$bookinfo->address}}" class="form-control" name="present_address">
                        @error('present_address')
                               <span style="color:red;"> {{ $message }}</span>
                            @enderror
                            </div>
                      
                     <div class="col-lg-6">
                        <label for="memo_no">Permanent Address</label>
                        <input type="text" value="{{old('permanent_address')}}" class="form-control" name="permanent_address">
                        @error('permanent_address')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     </div>
                     
                       <div class="col-lg-6">
                        <label for="number of share">Number of Share</label>
                        <input type="number" value="{{old('share')}}" class="form-control" name="share">
                        @error('share')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     </div>
                     
                        <div class="col-lg-6">
                        <label for="cash_ba_check">Date of birth</label>
                        <input type="date" class="form-control" value="{{old('date')}}" name="date">
                        @error('date')
                        <span style="color:red;"> {{ $message }}</span>
                        @enderror
                     </div>
                       
                       
                    <div class="col-lg-6">
                        <label for="cash_ba_check">Nationality</label>
                        <input type="text" class="form-control" value="{{old('nationality')}}" name="nationality">
                        @error('nationality')
                        <span style="color:red;"> {{ $message }}</span>
                        @enderror
                    </div>
                       
                       
                       <div class="col-lg-6">
                        <label for="cash_ba_check">National ID No</label>
                        <input type="number" class="form-control" value="{{old('nid_no')}}" name="nid_no">
                        @error('nid_no')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     </div>
                     
                   

                <div class="col-lg-6">
                   <label for="file">Image</label>
                        <input type="file" class="form-control" value="{{old('image')}}" name="image">
                        @error('image')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                </div>
                
                
                
                
                        
                    <div class="col-lg-6">
                        <label for="date">NID With Image</label>
                        <input type="file"class="form-control" value="{{old('ind_image')}}" name="ind_image">
                        @error('ind_image')
                        <span style="color:red;"> {{ $message }}</span>
                        @enderror
                     </div>
                     
                     

                       
                       <div class="col-lg-6">
                        <label for="cash_ba_check">Marital Status</label>
                        <input type="text" class="form-control" value="{{old('marital_status')}}" name="marital_status">
                        @error('marital_status')
                        <span style="color:red;"> {{ $message }}</span>
                     @enderror
                     </div>
                    
                    <div class="col-lg-6">
                     <label for="cash_ba_check">Marriage Day</label>
                     <input type="date" class="form-control" value="{{old('marriage')}}" name="marriage">
                     @error('marriage')
                     <span style="color:red;"> {{ $message }}</span>
                  @enderror
                  </div>
                  

            </div>


                     <div class="row">

                  
                     </div>
                     

                </div>
                <div class="d-flex justify-content-center mt-1 mb-1">
                    <div class="col-lg-6">
                       <button style="width: 100%" type="submit" class="btn btn-primary">submit</button>
                    </div>
                    </div>
                    
                </form>
        </div>
    </div>
</div>




@endsection