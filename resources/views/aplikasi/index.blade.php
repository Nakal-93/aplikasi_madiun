@extends('layouts.app')

@section('title', 'Daftar Aplikasi - Data Aplikasi Kabupaten Madiun')

@section('content')
<!-- Modern Hero Section -->
<div class="gradient-bg rounded-3xl shadow-2xl mb-8 overflow-hidden relative" data-aos="fade-down">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute -top-20 -right-20 w-40 h-40 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-40 h-40 rounded-full bg-white/10 blur-3xl"></div>
    </div>
    
    <div class="relative px-8 py-16">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="flex-1" data-aos="fade-right">
                <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Aplikasi Digital
                    <span class="block text-white/90 text-2xl font-normal mt-2">
                        Kabupaten Madiun
                    </span>
                </h1>
                <p class="text-white/90 text-xl leading-relaxed max-w-2xl mb-8">
                    Sistem informasi terpadu untuk mengelola dan memantau seluruh aplikasi yang digunakan oleh OPD di lingkungan Pemerintah Kabupaten Madiun.
                </p>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="glass-effect rounded-2xl p-4 text-center" data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-3xl font-bold text-white">{{ $totalAplikasi }}</div>
                        <div class="text-white/80">Total Aplikasi</div>
                    </div>
                    <div class="glass-effect rounded-2xl p-4 text-center" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-3xl font-bold text-green-300">{{ $aplikasiAktif }}</div>
                        <div class="text-white/80">Aplikasi Aktif</div>
                    </div>
                    <div class="glass-effect rounded-2xl p-4 text-center" data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-3xl font-bold text-red-300">{{ $aplikasiTidakAktif }}</div>
                        <div class="text-white/80">Tidak Aktif</div>
                    </div>
                    <div class="glass-effect rounded-2xl p-4 text-center" data-aos="zoom-in" data-aos-delay="400">
                        <div class="text-3xl font-bold text-blue-300">{{ $totalOpd }}</div>
                        <div class="text-white/80">OPD Terdaftar</div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('aplikasi.create') }}" 
                       class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 btn-hover"
                       data-aos="fade-up" data-aos-delay="400">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Aplikasi Baru
                    </a>
                    
                    @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="inline-flex items-center px-8 py-4 glass-effect border border-white/30 text-white font-semibold rounded-2xl hover:bg-white/10 transition-all duration-300 btn-hover"
                       data-aos="fade-up" data-aos-delay="500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dashboard Admin
                    </a>
                    @else
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center px-8 py-4 glass-effect border border-white/30 text-white font-semibold rounded-2xl hover:bg-white/10 transition-all duration-300 btn-hover"
                       data-aos="fade-up" data-aos-delay="500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login Admin
                    </a>
                    @endauth
                </div>
            </div>
            
            <!-- Hero Illustration -->
            <div class="mt-8 lg:mt-0 lg:ml-12 flex-shrink-0" data-aos="fade-left">
                <div class="w-80 h-80 glass-effect rounded-full flex items-center justify-center">
                    <svg class="w-40 h-40 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Menu Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover" data-aos="fade-up" data-aos-delay="100">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Lihat Semua Aplikasi</h3>
        <p class="text-gray-600 text-sm mb-4">Jelajahi daftar lengkap aplikasi yang tersedia</p>
        <a href="#aplikasi-list" onclick="scrollToElement('aplikasi-list')" class="text-blue-600 text-sm font-medium hover:text-blue-700">
            Lihat Aplikasi →
        </a>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover" data-aos="fade-up" data-aos-delay="200">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Daftarkan Aplikasi</h3>
        <p class="text-gray-600 text-sm mb-4">Tambahkan aplikasi baru ke dalam sistem</p>
        <a href="{{ route('aplikasi.create') }}" class="text-green-600 text-sm font-medium hover:text-green-700">
            Daftar Sekarang →
        </a>
    </div>
</div>

<!-- Filter & Search Section -->
<div class="mb-8" id="aplikasi-list" data-aos="fade-up">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center space-x-4">
                <h2 class="text-lg font-semibold text-gray-900">Daftar Aplikasi</h2>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                    {{ $aplikasis->total() }} Total
                </span>
            </div>
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Update terakhir: {{ now()->format('d M Y, H:i') }} WIB</span>
            </div>
        </div>
    </div>
</div>

<!-- Applications Grid -->
@if($aplikasis->count() > 0)
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach($aplikasis as $aplikasi)
            <div class="group bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-blue-200 transition-all duration-300 overflow-hidden">
                <!-- Card Header -->
                <div class="p-6 pb-4">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                    {{ $aplikasi->nama_aplikasi }}
                                </h3>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full flex-shrink-0
                            {{ $aplikasi->status_aplikasi === 'Aktif' 
                               ? 'bg-green-100 text-green-800 border border-green-200' 
                               : 'bg-red-100 text-red-800 border border-red-200' }}">
                            {{ $aplikasi->status_aplikasi }}
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ $aplikasi->deskripsi_singkat ? Str::limit($aplikasi->deskripsi_singkat, 120) : 'Tidak ada deskripsi tersedia.' }}
                    </p>
                </div>

                <!-- Card Body -->
                <div class="px-6 pb-4">
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="text-sm text-gray-600 truncate">{{ $aplikasi->opd->nama_opd }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">{{ $aplikasi->jenis_aplikasi }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm text-gray-600 truncate">{{ $aplikasi->nama_pengelola }}</span>
                        </div>
                        @if($aplikasi->alamat_domain)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                <a href="{{ $aplikasi->alamat_domain }}" 
                                   class="text-sm text-blue-600 hover:text-blue-800 truncate" 
                                   target="_blank">
                                    {{ parse_url($aplikasi->alamat_domain, PHP_URL_HOST) ?: $aplikasi->alamat_domain }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">
                            {{ $aplikasi->created_at->diffForHumans() }}
                        </span>
                        <a href="{{ route('aplikasi.show', $aplikasi) }}" 
                           class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200">
                            Lihat Detail
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $aplikasis->links() }}
    </div>
@else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada aplikasi terdaftar</h3>
        <p class="text-gray-600 mb-8">
            Mulai dengan menambahkan aplikasi pertama untuk membangun database aplikasi OPD Kabupaten Madiun.
        </p>
        <a href="{{ route('aplikasi.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Aplikasi Pertama
        </a>
    </div>
@endif
@endsection
