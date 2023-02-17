{{-- @extends('layouts.app')


@section('content')
<script src="https://js.stripe.com/v3/"></script>
<link rel="stylesheet" href="{{ asset('checkoutpage.css') }}">

<div class="row">
    <div class="col-75">
        <div class="container">
            <form action="/checkout_page.php">
                <div class="row">
                    <h2 id="mainheader">Checkout</h2>
                    <h3 id="billingheader">Billing Address</h3>
                    <label for="fullname" id="namelabel"><i class="fa fa-user"></i>Full Name</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Richard Roe">
                    <label for="email" id="emaillabel"><i class="fa fa-email"></i>Email</label>
                    <input type="email" id="email" name="email" placeholder="richard@example.com">
                    <label for="address" id="addresslabel"><i class="fa fa-address"></i>Address</label>
                    <input type="text" id="address" name="address" placeholder="123 Fifth Avenue">
                    <label for="city" id="citylabel"><i class="fa fa-city"></i>City</label>
                    <input type="text" id="city" name="city" placeholder="London">

                    <div class="row">
                        <div class="col-50">
                            <label for="county" id="countylabel">County</label>
                            <input type="text" id="county" name="county" placeholder="West Midlands">
                        </div>
                        <div class="col-50">
                            <label for="postcode" id="postlabel">Postcode</label>
                            <input type="text" id="postcode" name="postcode" placeholder="B4 7ET">
                        </div>
                    </div>

                    <div class="col-50">
                        <h3 id="paymentheader">Payment</h3>
                        <label for="acceptedcards">Accepted Cards</label>
                        <div class="icon-container">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                        </div>
                        <label for="cardname" id="cardnamelabel">Name on Card</label>
                        <input type="text" id="cardname" name="cardname" placeholder="Richard Roe">
                        <label for="cardno" id="cardnolabel">16-digit Number</label>
                        <input type="text" id="cardno" name="cardnumber" placeholder="1111-2222-3333-4444">
                        <label for="expmonth" id="expmonthlabel">Expiry Month</label>
                        <input type="text" id="expmonth" name="expmonth" placeholder="November">

                        <div class="row">
                            <div class="col-50">
                                <label for="expyear" id="expyearlabel">Expiry Year</label>
                                <input type="text" id="expyear" name="expyear" placeholder="2025">
                            </div>
                            <div class="col-50">
                                <label for="cvv" id="cvvlabel">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="123">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name_on_card">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                        </div>

                        <div class="form-group">
                            <label for="card-element">
                              Credit or debit card
                            </label>
                            <div id="card-element">
                              <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="spacer"></div>

                        <button type="submit" id="complete-order" class="button-primary full-width">Complete Order</button>


                    </form>
                    </div>
                </div>

                <label>
                    <input type="checkbox" checked="checked" name="sameaddress"> Shipping Address same as Billing
                </label>
                <input type="submit" value="Continue to checkout" class="btn" id="checkoutbtn">
            </form>
        </div>
    </div>

    <div class="col-25">
        <div class="container">
            {{-- Size still does not display will be added in later for now frontend make the name and Quantity (quantity for now is always 1) match up correctly --}}
            {{-- <h4>Name Quantity Size
                <span class="price" style="color:black">
                    <i class="fa fa-shopping-cart"></i>
                    <b>{{ Cart::instance('default')->count() }}</b>
                </span>
            </h4>
            @foreach (Cart::content() as $item)
            <p><a href="#">{{ $item->model->name }}</a> <a href=""><img style="width: 5rem; height:5rem" class="img-fluid" src="images/wedding.jpg" alt="image"></a><span class="price">{{ $item->model->presentPrice() }}</span><span style="padding: 1rem" class="product-quantity">{{ $item->qty }}</span><span>Size</span></p>
            @endforeach
            <hr>
            <p>Total With VAT(20%) <span class="price" style="color:black"><b>{{ presentPrice(Cart::total()) }}</b></span></p>
        </div>
    </div>
</div> --}}









{{-- <script>
    (function(){
        // Create a Stripe client
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        // Create an instance of Elements
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
          base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
              color: '#aab7c4'
            }
          },
          invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
          }
        };
        // Create an instance of the card Element
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });
        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
          var displayError = document.getElementById('card-errors');
          if (event.error) {
            displayError.textContent = event.error.message;
          } else {
            displayError.textContent = '';
          }
        });
        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
          event.preventDefault();
          // Disable the submit button to prevent repeated clicks
          document.getElementById('complete-order').disabled = true;
          var options = {
            name: document.getElementById('name_on_card').value,
            address_line1: document.getElementById('address').value,
            address_city: document.getElementById('city').value,
            address_state: document.getElementById('province').value,
            address_zip: document.getElementById('postalcode').value
          }
          stripe.createToken(card, options).then(function(result) {
            if (result.error) {
              // Inform the user if there was an error
              var errorElement = document.getElementById('card-errors');
              errorElement.textContent = result.error.message;
              // Enable the submit button
              document.getElementById('complete-order').disabled = false;
            } else {
              // Send the token to your server
              stripeTokenHandler(result.token);
            }
          });
        });
    })();
</script>

@endsection --}}

@extends('layouts.app')

<style>
    .checkout-heading{
        padding-top: 32px;
    }


    .featured-section {
        padding: 50px 0;
    }



    h1.checkout-heading {
        margin-top: 40px;
    }

    .checkout-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 30px;
    margin: 40px auto 80px;
    }

    .checkout-section .checkout-table-container {
    margin-left: 124px;
    }

    .checkout-section h2 {
    margin-bottom: 28px;
    }

    .checkout-section .checkout-table-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #919191;
    padding: 14px 0;
    }

    .checkout-section .checkout-table-row:last-child {
    border-bottom: 1px solid #919191;
    }

    .checkout-section .checkout-table-row .checkout-table-row-left,
    .checkout-section .checkout-table-row .checkout-table-row-right {
    display: flex;
    justify-content: space-between;
    align-items: center;
    }

    .checkout-section .checkout-table-row .checkout-table-row-left {
    width: 75%;
    }

    .checkout-section .checkout-table-row .checkout-table-img {
    max-height: 60px;
    }

    .checkout-section .checkout-table-row .checkout-table-description {
    color: #919191;
    }

    .checkout-section .checkout-table-row .checkout-table-price {
    padding-top: 6px;
    }

    .checkout-section .checkout-table-row .checkout-table-quantity {
    border: 1px solid #919191;
    padding: 4px 12px;
    margin-right: 5px;
    }

    .checkout-section .checkout-totals {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid #919191;
    padding: 18px 0;
    line-height: 2;
    }

    .checkout-section .checkout-totals .checkout-totals-right {
    text-align: right;
    }

    .checkout-section .checkout-totals .checkout-totals-total {
    font-weight: bold;
    font-size: 22px;
    line-height: 2.2;
    }
    .StripeElement {
    background-color: white;
    padding: 16px 16px;
    border: 1px solid #ccc;

    }

    .StripeElement--invalid {
    border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
    }

    #card-errors {
    color: #fa755a;
    }

    #email #name #address #city #province #postalcode #phone{
        border: 1px solid #ebb000;
    }

</style>
<script src="https://js.stripe.com/v3/"></script>
@section('content')

    <div class="container">

        @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success" style="padding-top: 10rem">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger"  style="margin-top: 10rem">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="checkout-heading stylish-heading">Checkout</h1>
        <div class="checkout-section">
            <div>
                {{-- <form action="{{ route('checkout.store') }}" method="POST" id="payment-form"> --}}
                {{-- action="{{ route('checkout.index') }}" --}}
                {{-- App\Http\Controllers\CheckoutController@checkout --}}
                <form action="{{route('strip.session')}}" id="payment-form" class="payment-form" method="POST">
                    {{ csrf_field() }}
                    <h2>Billing Details</h2>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        @if (auth()->user())
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                        @else
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="half-form">
                        <div class="form-group">
                            <label for="postalcode">Postal Code</label>
                            <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="spacer"></div>

                    <h2>Payment</h2>

                    <input type="hidden" name = "payment_method_id" id ="payment_method_id" class="payment_method_id" value ="" >
                    <div class="form-group">
                        <div class="form-group">
                            <label for="name_on_card">Name On Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="" required>
                        </div>
                        <label for="card-element">
                          Credit or debit card
                        </label>
                        <div id="card-element" class="card-element">
                          <!-- a Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors -->
                        <div id="card-errors" class="card-errors" role="alert"></div>
                    </div>

                    <div class="spacer"></div>

                    <button type="submit" id="confirm-purchase" style="margin-top: 1rem" class="btn btn-primary full-width">Pay Now</button>


                </form>


            </div>



            <div class="checkout-table-container">
                <h2>Your Order</h2>

                <div class="checkout-table">
                    @foreach (Cart::content() as $item)
                    <div class="checkout-table-row">
                        <div class="checkout-table-row-left">
                            <img src="{{asset('storage/'.$item->model->image)}}" alt="{{('storage/'.$item->model->image)}}" class="checkout-table-img">
                            <div class="checkout-item-details">
                                <div class="checkout-table-item">{{ $item->model->name }}</div>
                                <div class="checkout-table-description">{{ $item->model->details }}</div>
                                <div class="checkout-table-price">{{ $item->model->presentPrice() }}</div>
                            </div>
                        </div> <!-- end checkout-table -->

                        <div class="checkout-table-row-right">
                            <div class="checkout-table-quantity">{{ $item->qty }}</div>
                        </div>
                    </div> <!-- end checkout-table-row -->
                    @endforeach

                </div> <!-- end checkout-table -->

                <div class="checkout-totals">
                    <div class="checkout-totals-left">
                        Subtotal <br>

                        Tax ({{config('cart.tax')}}%)<br>
                        <span class="checkout-totals-total">Total</span>

                    </div>

                    <div class="checkout-totals-right">
                        {{ presentPrice(Cart::subtotal()) }} <br>

                        {{ presentPrice(Cart::tax()) }} <br>
                        <span class="checkout-totals-total">{{ presentPrice(Cart::total()) }}</span>

                    </div>
                </div> <!-- end checkout-totals -->
            </div>

        </div> <!-- end checkout-section -->
    </div>
<script>
    var stripe = Stripe('pk_test_51M9mb6BlVQ0NJoLd98m5VVZlPMUpv4lcTXivXFxCRi2rdEctAO6QjaUCHZ7uQVkibyVB0Tg4braHm0koCQClRaGA00KYKbXOyd');

        var elements = stripe.elements();

        var style = {
            base: {
                color:"#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            },
        };

        var cardElement = elements.create('card', {
            style: style,
            hidePostalCode: true
        });
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event){
            event.preventDefault();

            stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {

                name :'Jenny Rosen',
                },
            }).then(stripePaymentMethodHandler);
        });

        function stripePaymentMethodHandler(result) {
            if (result.error) {

            } else {
                document.getElementById('confirm-purchase').disabled = true;
                document.getElementById('payment_method_id').value = result.paymentMethod.id
                form.submit();
            }
        }


</script>



@endsection



