<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AplikasiController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['edit', 'update', 'destroy']),
        ];
    }

    public function index()
    {
        $aplikasis = Aplikasi::with('opd')->latest()->paginate(20);
        
        // Statistik untuk halaman utama
        $totalAplikasi = Aplikasi::count();
        $aplikasiAktif = Aplikasi::where('status_aplikasi', 'Aktif')->count();
        $aplikasiTidakAktif = Aplikasi::where('status_aplikasi', 'Tidak Aktif')->count();
        $totalOpd = \App\Models\Opd::count();
        
        return view('aplikasi.index', compact('aplikasis', 'totalAplikasi', 'aplikasiAktif', 'aplikasiTidakAktif', 'totalOpd'));
    }

    public function create()
    {
        $opds = Opd::orderBy('nama_opd')->get();
        return view('aplikasi.create', compact('opds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'opd_id' => 'required|exists:opds,id',
            'nama_aplikasi' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'alamat_domain' => 'nullable|url',
            'server_type' => 'nullable|in:Load-Balance,WHM',
            'jenis_aplikasi' => 'required|in:Aplikasi Khusus/Daerah,Aplikasi Pusat/Umum,Aplikasi Lainnya',
            'status_aplikasi' => 'required|in:Aktif,Tidak Aktif',
            'penyebab_tidak_aktif' => 'nullable|string',
            'nama_pengelola' => 'required|string|max:255',
            'nomor_wa_pengelola' => 'required|string|max:20',
        ]);

        Aplikasi::create($validated);

        return redirect()->route('aplikasi.index')->with('success', 'Data aplikasi berhasil ditambahkan!');
    }

    public function show(Aplikasi $aplikasi)
    {
        $aplikasi->load('opd');
        return view('aplikasi.show', compact('aplikasi'));
    }

    public function edit(Aplikasi $aplikasi)
    {
        $opds = Opd::orderBy('nama_opd')->get();
        return view('aplikasi.edit', compact('aplikasi', 'opds'));
    }

    public function update(Request $request, Aplikasi $aplikasi)
    {
        $validated = $request->validate([
            'opd_id' => 'required|exists:opds,id',
            'nama_aplikasi' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'alamat_domain' => 'nullable|url',
            'server_type' => 'nullable|in:Load-Balance,WHM',
            'jenis_aplikasi' => 'required|in:Aplikasi Khusus/Daerah,Aplikasi Pusat/Umum,Aplikasi Lainnya',
            'status_aplikasi' => 'required|in:Aktif,Tidak Aktif',
            'penyebab_tidak_aktif' => 'nullable|string',
            'nama_pengelola' => 'required|string|max:255',
            'nomor_wa_pengelola' => 'required|string|max:20',
        ]);

        $aplikasi->update($validated);

        return redirect()->route('admin.aplikasi')->with('success', 'Data aplikasi berhasil diupdate!');
    }

    public function destroy(Aplikasi $aplikasi)
    {
        $aplikasi->delete();
        return redirect()->route('admin.aplikasi')->with('success', 'Data aplikasi berhasil dihapus!');
    }
}
