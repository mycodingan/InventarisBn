<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'peminjaman';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_peminjam',
        'barang_id',
        'borrow_date',
        'return_date',
        'status',
        'notes',
    ];

    /**
     * Get the barang associated with the peminjaman.
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
