
<!DOCTYPE html>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
        <!-- BEGIN: CSS Assets-->
        
        <link rel="stylesheet" href="{{ asset('backend/dist/css/app.css') }}"/>
        <link rel="stylesheet" href="{{ asset('backend/dist/css/style.css') }}"/>
        @stack('customjs')
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="main">
        <div class="d-flex">
             <!-- BEGIN: Side Menu -->
            @include('layouts.backendsideber')
                <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb me-auto d-none d-sm-flex"> <a href="index.html">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="index.html" class="breadcrumb--active">Dashboard</a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="intro-x position-relative me-3 me-sm-6">
                       @yield('search')
                       @yield('search_to')
                        <a class="notification d-sm-none" href="index.html"> <i data-feather="search" class="notification__icon dark-text-gray-300"></i> </a>
                    </div>
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                    <div class="intro-x dropdown me-auto me-sm-6">
                        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-bs-toggle="dropdown"> <i data-feather="bell" class="notification__icon dark-text-gray-300"></i> </div>
                        <div class="notification-content pt-2 dropdown-menu">
                            <div class="notification-content__box dropdown-content">
                                <div class="notification-content__title dark-text-gray-300">Notifications</div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8">
                        <div class="dropdown-toggle w-8 h-8 rounded-pill overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-bs-toggle="dropdown">
                            <img alt="Rubick Tailwind HTML Admin Template" src="https://api.dicebear.com/7.x/initials/svg?seed={{ Auth::user()->name }}">
                        </div>
                        <div class="dropdown-menu w-56">
                            <ul class="dropdown-content bg-theme-26 dark-bg-dark-6 text-white">
                                <li class="p-2">
                                    <div class="fw-medium text-white">{{ Auth::user()->name }}</div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-theme-27 dark-border-dark-3">
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="user" class="w-4 h-4 me-2"></i> Profile </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-theme-27 dark-border-dark-3">
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> <i data-feather="toggle-right" class="w-4 h-4 me-2"></i>
                              
                                     {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST" class="d-none">
                                     @csrf
                                 </form>
                              
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>


                @yield('content')
            </div>
            <!-- END: Content -->
        </div>

        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG7gNHAhDzgYmq4-EHvM4bqW1DNj2UCuk&libraries=places"></script>
      
        <script src="{{ asset('backend/dist/js/app.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <!-- END: JS Assets-->
        <script src="https://kit.fontawesome.com/d13ba7a991.js" crossorigin="anonymous"></script>
        @stack('customjs')
    </body>
</html>