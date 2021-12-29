@extends('layouts.shop.master')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Keranjang Belanja</h2>
                    <div class="breadcrumb__option">
                        <a href="#">Home</a>
                        <span>Keranjang Belanja</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <form action="{{ route('shoppingCarts.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah Beli</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($shoppingCarts as $cart)
                                    @php
                                        $total += $cart->goods->price * $cart->qty;
                                    @endphp
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset('storage/' . $cart->goods->goodsImages[0]->src) }}" width="100px" height="100px">
                                            <h5>
                                                {{ $cart->goods->name }} <br>
                                                <span style="font-size: 13px !important; color: grey; margin-top: 24px">{{ $cart->seller->name }}</span>
                                            </h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ 'Rp ' . number_format($cart->goods->price, 0, ',', '.') }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $cart->qty }}" name="qty[]">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{ 'Rp ' . number_format($cart->goods->price * $cart->qty, 0, ',', '.') }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ route('shoppingCarts.destroy', $cart->id) }}"><span class="icon_trash"></span></a>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="goods_id[]" value="{{ $cart->id }}">
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('shop.index') }}" class="primary-btn cart-btn">Lanjutkan Belanja</a>
                        <button type="submit" class="primary-btn cart-btn cart-btn-right" style="border: none !important">
                            <span class="icon_loading"></span>
                            Update Keranjang Belanja
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    {{-- <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total Keranjang Belanja</h5>
                        <ul>
                            <li>Total <span>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span></li>
                        </ul>
                        <a href="{{ route('transactions.create') }}" class="primary-btn">Proses ke Pembayaran</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shoping Cart Section End -->
@endsection
