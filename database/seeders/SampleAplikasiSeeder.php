<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aplikasi;
use App\Models\Opd;

class SampleAplikasiSeeder extends Seeder
{
    public function run()
    {
        // Hapus data aplikasi yang sudah ada untuk fresh start
        Aplikasi::truncate();
        
        $aplikasiData = [
            // 1. Rumah Sakit Umum Daerah Caruban
            [
                'nama_aplikasi' => 'SP4N LAPOR',
                'opd_nama' => 'Rumah Sakit Umum Daerah Caruban',
                'deskripsi' => 'SP4N LAPOR! adalah Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional - Layanan Aspirasi dan Pengaduan Online Rakyat. Platform resmi yang memungkinkan masyarakat Indonesia menyampaikan aspirasi dan pengaduan terkait pelayanan publik.',
                'alamat_domain' => 'https://lapor.go.id',
                'jenis_aplikasi' => 'Aplikasi Pusat/Umum',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'INSTALASI HUMAS dan PROMKES',
                'nomor_wa' => '081335598281'
            ],
            
            // 2. Kecamatan Dolopo  
            [
                'nama_aplikasi' => 'Sistem Informasi Kecamatan Dolopo',
                'opd_nama' => 'Kecamatan Dolopo',
                'deskripsi' => 'Belum memiliki aplikasi khusus untuk pelayanan publik kecamatan',
                'alamat_domain' => null,
                'jenis_aplikasi' => 'Aplikasi Lainnya',
                'status_aplikasi' => 'Tidak Aktif',
                'penyebab_tidak_aktif' => 'Belum dikembangkan',
                'nama_pengelola' => 'Camat Dolopo',
                'nomor_wa' => '081234567801'
            ],
            
            // 3-7. Dinas Pekerjaan Umum dan Penataan Ruang (5 aplikasi)
            [
                'nama_aplikasi' => 'Sistem Manajemen Arsip Digital (SIMARTA)',
                'opd_nama' => 'Dinas Pekerjaan Umum Dan Penataan Ruang',
                'deskripsi' => 'Sebuah sistem informasi penyimpanan Arsip secara digital. Program yang diolah untuk mempermudah dalam pencarian data dari surat masuk, surat keluar, dokumen, arsip pada Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Madiun',
                'alamat_domain' => 'http://192.168.108.2/',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'SRI WAHYUNINGSIH, ST., M.Si',
                'nomor_wa' => '081335102400'
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi Tata Ruang Kabupaten Madiun (SITARUKAMA)',
                'opd_nama' => 'Dinas Pekerjaan Umum Dan Penataan Ruang',
                'deskripsi' => 'Sebuah aplikasi peta digital yang menggambarkan data informasi terkait tata ruang di wilayah Kabupaten Madiun.',
                'alamat_domain' => 'https://sitarukama.citymap.id/',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'FEBRI EKO SISWANTO, ST., MT',
                'nomor_wa' => '081235517753'
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi Terpadu Jasa Konstruksi (SITJ KONSTRUKSI)',
                'opd_nama' => 'Dinas Pekerjaan Umum Dan Penataan Ruang',
                'deskripsi' => 'Mempermudah proses pengolahan data pengawasan serta pelaporan perusahaan konstruksi. Monitoring dan pengawasan terhadap izin-izin perusahaan konstruksi dengan bantuan aplikasi Teknologi Informasi yang tepat dan efisien.',
                'alamat_domain' => 'https://sitj-konstruksi.madiunkab.go.id/',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Agus Khoirul Budiawan',
                'nomor_wa' => '082142300290'
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi Sumber Daya Air Modern Berbasis Online dan Analog (SiSAMBONG)',
                'opd_nama' => 'Dinas Pekerjaan Umum Dan Penataan Ruang',
                'deskripsi' => 'Sebuah aplikasi modern yang menyajikan informasi dalam bidang sumber daya air. Berbagai macam informasi sumur pompa dalam, sumur reservoir, saluran pembuang, jaringan irigasi.',
                'alamat_domain' => 'https://sisambong.madiunkab.go.id/',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Fitri Nur Jannah, ST',
                'nomor_wa' => '085649345019'
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi dan Pelaporan Terpadu Jalan dan Jembatan (SILAT JANTAN)',
                'opd_nama' => 'Dinas Pekerjaan Umum Dan Penataan Ruang',
                'deskripsi' => 'Sebuah aplikasi peta digital yang menggambarkan data-data kondisi infrastruktur jalan dan jembatan di Kabupaten Madiun, serta aplikasi untuk melaporkan kerusakan jalan.',
                'alamat_domain' => 'https://silatjantan.madiunkab.go.id/',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'ALFIQ NURCHOLIS SETIADI, ST',
                'nomor_wa' => '08112873429'
            ],
            
            // 8. Bagian Perekonomian dan SDA
            [
                'nama_aplikasi' => 'SIPD & Srikandi',
                'opd_nama' => 'Bagian Perekonomian Dan Sumber Daya Alam',
                'deskripsi' => 'SIPD untuk Perencanaan dan penataausahan APBD, Srikandi untuk Surat Elektronik',
                'alamat_domain' => 'https://sipd.kemendagri.go.id/landing',
                'jenis_aplikasi' => 'Aplikasi Pusat/Umum',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'GHULAM FAHRUL UMAM',
                'nomor_wa' => '085235011129'
            ],
            
            // 9. Kecamatan Balerejo
            [
                'nama_aplikasi' => 'SIPD Kecamatan Balerejo',
                'opd_nama' => 'Kecamatan Balerejo',
                'deskripsi' => 'Sistem Informasi Pemerintah Daerah untuk Kecamatan Balerejo',
                'alamat_domain' => 'https://sipd-ri.kemendagri.go.id/auth/login',
                'jenis_aplikasi' => 'Aplikasi Pusat/Umum',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Khury Imma',
                'nomor_wa' => '083864655088'
            ],
            
            // 10-21. Bagian Administrasi Pemerintahan (12 aplikasi)
            [
                'nama_aplikasi' => 'Satu Data Kabupaten Madiun',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Media penyelenggaraan Satu Data Kabupaten Madiun, mulai dari Perencanaan Data, Pengumpulan Data, Pemeriksaan Data, dan Penyebarluasan Data',
                'alamat_domain' => 'https://data.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'DISKOMINFO Kabupaten Madiun',
                'nomor_wa' => '0351462927'
            ],
            [
                'nama_aplikasi' => 'E-Presensi Kabupaten Madiun',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem presensi elektronik Pemerintah Kabupaten Madiun',
                'alamat_domain' => 'https://absen.madiunkab.go.id/',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'DISKOMINFO Kabupaten Madiun',
                'nomor_wa' => '0351462927'
            ],
            [
                'nama_aplikasi' => 'ESAKA Evaluasi SAKIP Perangkat Daerah',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem informasi mengenai pelaporan renstra, perjanjian kinerja, pengukuran kinerja, pengelolaan data kinerja, pelaporan kinerja, serta reviu dan evaluasi kinerja Kabupaten Madiun',
                'alamat_domain' => 'https://esaka.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'INSPEKTORAT KABUPATEN MADIUN',
                'nomor_wa' => '0351453412'
            ],
            [
                'nama_aplikasi' => 'Kertas Kerja Kab. Madiun',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem manajemen dan pelaporan kinerja pembangunan Daerah di Kabupaten Madiun',
                'alamat_domain' => 'https://kab.kertaskerja.cc',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'BAPPERIDA Kabupaten Madiun',
                'nomor_wa' => '0351451145'
            ],
            [
                'nama_aplikasi' => 'Penilaian Pelaksanaan Pekerjaan (e-P3)',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem informasi Penilaian Pelaksanaan Pekerjaan Pegawai Kabupaten Madiun',
                'alamat_domain' => 'http://ep3-madiunkab.prototipe.net',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'BKPSDM KABUPATEN MADIUN',
                'nomor_wa' => '03513890558'
            ],
            [
                'nama_aplikasi' => 'Simpeg Super App',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem Informasi Manajemen Kepegawaian Kabupaten Madiun',
                'alamat_domain' => 'https://simpeg.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'BKPSDM KABUPATEN MADIUN',
                'nomor_wa' => '03513890558'
            ],
            [
                'nama_aplikasi' => 'SISTEM INFORMASI LAPORAN PENYELENGGARAAN PEMERINTAHAN DAERAH V.1.2',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Platform yang bertujuan untuk memfasilitasi pelaporan dan evaluasi kinerja pemerintah daerah yang mengintegrasikan data dari berbagai sektor dan OPD untuk menyusun LPPD yang komprehensif',
                'alamat_domain' => 'https://elppd.kemendagri.go.id/',
                'jenis_aplikasi' => 'Aplikasi Pusat/Umum',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Direktorat Jenderal Otonomi Daerah',
                'nomor_wa' => '0213859335'
            ],
            [
                'nama_aplikasi' => 'LPPD JATIM',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Platform untuk memantau, mengevaluasi, dan melaporkan kinerja pemerintahan daerah di Provinsi Jawa Timur',
                'alamat_domain' => 'https://lppd.ropem.jatimprov.go.id/v2/',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Biro Pemerintahan dan Otonomi Daerah Sekretariat Daerah Provinsi Jawa Timur',
                'nomor_wa' => '031352400'
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi Kecamatan Pemerintah Provinsi Jawa Timur',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Platform bagi pemerintah provinsi Jawa Timur untuk mengelola dan memfasilitasi administrasi serta informasi terkait kecamatan di Provinsi Jawa Timur',
                'alamat_domain' => 'https://satria.ropem.jatimprov.go.id/sincan//',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Biro Pemerintahan & Otonomi Daerah Setda Provinsi Jawa Timur',
                'nomor_wa' => '031352400'
            ],
            [
                'nama_aplikasi' => 'PELAPORAN STANDAR PELAYANAN MINIMAL (SPM)',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Pusat informasi dan referensi mengenai standar pelayanan minimal (SPM) bagi Pemerintah Daerah di seluruh Indonesia',
                'alamat_domain' => 'https://spm.bangda.kemendagri.go.id/',
                'jenis_aplikasi' => 'Aplikasi Pusat/Umum',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'DITJEN BINA PEMBANGUNAN DAERAH KEMENTERIAN DALAM NEGERI',
                'nomor_wa' => '0217942653'
            ],
            [
                'nama_aplikasi' => 'Sistem Informasi Keuangan Daerah (SIKD)',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem untuk mengelola keuangan daerah secara terintegrasi dan transparan',
                'alamat_domain' => 'https://sikd.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Bagian Keuangan',
                'nomor_wa' => '081234567802'
            ],
            [
                'nama_aplikasi' => 'E-Surat Menyurat',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem surat menyurat elektronik untuk meningkatkan efisiensi administrasi pemerintahan',
                'alamat_domain' => 'https://esurat.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Bagian Umum',
                'nomor_wa' => '081234567803'
            ],
            
            // 22. Badan Perencanaan Pembangunan Daerah (BAPPEDA) - 1
            [
                'nama_aplikasi' => 'SIPD RI Kemendagri',
                'opd_nama' => 'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah',
                'deskripsi' => 'SIPD‑RI merupakan platform digital yang dikembangkan oleh Kementerian Dalam Negeri sebagai bagian dari kebijakan Sistem Pemerintahan Berbasis Elektronik (SPBE). Aplikasi ini mengintegrasikan seluruh data pembangunan, keuangan, dan pemerintahan daerah.',
                'alamat_domain' => 'https://sipd-ri.kemendagri.go.id/',
                'jenis_aplikasi' => 'Aplikasi Pusat/Umum',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'KHOIRUL IBAD, S.Sos',
                'nomor_wa' => '085745086487'
            ],
            
            // 23-24. Bagian Administrasi Pemerintahan (2 lagi)
            [
                'nama_aplikasi' => 'Sistem Monitoring Proyek Pembangunan',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Aplikasi untuk monitoring dan evaluasi progress proyek pembangunan di Kabupaten Madiun',
                'alamat_domain' => 'https://monitoring.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Tim Monitoring Pembangunan',
                'nomor_wa' => '081234567804'
            ],
            [
                'nama_aplikasi' => 'E-Pengadaan Barang dan Jasa',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem elektronik untuk pengadaan barang dan jasa pemerintah daerah',
                'alamat_domain' => 'https://lpse.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'LPSE Kabupaten Madiun',
                'nomor_wa' => '081234567805'
            ],
            
            // 25-26. Badan Perencanaan Pembangunan Daerah (BAPPEDA) - 2 lagi
            [
                'nama_aplikasi' => 'KRISNA',
                'opd_nama' => 'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah',
                'deskripsi' => 'Aplikasi KRISNA adalah sistem informasi berbasis web yang mendukung perencanaan program dan kegiatan pemerintah, termasuk penyusunan Rencana Kerja Pemerintah (RKP), penganggaran, serta pelaporan kinerja.',
                'alamat_domain' => 'https://madiunkab.krisna.systems/',
                'jenis_aplikasi' => 'Aplikasi Pusat/Umum',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'DAFFA\' PAMBUDI WIBOWO, S.Tr.IP',
                'nomor_wa' => '082141594449'
            ],
            [
                'nama_aplikasi' => 'MAPID',
                'opd_nama' => 'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah',
                'deskripsi' => 'Platform analitik lokasi yang menyediakan berbagai layanan untuk membantu pengguna dalam mengumpulkan, mengelola, memvisualisasikan, dan menganalisis data geospasial di Kabupaten Madiun',
                'alamat_domain' => 'https://bapperidamadiun.mapid.io/login',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'JUNI BAHTIAR RAHMAD, A.Md.',
                'nomor_wa' => '081233629293'
            ],
            
            // 27. Bagian Administrasi Pemerintahan (1 lagi)
            [
                'nama_aplikasi' => 'Aplikasi Pelayanan Perizinan Online',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem pelayanan perizinan online untuk mempermudah masyarakat dalam mengurus berbagai jenis izin',
                'alamat_domain' => 'https://izin.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Tidak Aktif',
                'penyebab_tidak_aktif' => 'Dalam tahap pengembangan',
                'nama_pengelola' => 'Bagian Perizinan',
                'nomor_wa' => '081234567806'
            ],
            
            // 28. Badan Perencanaan Pembangunan Daerah (BAPPEDA) - 1 lagi
            [
                'nama_aplikasi' => 'Sistem Perencanaan Pembangunan Daerah (SPPD)',
                'opd_nama' => 'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah',
                'deskripsi' => 'Sistem untuk perencanaan, monitoring, dan evaluasi pembangunan daerah secara komprehensif',
                'alamat_domain' => 'https://sppd.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Tim Perencanaan BAPPEDA',
                'nomor_wa' => '081234567807'
            ],
            
            // 29-30. Bagian Administrasi Pemerintahan (2 terakhir)
            [
                'nama_aplikasi' => 'E-Voting Musrenbang',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Sistem e-voting untuk musyawarah perencanaan pembangunan tingkat desa dan kelurahan',
                'alamat_domain' => 'https://evoting.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Tidak Aktif',
                'penyebab_tidak_aktif' => 'Hanya digunakan saat musrenbang',
                'nama_pengelola' => 'Tim IT Pembangunan',
                'nomor_wa' => '081234567808'
            ],
            [
                'nama_aplikasi' => 'Dashboard Kinerja OPD',
                'opd_nama' => 'Bagian Administrasi Pembangunan',
                'deskripsi' => 'Dashboard untuk memantau kinerja seluruh Organisasi Perangkat Daerah di Kabupaten Madiun',
                'alamat_domain' => 'https://dashboard.madiunkab.go.id',
                'jenis_aplikasi' => 'Aplikasi Khusus/Daerah',
                'status_aplikasi' => 'Aktif',
                'penyebab_tidak_aktif' => null,
                'nama_pengelola' => 'Tim Dashboard OPD',
                'nomor_wa' => '081234567809'
            ]
        ];

        foreach ($aplikasiData as $data) {
            // Cari OPD berdasarkan nama yang mirip
            $opd = $this->findMatchingOpd($data['opd_nama']);
            
            if (!$opd) {
                // Default ke OPD pertama jika tidak ditemukan
                $opd = Opd::first();
                echo "Warning: OPD '{$data['opd_nama']}' tidak ditemukan, menggunakan default.\n";
            }

            Aplikasi::create([
                'nama_aplikasi' => $data['nama_aplikasi'],
                'opd_id' => $opd->id,
                'deskripsi_singkat' => $data['deskripsi'],
                'alamat_domain' => $data['alamat_domain'],
                'jenis_aplikasi' => $data['jenis_aplikasi'],
                'status_aplikasi' => $data['status_aplikasi'],
                'penyebab_tidak_aktif' => $data['penyebab_tidak_aktif'],
                'nama_pengelola' => $data['nama_pengelola'],
                'nomor_wa_pengelola' => $data['nomor_wa']
            ]);
        }

        echo "Sample 30 aplikasi berhasil ditambahkan!\n";
    }

    private function findMatchingOpd($opdName)
    {
        // Mapping nama OPD dari data dengan nama OPD di database
        $mappings = [
            'Rumah Sakit Umum Daerah Caruban' => 'Rumah Sakit Umum Daerah Caruban',
            'Kecamatan Dolopo' => 'Kecamatan Dolopo',
            'Dinas Pekerjaan Umum Dan Penataan Ruang' => 'Dinas Pekerjaan Umum Dan Penataan Ruang',
            'Bagian Perekonomian Dan Sumber Daya Alam' => 'Bagian Perekonomian Dan Sumber Daya Alam',
            'Kecamatan Balerejo' => 'Kecamatan Balerejo',
            'Bagian Administrasi Pembangunan' => 'Bagian Administrasi Pembangunan',
            'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah' => 'Badan Perencanaan Pembangunan Riset Dan Inovasi Daerah'
        ];

        // Cari exact match
        if (isset($mappings[$opdName])) {
            return Opd::where('nama_opd', $mappings[$opdName])->first();
        }

        // Cari dengan LIKE jika tidak exact match
        return Opd::where('nama_opd', 'LIKE', '%' . $opdName . '%')->first();
    }
}
