@extends('layouts.frontendapp')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zoomable Image</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-y: scroll;
            overflow-x: hidden;

        }

        #zoom-in,
        #zoom-out {
            position: absolute;
            font-size: 24px;
            color: #000000;
            cursor: pointer;
        }

        #zoom-in {
            top: 60rem;
            left: 72rem;
        }

        #zoom-out {
            top: 62rem;
            left: 72rem;
        }

        .image-container {
            margin: 30px 0px 0px 130px;
            width: 80%;
            height: 500px;
            overflow: scroll;
            display: flex;
            justify-content: center;
        }

        #zoomable-image {
             width: 100%;
             height: 85rem;
             transition: transform 0.2s;
             cursor: pointer;
        }

        .footer-item {
            height: 275px;
            width: 23%;
            color: #313131;
        }
        
        @media only screen and (max-width: 600px) {
         .footer-item{
            margin: 10px 0px 0 100px !important;
            width: 56%;
             }
        }

        .img-fluid {
            max-width: 25%;
            height: auto;
        }

        .navbar-brand {
            margin-right: -65rem;
        }
    </style>
    <!-- manu start  -->
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
            <div class="container-fluid">
                <a class="navbar-brand"><img class="img-fluid" src="{{ asset('images/logo1.jpeg') }}" alt=""></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active text-success" aria-current="page" href="#"><i class="fa-solid fa-house"></i>&nbsp;Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" href="#"><i class="fa-solid fa-address-card"></i>&nbsp;About us</a>
                        </li>
                        <!--<li class="nav-item dropdown">-->
                        <!--    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"-->
                        <!--        data-bs-toggle="dropdown" aria-expanded="false">-->
                        <!--        Link section-->
                        <!--    </a>-->
                        <!--    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">-->
                        <!--        <li><a class="dropdown-item" href="#">Action</a></li>-->
                        <!--        <li><a class="dropdown-item" href="#">Another action</a></li>-->
                        <!--        <li><a class="dropdown-item" href="#">Something else here</a></li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                        <li class="nav-item">
                            <a class="nav-link text-success" href="#" tabindex="-1" aria-disabled="true"><i class="fa-solid fa-address-book"></i>&nbsp;Contact us</a>
                        </li>
                    </ul>
                    <div class="d-flex gap-3">
                        <a class="text-decoration-none text-success" href={{route('login')}}><i class="fa-solid fa-right-to-bracket"></i>&nbsp;Login</a>
                        <!--<a class="text-decoration-none" href="#">Registration</a>-->
                    </div>
                </div>
            </div>
        </nav>
    </div>
    {{--  =============================================  --}}
    <div class="container mt-4 border rounded shadow">
        <div class="card-header m-auto text-center mt-1 border rounded-2">
            <h3>Find Your Plot</h3>
        </div>
        <div class="card-body d-flex row ">
            <div class="col-6">
                <form action="{{ route('book') }}" method="POST">
                    @method('post')
                    @csrf

                    <div class="row">
                       
                        <div class="col-lg-12">

                            @if (isset($project_name))
                            <div>
                             <b> Project Name :</b>  {{ $project_name->project_name }}
                            </div>
                            @else
                                
                            @endif
                           

                            <label for="exampleInputEmail1" class="form-label"><b>Block :</b></label>
                            <br>
                            <select class="form-control border rounded w-100 p-1" for="block" required id="block" name="block">
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

                            <label for="road" class="form-label"><b>Road :</b></label>

                            {{-- <select id="road" class="form-control" style="width: 100%"> --}}

                            <select class="form-control border rounded w-100 p-1" name="road" required id="road">
                                <option value="" selected disabled>Select Road</option>
                            </select>

                            {{-- </select> --}}
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12 mt-2">

                            <label for="plot" class="form-label"><b>Plot :</b></label>

                            {{-- <select id="road" class="form-control" style="width: 100%"> --}}

                            <select class="form-control border rounded w-100 p-1" name="plot" required id="plot">
                                <option value="" selected disabled>Select Plot</option>
                            </select>

                            {{-- </select> --}}
                        </div>

                    </div>

                    <div class="col-lg-12 mt-2">

                        <label for="plot_view" class="form-label"></label>

                        {{-- <select id="road" class="form-control" style="width: 100%"> --}}


                        <option style="font-size: 20px" value="" id="plot_view"></option>

                        {{-- </select> --}}
                    </div>

                    <div class="row">

                        <div class="col-lg-12 mt-2">

                            <label for="info" class="form-label"></label><br>

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

    {{--  footer part i have added   --}}
    {{--  ==============================================================  --}}
    <hr>
    <div class="d-flex justify-content-center">
        <h3>Our Project Map</h3>
    </div>
    <hr class="w-100 border border-dark container">
    <div>
        <div class="image-container">
            <img id="zoomable-image" src="{{ asset('images/Dakhina-City.jpg') }}" alt="Your Image">
        </div>
        <i id="zoom-in" class="fas fa-search-plus"></i>
        <i id="zoom-out" class="fas fa-search-minus"></i>
    </div>

    <div class="container">
        <div class="row">
            <div class="footer-item col-lg-3 col-sm-12 col-md-6 d-flex flex-column border rounded border-dark m-2 p-2 shadow bg-light">
                <span>About Us</span>
                <hr>
                <span>DAKHINA GLOBAL CONSULTANCY is one of the most popular student VISA Counseling firm in Bangladesh,
                    It was established in 2010, and operating since 2018.</span>
            </div>
            <div class="footer-item col-lg-3 col-sm-12 col-md-6 border rounded border-dark m-2 p-2 shadow bg-light">
                <span>Our Products</span>
                <hr>
                <span class="d-flex flex-column">
                    <a href="#"><i class="fa-solid fa-link"></i>&nbsp;link</a>
                    <a href="#"><i class="fa-solid fa-link"></i>&nbsp;link</a>
                    <a href="#"><i class="fa-solid fa-link"></i>&nbsp;link</a>
                    <a href="#"><i class="fa-solid fa-link"></i>&nbsp;link</a>
                    <a href="#"><i class="fa-solid fa-link"></i>&nbsp;link</a></span>
            </div>
            <div class="footer-item col-lg-3 col-sm-12 col-md-6 border rounded border-dark m-2 p-2 shadow bg-light">
                <span>Our Location Map</span>
                <span>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.3218720141617!2d90.37426517447294!3d23.80715078659687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c72a42f45c73%3A0x20c73d5f47a63fe8!2sShataj%20Soft!5e0!3m2!1sen!2sbd!4v1698555839613!5m2!1sen!2sbd"
                        width="240" height="218" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </span>
            </div>
            <div class="footer-item col-lg-3 col-sm-12 col-md-6 border rounded border-dark m-2 p-2 shadow bg-light">
                <span>CONTACT US</span>
                <hr>
                Dakhina Tower, Holding No-543/A (5th Floor), ECB Chattar Main Road, Dhaka Cantonment, Dhaka-1206.
                +88 01407 048191
                +88 01816 914270
                dakhinaedu@gmail.com
                support@dgcedn.com
            </div>
        </div>
    </div>
    <div class="border rounded mt-2 mb-2 shadow bg-success">
        <div class="d-flex justify-content-center">
        <span class="text-white"> &copy; <?php echo date("Y");?>| Design & Developed by Shataj Soft Ltd.</span>
        </div>
    </div>


    <script>
        const zoomableImage = document.getElementById('zoomable-image');
        const zoomControls = document.getElementById('zoom-controls');
        let currentScale = 1.0;
        const minScale = 1.0; // Minimum scale
        const maxScale = 10.0; // Maximum scale
        let isDragging = false;
        let initialX, initialY;
        let xOffset = 0;
        let yOffset = 0;
        document.getElementById('zoom-in').addEventListener('click', () => {
            currentScale += 0.2; // Increase the scale by 0.2 each time you click the zoom-in button
            if (currentScale > maxScale) {
                currentScale = maxScale;
            }
            zoomableImage.style.transform = `scale(${currentScale}) translate(${xOffset}px, ${yOffset}px)`;
        });

        document.getElementById('zoom-out').addEventListener('click', () => {
            currentScale -= 0.2; // Decrease the scale by 0.2 each time you click the zoom-out button
            if (currentScale < minScale) {
                currentScale = minScale;
            }
            zoomableImage.style.transform = `scale(${currentScale}) translate(${xOffset}px, ${yOffset}px)`;
        });

        zoomableImage.addEventListener('mousedown', (e) => {
            isDragging = true;
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });
        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                xOffset = e.clientX - initialX;
                yOffset = e.clientY - initialY;
                zoomableImage.style.transform = `scale(${currentScale}) translate(${xOffset}px, ${yOffset}px)`;
            }
        });
    </script>




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
                                    <b>Plot Details :</b>
                                    <hr>
                                    <p>Plot Num : <a>${result.plot_info.plot_num}</a></p>
                                    <p>Plot Size : <a>${result.plot_info.plot_size}</a></p>
                                    <p>Plot Type : <a>${result.plot_info.plot_type}</a></p>
                                    <p>Facing : <a>${result.plot_info.facing}</a></p>
                            `;


                        $('#info').html(data);

                    }
                });

            });
        });
    </script>



    <script src="https://kit.fontawesome.com/d13ba7a991.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endsection
