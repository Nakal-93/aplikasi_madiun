<?php

namespace Database\Factories;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\Factory;

class AplikasiFactory extends Factory
{
    public function definition(): array
    {
        $jenisAplikasi = ['Aplikasi Khusus/Daerah', 'Aplikasi Pusat/Umum', 'Aplikasi Lainnya'];
        $statusAplikasi = ['Aktif', 'Tidak Aktif'];
        
        $namaAplikasi = [
            'Sistem Informasi Manajemen',
            'E-Government',
            'Portal Layanan Online',
            'Aplikasi Mobile Service',
            'Dashboard Monitoring',
            'Sistem Pelaporan Digital',
            'Platform Integrasi Data',
            'Aplikasi Pelayanan Publik',
            'Sistem Administrasi',
            'E-Office',
            'Sistem Keuangan',
            'Aplikasi Kepegawaian',
            'Portal Transparansi',
            'Sistem Perizinan',
            'E-Procurement',
            'Aplikasi Monitoring Kinerja',
            'Sistem Inventarisasi',
            'Portal Pengaduan Masyarakat',
            'Aplikasi Perencanaan',
            'Sistem Evaluasi'
        ];
        
        $deskripsi = [
            'Sistem informasi terintegrasi untuk meningkatkan efisiensi pelayanan publik di Kabupaten Madiun.',
            'Platform digital yang memfasilitasi interaksi antara pemerintah dan masyarakat secara online.',
            'Aplikasi berbasis web untuk mempermudah proses administrasi dan birokrasi pemerintahan.',
            'Sistem manajemen data yang mendukung pengambilan keputusan berbasis data akurat.',
            'Portal layanan terpadu yang mengintegrasikan berbagai layanan pemerintahan dalam satu platform.',
            'Aplikasi mobile untuk meningkatkan aksesibilitas layanan pemerintah bagi masyarakat.',
            'Sistem monitoring dan evaluasi kinerja organisasi perangkat daerah secara real-time.',
            'Platform digital untuk transparansi dan akuntabilitas penyelenggaraan pemerintahan.',
            'Aplikasi pengelolaan dokumen dan arsip digital untuk efisiensi administrasi.',
            'Sistem informasi yang mendukung pelaksanaan smart city di Kabupaten Madiun.'
        ];
        
        $domains = [
            'https://app1.madiunkab.go.id',
            'https://app2.madiunkab.go.id', 
            'https://sistem.madiunkab.go.id',
            'https://portal.madiunkab.go.id',
            'https://layanan.madiunkab.go.id',
            'https://e-gov.madiunkab.go.id',
            'https://digital.madiunkab.go.id',
            'https://online.madiunkab.go.id',
            null // Some apps don't have domain
        ];
        
        $pengelola = [
            'Tim IT Kabupaten Madiun',
            'DISKOMINFO Kabupaten Madiun',
            'Bagian TI dan Komunikasi',
            'Staff Teknologi Informasi',
            'Administrator Sistem',
            'Tim Pengembang Aplikasi',
            'Koordinator IT OPD',
            'Pengelola Sistem Informasi',
            'Tim Support Teknis',
            'Manager Aplikasi'
        ];
        
        $penyebabTidakAktif = [
            'Dalam tahap pengembangan',
            'Maintenance sistem',
            'Migrasi server',
            'Update security',
            'Integrasi dengan sistem baru',
            'Menunggu persetujuan',
            'Budget maintenance habis',
            null
        ];
        
        $isAktif = $this->faker->randomElement($statusAplikasi) === 'Aktif';
        
        return [
            'opd_id' => Opd::inRandomOrder()->first()->id,
            'nama_aplikasi' => $this->faker->randomElement($namaAplikasi) . ' ' . $this->faker->words(2, true),
            'deskripsi_singkat' => $this->faker->randomElement($deskripsi),
            'alamat_domain' => $this->faker->randomElement($domains),
            'jenis_aplikasi' => $this->faker->randomElement($jenisAplikasi),
            'status_aplikasi' => $isAktif ? 'Aktif' : 'Tidak Aktif',
            'penyebab_tidak_aktif' => $isAktif ? null : $this->faker->randomElement($penyebabTidakAktif),
            'nama_pengelola' => $this->faker->randomElement($pengelola),
            'nomor_wa_pengelola' => '08' . $this->faker->numerify('##########'),
        ];
    }
}
