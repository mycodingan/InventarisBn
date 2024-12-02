<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Barang
            $table->string('category'); // Kategori Barang
            $table->text('description')->nullable(); // Deskripsi Barang
            $table->integer('quantity'); // Jumlah Barang
            $table->string('condition'); // Kondisi Barang (Baik, Rusak, Perlu Perbaikan)
            $table->date('date_received'); // Tanggal Masuk Barang
            $table->string('location')->nullable(); // Lokasi Barang di Lab
            $table->decimal('unit_price', 10, 2)->nullable(); // Harga Satuan Barang
            $table->string('inventory_code')->unique(); // Kode Inventaris
            $table->enum('status', ['Tersedia', 'Dipinjam', 'Rusak'])->default('Tersedia'); // Status Barang
            $table->timestamps();
        });

        // Insert sample data
        DB::table('barangs')->insert([
            [
                'name' => 'Microscope',
                'category' => 'Peralatan Elektronik',
                'description' => 'Microscope digital untuk eksperimen biologi.',
                'quantity' => 10,
                'condition' => 'Baik',
                'date_received' => now(),
                'location' => 'Rak A1',
                'unit_price' => 1500000.00,
                'inventory_code' => 'INV12345',
                'status' => 'Tersedia'
            ],
            [
                'name' => 'Laptop',
                'category' => 'Peralatan Elektronik',
                'description' => 'Laptop untuk keperluan pengajaran dan eksperimen.',
                'quantity' => 5,
                'condition' => 'Perlu Perbaikan',
                'date_received' => now(),
                'location' => 'Meja Lab 2',
                'unit_price' => 8000000.00,
                'inventory_code' => 'INV12346',
                'status' => 'Dipinjam'
            ],
            [
                'name' => 'Beaker',
                'category' => 'Peralatan Kimia',
                'description' => 'Beaker ukuran 500 ml untuk eksperimen kimia.',
                'quantity' => 20,
                'condition' => 'Baik',
                'date_received' => now(),
                'location' => 'Rak B3',
                'unit_price' => 25000.00,
                'inventory_code' => 'INV12347',
                'status' => 'Tersedia'
            ],
            [
                'name' => 'Proyektor',
                'category' => 'Peralatan Elektronik',
                'description' => 'Proyektor untuk presentasi di ruang kelas.',
                'quantity' => 3,
                'condition' => 'Baik',
                'date_received' => now(),
                'location' => 'Ruang Kelas 1',
                'unit_price' => 4000000.00,
                'inventory_code' => 'INV12348',
                'status' => 'Tersedia'
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
        Schema::dropIfExists('barangs');
    }
}
