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
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('mobil_id')->constrained('mobils');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->integer('total_biaya');
        $table->timestamp('payment_deadline')->nullable();
        $table->string('status')->default('menunggu_pembayaran');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
