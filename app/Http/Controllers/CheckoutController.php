<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
    }

    public function done()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function success()
    {
        return "It workss";
    }

    public function session()
    {

        function calculateOrderAmount(): int {
            return Cart::total();
        }
         \Stripe\Stripe::setApiKey(config(key: 'stripe.sk'));
         $session = \Stripe\Checkout\Session::create([
             'line_items' => [
                 [
                     'price_data' => [
                         'currency' => 'gbp',
                         'product_data' => [
                             'name' => 'Total Amount With VAT',
                         ],
                         'unit_amount' => calculateOrderAmount(), //pound 5
                     ],
                     'quantity' => 1,
                 ],
             ],
             'mode' => 'payment',
             'success_url' => route(name:'strip.success'), //route to success method in this controller
             'cancel_url' => route(name:'checkout.index')
         ]);

         return redirect()->away($session->url);
    }

}
