<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing records that have null jenis_aplikasi
        DB::table('aplikasis')
            ->whereNull('jenis_aplikasi')
            ->update(['jenis_aplikasi' => 'Aplikasi Lainnya']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this as it's just setting default values
    }
};
