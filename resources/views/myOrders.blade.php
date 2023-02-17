@extends('layouts.app')

@section('content')


<head>
    <link rel="stylesheet" href="{{ asset('myProfile.css') }}" />
</head>

<body class="d-flex flex-column min-vh-100">
    <section id="banner" class="my-5 py-4">
        <div class="container-flex">
            <h5 class="pt-3 title-text">Welcome back, {{ Auth::user()->name }} </h5>
        </div>
    </section>
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

    <section id="list-banner" class="container-flex mb-3 ">
        <a class="btn btn-bar btn-live mr-5" href="{{url('myOrders')}}">My Orders</a>
        <a class="btn btn-bar ml-5" href="{{url('/myProfile')}}">My Profile</a>
    </section>

    <div class="container">
        <div class="row">
            @foreach ( $orders as $order)
            <div class="card mb-3">
                <div class="card-header">
                    <div class="order-header-items">
                        <div>Order Placed: <p> {{$order->created_at}}</p>
                        </div>
                        <div>Order ID: <p> {{$order->id}}</p>
                        </div>
                        <div>Total: <p>{{presentPrice($order->billing_total)}}</p>
                        </div>
                        <div><a href="{{ route('orders.show', $order->id) }}">| Click For Order Details |</a></div>
                    </div>
                </div>
                @foreach ( $order->products as $product )

                    <div class="card-body">
                        <div class="order-product-item">
                            <div><img src="{{ asset('storage/'.$product->image) }}" alt="gallery image" class="order-img">
                                <p>{{$product->name}}</p>
                                <div>{{presentPrice($product->price)}}</div>
                                <div>Quantity Bought: {{$product->pivot->quantity}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
            </div>
        </div>
    </body>
    @endsection
