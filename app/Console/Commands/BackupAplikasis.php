<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BackupAplikasis extends Command
{
    protected $signature = 'aplikasi:backup {--path= : Custom relative path inside storage/app}';
    protected $description = 'Backup tabel aplikasis ke file SQL (INSERT statements)';

    public function handle(): int
    {
        $rows = DB::table('aplikasis')->get();
        $count = $rows->count();
        if ($count === 0) {
            $this->info('Tabel aplikasis kosong, tetap membuat file kosong.');
        }

        $pathOption = $this->option('path');
        $dir = $pathOption ?: 'backups';
        $filename = 'aplikasis_backup_' . now()->format('Ymd_His') . '.sql';
        $fullPath = $dir . '/' . $filename;

        $lines = [];
        $lines[] = '-- Backup generated at ' . now();
        foreach ($rows as $r) {
            $vals = [
                $r->id,
                $r->opd_id,
                addslashes($r->nama_aplikasi),
                addslashes($r->deskripsi_singkat),
                $r->alamat_domain === null ? 'NULL' : "'" . addslashes($r->alamat_domain) . "'",
                addslashes($r->jenis_aplikasi),
                addslashes($r->status_aplikasi),
                $r->penyebab_tidak_aktif === null ? 'NULL' : "'" . addslashes($r->penyebab_tidak_aktif) . "'",
                addslashes($r->nama_pengelola),
                addslashes($r->nomor_wa_pengelola),
                $r->server_type ? "'" . addslashes($r->server_type) . "'" : 'NULL',
                "'" . $r->created_at . "'",
                "'" . $r->updated_at . "'",
            ];
            $lines[] = 'INSERT INTO aplikasis (id,opd_id,nama_aplikasi,deskripsi_singkat,alamat_domain,jenis_aplikasi,status_aplikasi,penyebab_tidak_aktif,nama_pengelola,nomor_wa_pengelola,server_type,created_at,updated_at) VALUES ('
                . $vals[0] . ',' . $vals[1] . ',\'' . $vals[2] . '\',\'' . $vals[3] . '\',' . $vals[4] . ',\'' . $vals[5] . '\',\'' . $vals[6] . '\',' . $vals[7] . ',\'' . $vals[8] . '\',\'' . $vals[9] . '\',' . $vals[10] . ',' . $vals[11] . ',' . $vals[12] . ');';
        }

        Storage::put($fullPath, implode("\n", $lines) . "\n");
        $this->info("Backup tersimpan: storage/app/$fullPath (baris: $count)");
        return Command::SUCCESS;
    }
}
