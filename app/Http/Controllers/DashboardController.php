<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\ProdukMasuk;
use App\Models\ProdukKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'jumlahProduk' => Produk::count(),
            'jumlahSupplier' => Supplier::count(),
            'jumlahProdukMasuk' => ProdukMasuk::count(),
            'jumlahProdukKeluar' => ProdukKeluar::count(),
            'produkTerbaru' => Produk::latest()->take(5)->get(),
            'supplierTerbaru' => Supplier::latest()->take(5)->get(),
            'produkMasukTerbaru' => ProdukMasuk::latest()->take(5)->get(),
            'produkKeluarTerbaru' => ProdukKeluar::latest()->take(5)->get(),
        ]);
    }
    
}
