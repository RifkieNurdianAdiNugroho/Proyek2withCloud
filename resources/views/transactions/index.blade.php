@extends('layouts.admin.master')

@section('breadcrumb')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Transaksi</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Data Transaksi</li>
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
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pembeli</th>
                                    <th>Catatan</th>
                                    <th>Total</th>
                                    @if (auth()->user()->role == 'penjual')
                                        <th>Status</th>
                                    @endif
                                    <th style="width: 30px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $item)
                                    @php
                                        $status = App\Models\TransactionDetail::checkStatus($item->id);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                        <td>{{ $item->buyer->name }}</td>
                                        <td>{{ $item->note == null ? '-' : $item->note }}</td>
                                        <td>{{ 'Rp ' . number_format($item->total, 0, ',', '.') }}</td>
                                        @if (auth()->user()->role == 'penjual')
                                            <td class="text-capitalize">
                                                @if ($status->status == 'pending')
                                                    <span class="badge badge-warning badge-pill">Menunggu</span>
                                                @elseif ($status->status == 'reject')
                                                    <span class="badge badge-danger badge-pill">Ditolak</span>
                                                @elseif ($status->status == 'packing')
                                                    <span class="badge badge-light badge-pill">Dikemas</span>
                                                @elseif ($status->status == 'sending')
                                                    <span class="badge badge-primary badge-pill">Dikirim</span>
                                                @else
                                                    <span class="badge badge-success badge-pill">Selesai</span>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="d-flex">
                                            <a href="{{ route('transactions.show', $item->id) }}" class="btn btn-sm btn btn-rounded btn-info" title="Detail"><i class="fas fa-eye"></i></a>
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

@push('script')
    <link
        href="{{ asset('adminmart/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}"
        rel="stylesheet">
@endpush

@push('script')
    <script
        src="{{ asset('adminmart/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}">
    </script>
    <script src="{{ asset('adminmart/dist/js/pages/datatable/datatable-basic.init.js') }}">
    </script>
@endpush
