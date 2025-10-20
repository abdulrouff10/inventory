<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukMasukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Produk Masuk',
            'produk_masuk' => ProdukMasuk::where('user_id', Auth::id())->get()
        ];

        return view('produk_masuk.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk Masuk',
            'produk' => Produk::where('user_id', Auth::id())->get()
        ];
        return view('produk_masuk.tambah', $data);
    }

    public function store(Request $request)
    {
        ProdukMasuk::create([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'user_id' => Auth::id(), // ✅ tambahkan user_id
        ]);

        $produk = Produk::where('id', $request->id_produk)->first();
        $total_stok = $produk->stok + $request->jumlah;

        Produk::where('id', $request->id_produk)->update(['stok' => $total_stok]);

        return redirect()->route('produk_masuk.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Produk Masuk',
            'produk' => Produk::where('user_id', Auth::id())->get(),
            'produk_masuk' => ProdukMasuk::where('id', $id)->where('user_id', Auth::id())->firstOrFail()
        ];
        return view('produk_masuk.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $produk_masuk = ProdukMasuk::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $produk = Produk::where('id', $request->id_produk)->first();

        $kurangi_stok = $produk->stok - $produk_masuk->jumlah;

        Produk::where('id', $request->id_produk)->update(['stok' => $kurangi_stok]);

        ProdukMasuk::where('id', $id)->update([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'user_id' => Auth::id(), // ✅ jaga-jaga jika berubah user
        ]);

        $total_stok = $request->jumlah + $kurangi_stok;

        Produk::where('id', $request->id_produk)->update(['stok' => $total_stok]);

        return redirect()->route('produk_masuk.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk_masuk = ProdukMasuk::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // kembalikan stok ke awal sebelum hapus
        $produk = Produk::find($produk_masuk->id_produk);
        if ($produk) {
            $produk->stok -= $produk_masuk->jumlah;
            $produk->save();
        }

        $produk_masuk->delete();

        return redirect()->route('produk_masuk.index')->with('success', 'Data berhasil dihapus!');
    }
}
