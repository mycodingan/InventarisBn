<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('barang')->get();
        $barangs = Barang::all();
        return view('peminjaman.index', compact('peminjaman', 'barangs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'barang_id' => 'required|exists:barangs,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Peminjaman::create($validatedData);
        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'barang_id' => 'required|exists:barangs,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($validatedData);
        return redirect()->back()->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
        return redirect()->back()->with('success', 'Peminjaman berhasil dihapus.');
    }
}
