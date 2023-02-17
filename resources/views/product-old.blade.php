@extends('layouts.app')

@section('content')

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" src="https://i.imgur.com/Dhebu4F.jpg" width="250" alt="main-image" /> </div>
                            <div class="thumbnail text-center"> <img onclick="change_image(this)" src="https://i.imgur.com/Rx7uKd0.jpg" width="70"> <img onclick="change_image(this)" src="https://i.imgur.com/Dhebu4F.jpg" width="70"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <a href="{{ route("shopIndex", $product->type)}}"><i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span></a> </div> <a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart text-muted"></i></a>
                            </div>
                            <div class="mt-4 mb-3"> <h4> <span class="text-uppercase brand">{{$product->name}}</span> </h4>
                                <h6 class="text">{{$product->details}}</h6>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price">{{$product->presentPrice()}}</span>

                                </div>
                            </div>
                            <p class="about">{!! $product->description !!}</p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <button type="submit" class="button button-plain">Add to Cart</button>
                            </form>
                            <div class="cart mt-4 align-items-center"> <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button>  </div>
                            <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
{{-- This function diplays the product image that is clicked on--}}
<script>
    function change_image(image){

                 var container = document.getElementById("main-image");

                container.src = image.src;
            }



            document.addEventListener("DOMContentLoaded", function(event) {







            });
</script>

