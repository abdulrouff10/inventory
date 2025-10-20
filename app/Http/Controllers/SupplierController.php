<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Supplier',
            'supplier' => Supplier::where('user_id', Auth::id())->get()
        ];
        return view('supplier.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Supplier',
        ];
        return view('supplier.tambah', $data);
    }

    public function store(Request $request)
    {
        Supplier::create([
            'user_id' => Auth::id(),
            'nama_supplier' => $request->nama_supplier,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('supplier.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $supplier = Supplier::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = [
            'title' => 'Supplier',
            'supplier' => $supplier,
        ];
        return view('supplier.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('supplier.index')->with('success', 'Data berhasil disimpan!');
    }

    public function destroy(string $id)
    {
        $supplier = Supplier::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Data berhasil dihapus!');
    }
}
