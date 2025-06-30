@extends('template/main')
@section('title', $title)
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header justify-content-between d-flex">
                    <h4>Edit Produk Keluar</h4>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('produk_keluar.update', $produk_keluar->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ $produk_keluar->tanggal ? \Carbon\Carbon::parse($produk_keluar->tanggal)->format('Y-m-d') : '' }}"
                                required>
                        </div>

                        {{-- <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ $produk_masuk->tanggal ? $produk_masuk->tanggal->format('Y-m-d') : '' }}" required>
                        </div> --}}

                        <div class="mb-3">
                            <label>Produk</label>
                            <select name="id_produk" id="id_produk" class="form-control" required>
                                <option value="" disabled>-- Pilih --</option>
                                @foreach ($produk as $p)
                                    <option value="{{ $p->id }}"
                                        {{ $p->id == $produk_keluar->id_produk ? 'selected' : '' }}>
                                        {{ $p->kode_produk }} - {{ $p->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" value="{{ $produk_keluar->jumlah }}"
                                required>
                        </div>

                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
