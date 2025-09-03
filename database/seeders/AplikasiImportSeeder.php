<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use App\Models\Aplikasi;
use App\Models\Opd;

class AplikasiImportSeeder extends Seeder
{
    public function run(): void
    {
        $mappingPath = storage_path('app/import/mapping_opd_template.csv');
        $dataPath = base_path('aplikasi_normalized.csv');

        if (!file_exists($mappingPath) || !file_exists($dataPath)) {
            $this->command->warn('Mapping atau data file tidak ditemukan.');
            return;
        }

        // Bangun mapping Nama Perangkat Daerah -> opd_id
    $mappingCsv = Reader::createFromPath($mappingPath, 'r');
    $mappingCsv->setHeaderOffset(0);
    $mappingCsv->setDelimiter(';');
        $opdMap = [];
        foreach ($mappingCsv->getRecords() as $row) {
            $name = trim($row['Nama Perangkat Daerah'] ?? '');
            $id = trim($row['opd_id'] ?? '');
            if ($name !== '' && $id !== '') {
                $opdMap[$name] = (int)$id;
            }
        }

        // Baca data aplikasi
    $csv = Reader::createFromPath($dataPath, 'r');
    $csv->setHeaderOffset(0);
    $csv->setDelimiter(';');
        $records = $csv->getRecords();

        $insertBatch = [];
        $skippedNoOpd = 0;
        $skippedDuplicate = 0;
        $imported = 0;
        $correctedStatusSwap = 0;
        $defaultedStatus = 0;
        $nullifiedPenyebab = 0;

        $allowedStatus = ['Aktif', 'Tidak Aktif'];

        foreach ($records as $row) {
            $opdName = trim($row['Nama Perangkat Daerah'] ?? '');
            if (!isset($opdMap[$opdName])) {
                $skippedNoOpd++;
                continue; // skip baris tanpa mapping
            }
            $opdId = $opdMap[$opdName];

            $namaAplikasi = trim($row['Nama Aplikasi'] ?? '');
            // Cegah duplikasi sederhana
            $exists = Aplikasi::where('opd_id', $opdId)
                ->where('nama_aplikasi', $namaAplikasi)
                ->exists();
            if ($exists) {
                $skippedDuplicate++;
                continue;
            }

            $alamat = trim($row['Alamat Domain / Link Aplikasi'] ?? '');
            if ($alamat === '') {
                $alamat = null;
            }
            $jenis = trim($row['Jenis Aplikasi'] ?? '');
            $status = trim($row['Status Aplikasi'] ?? '');

            // Deteksi kemungkinan kolom tertukar (status berisi jenis atau sebaliknya)
            $looksLikeJenis = function (string $val): bool {
                if ($val === '') return false;
                if (str_starts_with($val, 'Aplikasi ')) return true; // pola umum
                $lower = strtolower($val);
                return in_array($lower, ['lainnya', 'aplikasi lainnya']);
            };

            if (!in_array($status, $allowedStatus)) {
                // Jika jenis berisi status valid sementara status tidak valid -> swap
                if (in_array($jenis, $allowedStatus)) {
                    $tmp = $status;
                    $status = $jenis;
                    $jenis = $tmp;
                    $correctedStatusSwap++;
                }
            }

            // Jika setelah swap status masih tidak valid, jadikan default 'Aktif'
            if (!in_array($status, $allowedStatus)) {
                $status = 'Aktif';
                $defaultedStatus++;
            }

            // Jika jenis kosong tapi status sebelumnya kelihatan seperti jenis (kasus tertukar ganda)
            if ($jenis === '' && $looksLikeJenis($row['Status Aplikasi'] ?? '')) {
                $jenis = trim($row['Status Aplikasi']);
            }

            // Gunakan kembali nilai jenis asli jika masih kosong dan ada fallback lain
            if ($jenis === '' && $looksLikeJenis($row['Jenis Aplikasi'] ?? '')) {
                $jenis = trim($row['Jenis Aplikasi']);
            }

            $penyebab = trim($row['Penyebab Aplikasi Tidak Aktif'] ?? '');
            if ($penyebab === '' || $penyebab === '?' || $status === 'Aktif') {
                if ($penyebab !== '') {
                    $nullifiedPenyebab++;
                }
                $penyebab = null;
            }

            $insertBatch[] = [
                'opd_id' => $opdId,
                'nama_aplikasi' => $namaAplikasi,
                'deskripsi_singkat' => $row['Deskripsi Singkat Aplikasi'] ?? '',
                'alamat_domain' => $alamat,
                'jenis_aplikasi' => $jenis,
                'status_aplikasi' => $status,
                'penyebab_tidak_aktif' => $penyebab,
                'nama_pengelola' => trim($row['Nama Pengelola '] ?? '') ?: trim($row['Nama Pengelola'] ?? ''),
                'nomor_wa_pengelola' => trim($row['Nomor  WA Pengelola'] ?? '') ?: '0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($insertBatch) === 500) {
                Aplikasi::insert($insertBatch);
                $imported += count($insertBatch);
                $insertBatch = [];
            }
        }

        if ($insertBatch) {
            Aplikasi::insert($insertBatch);
            $imported += count($insertBatch);
        }

    $this->command->info("Imported: $imported | Skipped No OPD: $skippedNoOpd | Skipped Duplicates: $skippedDuplicate | Status Swapped: $correctedStatusSwap | Status Defaulted: $defaultedStatus | Penyebab Cleared: $nullifiedPenyebab");
    }
}
