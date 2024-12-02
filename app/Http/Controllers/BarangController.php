<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::all(); // Ambil semua data barang
        return view('barang.index', compact('barangs')); // Arahkan ke halaman barang.index
    }

    // Menampilkan form untuk menambah barang
    public function create()
    {
        return view('barang.create'); // Arahkan ke halaman barang.create
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'condition' => 'required|string',
            'date_received' => 'required|date',
            'location' => 'nullable|string',
            'unit_price' => 'nullable|numeric',
            'inventory_code' => 'required|string|unique:barangs',
            'status' => 'required|string|in:Tersedia,Dipinjam,Rusak',
        ]);

        Barang::create($request->all()); // Simpan data barang
        return redirect()->route('barang.index'); // Redirect ke halaman barang.index
    }

    // Menampilkan form untuk mengedit data barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id); // Cari data barang berdasarkan ID
        return view('barang.edit', compact('barang')); // Arahkan ke halaman barang.edit
    }

    // Memperbarui data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'condition' => 'required|string',
            'date_received' => 'required|date',
            'location' => 'nullable|string',
            'unit_price' => 'nullable|numeric',
            'inventory_code' => 'required|string|unique:barangs,inventory_code,' . $id,
            'status' => 'required|string|in:Tersedia,Dipinjam,Rusak',
        ]);

        $barang = Barang::findOrFail($id); // Cari data barang berdasarkan ID
        $barang->update($request->all()); // Update data barang
        return redirect()->route('barang.index'); // Redirect ke halaman barang.index
    }

    // Menghapus data barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id); // Cari data barang berdasarkan ID
        $barang->delete(); // Hapus data barang
        return redirect()->route('barang.index'); // Redirect ke halaman barang.index
    }
}
