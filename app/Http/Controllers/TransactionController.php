<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'admin')
        {
            $transactions = Transaction::orderByDesc('created_at')->get();
        }
        elseif (auth()->user()->role == 'penjual')
        {
            $transactions = Transaction::with('transaction_details.goods.user')->whereRelation('transaction_details.goods', 'user_id', '=', auth()->id())->orderByDesc('created_at')->get();
        }
        else
        {
            $transactions = Transaction::where('buyer_id', auth()->id())->orderByDesc('created_at')->get();
        }
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoppingCarts = ShoppingCart::getDataById();
        return view('shop.checkout', compact('shoppingCarts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'buyer_id' => auth()->id(),
            'total' => $request->total,
            'note' => $request->note,
        ]);

        foreach ($request->cart_id as $item) {
            $cart = ShoppingCart::find($item);
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'goods_id' => $cart->goods_id,
                'qty' => $cart->qty,
                'status' => 'pending',
            ]);
            $cart->delete();
        }
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        foreach ($request->td_id as $id) {
            TransactionDetail::where('id', $id)->update([
                'status' => $request->status,
            ]);
        }

        return redirect()->back();
    }

    public function confirmSuccess($id)
    {
        TransactionDetail::where('id', $id)->update([
            'status' => 'success',
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
