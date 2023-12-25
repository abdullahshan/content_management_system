

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{ asset('backend/dist/css/login.css') }}"/>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo1.jpeg') }}">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="container bg-white">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 border margin-t rounded-3 border-style shadow bg-light">
                <div class="row border border-dark rounded-3 p-1 style-box" id="border-all" >
                    <div class="d-flex justify-content-center fs-1 fw-bold border rounded">Login</div>

                    <div class="col-lg-6 col-sm-12 col-md-12" id="mediaquare-img" ><img class="image-size" src="{{ asset('images/login.gif') }}" alt="logo"></div>
                    <!-- login form start hrer  -->
                    <div class="col-lg-6 col-sm-12 col-md-12 border" id="mediaquare-form" >
                        <div class="mt-5">
                            <form class="w-75 ms-2 h-auto" action="{{ route('login') }}" method="POST">
                             @csrf
                             
                                <div class="input-container">
                                    <i class="fa fa-user icon"></i>
                                    <input name="email" value="{{ old('email') }}" class="input-field form-control" type="text" placeholder="Username">
                                </div>
                                    @if (Session::has('message'))
                                    <div><span class="" style="color:red;">
                                        {{ Session::get('message') }}</span></div>
                                    @endif

                                
                                <div class="input-container">
                                    <i class="fa fa-key icon"></i>
                                    <input name="password" class="input-field form-control" type="password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn-style mb-2 form-control">Login</button>
                                </div>
                               
                                <div class="d-flex justify-content-center "></div>
                            </form>
                        </div>
                    </div>
                    <!-- login form end hrer  -->
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    <script src="https://kit.fontawesome.com/d13ba7a991.js" crossorigin="anonymous"></script>
</body>
</html>








