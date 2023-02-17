<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.jpg') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jewelz') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <!-- Scripts -->
    <script src="{{asset('app.js')}}"></script>
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<header class="app-navbar-header">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/JWZ_Logo.png') }}" alt="logo" class="d-inline-block align-text-center">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/shop-ring') }}">RINGS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/shop-necklace') }}">NECKLACES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/shop-bracelet') }}">BRACELETS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/shop-earring') }}">EARRINGS</a>
                    </li>
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ asset('images/user.png') }}">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <li><a class="dropdown-item" href="{{url('myProfile')}}">My Profile</a></li>
                            {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                            {{-- follow this formate to add more sections to the nav item dropdown button --}}
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}"><img src="{{ asset('images/cart.png') }}">
                            @if (Cart::instance('default')->count() > 0)
                            <span style="color: #f7c02b; size:20px">{{ Cart::instance('default')->count() }}</span>
                            @endif
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>


<div>
    <main>
        @yield('content')
    </main>
</div>

<body class="d-flex flex-column min-vh-100">
    <footer class="site-footer sticky-bottom footer mt-auto py-3 bg-dark app-footer-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>ABOUT JEWELZ</h6>
                    <p class="text-justify">
                        At our store, you will find the best jewelry at very reasonable prices. Our huge range includes
                        diamonds, gold and silver jewellery as well as special pieces made. All our products are
                        handmade by skilled craftsmen in our UK factories using traditional techniques passed down
                        through generations. We combine modern design with sustainability. We use recycled silver and
                        ethical diamonds so that our helix earrings, dainty bracelets, and curb chains look great,
                        whilst keeping the planet in mind.
                    </p>
                </div>
                <br>
                <div class="col-xs-6 col-md-3">
                    <h6>CATEGORIES</h6>
                    <ul class="footer-links">
                        <li>
                            <a href="{{ url('/#necklaces') }}">NECKLACES</a>
                        </li>
                        <li><a href="{{ url('/#rings') }}">RINGS</a></li>
                        <li>
                            <a href="{{ url('/#bracelets') }}">BRACELETS</a>
                        </li>
                        <li><a href="{{ url('/#earrings') }}">EARRINGS</a></li>
                    </ul>
                </div>
                <br>
                <div class="col-xs-6 col-md-3">
                    <h6>DISCOVER JEWELZ</h6>
                    <ul class="footer-links">
                        <li><a href="{{ url('/contact') }}">ABOUT US</a></li>
                        <li><a href="{{ url('/contact') }}#contact">CONTACT US</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by
                        <a href="{{ url('/') }}">Jewelz</a>.
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li><a class="facebook" href="{{ url('/') }}"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="{{ url('/') }}"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="instagram" href="{{ url('/') }}"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <body class="d-flex flex-column min-vh-100">


</html>
