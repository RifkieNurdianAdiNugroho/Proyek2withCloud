@extends('layouts.shop.master')

@section('content')

<!-- Product Details Section Begin -->
<section class="product-details spad pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{ asset('storage/' . $goods->goodsImages[0]->src) }}"
                            alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @foreach($goods->goodsImages as $item)
                            <img data-imgbigurl="{{ asset('storage/' . $item->src) }}"
                                src="{{ asset('storage/' . $item->src) }}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <form action="{{ route('shoppingCarts.store') }}" method="POST">
                    @csrf
                    <div class="product__details__text">
                        <h3>{{ $goods->name }}</h3>
                        <div class="product__details__rating">
                            Penjual: <span>{{ $goods->user->name }}</span>
                        </div>
                        <div class="product__details__price">
                            {{ 'Rp ' . number_format($goods->price, 0, ',', '.') }}
                        </div>
                        <p>{{ $goods->description }}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" name="qty">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="goods_id" value="{{ $goods->id }}">
                        @if (Auth::check())
                            <button type="submit" class="primary-btn" style="border: none">Masukkan Keranjang</button>
                        @else
                            <a href="{{ route('login') }}" class="primary-btn" style="border: none">Masukkan Keranjang</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
@endsection
