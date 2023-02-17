<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Shop;
use App\helpers;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $products = Shop::where('type', $type)->get();
        return view('shop')->with('products', $products);
    }

    /**
     * Display the specified resource.
     *
     * @param string $name
     *
     * @return use Illuminate\Http\Response
     *
     */

    public function show($name)
    {
        $product = Shop::where('name', $name)->firstOrFail();

        $stockLevel = getStockLevel($product->quantity);
        return view('product')->with([
            'product'=> $product,
            'stockLevel' => $stockLevel,
        ]);
    }

}
