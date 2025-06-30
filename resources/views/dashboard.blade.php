@extends('template.main')
@section('title', $title)

@section('content')

    <div class="container pt-3">
        <h2 class="text-center mb-4">Selamat Datang, {{ auth()->user()->name }}</h2>

        <div class="row">
            <!-- Produk -->
            <div class="col-md-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jumlahProduk }}</h3>
                        <p>Total Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>

            <!-- Supplier -->
            <div class="col-md-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $jumlahSupplier }}</h3>
                        <p>Total Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck"></i>
                    </div>
                </div>
            </div>

            <!-- Produk Masuk -->
            <div class="col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $jumlahProdukMasuk }}</h3>
                        <p>Produk Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                </div>
            </div>

            <!-- Produk Keluar -->
            <div class="col-md-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $jumlahProdukKeluar }}</h3>
                        <p>Produk Keluar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">

            <!-- Produk Terbaru -->
            <div class="col-md-6 mb-4">
                <div class="card shadow border-left-primary">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-box"></i> Produk Terbaru
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produkTerbaru as $p)
                                    <tr>
                                        <td>{{ $p->nama_produk }}</td>
                                        <td>{{ $p->stok }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Supplier Terbaru -->
            <div class="col-md-6 mb-4">
                <div class="card shadow border-left-success">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-truck"></i> Supplier Terbaru
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplierTerbaru as $s)
                                    <tr>
                                        <td>{{ $s->nama_supplier }}</td>
                                        <td>{{ $s->no_telp }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Produk Masuk Terbaru -->
            <div class="col-md-6 mb-4">
                <div class="card shadow border-left-warning">
                    <div class="card-header bg-warning text-dark">
                        <i class="fas fa-arrow-down"></i> Produk Masuk Terbaru
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produkMasukTerbaru as $pm)
                                    <tr>
                                        <td> {{ \Carbon\Carbon::parse($pm->tanggal)->translatedFormat('l, d F Y') }} </td>
                                        <td>{{ $pm->jumlah }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Produk Keluar Terbaru -->
            <div class="col-md-6 mb-4">
                <div class="card shadow border-left-danger">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-arrow-up"></i> Produk Keluar Terbaru
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produkKeluarTerbaru as $pk)
                                    <tr>
                                        <td> {{ \Carbon\Carbon::parse($pk->tanggal)->translatedFormat('l, d F Y') }} </td>
                                        <td>{{ $pk->jumlah }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        @endsection
