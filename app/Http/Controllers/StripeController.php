<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Shop;
use App\Models\helpers;
use App\Models\OrderProduct;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        return view('checkout');
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



        return view('thanks');
    }

     public function session(Request $request)
    {
        // \Stripe\Stripe::setApiKey(config(key:'stripe.sk'));
        \Stripe\Stripe::setApiKey('sk_test_51M9mb6BlVQ0NJoLd0DjB7KpjSN8VGT8zkwWje0Zwxln3B3TzWyw3EgFuAV26aYpBEiZSpjL06QBDnxi6AvICfRd600vQF9ibXN');
        function calculateOrderAmount(): int {
            return Cart::instance('default')->total();
        }

        $request->validate([
            'payment_method_id' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255'
        ]);



        try {
            if($request->payment_method_id){
                $intent = \Stripe\PaymentIntent::create([
                    'payment_method' => $request->payment_method_id,
                    'amount' => calculateOrderAmount(),
                    'currency' => 'gbp',
                    'confirmation_method' => 'manual',
                    'confirm' => true,

                ]);
            }





            $order = $this->addToOrdersTables($request, null);

            $this->decreaseQuantities();

            Cart::instance('default')->destroy();
            return redirect()->route('confirmation.index');
        } catch(\Stripe\Exception\ApiErrorException $e){
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
            ([

            'error' => $e->getMessage()
            ]);
        }






    }
    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_subtotal' => Cart::instance('default')->subtotal(),
            'billing_tax' => Cart::instance('default')->tax(),
            'billing_total' => Cart::instance('default')->total(),
            'error' => $error,
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }


    protected function decreaseQuantities(){
        foreach (Cart::content() as $item) {
            $product = Shop::find($item->model->id);

            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
    }




    // public function session()
    // {


    //     // This is your test secret API key.
    //     \Stripe\Stripe::setApiKey(config(key: 'stripe.sk'));
    //     $intent = null;
    //     function calculateOrderAmount(): int {
    //         // Replace this constant with a calculation of the order's amount
    //         // Calculate the order total on the server to prevent
    //         // people from directly manipulating the amount on the client
    //         return 1400;
    //     }

    //     header('Content-Type: application/json');

    //     try {
    //         // retrieve JSON from POST body
    //         $jsonStr = file_get_contents('php://input');
    //         $jsonObj = json_decode($jsonStr);

    //         // Create a PaymentIntent with amount and currency
    //         $paymentIntent = \Stripe\PaymentIntent::create([
    //             'amount' => calculateOrderAmount(),
    //             'currency' => 'gbp',
    //             // 'confirmation_method' => 'manual',
    //             // 'confirm' => true,
    //             'automatic_payment_methods' => [
    //                 'enabled' => true,
    //             ],
    //         ]);

    //         $output = [
    //             'clientSecret' => $paymentIntent->client_secret,
    //         ];

    //         echo json_encode($output);
    //     } catch (Error $e) {
    //         http_response_code(500);
    //         echo json_encode(['error' => $e->getMessage()]);
    //     }
    // }
}



