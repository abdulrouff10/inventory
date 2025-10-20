<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukKeluarController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Produk Keluar',
            'produk_keluar' => ProdukKeluar::where('user_id', Auth::id())->get()
        ];
        return view('produk_keluar.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Produk Keluar',
            'produk' => Produk::where('user_id', Auth::id())->get()
        ];
        return view('produk_keluar.tambah', $data);
    }

    public function store(Request $request)
    {
        ProdukKeluar::create([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::id() // ✅ Tambah user_id
        ]);

        // Update stok
        $produk = Produk::where('id', $request->id_produk)->first();
        $total_stok = $produk->stok - $request->jumlah;
        $produk->update(['stok' => $total_stok]);

        return redirect()->route('produk_keluar.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Produk Keluar',
            'produk' => Produk::where('user_id', Auth::id())->get(),
            'produk_keluar' => ProdukKeluar::where('id', $id)->where('user_id', Auth::id())->firstOrFail()
        ];
        return view('produk_keluar.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $produk_keluar = ProdukKeluar::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $produk = Produk::where('id', $request->id_produk)->firstOrFail();

        // Kembalikan stok ke semula
        $tambah_stok = $produk->stok + $produk_keluar->jumlah;
        $produk->update(['stok' => $tambah_stok]);

        // Simpan perubahan dan update stok
        $produk_keluar->update([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        $total_stok = $tambah_stok - $request->jumlah;
        $produk->update(['stok' => $total_stok]);

        return redirect()->route('produk_keluar.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $produk_keluar = ProdukKeluar::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Kembalikan stok sebelum menghapus
        $produk = Produk::where('id', $produk_keluar->id_produk)->first();
        $produk->update(['stok' => $produk->stok + $produk_keluar->jumlah]);

        $produk_keluar->delete();

        return redirect()->route('produk_keluar.index')->with('success', 'Data berhasil dihapus!');
    }
}
