<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aplikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'opd_id',
        'nama_aplikasi',
        'deskripsi_singkat',
        'alamat_domain',
        'jenis_aplikasi',
        'status_aplikasi',
        'penyebab_tidak_aktif',
        'nama_pengelola',
        'nomor_wa_pengelola'
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
