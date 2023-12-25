@extends('layouts.backendapp')

@section('content')
    <div class="container">
        <div class="card-header" style="margin:auto; text-align:center;margin-top:5px;">
            <h3>Find Your Plot</h3>
        </div>
        <div class="card-body d-flex row ">
            <div class="col-6">
                <form action="{{ route('contact.apply_store',$id) }}" method="POST">
                    @method('post')
                    @csrf

                    <div class="row">
                       
                        <div class="col-lg-12">

                            <label for="exampleInputEmail1" class="form-label">Block :</label>
                            <br>
                            <select for="block" required id="block" name="block" style="width: 100%; padding:1%">
                                <option value="" selected disabled>Select Block</option>
                                @forelse ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>

                                @empty
                                @endforelse

                            </select>


                        </div>

                    </div>


                    <div class="row">
                        <div class="col-lg-12">

                            <label for="road" class="form-label">Road :</label>

                            {{-- <select id="road" class="form-control" style="width: 100%"> --}}

                            <select name="road" required id="road" style="width: 100%; padding:1%">
                                <option value="" selected disabled>Select Road</option>
                            </select>

                            {{-- </select> --}}
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12 mt-2">

                            <label for="plot" class="form-label">Plot :</label>

                            {{-- <select id="road" class="form-control" style="width: 100%"> --}}

                            <select name="plot" required id="plot" style="width: 100%; padding:1%">
                                <option value="" selected disabled>Select Plot</option>
                            </select>

                            {{-- </select> --}}
                        </div>

                    </div>

                    <div class="col-lg-12 mt-2">

                        <label for="plot_view" class="form-label">Available Plots:</label>

                        {{-- <select id="road" class="form-control" style="width: 100%"> --}}


                        <option style="font-size: 20px" value="" id="plot_view"></option>

                        {{-- </select> --}}
                    </div>

                    <div class="row">

                        <div class="col-lg-12 mt-2">

                            <label for="info" class="form-label">Plot Details :</label><br>

                            <div style="display: inline">

                                <a id="info"></a>

                            </div>

                        </div>


                    </div>

                    <!--For Image -->




                    <br>

                    <div class="row">
                        <div class="col-lg-12 mt-2">

                            <button type="submit" class="btn btn-primary">BOOK NOW</button>

                        </div>
                    </div>

                </form>
            </div>

            <div class="col-6">
                <div class="mt-2" style="">

                    <label for="img" class="form-label"></label><br>

                    <div style="display: inline">

                        <span id="img"></span>

                    </div>

                </div>
            </div>
        </div>
    </div>





    <script>
        $(document).ready(function() {

            $('#block').change(function(e) {

                let block_id = $(this).val();

                jQuery.ajax({
                    url: '/road',
                    type: 'post',
                    data: 'data=' + block_id + '&_token={{ csrf_token() }}',
                    success: function(result) {

                        jQuery('#road').html(result);
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#block').change(function(e) {

                let img_id = $(this).val();

                $.ajax({
                    type: 'post',
                    url: '/block_image',
                    dataType: 'json',
                    data: 'data=' + img_id + '&_token={{ csrf_token() }}',
                    success: function(response) {

                        let result = response;

                        console.log(result);



                        let data = `
                                   
                                <img style="display: block;margin-left: auto;margin-right: auto;max-width: 100%;height:auto;" src="{{ asset('storage/') }}/${result.block_info.image}" alt="">

                            `;


                        $('#img').html(data);

                    }
                });

            });
        });
    </script>


    <script>
        $(document).ready(function() {

            $('#road').change(function(e) {

                let road_id = $(this).val();

                // alert(road_id);

                $.ajax({
                    type: 'post',
                    url: '/getroad',
                    data: 'data=' + road_id + '&_token={{ csrf_token() }}',
                    success: function(result) {

                        $('#plot').html(result);

                    }
                });

            });

        });
    </script>


    <script>
        $(document).ready(function() {

            $('#road').change(function(e) {

                let road_id = $(this).val();

                // alert(road_id);

                $.ajax({
                    type: 'post',
                    url: '/plot_view',
                    data: 'data=' + road_id + '&_token={{ csrf_token() }}',
                    success: function(result) {

                        $('#plot_view').html(result);
                    }
                });

            });

        });
    </script>



    <script>
        $(document).ready(function() {

            $('#plot').change(function(e) {

                let $plot_id = $(this).val();

                $.ajax({
                    type: 'post',
                    url: '/plot_info',
                    dataType: 'json',
                    data: 'data=' + $plot_id + '&_token={{ csrf_token() }}',
                    success: function(response) {

                        let result = response;

                        console.log(result);



                        let data = `
                                    <p>Plot Num : <a>${result.plot_info.plot_num}</a></p>
                                    <p>Pot Size : <a>${result.plot_info.plot_size}</a></p>
                                    <p>Plot Type : <a>${result.plot_info.plot_type}</a></p>
                                    <p>Plot Price : <a>${result.plot_info.plot_price}</a></p>
                            `;


                        $('#info').html(data);

                    }
                });

            });
        });
    </script>




    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endsection
