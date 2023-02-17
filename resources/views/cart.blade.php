<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');body{background-color: #eeeeee;font-family: 'Open Sans',serif;font-size: 14px}.container-fluid{margin-top:0px}.card-body{-ms-flex: 1 1 auto;flex: 1 1 auto;padding: 1.40rem}.img-sm{width: 80px;height: 80px}.itemside .info{padding-left: 15px;padding-right: 7px}.table-shopping-cart .price-wrap{line-height: 1.2}.table-shopping-cart .price{font-weight: bold;margin-right: 5px;display: block}.text-muted{color: #969696 !important}a{text-decoration: none !important}.card{position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0,0,0,.125);border-radius: 0px}.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}.dlist-align{display: -webkit-box;display: -ms-flexbox;display: flex}[class*="dlist-"]{margin-bottom: 5px}.coupon{border-radius: 1px}.price{font-weight: 600;color: #212529}.btn.btn-out{outline: 1px solid #fff;outline-offset: -5px}.btn-main{border-radius: 0px;text-transform: capitalize;font-size: 15px;padding: 10px 19px;cursor: pointer;color: #fff;width: 100%}.btn-light{color: #ffffff;background-color: #F44336;border-color: #f8f9fa;font-size: 12px}.btn-light:hover{color: #ffffff;background-color: #F44336;border-color: #F44336}.btn-apply{font-size: 11px}.title{font-weight: 600; text-decoration: underline;}.btn-sec{background-color: #dbab27; width: 100%;}.btn-purchase{background-color: #f7c02b;}button{border: 0px;}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="{{ asset('favicon.jpg') }}">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Jewelz') }}</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>
<header class="app-navbar-header">
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
                            <img src="{{ asset('images/user.png') }}" >
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
<body>
    @guest
    <h1>Login to view cart<h1>
        @else

        <div style="margin-top: 5rem; margin-bottom: 2rem" class="container-fluid">
            <div class="row">
                <aside class="col-lg-9">
                    @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                    @endif

                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <h1 class="title">My Cart:</h1>
                    <div>


                        @if (Cart::count() > 0)
                        <div class="card">

                            <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>
                            <div class="table-responsive">
                                <table class="table table-borderless table-shopping-cart">
                                    <thead class="text-muted">
                                        <tr class="small text-uppercase">
                                            <th scope="col">Product</th>
                                            <th scope="col" width="120">Quantity</th>
                                            <th scope="col" width="120">Price</th>
                                            <th scope="col" class="text-right d-none d-md-block" width="200"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::content() as $item)
                                        <tr>
                                            <td>
                                                <figure class="itemside align-items-center">
                                                    <div class="aside"><img src="{{asset('storage/'.$item->model->image)}}" alt="Cart item picture" class="img-sm"></div>
                                                    <figcaption class="info"> <a href="{{ route('shop.show', $item->name) }}" class="title text-dark" data-abc="true">{{ $item->name }}</a>
                                                        {{-- <p class="text-muted small">SIZE: L </p> --}}
                                                    </figcaption>
                                                </figure>
                                            </td>

                                            <td> <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                                @for ($i = 1; $i < 5 + 1 ; $i++)
                                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select></td>

                                            <td>
                                                <div class="price-wrap"> <var class="price">{{ presentPrice($item->subtotal) }}</var></div>
                                            </td>
                                            <td class="text-right d-none d-md-block">
                                                <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                                    {{ csrf_field() }}

                                                    <button type="submit" data-original-title="Save to Wishlist" data-abc="true" class="cart-options btn btn-light"><i class="fa fa-heart"></i></button>
                                                </form>
                                                <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" data-abc="true" style="margin-top: 1rem"  class="cart-options btn btn-light">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        {{-- <tr>
                                            <td>
                                                <figure class="itemside align-items-center">
                                                    <div class="aside"><img src="https://i.imgur.com/hqiAldf.jpg" class="img-sm"></div>
                                                    <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">Flower Formal T-shirt</a>
                                                        <p class="text-muted small">SIZE: L <br> Brand: ADDA </p>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td> <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select> </td>
                                            <td>
                                                <div class="price-wrap"> <var class="price">$15</var> <small class="text-muted"> $12 each </small> </div>
                                            </td>
                                            <td class="text-right d-none d-md-block"> <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip" data-abc="true"> <i class="fa fa-heart"></i></a> <a href="" class="btn btn-light btn-round" data-abc="true"> Remove</a> </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="card">
                                <h4>No Items In Shopping cart</h4>
                            </div>
                        @endif
                        </div>
                    </aside>



                    <aside class="col-lg-3">
                        {{-- <div class="card mb-3">
                            <div class="card-body">
                                <form>
                                    <div class="form-group"> <label>Have coupon?</label>
                                        <div class="input-group"> <input type="text" class="form-control coupon" name="" placeholder="Coupon code"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt style="margin-right:10px">Price:</dt>
                                    <dd class="text-right ml-3"> {{ presentPrice(Cart::subtotal()) }}</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt style="margin-right: 10px">20% VAT:</dt>
                                    <dd class="text-right ml-3">{{ presentPrice(Cart::tax()) }}</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt style="margin-right: 10px">Price With VAT:</dt>
                                    <dd class="text-right text-dark b ml-3"><strong>{{ presentPrice(Cart::total()) }}</strong></dd>
                                </dl>
                                <hr>
                                @if (Cart::count() > 0)
                                <a href="{{ route('checkout.index') }}"><button href="{{ route('checkout.index') }}" class="btn-purchase btn-out btn-main mt-2" data-abc="true"> Make Purchase </button></a>
                                @endif
                                <a href="{{ url('/') }}"><button href="{{ url('/') }}" class="btn-sec btn-out btn-main mt-2" data-abc="true">Continue Shopping</button></a>
                            </div>
                        </div>
                    </aside>
                    <aside class="col-lg-9">
                        <h1 style="margin-top: 1rem" class="title">My WishList:</h1>
                        @if (Cart::instance('saveForLater')->count() > 0)
                        <div class="card">
                            <h1>{{ Cart::instance('saveForLater')->count() }} item(s) In WishList</h1>
                            <div class="table-responsive">
                                <table class="table table-borderless table-shopping-cart">
                                    <thead class="text-muted">
                                        <tr class="small text-uppercase">
                                            <th scope="col">Product</th>
                                            <th scope="col" class="text-right d-none d-md-block" width="200"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('saveForLater')->content() as $item)
                                        <tr>
                                            <td>
                                                <figure class="itemside align-items-center">
                                                    <div class="aside"><img src="{{asset('storage/'.$item->model->image)}}" alt="wishlist picture" class="img-sm"></div>
                                                    <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">{{$item->name}}</a>
                                                        {{-- <p class="text-muted small">SIZE: L</p> --}}
                                                    </figcaption>
                                                </figure>
                                            </td>



                                            <td>
                                                <div class="price-wrap"> <var class="price">{{$item->model->presentPrice()}}</var></div>
                                            </td>
                                            <td class="text-right d-none d-md-block">
                                                <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" data-abc="true" class="btn btn-light">Remove</button>
                                                </form>
                                                <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                                    {{ csrf_field() }}

                                                    <button type="submit" data-abc="true" style="margin-top: 1rem" class="btn btn-light">Move to Cart</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        {{-- <tr>
                                            <td>
                                                <figure class="itemside align-items-center">
                                                    <div class="aside"><img src="https://i.imgur.com/hqiAldf.jpg" class="img-sm"></div>
                                                    <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">Flower Formal T-shirt</a>
                                                        <p class="text-muted small">SIZE: L <br> Brand: ADDA </p>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td> <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select> </td>
                                            <td>
                                                <div class="price-wrap"> <var class="price">$15</var> <small class="text-muted"> $12 each </small> </div>
                                            </td>
                                            <td class="text-right d-none d-md-block"> <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip" data-abc="true"> <i class="fa fa-heart"></i></a> <a href="" class="btn btn-light btn-round" data-abc="true"> Remove</a> </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @else
                        <div class="card">
                            <h4>No Items In WishList</h4>
                        </div>
                        @endif
                    </aside>
                </div>
            </div>


            @endguest




</body>
<script>
    (function(){
        const classname = document.querySelectorAll('.quantity')

        Array.from(classname).forEach(function(element) {
            element.addEventListener('change', function() {
                const id = element.getAttribute('data-id')
                const productQuantity = element.getAttribute('data-productQuantity')

                axios.patch(`<?php echo URL::current(); ?>/${id}`, {
                    quantity: this.value,
                    productQuantity: productQuantity
                })
                .then(function (response) {
                    // console.log(response);
                    window.location.href = '{{ route('cart.index') }}'
                })
                .catch(function (error) {
                    // console.log(error);
                    window.location.href = '{{ route('cart.index') }}'
                });
            })
        })
    })();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>

<body class="d-flex flex-column min-vh-100">
    <footer class="site-footer sticky-bottom footer mt-auto py-3 bg-dark app-footer-footer">
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
                        <li><a href="{{ url('/about') }}">ABOUT US</a></li>
                        <li><a href="{{ url('/contact') }}">CONTACT US</a></li>
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
