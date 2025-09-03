<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Adjust schema to support bulk import dataset (long descriptions, flexible jenis_aplikasi values, non-URL domains kept).
     */
    public function up(): void
    {
        // 1. Widen deskripsi_singkat to LONGTEXT to safely hold appended source notes.
        // 2. Relax jenis_aplikasi from ENUM to VARCHAR(100) because CSV contains value 'Lainnya' (without prefix) per user instruction not to alter original data.
        // 3. (Optional) No change needed for alamat_domain column type; validation will be relaxed in controller.
        if (Schema::hasTable('aplikasis')) {
            // Change deskripsi_singkat to LONGTEXT.
            DB::statement('ALTER TABLE aplikasis MODIFY deskripsi_singkat LONGTEXT');

            // Change jenis_aplikasi enum to VARCHAR(100) if currently enum.
            // MySQL specific: direct ALTER (safe even if already varchar).
            DB::statement('ALTER TABLE aplikasis MODIFY jenis_aplikasi VARCHAR(100)');
        }
    }

    /**
     * Revert changes (best effort).
     */
    public function down(): void
    {
        if (Schema::hasTable('aplikasis')) {
            // Revert jenis_aplikasi back to original ENUM set.
            DB::statement("ALTER TABLE aplikasis MODIFY jenis_aplikasi ENUM('Aplikasi Khusus/Daerah','Aplikasi Pusat/Umum','Aplikasi Lainnya')");
            // Revert deskripsi_singkat to TEXT (was originally TEXT after prior migration).
            DB::statement('ALTER TABLE aplikasis MODIFY deskripsi_singkat TEXT');
        }
    }
};
