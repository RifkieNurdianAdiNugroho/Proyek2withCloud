@extends('layouts.admin.master')

@section('breadcrumb')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Barang</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Manajemen Barang</li>
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
                    <h4 class="card-title mb-4">
                        <a href="{{ route('goods.create') }}" class="btn btn btn-rounded btn-primary">Tambah Barang Baru</a>
                    </h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th style="width: 30px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($goods as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-capitalize">{{ $item->category }}</td>
                                        <td>{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                                        <td>{{ $item->status == 'in stock' ? 'Tersedia' : 'Habis' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('goods.show', $item->id) }}" class="btn btn-sm btn btn-rounded btn-info"><i class="fas fa-eye"></i></a>&nbsp;
                                            <a href="{{ route('goods.edit', $item->id) }}" class="btn btn-sm btn btn-rounded btn-primary"><i class="fas fa-edit"></i></a>&nbsp;
                                            <form action="{{ route('goods.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn btn-rounded btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
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
