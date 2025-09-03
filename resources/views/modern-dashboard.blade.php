@extends('layouts.modern')

@section('title', 'Beranda')
@section('page-title', 'Data Aplikasi')

@section('breadcrumbs')
    <li><a>Beranda</a></li>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Aplikasi -->
        <div class="stat bg-base-200 rounded-box shadow-sm hover:shadow-md transition-shadow">
            <div class="stat-figure text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <div class="stat-title">Total Aplikasi</div>
            <div class="stat-value text-primary">{{ $totalAplikasi ?? 32 }}</div>
            <div class="stat-desc">Aplikasi terdaftar</div>
        </div>

        <!-- OPD Aktif -->
        <div class="stat bg-base-200 rounded-box shadow-sm hover:shadow-md transition-shadow">
            <div class="stat-figure text-secondary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div class="stat-title">OPD Aktif</div>
            <div class="stat-value text-secondary">{{ $opdAktif ?? 61 }}</div>
            <div class="stat-desc">Organisasi terdaftar</div>
        </div>

        <!-- Aplikasi Aktif -->
        <div class="stat bg-base-200 rounded-box shadow-sm hover:shadow-md transition-shadow">
            <div class="stat-figure text-accent">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <div class="stat-title">Aplikasi Aktif</div>
            <div class="stat-value text-accent">{{ $aplikasiAktif ?? 28 }}</div>
            <div class="stat-desc">Sedang beroperasi</div>
        </div>

        <!-- Pengembangan -->
        <div class="stat bg-base-200 rounded-box shadow-sm hover:shadow-md transition-shadow">
            <div class="stat-figure text-info">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
            </div>
            <div class="stat-title">Pengembangan</div>
            <div class="stat-value text-info">{{ $pengembangan ?? 4 }}</div>
            <div class="stat-desc">Dalam proses</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card bg-base-200 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Aksi Cepat
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <a href="{{ route('aplikasi.create') }}" class="btn btn-primary btn-lg btn-hover-lift">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Aplikasi Baru
                </a>
                
                <a href="{{ route('aplikasi.index') }}" class="btn btn-secondary btn-lg btn-hover-lift">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Lihat Semua Aplikasi
                </a>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-accent btn-lg btn-hover-lift">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dashboard Admin
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Latest Applications -->
    <div class="card bg-base-200 shadow-xl">
        <div class="card-body">
            <div class="flex items-center justify-between mb-4">
                <h2 class="card-title">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Aplikasi Terbaru
                </h2>
                <a href="{{ route('aplikasi.index') }}" class="btn btn-ghost btn-sm">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Sample Application Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Sample Card 1 -->
                <div class="card bg-base-100 shadow-lg card-hover">
                    <figure class="px-6 pt-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title text-base">SIMDA (Sistem Informasi Manajemen Daerah)</h3>
                        <p class="text-sm text-base-content/70">Sistem manajemen keuangan dan aset daerah untuk optimalisasi pengelolaan anggaran.</p>
                        <div class="flex items-center justify-between mt-4">
                            <div class="badge badge-primary">Keuangan</div>
                            <div class="flex items-center text-xs text-base-content/50">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                2 hari lalu
                            </div>
                        </div>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-sm btn-outline">Detail</button>
                        </div>
                    </div>
                </div>

                <!-- Sample Card 2 -->
                <div class="card bg-base-100 shadow-lg card-hover">
                    <figure class="px-6 pt-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-secondary to-accent rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title text-base">SIMPEG (Sistem Informasi Kepegawaian)</h3>
                        <p class="text-sm text-base-content/70">Aplikasi pengelolaan data kepegawaian dan administrasi SDM aparatur sipil negara.</p>
                        <div class="flex items-center justify-between mt-4">
                            <div class="badge badge-secondary">Kepegawaian</div>
                            <div class="flex items-center text-xs text-base-content/50">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                5 hari lalu
                            </div>
                        </div>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-sm btn-outline">Detail</button>
                        </div>
                    </div>
                </div>

                <!-- Sample Card 3 -->
                <div class="card bg-base-100 shadow-lg card-hover">
                    <figure class="px-6 pt-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent to-info rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title text-base">E-Planning (Perencanaan Elektronik)</h3>
                        <p class="text-sm text-base-content/70">Platform digital untuk penyusunan dan monitoring rencana pembangunan daerah.</p>
                        <div class="flex items-center justify-between mt-4">
                            <div class="badge badge-accent">Perencanaan</div>
                            <div class="flex items-center text-xs text-base-content/50">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                1 minggu lalu
                            </div>
                        </div>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-sm btn-outline">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- About Section -->
        <div class="card bg-gradient-to-br from-primary to-secondary text-primary-content shadow-xl">
            <div class="card-body">
                <h2 class="card-title">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tentang Sistem
                </h2>
                <p>
                    Sistem Informasi Manajemen Aplikasi Kabupaten Madiun merupakan platform terpusat untuk mengelola dan memantau seluruh aplikasi yang digunakan oleh Organisasi Perangkat Daerah (OPD) di lingkungan Pemerintah Kabupaten Madiun.
                </p>
                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-ghost text-primary-content">
                        Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="card bg-base-200 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Kontak & Dukungan
                </h2>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="text-sm">Dinas Komunikasi dan Informatika</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm">diskominfo@madiunkab.go.id</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-sm">(0351) 464-xxx</span>
                    </div>
                </div>
                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-primary btn-sm">Hubungi Kami</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Additional JavaScript for interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add click animations to cards
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.classList.contains('btn')) {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                }
            });
        });
    });
</script>
@endpush
