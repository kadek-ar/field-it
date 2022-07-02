<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="/css/stylehome.css">
    <link rel="stylesheet" href="landingPage.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/customStyle.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/global_variables.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/book.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
    />
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('header_Page')</title>
    
    <style>
        .main-bg{
            /* background: #F5EEDC; */
            background: #DDDDDD;
        }
        .bg-main-green{
            background: #1A4D2E;
        }
        .text-main-green{
            color: #1A4D2E;
        }
        .bg-main-grey{
            background: #DDDDDD;
        }
        .max-w-799{
            max-width: 799px;
        }
        .bg-img-home{
            background-image: url('/img/Background.jpg')
        }
        .yellow-text{
            color: #F1D00A;
        }
    </style>
</head>
<body class="main-bg">
    @include('sweetalert::alert')
    <nav class="bg-main-green navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand text-white fw-bold d-flex align-items-baseline" href="/homepage">
                <div class="me-3 bg-white rounded p-1">
                    <img style="width: 47px;" src="/img/logops.png" alt="">
                </div>
                <span>Field-it</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-2">
                        <a class="nav-link fw-bold text-white" href="/field/list">Book</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link fw-bold text-white" href="/fieldsTo/order/list">Order List</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link fw-bold text-white" href="/newsHome">News</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link fw-bold text-white" href="/maps">Maps</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link fw-bold text-white" href="/about_us">About Us</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link fw-bold text-white" href="/owner">Create Field</a>
                    </li>


                    @auth
                        <li class="nav-item d-flex align-items-baseline">
                            <div class="dropdown">
                                <svg id="ddUser" xmlns="http://www.w3.org/2000/svg" class="text-white mt-2 bi bi-person-circle" width="26" height="26" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <ul id="ddUserBtn" class="dropdown-menu dropdown-menu-lg-end pb-0 overflow-hidden" aria-labelledby="dropdownMenuButton1">
                                    <li class="text-center"><span class="nav-link" >Welcome, {{ auth()->user()->name }}</span></li>
                                    <li class="text-center text-center bg-danger text-white">
                                        <form action="/logout" method="post">
                                            @csrf
                                            <li class="nav-item pb-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                                </svg>
                                                <button type="submit" class="btn text-white">Logout!</button>
                                            </li>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        </div>
                        

                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/">LOGIN</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
    <div class="mt-5 pt-4">
        @if(Auth::user()->status == 2)
            <h1 class="text-center">Sorry, you can't access to this page because your role is “Owner”!</h1>
        @else
            @yield('content')
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjmq12Yg6RU5UhDvdeBPlXcE6WUulIT40&callback=initMap"></script>
        @endif

    </div>
    
</body>
</html>