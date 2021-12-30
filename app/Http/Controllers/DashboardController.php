<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $goods_count = Goods::count();
        $buyer_count = User::where('role', 'pembeli')->count();
        $seller_count = User::where('role', 'penjual')->count();
        $transaction_count = Transaction::count();
        $best_sellers = Goods::with('transactionDetails', 'user', 'goodsImages')
                        ->withSum('transactionDetails', 'qty')
                        ->orderByDesc('transaction_details_sum_qty')
                        ->limit(6)
                        ->get();
        $last_transactions = Transaction::orderByDesc('created_at')->limit(6)->get();
        return view('dashboard.admin', compact('goods_count', 'buyer_count', 'seller_count', 'transaction_count', 'best_sellers', 'last_transactions'));
    }

    public function seller()
    {
        $goods_count = Goods::where('user_id', auth()->id())->count();
        $transaction_count = Transaction::with('transaction_details.goods.user')
                                ->whereRelation('transaction_details.goods', 'user_id', '=', auth()->id())
                                ->count();
        $best_sellers = Goods::with('transactionDetails', 'user', 'goodsImages')
                        ->withSum('transactionDetails', 'qty')
                        ->where('user_id', auth()->id())
                        ->orderByDesc('transaction_details_sum_qty')
                        ->limit(6)
                        ->get();
        $transactions = TransactionDetail::with('goods')
                        ->whereRelation('goods', 'user_id', '=', auth()->id())
                        ->get();
        $total = 0;
        foreach ($transactions as $t) {
            $total += $t->qty * $t->goods->price;
        }

        return view('dashboard.seller', compact('goods_count', 'transaction_count', 'best_sellers', 'total'));
    }

    public function buyer()
    {
        $top_products = Goods::with('transactionDetails', 'user', 'goodsImages')
                        ->withSum('transactionDetails', 'qty')
                        ->whereRelation('transactionDetails.transaction', 'buyer_id', auth()->id())
                        ->orderByDesc('transaction_details_sum_qty')
                        ->limit(5)
                        ->get();
        $last_transactions = Transaction::with('transaction_details.goods.user')
                                ->where('buyer_id', auth()->id())
                                ->orderByDesc('created_at')
                                ->limit(6)
                                ->get();
        return view('dashboard.buyer', compact('top_products', 'last_transactions'));
    }
}
