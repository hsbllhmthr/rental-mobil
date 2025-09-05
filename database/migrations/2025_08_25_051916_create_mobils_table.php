<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('mobils', function (Blueprint $table) {
        $table->id();
        $table->foreignId('merek_id')->constrained('mereks');
        $table->string('nama_mobil');
        $table->string('no_polisi')->unique();
        $table->integer('harga_sewa');
        $table->string('bahan_bakar');
        $table->year('tahun');
        $table->text('deskripsi')->nullable();
        $table->json('gambar')->nullable();

        // Kolom-kolom yang hilang:
        $table->integer('kapasitas');
        $table->string('transmisi');
        $table->string('tipe_mobil');
        $table->integer('jumlah_kursi');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
