@extends('layouts.shop.master')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="#">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Detail Pengiriman</h4>
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nama Penerima<span>*</span></p>
                                    <input type="text" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nomor WhatsApp<span>*</span></p>
                                    <input type="text" value="{{ Auth::user()->userDetail->phone_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Alamat Penerima<span>*</span></p>
                            <input type="text" class="checkout__input__add" value="{{ Auth::user()->userDetail->address }}">
                        </div>
                        <div class="checkout__input">
                            <p>Catatan <span>(optional)</span></p>
                            <input type="text" name="note" placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Pesanan Anda</h4>
                            <div class="checkout__order__products">Produk <span>Total</span></div>
                            <ul>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($shoppingCarts as $item)
                                    @php
                                        $total += $item->goods->price * $item->qty;
                                    @endphp
                                    <li>{{ $item->goods->name . ' (' . $item->qty . ')'}} <span>{{ 'Rp ' . number_format($item->goods->price * $item->qty, 0, ',', '.') }}</span></li>
                                    <input type="hidden" name="cart_id[]" value="{{ $item->id }}">
                                @endforeach
                            </ul>
                            <div class="checkout__order__total">Total <span>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span></div>
                            <input type="hidden" name="total" value="{{ $total }}">
                            <div class="checkout__order__products">Metode Pembayaran</div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    COD
                                    <input type="checkbox" id="paypal" checked disabled>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn">PESAN SEKARANG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection
