<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam'); // Nama peminjam
            $table->unsignedBigInteger('barang_id'); // ID Barang yang dipinjam (referensi ke tabel barangs)
            $table->date('borrow_date'); // Tanggal Pinjam
            $table->date('return_date')->nullable(); // Tanggal Pengembalian (nullable jika belum dikembalikan)
            $table->string('status')->default('Dipinjam'); // Status Peminjaman (Dipinjam/Dikembalikan)
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->timestamps();
        
            // Relasi foreign key
            $table->foreign('barang_id')->references('id')->on('barangs');
        });
        

        // Insert sample data
        DB::table('peminjaman')->insert([
            [
                'nama_peminjam' => 'John Doe',
                'barang_id' => 1,
                'borrow_date' => now(),
                'return_date' => null,
                'status' => 'Dipinjam',
                'notes' => 'Peminjaman untuk proyek penelitian biologi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_peminjam' => 'Jane Smith',
                'barang_id' => 2,
                'borrow_date' => now(),
                'return_date' => null,
                'status' => 'Dipinjam',
                'notes' => 'Peminjaman untuk keperluan presentasi kelas.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
