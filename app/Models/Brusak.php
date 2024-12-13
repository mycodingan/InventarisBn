<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brusak extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'tanggal_rusak',
        'deskripsi_kerusakan',
        'status',
    ];

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
