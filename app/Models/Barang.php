<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dari penamaan default
    protected $table = 'barangs';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'name',
        'category',
        'description',
        'quantity',
        'condition',
        'date_received',
        'location',
        'unit_price',
        'inventory_code',
        'status'
    ];

    // Kolom yang tidak bisa diisi secara massal (protected $guarded)
    // protected $guarded = ['id'];

    // Menentukan tipe data untuk kolom tertentu jika diperlukan
    protected $casts = [
        'date_received' => 'datetime',  // Memastikan format tanggal
        'unit_price' => 'decimal:2',    // Memastikan harga dalam format desimal dengan 2 angka setelah titik
    ];
}
