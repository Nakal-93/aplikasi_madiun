<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aplikasi;
use App\Models\Opd;

class TambahanAplikasiSeeder extends Seeder
{
    public function run()
    {
        // Daftar 179 OPD dengan data cleaning dan mapping ke database
        $opdList = [
            'Bagian Administrasi Pembangunan', // mapping dari 'Bagian Administrasi Pemerintahan'
            'Bagian Administrasi Pembangunan',
            'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah', // mapping dari 'Badan Perencanaan Pembangunan Daerah (BAPPEDA)'
            'Bagian Administrasi Pembangunan',
            'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah',
            'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah',
            'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah',
            'Bagian Protokol Dan Komunikasi Pimpinan', // mapping dari 'Bagian Protokol dan Komunikasi Pimpinan'
            'Kecamatan Mejayan',
            'Kecamatan Sawahan',
            'Dinas Sosial',
            'Kecamatan Mejayan',
            'Dinas Pariwisata Pemuda Dan Olahraga', // mapping dari 'Dinas Pariwisata, Pemuda dan Olahraga'
            'Dinas Pariwisata Pemuda Dan Olahraga',
            'Kecamatan Dagangan',
            'Dinas Pariwisata Pemuda Dan Olahraga',
            'Kecamatan Mejayan',
            'Kecamatan Mejayan',
            'Kecamatan Mejayan',
            'Kecamatan Mejayan',
            'Badan Kesatuan Bangsa Dan Politik', // mapping dari 'Badan Kesatuan Bangsa dan Politik Dalam Negeri'
            'Badan Kesatuan Bangsa Dan Politik',
            'Badan Kesatuan Bangsa Dan Politik',
            'Badan Kesatuan Bangsa Dan Politik',
            'Dinas Lingkungan Hidup',
            'Dinas Lingkungan Hidup',
            'Badan Pengelolaan Keuangan Dan Aset Daerah', // mapping dari 'Badan Pengelolaan Keuangan dan Aset Daerah (BPKAD)'
            'Badan Pengelolaan Keuangan Dan Aset Daerah',
            'Badan Pengelolaan Keuangan Dan Aset Daerah',
            'Dinas Perumahan Dan Kawasan Permukiman', // mapping dari 'Dinas Perumahan dan Kawasan Pemukiman'
            'Dinas Perumahan Dan Kawasan Permukiman',
            'Dinas Perumahan Dan Kawasan Permukiman',
            'Dinas Perumahan Dan Kawasan Permukiman',
            'Dinas Kependudukan Dan Pencatatan Sipil', // mapping dari 'Dinas Kependudukan dan Pencatatan Sipil'
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Sekretariat DPRD',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Kebonsari',
            'Kecamatan Kebonsari',
            'Kecamatan Kebonsari',
            'Kecamatan Kebonsari',
            'Kecamatan Kebonsari',
            'Kecamatan Kebonsari',
            'Kecamatan Kebonsari',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Wungu',
            'Kecamatan Saradan',
            'Kecamatan Saradan',
            'Kecamatan Saradan',
            'Kecamatan Kebonsari',
            'Kecamatan Kebonsari',
            'Kecamatan Saradan',
            'Kecamatan Kebonsari',
            'Kecamatan Jiwan',
            'Kecamatan Kebonsari',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Jiwan',
            'Kecamatan Saradan',
            'Kecamatan Saradan',
            'Kecamatan Saradan',
            'Kecamatan Jiwan',
            'Kecamatan Madiun',
            'Dinas Pendidikan Dan Kebudayaan', // mapping dari 'Dinas Pendidikan dan Kebudayaan'
            'Dinas Pendidikan Dan Kebudayaan',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu', // mapping dari 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Kecamatan Pilangkenceng',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Kecamatan Pilangkenceng',
            'Kecamatan Pilangkenceng',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Dinas Perpustakaan Dan Kearsipan', // mapping dari 'Dinas Perpustakaan dan Kearsipan'
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Dinas Perpustakaan Dan Kearsipan',
            'Dinas Perpustakaan Dan Kearsipan',
            'Dinas Perpustakaan Dan Kearsipan',
            'Bagian Pengadaan Barang Dan Jasa', // mapping dari 'Bagian Pengadaan Barang/Jasa'
            'Bagian Pengadaan Barang Dan Jasa',
            'Bagian Pengadaan Barang Dan Jasa',
            'Bagian Pengadaan Barang Dan Jasa',
            'Dinas Kesehatan',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Dinas Pemberdayaan Masyarakat Dan Desa', // mapping dari 'Dinas Pemberdayaan Masyarakat dan Desa'
            'Dinas Pemberdayaan Masyarakat Dan Desa',
            'Dinas Pemberdayaan Masyarakat Dan Desa',
            'Dinas Perdagangan Koperasi Dan Usaha Mikro', // mapping dari 'Dinas Perdagangan, Koperasi dan Usaha Mikro'
            'Dinas Perdagangan Koperasi Dan Usaha Mikro',
            'Dinas Perdagangan Koperasi Dan Usaha Mikro',
            'Dinas Perdagangan Koperasi Dan Usaha Mikro',
            'Dinas Perdagangan Koperasi Dan Usaha Mikro',
            'Dinas Perdagangan Koperasi Dan Usaha Mikro',
            'Dinas Perdagangan Koperasi Dan Usaha Mikro',
            'Dinas Perdagangan Koperasi Dan Usaha Mikro',
            'Dinas Perhubungan',
            'Dinas Perhubungan',
            'Dinas Pengendalian Penduduk Dan Keluarga Berencana Pemberdayaan Perempuan Dan Perlindungan Anak', // mapping dari nama panjang
            'Dinas Pengendalian Penduduk Dan Keluarga Berencana Pemberdayaan Perempuan Dan Perlindungan Anak',
            'Rumah Sakit Umum Daerah Dolopo' // mapping dari 'Rumah Sakit Umum Daerah Dolopo'
        ];

        $count = 0;
        $errors = [];
        $cleaningLog = [];

        foreach ($opdList as $index => $opdNama) {
            try {
                // Cari OPD di database dengan data cleaning
                $opd = Opd::where('nama_opd', $opdNama)->first();
                
                if (!$opd) {
                    // Fallback ke OPD pertama jika tidak ditemukan
                    $opd = Opd::first();
                    $errors[] = "⚠️ OPD '{$opdNama}' tidak ditemukan di database, menggunakan fallback";
                }

                // Generate data aplikasi dengan cleaning
                $dataAplikasi = $this->generateCleanData($opdNama, $index);
                
                Aplikasi::create([
                    'nama_aplikasi' => $dataAplikasi['nama_aplikasi'],
                    'opd_id' => $opd->id,
                    'deskripsi_singkat' => $dataAplikasi['deskripsi_singkat'], // kolom yang benar
                    'alamat_domain' => $dataAplikasi['alamat_domain'],
                    'jenis_aplikasi' => $dataAplikasi['jenis_aplikasi'],
                    'status_aplikasi' => $dataAplikasi['status_aplikasi'],
                    'penyebab_tidak_aktif' => $dataAplikasi['penyebab_tidak_aktif'],
                    'nama_pengelola' => $dataAplikasi['nama_pengelola'],
                    'nomor_wa_pengelola' => $dataAplikasi['nomor_wa_pengelola'] // kolom yang benar
                ]);

                $count++;
                
                // Log data cleaning
                if (!empty($dataAplikasi['cleaning_notes'])) {
                    $cleaningLog = array_merge($cleaningLog, $dataAplikasi['cleaning_notes']);
                }

            } catch (\Exception $e) {
                $errors[] = "❌ Error pada aplikasi ke-" . ($index + 1) . " ({$opdNama}): " . $e->getMessage();
            }
        }

        // Output hasil
        echo "🎉 SEEDING SELESAI!\n";
        echo "✅ Berhasil menambahkan: {$count} aplikasi\n";
        echo "📊 Total aplikasi sekarang: " . Aplikasi::count() . "\n\n";
        
        // Show data cleaning summary
        if (!empty($cleaningLog)) {
            echo "🧹 DATA CLEANING SUMMARY:\n";
            $cleaningStats = array_count_values($cleaningLog);
            foreach ($cleaningStats as $issue => $count) {
                echo "- {$issue}: {$count} kasus\n";
            }
            echo "\n";
        }
        
        // Show errors (max 10)
        if (!empty($errors)) {
            echo "⚠️ WARNINGS & ERRORS (showing first 10):\n";
            foreach (array_slice($errors, 0, 10) as $error) {
                echo "{$error}\n";
            }
            if (count($errors) > 10) {
                echo "... dan " . (count($errors) - 10) . " warning lainnya\n";
            }
        }
    }

    private function generateCleanData($opdNama, $index)
    {
        static $opdCounter = [];
        $cleaningNotes = [];
        
        if (!isset($opdCounter[$opdNama])) {
            $opdCounter[$opdNama] = 0;
        }
        $opdCounter[$opdNama]++;

        // Generate nama aplikasi
        $namaAplikasi = $this->generateNamaAplikasi($opdNama, $opdCounter[$opdNama]);
        
        // Generate data dengan simulasi masalah asli
        $jenisAplikasi = ['Aplikasi Khusus/Daerah', 'Aplikasi Pusat/Umum', 'Aplikasi Lainnya'];
        $statusAplikasi = ['Aktif', 'Tidak Aktif'];
        
        $jenis = $jenisAplikasi[array_rand($jenisAplikasi)];
        $status = $statusAplikasi[array_rand($statusAplikasi)];
        
        // Generate nomor HP dengan masalah (terlalu panjang, dll)
        $nomorAsli = $this->generateProblematicPhoneNumber();
        $nomorBersih = $this->cleanPhoneNumber($nomorAsli);
        if ($nomorAsli !== $nomorBersih) {
            $cleaningNotes[] = "Nomor HP dibersihkan";
        }
        
        // Generate domain dengan masalah
        $domainAsli = $this->generateProblematicDomain($namaAplikasi, $status);
        $domainBersih = $this->cleanDomain($domainAsli);
        if ($domainAsli !== $domainBersih) {
            $cleaningNotes[] = "Domain diperbaiki";
        }

        return [
            'nama_aplikasi' => $namaAplikasi,
            'deskripsi_singkat' => $this->generateDeskripsi($namaAplikasi, $opdNama),
            'alamat_domain' => $domainBersih,
            'jenis_aplikasi' => $jenis,
            'status_aplikasi' => $status,
            'penyebab_tidak_aktif' => ($status === 'Tidak Aktif') ? $this->generatePenyebab() : null,
            'nama_pengelola' => $this->generatePengelola($opdNama),
            'nomor_wa_pengelola' => $nomorBersih,
            'cleaning_notes' => $cleaningNotes
        ];
    }

    private function generateProblematicPhoneNumber()
    {
        $problematic = [
            '081234567890123456', // terlalu panjang (16 digit)
            '02180882815734621', // terlalu panjang (17 digit)  
            '0217805851999888', // terlalu panjang (15 digit)
            '0', // terlalu pendek
            '-', // invalid
            'tidak ada', // invalid
            '081-234-567-890', // ada strip
            '+62811234567890', // ada kode negara
            '0811 2345 6789', // ada spasi
            '(0811) 234-5678', // ada kurung
        ];
        
        return $problematic[array_rand($problematic)];
    }

    private function generateProblematicDomain($namaAplikasi, $status)
    {
        $problematic = [
            'tidak ada',
            '-',
            'VPN',
            'Desktop',
            'Privat',
            'Link khusus FTP',
            'Aplikasi yang diinstal',
            'http://192.168.1.100', // IP internal
            'localhost:8080', // localhost
            'www.google.com', // domain salah
            '', // kosong
            'htps://salah.com', // typo protokol
        ];
        
        // 30% kemungkinan domain bermasalah
        if (rand(1, 100) <= 30 || $status === 'Tidak Aktif') {
            return $problematic[array_rand($problematic)];
        }
        
        // Domain normal
        $slug = strtolower(str_replace([' ', '/', '(', ')', ','], ['', '', '', '', ''], $namaAplikasi));
        $slug = substr($slug, 0, 15);
        return 'https://' . $slug . '.madiunkab.go.id';
    }

    private function cleanPhoneNumber($phone)
    {
        if (empty($phone) || $phone === '0' || $phone === '-' || $phone === 'tidak ada') {
            return '081234567890'; // Default
        }

        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Remove country code if exists
        if (str_starts_with($phone, '62')) {
            $phone = '0' . substr($phone, 2);
        }

        // Limit to 13 digits max (Indonesian mobile standard)
        if (strlen($phone) > 13) {
            $phone = substr($phone, 0, 13);
        }

        // Ensure minimum 10 digits
        if (strlen($phone) < 10) {
            return '081234567890';
        }

        // Ensure starts with 0
        if (!str_starts_with($phone, '0')) {
            $phone = '0' . $phone;
        }

        return $phone;
    }

    private function cleanDomain($domain)
    {
        $invalidDomains = [
            'tidak ada', '-', 'VPN', 'Desktop', 'Privat', 
            'Link khusus FTP', 'Aplikasi yang diinstal', 
            'localhost', ''
        ];

        if (empty($domain) || in_array(strtolower($domain), array_map('strtolower', $invalidDomains))) {
            return null; // Set to null for invalid domains
        }

        // Fix common typos
        $domain = str_replace('htps://', 'https://', $domain);
        $domain = str_replace('http://', 'https://', $domain);
        
        // Add protocol if missing and domain looks valid
        if (!str_starts_with($domain, 'http') && str_contains($domain, '.')) {
            $domain = 'https://' . $domain;
        }

        // Validate domain format
        if (!filter_var($domain, FILTER_VALIDATE_URL)) {
            return null;
        }

        return $domain;
    }

    private function generateNamaAplikasi($opdNama, $counter)
    {
        $templates = [
            'kecamatan' => [
                'SIPD Kecamatan', 'E-Surat Kecamatan', 'Portal Desa', 'Sistem Pelayanan Kecamatan',
                'E-Monev Kecamatan', 'Sistem Informasi Penduduk', 'E-Planning Kecamatan', 'Portal APBDes',
                'Sistem Pengaduan Masyarakat', 'E-Laporan Kecamatan', 'Portal Transparansi', 'E-Musrenbang',
                'Sistem Administrasi Desa', 'Portal Statistik', 'E-Voting Musdes', 'Portal Layanan Publik',
                'Sistem Informasi Geografis', 'E-Perizinan Desa', 'Portal Informasi Publik', 'Dashboard Kecamatan'
            ],
            'dinas' => [
                'Sistem Informasi Manajemen', 'E-Planning', 'Portal Layanan Publik', 'Sistem Monitoring',
                'E-Reporting', 'Aplikasi Mobile Service', 'Dashboard Kinerja', 'Sistem Pengaduan Online',
                'E-Document Management', 'Portal Transparansi'
            ],
            'default' => [
                'Sistem Informasi', 'E-Office', 'Portal Internal', 'Dashboard Executive',
                'Sistem Administrasi', 'E-Planning', 'Sistem Monitoring', 'E-Reporting'
            ]
        ];

        if (str_contains($opdNama, 'Kecamatan')) {
            $namaKec = str_replace('Kecamatan ', '', $opdNama);
            $apps = $templates['kecamatan'];
            $appIndex = ($counter - 1) % count($apps);
            return $apps[$appIndex] . ' ' . $namaKec;
        } elseif (str_contains($opdNama, 'Dinas')) {
            $apps = $templates['dinas'];
            $appIndex = ($counter - 1) % count($apps);
            return $apps[$appIndex] . ' ' . str_replace('Dinas ', '', $opdNama);
        } else {
            $apps = $templates['default'];
            $appIndex = ($counter - 1) % count($apps);
            return $apps[$appIndex] . ' ' . $opdNama . ($counter > 1 ? ' #' . $counter : '');
        }
    }

    private function generateDeskripsi($namaAplikasi, $opdNama)
    {
        $templates = [
            "Sistem informasi untuk mendukung pelayanan dan administrasi di {$opdNama}",
            "Aplikasi digital yang membantu meningkatkan efisiensi kerja {$opdNama}",
            "Platform teknologi untuk optimalisasi layanan publik {$opdNama}",
            "Sistem manajemen terintegrasi untuk {$opdNama}",
            "Aplikasi pendukung operasional dan pelayanan {$opdNama}"
        ];

        return $templates[array_rand($templates)];
    }

    private function generatePengelola($opdNama)
    {
        $positions = ['Kepala Bidang IT', 'Admin Sistem', 'Operator Aplikasi', 'Koordinator IT', 'Tim Teknis'];
        return $positions[array_rand($positions)] . ' ' . $opdNama;
    }

    private function generatePenyebab()
    {
        $penyebab = [
            'Masih dalam pengembangan',
            'Butuh update sistem', 
            'Server maintenance',
            'Migrasi data',
            'Upgrade infrastruktur',
            'Belum ada anggaran',
            'Menunggu persetujuan'
        ];
        
        return $penyebab[array_rand($penyebab)];
    }
}
