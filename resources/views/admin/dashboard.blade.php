@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-2xl shadow-xl p-8 text-white">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="flex-1">
                <h1 class="text-3xl lg:text-4xl font-bold mb-2">Dashboard Admin</h1>
                <p class="text-blue-100 text-lg mb-4 lg:mb-0">Selamat datang di panel administrasi Data Aplikasi Kabupaten Madiun</p>
                <div class="flex items-center space-x-2 text-blue-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ now()->format('d F Y, H:i') }} WIB</span>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="w-32 h-32 bg-white bg-opacity-10 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Aplikasi -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Aplikasi</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalAplikasi }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">
                            +12% dari bulan lalu
                        </span>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aplikasi Aktif -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Aplikasi Aktif</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $aplikasiAktif }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">
                            {{ $totalAplikasi > 0 ? round(($aplikasiAktif / $totalAplikasi) * 100, 1) : 0 }}% dari total
                        </span>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aplikasi Tidak Aktif -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Tidak Aktif</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $aplikasiTidakAktif }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">
                            {{ $totalAplikasi > 0 ? round(($aplikasiTidakAktif / $totalAplikasi) * 100, 1) : 0 }}% dari total
                        </span>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center">
                        <div class="w-8 h-8 bg-red-100 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total OPD -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total OPD</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalOpd }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">
                            Organisasi Daerah
                        </span>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center">
                        <div class="w-8 h-8 bg-purple-100 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics Section -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Aplikasi per Jenis -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Distribusi Aplikasi per Jenis</h2>
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            
            <div class="space-y-4">
                @foreach($aplikasiPerJenis as $index => $jenis)
                    @php
                        $colors = [
                            'Web' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-600', 'light' => 'bg-blue-100'],
                            'Mobile' => ['bg' => 'bg-green-500', 'text' => 'text-green-600', 'light' => 'bg-green-100'],
                            'Desktop' => ['bg' => 'bg-purple-500', 'text' => 'text-purple-600', 'light' => 'bg-purple-100']
                        ];
                        $color = $colors[$jenis->jenis_aplikasi] ?? ['bg' => 'bg-gray-500', 'text' => 'text-gray-600', 'light' => 'bg-gray-100'];
                        $percentage = $totalAplikasi > 0 ? ($jenis->total / $totalAplikasi) * 100 : 0;
                    @endphp
                    <div class="flex items-center justify-between p-4 {{ $color['light'] }} rounded-xl hover:shadow-md transition-all duration-300">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 {{ $color['bg'] }} rounded-lg flex items-center justify-center">
                                @if($jenis->jenis_aplikasi === 'Web')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                @elseif($jenis->jenis_aplikasi === 'Mobile')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <span class="text-sm font-semibold text-gray-800">{{ $jenis->jenis_aplikasi }}</span>
                                <p class="text-xs text-gray-600">{{ round($percentage, 1) }}% dari total</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-24 bg-gray-200 rounded-full h-3">
                                <div class="{{ $color['bg'] }} h-3 rounded-full transition-all duration-1000 ease-out" 
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                            <span class="text-xl font-bold {{ $color['text'] }}">{{ $jenis->total }}</span>
                        </div>
                    </div>
                @endforeach
                
                @if($aplikasiPerJenis->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Belum ada data aplikasi</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Aplikasi Terbaru -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Aplikasi Terbaru</h2>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <a href="{{ route('admin.aplikasi') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            
            <div class="space-y-4">
                @forelse($aplikasiTerbaru as $aplikasi)
                    <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all duration-300 group">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                @if($aplikasi->jenis_aplikasi === 'Web')
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                @elseif($aplikasi->jenis_aplikasi === 'Mobile')
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate group-hover:text-blue-600 transition-colors duration-300">
                                <a href="{{ route('aplikasi.show', $aplikasi) }}" class="hover:underline">
                                    {{ $aplikasi->nama_aplikasi }}
                                </a>
                            </p>
                            <p class="text-xs text-gray-600 truncate mt-1">{{ $aplikasi->opd->nama_opd }}</p>
                            <div class="flex items-center mt-2 space-x-2">
                                <span class="text-xs text-gray-500">{{ $aplikasi->created_at->diffForHumans() }}</span>
                                <span class="text-xs text-gray-400">•</span>
                                <span class="text-xs text-gray-500">{{ $aplikasi->jenis_aplikasi }}</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $aplikasi->status_aplikasi === 'Aktif' 
                                   ? 'bg-green-100 text-green-800' 
                                   : 'bg-red-100 text-red-800' }}">
                                {{ $aplikasi->status_aplikasi }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Belum ada aplikasi yang terdaftar</p>
                        <a href="{{ route('aplikasi.create') }}" 
                           class="mt-3 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Aplikasi Pertama
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900">Menu Cepat</h2>
            <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>
        
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('aplikasi.create') }}" 
               class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100 border-2 border-dashed border-blue-300 rounded-2xl p-6 hover:border-blue-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500 bg-opacity-10 rounded-full transform translate-x-6 -translate-y-6"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">Tambah Aplikasi Baru</h3>
                    <p class="text-sm text-gray-600">Daftarkan aplikasi baru ke dalam sistem data Kabupaten Madiun</p>
                    <div class="mt-4 flex items-center text-blue-600 text-sm font-medium">
                        <span>Mulai sekarang</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.aplikasi') }}" 
               class="group relative overflow-hidden bg-gradient-to-br from-green-50 to-emerald-100 border-2 border-dashed border-green-300 rounded-2xl p-6 hover:border-green-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-green-500 bg-opacity-10 rounded-full transform translate-x-6 -translate-y-6"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors duration-300">Kelola Aplikasi</h3>
                    <p class="text-sm text-gray-600">Edit, hapus, dan kelola seluruh data aplikasi yang terdaftar</p>
                    <div class="mt-4 flex items-center text-green-600 text-sm font-medium">
                        <span>Kelola data</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('aplikasi.index') }}" 
               class="group relative overflow-hidden bg-gradient-to-br from-purple-50 to-violet-100 border-2 border-dashed border-purple-300 rounded-2xl p-6 hover:border-purple-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-purple-500 bg-opacity-10 rounded-full transform translate-x-6 -translate-y-6"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors duration-300">Lihat Halaman Publik</h3>
                    <p class="text-sm text-gray-600">Tampilan halaman aplikasi untuk masyarakat umum</p>
                    <div class="mt-4 flex items-center text-purple-600 text-sm font-medium">
                        <span>Buka halaman</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Add some custom animations -->
<style>
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.space-y-6 > * {
    animation: slideInUp 0.6s ease-out forwards;
}

.space-y-6 > *:nth-child(1) { animation-delay: 0.1s; }
.space-y-6 > *:nth-child(2) { animation-delay: 0.2s; }
.space-y-6 > *:nth-child(3) { animation-delay: 0.3s; }
.space-y-6 > *:nth-child(4) { animation-delay: 0.4s; }

@media (prefers-reduced-motion: reduce) {
    .space-y-6 > * {
        animation: none;
    }
}
</style>
@endsection
