@extends('layouts.admin.base')

@section('slot')

<div class="main-wrapper">
    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- Preloader -->

    <!-- Login -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
        style="background:url({{ asset('adminmart/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
        <div class="auth-box row text-center">
            <div class="col-lg-12 bg-white">
                <div class="p-3">
                    <img src="{{ asset('adminmart/assets/images/text-logo.png') }}" alt="wrapkit" width="134" height="34">
                    <h2 class="mt-3 text-center">Daftar</h2>
                    <form class="mt-4" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="float-left">Nama Lengkap</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="float-left">No. Telepon</label>
                                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text" name="phone_number" value="{{ old('phone_number') }}" required>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="float-left">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="float-left">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="float-left">Konfirmasi Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="float-left">Daftar Sebagai</label>
                                    <select name="role" class="form-control" required>
                                        <option value="pembeli">Pembeli</option>
                                        <option value="penjual">Penjual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="float-left">Jenis Kelamin</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="float-left">Alamat</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5" required></textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-block btn-dark">Daftar</button>
                            </div>
                            <div class="col-lg-12 text-center mt-5">
                                Sudah memiliki akun? <a href="{{ route('login') }}" class="text-danger">Masuk</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login -->
</div>
@endsection
