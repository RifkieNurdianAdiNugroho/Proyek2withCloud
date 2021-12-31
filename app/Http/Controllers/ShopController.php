<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $goods = Goods::with('goodsImages')->get();
        $best_sellers = Goods::with('transactionDetails', 'user', 'goodsImages')
                        ->withSum('transactionDetails', 'qty')
                        ->orderByDesc('transaction_details_sum_qty')
                        ->limit(6)
                        ->get();
        $title = "Semua Produk";
        return view('shop.index', compact('goods', 'best_sellers', 'title'));
    }

    public function show($id)
    {
        $goods = Goods::with('goodsImages')->find($id);
        return view('shop.detail', compact('goods'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $best_sellers = Goods::with('transactionDetails', 'user', 'goodsImages')
                        ->withSum('transactionDetails', 'qty')
                        ->orderByDesc('transaction_details_sum_qty')
                        ->limit(6)
                        ->get();

        $title = "Hasil Pencarian: " . $keyword;

        if ($keyword == null || $keyword == '')
        {
            return redirect()->route('shop.index');
        }

        $goods = Goods::with('goodsImages')->where('name', 'like', '%' . $keyword . '%')->get();

        return view('shop.index', compact('goods', 'best_sellers', 'title'));
    }

    public function filterCategory($category)
    {
        $best_sellers = Goods::with('transactionDetails', 'user', 'goodsImages')
                        ->withSum('transactionDetails', 'qty')
                        ->orderByDesc('transaction_details_sum_qty')
                        ->limit(6)
                        ->get();

        $goods = Goods::with('goodsImages')->where('category', $category)->get();
        
        if ($category == 'sayur segar') {
            $category = 'Sayuran Segar';
        } elseif ($category == 'buah segar') {
            $category = 'Buah-Buahan';
        } elseif ($category == 'daging segar') {
            $category = 'Daging Segar';
        } else {
            $category = 'Bumbu Dapur';
        }

        $title = "Kategori: " . $category;

        return view('shop.index', compact('goods', 'best_sellers', 'title'));
    }
}
