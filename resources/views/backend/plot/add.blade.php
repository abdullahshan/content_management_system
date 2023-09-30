
@extends('layouts.backendapp')

@section('content')
    @push('customjs')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush

    <div class="card">
        <div class="card-header">
            <h2 style="font-size: 20px;"><b>Add Plot</b></h2>
        </div>
        <div class="card-body">

            <form action="{{ route('plot.store') }}" method="POST">

                @csrf
                @method('post')


                <div class="row">
                    <div class="col-lg-6">

                        <label for="exampleInputEmail1" class="form-label">Select Block :</label>
                        <select class="form-control" for="road" name="block" id="block" style="width: 100%; padding:2%">
                            @foreach ($getblocks as $getblock)
                                <option value="{{ $getblock->id }}">{{ $getblock->title }}</option>
                            @endforeach
                        </select>

                        @error('block')
                        <span style="color:red;"> {{ $message }}</span>
                    @enderror
                    <br>

                    </div>
                    
                    <div class="col-lg-6">
                        <label for="block" class="form-label">Select Road</label>

                        <select class="form-control" name="road" for="road" id="road" style="width: 100%; padding:2%">
                            <option value="">Select Road</option>
                        </select>

                        @error('road')
                        <span style="color:red;"> {{ $message }}</span>
                    @enderror
                    <br>

                    </div>
                </div>
                <br>
                <div class="mb-3">
                    <label for="plot" class="form-label">Plot num :</label>
                    <input type="text" name="plot_num" class="form-control" placeholder="enter plot number">
                </div>

                @error('plot_num')
                    <span style="color:red;"> {{ $message }}</span>
                @enderror
                <br>

                <div class="mb-3">
                    <label for="plot" class="form-label">Plot Size :</label>
                    <input type="text" name="plot_size" class="form-control" placeholder="enter plot size">
                </div>

                @error('plot_size')
                    <span style="color:red;"> {{ $message }}</span>
                @enderror
                <br>

                <div class="mb-3">
                    <label for="plot" class="form-label">Plot Type :</label>
                    <input type="text" name="plot_type" class="form-control" placeholder="enter plot type">
                </div>

                @error('plot_type')
                    <span style="color:red;"> {{ $message }}</span>
                @enderror
                <br>


                <div class="mb-3">
                    <label for="plot" class="form-label">Plot Price :</label>
                    <input type="text" name="plot_price" class="form-control" placeholder="enter road price">
                </div>

                @error('plot_price')
                    <span style="color:red;"> {{ $message }}</span>
                @enderror
                <br>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


    <script>
        $('#block').change(function(e) {

            let block_id = $(this).val();

            jQuery.ajax({
                url: '/getblock',
                type: 'post',
                data: 'data=' + block_id + '&_token={{ csrf_token() }}',
                success: function(result) {

                    jQuery('#road').html(result);
                }
            });

        });
    </script>


    @push('customjs')
    @endpush
@endsection
