<?php

namespace App\Http\Controllers;

use App\Models\Brusak;
use App\Models\Barang;
use Illuminate\Http\Request;

class BrusakController extends Controller
{
    /**
     * Menampilkan laporan barang rusak dengan filter
     */
    public function index(Request $request)
    {
        // Filter berdasarkan tanggal dan status jika ada
        $query = Brusak::with('barang');

        if ($request->has('tanggal_rusak')) {
            $query->whereDate('tanggal_rusak', $request->tanggal_rusak);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Menampilkan data laporan barang rusak
        $brusaks = $query->get();
        $barangs = Barang::all(); // Ambil data barang untuk dropdown
        return view('brusak.index', compact('brusaks', 'barangs'));
    }

    /**
     * Menyimpan data barang rusak baru atau memperbarui data barang rusak yang ada
     */
    public function save(Request $request, $id = null)
    {
        // Validasi input
        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_rusak' => 'required|date',
            'deskripsi_kerusakan' => 'required|string',
            'status' => 'required|in:Rusak,Diperbaiki,Selesai',
        ]);

        if ($id) {
            // Update data jika ID tersedia
            $brusak = Brusak::findOrFail($id);
            $brusak->update($validated); // Memperbarui data barang rusak
        } else {
            // Buat data baru jika ID tidak ada
            Brusak::create($validated); // Menyimpan data barang rusak
        }

        // Redirect kembali ke halaman laporan
        return redirect()->back()->with('success', $id ? 'Barang rusak berhasil diperbarui' : 'Barang rusak berhasil ditambahkan');
    }

    /**
     * Menghapus data barang rusak
     */
    public function destroy($id)
    {
        $brusak = Brusak::findOrFail($id);
        $brusak->delete(); // Menghapus data barang rusak

        // Redirect kembali ke halaman laporan
        return redirect()->back()->with('success', 'Barang rusak berhasil dihapus');
    }
}
