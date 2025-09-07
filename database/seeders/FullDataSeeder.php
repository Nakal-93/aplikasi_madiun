<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FullDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        try {
            // Copy all data from main database to current database
            $this->copyOpdData();
            $this->copyAplikasiData();
            $this->createAdminUser();
        } finally {
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }

    private function copyOpdData()
    {
        echo "Copying OPD data...\n";
        
        // Truncate existing data
        DB::table('opds')->truncate();
        
        // Get data from main database aplikasi_madiun
        $opds = DB::connection()->table('aplikasi_madiun.opds')
            ->select(['nama_opd', 'created_at', 'updated_at'])
            ->get();
        
        foreach ($opds as $opd) {
            DB::table('opds')->insert([
                'nama_opd' => $opd->nama_opd,
                'created_at' => $opd->created_at,
                'updated_at' => $opd->updated_at,
            ]);
        }
        
        echo "Copied " . $opds->count() . " OPD records\n";
    }

    private function copyAplikasiData()
    {
        echo "Copying Aplikasi data...\n";
        
        // Truncate existing data
        DB::table('aplikasis')->truncate();
        
        // Get data from main database aplikasi_madiun
        $aplikasis = DB::connection()->table('aplikasi_madiun.aplikasis')
            ->get();
        
        foreach ($aplikasis as $app) {
            DB::table('aplikasis')->insert([
                'opd_id' => $app->opd_id,
                'nama_aplikasi' => $app->nama_aplikasi,
                'deskripsi_singkat' => $app->deskripsi_singkat,
                'alamat_domain' => $app->alamat_domain,
                'server_type' => $app->server_type,
                'jenis_aplikasi' => $app->jenis_aplikasi,
                'status_aplikasi' => $app->status_aplikasi,
                'penyebab_tidak_aktif' => $app->penyebab_tidak_aktif,
                'nama_pengelola' => $app->nama_pengelola,
                'nomor_wa_pengelola' => $app->nomor_wa_pengelola,
                'created_at' => $app->created_at,
                'updated_at' => $app->updated_at,
            ]);
        }
        
        echo "Copied " . $aplikasis->count() . " Aplikasi records\n";
    }

    private function createAdminUser()
    {
        echo "Creating admin user...\n";
        
        // Create admin user if not exists
        $userExists = DB::table('users')->where('email', 'admin@madiun.go.id')->exists();
        
        if (!$userExists) {
            DB::table('users')->insert([
                'name' => 'Admin Kabupaten Madiun',
                'email' => 'admin@madiun.go.id',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            echo "Admin user created\n";
        } else {
            echo "Admin user already exists\n";
        }
    }
}
