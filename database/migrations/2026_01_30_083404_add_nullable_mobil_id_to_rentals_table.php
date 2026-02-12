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
        Schema::table('rentals', function (Blueprint $table) {
            // 1. Drop existing foreign key constraint first
            $table->dropForeign(['mobil_id']);

            // 2. Make mobil_id nullable
            $table->foreignId('mobil_id')->nullable()->change();

            // 3. Re-add the foreign key constraint with onDelete('set null')
            $table->foreign('mobil_id')->references('id')->on('mobils')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            // Revert changes in reverse order
            // 1. Drop the foreign key with onDelete('set null')
            $table->dropForeign(['mobil_id']);

            // 2. Make mobil_id non-nullable again
            // Note: If there are null values in the column, this will fail.
            //       You might need to handle those nulls before rolling back.
            $table->foreignId('mobil_id')->change();

            // 3. Re-add the original foreign key constraint
            $table->foreign('mobil_id')->references('id')->on('mobils');
        });
    }
};