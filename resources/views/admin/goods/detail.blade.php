@extends('layouts.admin.master')

@section('breadcrumb')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Barang</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Manajemen Barang</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Detail Barang</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
@endsection

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama Barang</dt>
                        <dd class="col-sm-9">{{ $goods->name }}</dd>

                        <dt class="col-sm-3">Penjual</dt>
                        <dd class="col-sm-9">{{ $goods->user->name }}</dd>

                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9 text-capitalize">{{ $goods->category }}</dd>

                        <dt class="col-sm-3">Harga</dt>
                        <dd class="col-sm-9">{{ 'Rp ' . number_format($goods->price, 0, ',', '.') }}</dd>

                        <dt class="col-sm-3">Deskripsi Barang</dt>
                        <dd class="col-sm-9">{{ $goods->description != null ? $goods->description : '-' }}</dd>
                    </dl>
                    @foreach ($images as $image)
                        <img src="{{ asset('storage/'. $image->src) }}" width="72px" height="72px" class="img-thumbnail mr-2">
                    @endforeach
                    <div class="form-actions mt-3">
                            <a href="{{ route('goods.index') }}" class="btn btn-dark">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
</div>
<!-- End Container fluid  -->
@endsection
