<?php


namespace App\Http\Controllers;
use DB;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message', 'Item Has Been Removed!');
    }


    /**
     * @witch item from Saved for later to Cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($id)
    {
        $item=Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already In Your Cart!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Shop');

        return redirect()->route('cart.index')->with('success_message', 'Item Has Been Moved To Cart!');
    }
}
