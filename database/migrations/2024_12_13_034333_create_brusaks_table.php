<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrusaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brusaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id'); // ID Barang yang rusak
            $table->date('tanggal_rusak'); // Tanggal kerusakan
            $table->text('deskripsi_kerusakan'); // Deskripsi kerusakan
            $table->enum('status', ['Rusak', 'Diperbaiki', 'Selesai']); // Status perbaikan
            $table->timestamps();

            // Tambahkan foreign key jika ada relasi ke tabel barang
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brusaks');
    }
}
