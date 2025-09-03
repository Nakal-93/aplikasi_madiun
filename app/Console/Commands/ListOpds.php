<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Opd;

class ListOpds extends Command
{
    protected $signature = 'opd:list';
    protected $description = 'Tampilkan daftar OPD (id;nama) untuk mapping';

    public function handle(): int
    {
        Opd::orderBy('nama_opd')->get(['id','nama_opd'])->each(function($o){
            $this->line($o->id.';'.$o->nama_opd);
        });
        return Command::SUCCESS;
    }
}
