@extends('layouts.backendapp')

@section('content')
    @push('customjs')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush

  <div class="row justify-content-center mt-2">
    <div class="col-lg-7 justify-content-center">
        <div class="card">
            @if (Session::has('message'))
            <span class="d-flex justify-content-center" style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
            @endif

           

            @if (isset($data))
            <div class="card-header">
                <h2 style="font-size: 20px;"><b>Edit Road</b></h2>
            </div>

            <div class="card-body">
    
                <form action="{{ route('category.update_road', $data->id) }}" method="POST" enctype="multipart/form-data">
    
                    @csrf
                    @method('post')

                    <input type="number" hidden name="road_id" value="{{ $id }}">
    
                    <h4 style="font-size: 15px;">Choise Block</h4>
                    <br>
                    <select name="category_id" id="" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
    
                    </select>
                    <br>
                    @error('category_id')
                        <span style="color:red;"> {{ $message }}</span>
                    @enderror
                    <br>
    
                    <div class="mb-3">
                        <label for="plot" class="form-label">Road Number :</label>
                        <input type="number" name="road_num" value="{{ $data->road_num }}" class="form-control" placeholder="enter road number">
                    </div>
    
                    @error('road_num')
                        <span style="color:red;"> {{ $message }}</span>
                    @enderror
    
                    <br>
                    <button type="submit" class="mt-2 btn btn-primary">Submit</button>
                </form>
            </div>
            @else
                
           

            <div class="card-header">
                <h2 style="font-size: 20px;"><b>Add Road</b></h2>
            </div>
            <div class="card-body">
    
                <form action="{{ route('road.store') }}" method="POST" enctype="multipart/form-data">
    
                    @csrf
                    @method('post')
    
                    <h4 style="font-size: 15px;">Choise Block</h4>
                    <br>
                    <select name="category_id" id="" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
    
                    </select>
                    <br>
                    @error('category_id')
                        <span style="color:red;"> {{ $message }}</span>
                    @enderror
                    <br>
    
                    <div class="mb-3">
                        <label for="plot" class="form-label">Road Number :</label>
                        <input type="number" name="road_num" class="form-control" placeholder="enter road number">
                    </div>
    
                    @error('road_num')
                        <span style="color:red;"> {{ $message }}</span>
                    @enderror
    
                    <br>
                    <button type="submit" class="mt-2 btn btn-primary">Submit</button>
                </form>
            </div>
            @endif
        </div>
    </div>
  </div>



    @push('customjs')
    @endpush
@endsection
