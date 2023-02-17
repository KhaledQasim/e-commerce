<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.jpg') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Jewelz') }}</title>






    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link rel="stylesheet" href="{{ asset('productpage.css') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <style>

        .small-img-group{
            display: flex;
            justify-content: space-between;
        }
        .small-img-col{
            flex-basis: 33%;
            cursor: pointer;
        }
        .sproduct select{
            display:block;
            padding: 5px 10px;
        }
        .sproduct input{
            width: 50px;
            height: 40px;
            padding-left: 10px;
            font-size: 16px;
            margin-right: 10px
        }
        .sproduct input:focus{
            outline: none
        }
        .buy-btn{
            border: 1.5px solid #ffffff;
            border-radius: 25px;
            text-align: center;
            padding: 0.45rem 0.8rem;
            outline: 0;
            margin-right: 0.2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        .buy-btn{
            background: rgb(8, 0, 255);
            color:rgb(255, 253, 253);
            opacity: 1;
            transition: 0.3s all;
        }




    </style>


    <!-- Scripts -->
    {{-- <script src="{{asset('app.js')}}"></script> --}}

    {{-- <script src="{{asset('script.js')}}"></script> --}}
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/JWZ_Logo.png') }}" alt="logo"  class="d-inline-block align-text-center">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                     <img src="{{ asset('images/user.png') }}">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
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
                            <span>{{ Cart::instance('default')->count() }}</span>
                        @endif
                    </a>
                </li>
                @endguest
              </ul>
            </div>
        </div>
    </nav>
</header>

<body>

    <section class="container sproduct my-5 pt-5">
        <div class="row mt-5">
            <div class="col-lg-5 col-md-12 col-12">
                <img class="img-fluid w-100 pb-1" src="{{ asset('storage/'.$product->image) }}" id="MainImg" alt="main image">
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="{{ asset('storage/'.$product->image) }}" width="100%" class="small-img" alt="main image">
                    </div>
                    @if ($product->images)
                         @foreach (json_decode($product->images, true) as $image)
                            <div class="small-img-col">
                                <img src="{{ asset('storage/'.$image) }}" width="100%" class="small-img" alt="gallery image">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <h6><a href="{{url('/')}}">Home</a> / <a href="{{url('/shop-'.$product->type)}}">{{ucfirst($product->type)}}</a></h6>
                <h1 class="py-4">{{$product->name}}</h1>
                <h2>{{$product->presentPrice()}}</h2>
                @if ($stockLevel == 'In Stock')
                    <h6 class="badge bg-success">{!! $stockLevel !!}</h6>
                @elseif($stockLevel == 'Low Stock')
                    <h6 class="badge bg-warning text-dark">{!! $stockLevel !!}</h6>
                @else
                    <h6 class="badge bg-danger">{!! $stockLevel !!}</h6>
                @endif

                @if ($product->quantity > 0)
                    @guest

                    @else
                    <form action="{{ route('cart.store', $product) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="buy-btn">Add to Cart</button>
                    </form>
                    @endguest
                @endif
                <h4 class= "mt-5 mb-5">{{$product->details}}</h4>
                <div class= "Product-info">
                    <p>{!! $product->description !!}
                    </p>
                        <li>Category: <span>{{ucfirst($product->type)}}</span></li>
                        <li>Shipping Area: <span>All over the world</span></li>
                        <li>Shipping fee: <span>Free</span></li>
                </div>
            </div>
        </div>

    </section>



    <script>


      var MainImg = document.getElementById('MainImg');
      var smallimg = document.getElementsByClassName('small-img')

     smallimg[0].onclick = function(){
        MainImg.src = smallimg[0].src;
     }
     smallimg[1].onclick = function(){
        MainImg.src = smallimg[1].src;
     }
     smallimg[2].onclick = function(){
        MainImg.src = smallimg[2].src;
     }
    </script>





</body>






<body class="d-flex flex-column min-vh-100">
    <footer class="site-footer sticky-bottom footer mt-auto py-3 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>ABOUT JEWELZ</h6>
                    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate velit esse.</p>
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
</body>



</html>




















