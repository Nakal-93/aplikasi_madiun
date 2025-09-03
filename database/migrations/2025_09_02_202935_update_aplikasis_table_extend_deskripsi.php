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
        Schema::table('aplikasis', function (Blueprint $table) {
            // Ubah kolom deskripsi_singkat dari varchar(255) ke text untuk menampung lebih banyak karakter
            $table->text('deskripsi_singkat')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aplikasis', function (Blueprint $table) {
            // Kembalikan ke varchar(255)
            $table->string('deskripsi_singkat', 255)->change();
        });
    }
};
