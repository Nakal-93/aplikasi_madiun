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
        Schema::create('aplikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->constrained('opds');
            $table->string('nama_aplikasi');
            $table->text('deskripsi_singkat');
            $table->string('alamat_domain')->nullable();
            $table->enum('jenis_aplikasi', ['Aplikasi Khusus/Daerah', 'Aplikasi Pusat/Umum', 'Aplikasi Lainnya']);
            $table->enum('status_aplikasi', ['Aktif', 'Tidak Aktif']);
            $table->text('penyebab_tidak_aktif')->nullable();
            $table->string('nama_pengelola');
            $table->string('nomor_wa_pengelola');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplikasis');
    }
};
