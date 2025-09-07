<?php

namespace Database\Seeders;

use App\Models\Aplikasi;
use App\Models\Opd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AplikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan OPD sudah ada terlebih dahulu
        if (Opd::count() == 0) {
            $this->call(OpdSeeder::class);
        }

        // Hapus data aplikasi yang sudah ada untuk memastikan data fresh
        Aplikasi::truncate();

        // Ambil data dari database utama jika tersedia
        try {
            $aplikasiData = DB::connection('mysql')->table('aplikasis')->get();
            
            if ($aplikasiData->count() > 0) {
                echo "Copying " . $aplikasiData->count() . " aplikasi from main database...\n";
                
                foreach ($aplikasiData as $app) {
                    Aplikasi::create([
                        'nama_aplikasi' => $app->nama_aplikasi,
                        'deskripsi_singkat' => $app->deskripsi_singkat,
                        'alamat_domain' => $app->alamat_domain,
                        'server_type' => $app->server_type,
                        'jenis_aplikasi' => $app->jenis_aplikasi,
                        'status_aplikasi' => $app->status_aplikasi,
                        'penyebab_tidak_aktif' => $app->penyebab_tidak_aktif,
                        'nama_pengelola' => $app->nama_pengelola,
                        'nomor_wa_pengelola' => $app->nomor_wa_pengelola,
                        'opd_id' => $app->opd_id,
                        'created_at' => $app->created_at,
                        'updated_at' => $app->updated_at,
                    ]);
                }
                
                echo "Successfully copied all aplikasi data!\n";
                return;
            }
        } catch (\Exception $e) {
            echo "Could not copy from main database: " . $e->getMessage() . "\n";
            echo "Using sample data instead...\n";
        }

        // Jika tidak bisa mengambil dari database utama, gunakan data sample
        $this->createSampleData();
    }

    private function createSampleData()
    {
        // Sample data aplikasi berdasarkan data nyata
        $aplikasis = [
            [
                'nama_aplikasi' => 'SP4N LAPOR',
                'jenis_aplikasi' => 'Aplikasi Pusat/Umum',
                'status_aplikasi' => 'Aktif',
                'nama_pengelola' => 'INSTALASI HUMAS dan PROMKES',
                'nomor_wa_pengelola' => '081335598281',
                'alamat_domain' => 'https://lapor.go.id',
                'deskripsi_singkat' => 'SP4N LAPOR! adalah Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional - Layanan Aspirasi dan Pengaduan Online Rakyat.',
                'opd_id' => 1,
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi Kecamatan Dolopo',
                'jenis_aplikasi' => 'Aplikasi Lainnya',
                'status_aplikasi' => 'Tidak Aktif',
                'nama_pengelola' => 'Camat Dolopo',
                'nomor_wa_pengelola' => '081234567801',
                'deskripsi_singkat' => 'Belum memiliki aplikasi khusus untuk pelayanan publik kecamatan',
                'opd_id' => 2,
            ],
            [
                'nama_aplikasi' => 'Sistem Manajemen Arsip Digital (SIMARTA)',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'nama_pengelola' => 'SRI WAHYUNINGSIH, ST., M.Si',
                'nomor_wa_pengelola' => '081335102400',
                'alamat_domain' => 'http://192.168.108.2/',
                'deskripsi_singkat' => 'Sistem informasi penyimpanan Arsip secara digital untuk Dinas Pekerjaan Umum dan Penataan Ruang',
                'opd_id' => 3,
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi Tata Ruang Kabupaten Madiun (SITARUKAMA)',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'nama_pengelola' => 'FEBRI EKO SISWANTO, ST., MT',
                'nomor_wa_pengelola' => '081235517753',
                'alamat_domain' => 'https://sitarukama.citymap.id/',
                'deskripsi_singkat' => 'Aplikasi peta digital informasi tata ruang di wilayah Kabupaten Madiun',
                'opd_id' => 4,
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi Terpadu Jasa Konstruksi (SITJ KONSTRUKSI)',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'nama_pengelola' => 'Admin Konstruksi',
                'nomor_wa_pengelola' => '081234567894',
                'deskripsi_singkat' => 'Sistem informasi terpadu untuk mengelola jasa konstruksi',
                'opd_id' => 5,
            ],
        ];

        foreach ($aplikasis as $aplikasi) {
            Aplikasi::create($aplikasi);
        }

        // Tambah data dummy menggunakan factory untuk mencapai 218 data
        $currentCount = Aplikasi::count();
        $targetCount = 218;
        
        if ($currentCount < $targetCount) {
            $remaining = $targetCount - $currentCount;
            echo "Creating $remaining additional aplikasi using factory...\n";
            Aplikasi::factory($remaining)->create();
        }
        
        echo "Total aplikasi created: " . Aplikasi::count() . "\n";
    }
}
