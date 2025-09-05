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
    Schema::table('users', function (Blueprint $table) {
        $table->string('nomor_telepon')->nullable()->after('email');
        $table->text('alamat')->nullable()->after('nomor_telepon');
        $table->string('foto_ktp')->nullable()->after('alamat');
        $table->string('foto_kk')->nullable()->after('foto_ktp');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
