@extends('layouts.shop.master')

@section('content')
<!-- Banner Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero__item set-bg" data-setbg="{{ asset('ogani/img/hero/banner.jpg') }}">
                    <div class="hero__text">
                        <span>BUAH BUAHAN SEGAR</span>
                        <h2>SAYURAN <br />100% Organik</h2>
                        <p>Tersedia Pemesanan dan Pengiriman Gratis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Kategori</h4>
                        <ul>
                            <li><a href="{{ route('shop.filterCategory', 'sayur segar') }}" class="{{ Request::segment(2) === 'sayur segar' ? 'text-primary font-weight-bold' : '' }}">Sayuran Segar</a></li>
                            <li><a href="{{ route('shop.filterCategory', 'buah segar') }}" class="{{ Request::segment(2) === 'buah segar' ? 'text-primary font-weight-bold' : '' }}">Buah-Buahan</a></li>
                            <li><a href="{{ route('shop.filterCategory', 'daging segar') }}" class="{{ Request::segment(2) === 'daging segar' ? 'text-primary font-weight-bold' : '' }}">Daging Segar</a></li>
                            <li><a href="{{ route('shop.filterCategory', 'bumbu dapur') }}" class="{{ Request::segment(2) === 'bumbu dapur' ? 'text-primary font-weight-bold' : '' }}">Bumbu Dapur</a></li>
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Produk Terlaris</h4>
                            <div class="latest-product__slider owl-carousel">
                                @foreach ($best_sellers->split($best_sellers->count()/3) as $section)
                                    <div class="latest-prdouct__slider__item">
                                        @foreach ($section as $best_seller)
                                            <a href="{{ route('shop.show', $best_seller->id) }}" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="{{ asset('storage/' . $best_seller->goodsImages[0]->src) }}" style="width: 110px !important; height: 110px !important">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{ $best_seller->name }}</h6>
                                                    <p style="font-size: 13px">{{ $best_seller->user->name }}</p>
                                                    <span>{{ 'Rp ' . number_format($best_seller->price, 0, ',', '.') }}</span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="section-title product__discount__title">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="row">
                    @foreach ($goods as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="{{ route('shop.show', $item->id) }}">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $item->goodsImages[0]->src) }}"></div>
                                    <div class="product__discount__item__text">
                                        <span>{{ $item->user->name }}</span>
                                        <h5>{{ $item->name }}</h5>
                                        <div class="product__item__price">{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="product__pagination">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

@endsection
