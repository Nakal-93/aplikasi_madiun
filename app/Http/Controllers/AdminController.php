<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Opd;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalAplikasi = Aplikasi::count();
        $totalOpd = Opd::count();
        $aplikasiAktif = Aplikasi::where('status_aplikasi', 'Aktif')->count();
        $aplikasiTidakAktif = Aplikasi::where('status_aplikasi', 'Tidak Aktif')->count();
        
        $aplikasiTerbaru = Aplikasi::with('opd')->latest()->take(5)->get();
        
        // Data untuk chart aplikasi per jenis
        $aplikasiPerJenis = Aplikasi::selectRaw('jenis_aplikasi, count(*) as total')
            ->groupBy('jenis_aplikasi')
            ->get();
        
        return view('admin.dashboard', compact(
            'totalAplikasi', 
            'totalOpd', 
            'aplikasiAktif', 
            'aplikasiTidakAktif',
            'aplikasiTerbaru',
            'aplikasiPerJenis'
        ));
    }

    public function aplikasi(Request $request)
    {
        $query = Aplikasi::with('opd');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_aplikasi', 'like', "%{$search}%")
                  ->orWhere('nama_pengelola', 'like', "%{$search}%")
                  ->orWhereHas('opd', function($opdQuery) use ($search) {
                      $opdQuery->where('nama_opd', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status_aplikasi', $request->status);
        }

        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_aplikasi', $request->jenis);
        }

        if ($request->has('opd') && $request->opd != '') {
            $query->where('opd_id', $request->opd);
        }

        $aplikasis = $query->latest()->paginate(20);
        $opds = Opd::orderBy('nama_opd')->get();
        
        return view('admin.aplikasi', compact('aplikasis', 'opds'));
    }
}
