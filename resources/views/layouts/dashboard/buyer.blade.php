@extends('layouts.admin.master')

@section('breadcrumb')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Dashboard</li>
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
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Top Produk</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-medium text-muted">Nama Produk</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Harga</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Total Membeli</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top_products as $item)
                                    <tr>
                                        <td class="border-top-0 px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3"><img src="{{ asset('storage/' . $item->goodsImages[0]->src) }}"
                                                        alt="user" class="rounded-circle" width="45" height="45"></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">{{ $item->name }}</h5>
                                                    <span class="text-muted font-14">{{ $item->user->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="border-top-0 text-muted text-center px-2 py-4">{{ $item->transaction_details_sum_qty }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Transaksi Terakhir</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-medium text-muted">Tanggal Transaksi</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted text-center">Total Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($last_transactions as $item)
                                    <tr>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="border-top-0 text-muted text-center px-2 py-4">{{ 'Rp ' . number_format($item->total, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
</div>
<!-- End Container fluid  -->
@endsection
