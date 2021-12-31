<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGoods;
use App\Models\Goods;
use App\Models\GoodsImages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = Goods::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.goods.index', compact('goods'));
        } else {
            return view('seller.goods.index', compact('goods'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'admin') {
            $sellers = User::where('role', 'penjual')->get();
            return view('admin.goods.create', compact('sellers'));
        } else {
            return view('seller.goods.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGoods  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoods $request)
    {
        if (Auth::user()->role == 'admin') {
            $goods = Goods::create($request->validated());
        } else {
            $goods = auth()->user()->goods()->create($request->validated());
        }
        if ($request->file('goods_images')) {
            for ($i = 0; $i < count($request->goods_images); $i++) {
                if ($request->file('goods_images')[$i]) {
                    $image_name = $request->file('goods_images')[$i]->store('images/goods', 'public');
                    
                    GoodsImages::create([
                        'src' => $image_name,
                        'goods_id' => $goods->id
                    ]);
                }
            }
        }
       return redirect()->route('goods.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goods = Goods::find($id);
        $images = GoodsImages::where('goods_id', $id)->get();
        return view('admin.goods.detail', compact('goods', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goods = Goods::find($id);
        $images = GoodsImages::where('goods_id', $id)->get();
        if (Auth::user()->role == 'admin') {
            $sellers = User::where('role', 'penjual')->get();
            return view('admin.goods.edit', compact('goods', 'sellers', 'images'));
        } else {
            return view('seller.goods.edit', compact('goods', 'images'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreGoods  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoods $request, $id)
    {
        $goods = Goods::find($id);
        $goods->update($request->validated());
        if ($request->file('goods_images')) {
            for ($i = 0; $i < 4; $i++) {
                if (array_key_exists($i, $request->file('goods_images'))) {
                    if ($request->image_old) {
                        if (array_key_exists($i, $request->image_old)) {
                            if ($request->image_old[$i] && file_exists(storage_path('app/public/'.$request->image_old[$i]))) {
                                \Storage::delete('public/'.$request->image_old[$i]);
                            }
                            $image_name = $request->file('goods_images')[$i]->store('images/goods', 'public');
                            GoodsImages::where('src', $request->image_old[$i])->update([
                                'src' => $image_name,
                            ]);
                        } else {
                            $image_name = $request->file('goods_images')[$i]->store('images/goods', 'public');
                            
                            GoodsImages::create([
                                'src' => $image_name,
                                'goods_id' => $id
                            ]);
                        }
                    } else {
                        $image_name = $request->file('goods_images')[$i]->store('images/goods', 'public');
                        
                        GoodsImages::create([
                            'src' => $image_name,
                            'goods_id' => $id
                        ]);
                    }
                }
            }
        }
        return redirect()->route('goods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goods = Goods::find($id);
        $goods->goodsImages()->delete();
        $goods->delete();
        return redirect()->route('goods.index');
    }
}
