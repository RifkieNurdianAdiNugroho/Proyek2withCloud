<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoppingCarts = ShoppingCart::getDataById();
        return view('shop.cart', compact('shoppingCarts'));
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
        $seller = Goods::find($request->goods_id);
        $count = ShoppingCart::where('buyer_id', auth()->id())->where('goods_id', $request->goods_id)->count();
        if ($count == 0) {
            ShoppingCart::create([
                'buyer_id' => auth()->id(),
                'goods_id' => $request->goods_id,
                'seller_id' => $seller->user_id,
                'qty' => $request->qty,
            ]);
        } else {
            $cart = ShoppingCart::where('buyer_id', auth()->id())->where('goods_id', $request->goods_id)->first();
            $cart->qty = $cart->qty + $request->qty;
            $cart->save();
        }

        return redirect()->route('shoppingCarts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->goods_id as $index => $id) {
            $cart = ShoppingCart::find($id);
            $cart->update([
                'qty' => $request->qty[$index],
            ]);

            if ($cart->qty == 0) {
                $this->destroy($id);
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shoppingCart = ShoppingCart::find($id);
        $shoppingCart->delete();
        return redirect()->back();
    }
}
