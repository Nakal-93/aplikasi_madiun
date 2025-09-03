<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aplikasi;

class AdditionalAplikasiSeeder extends Seeder
{
    public function run()
    {
        echo "Menambahkan 180 aplikasi tambahan...\n";
        
        // Generate 180 aplikasi menggunakan Factory
        Aplikasi::factory(180)->create();
        
        echo "180 aplikasi tambahan berhasil ditambahkan!\n";
        echo "Total aplikasi sekarang: " . Aplikasi::count() . "\n";
        
        // Show statistics
        echo "\n=== STATISTIK APLIKASI ===\n";
        
        echo "Status Aplikasi:\n";
        Aplikasi::selectRaw('status_aplikasi, count(*) as total')
            ->groupBy('status_aplikasi')
            ->get()
            ->each(function($item) {
                echo "- {$item->status_aplikasi}: {$item->total}\n";
            });
            
        echo "\nJenis Aplikasi:\n";
        Aplikasi::selectRaw('jenis_aplikasi, count(*) as total')
            ->groupBy('jenis_aplikasi')
            ->get()
            ->each(function($item) {
                echo "- {$item->jenis_aplikasi}: {$item->total}\n";
            });
            
        echo "\nTop 10 OPD dengan Aplikasi Terbanyak:\n";
        Aplikasi::with('opd')
            ->selectRaw('opd_id, count(*) as total')
            ->groupBy('opd_id')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get()
            ->each(function($item) {
                echo "- {$item->opd->nama_opd}: {$item->total} aplikasi\n";
            });
    }
}
