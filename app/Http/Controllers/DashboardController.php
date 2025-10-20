<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\ProdukMasuk;
use App\Models\ProdukKeluar;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        return view('dashboard', [
            'title' => 'Dashboard',
            'jumlahProduk' => Produk::where('user_id', $userId)->count(),
            'jumlahSupplier' => Supplier::where('user_id', $userId)->count(),
            'jumlahProdukMasuk' => ProdukMasuk::where('user_id', $userId)->count(),
            'jumlahProdukKeluar' => ProdukKeluar::where('user_id', $userId)->count(),

            'produkTerbaru' => Produk::where('user_id', $userId)->latest()->take(5)->get(),
            'supplierTerbaru' => Supplier::where('user_id', $userId)->latest()->take(5)->get(),
            'produkMasukTerbaru' => ProdukMasuk::where('user_id', $userId)->latest()->take(5)->get(),
            'produkKeluarTerbaru' => ProdukKeluar::where('user_id', $userId)->latest()->take(5)->get(),
        ]);
    }
}
