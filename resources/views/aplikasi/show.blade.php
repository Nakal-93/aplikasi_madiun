@extends('layouts.app')

@section('title', $aplikasi->nama_aplikasi . ' - Detail Aplikasi')

@section('content')
<!-- Breadcrumb -->
<nav class="mb-6" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm">
        <li>
            <a href="{{ route('aplikasi.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                Beranda
            </a>
        </li>
        <li>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
        </li>
        <li class="text-gray-900 font-medium truncate">
            {{ Str::limit($aplikasi->nama_aplikasi, 50) }}
        </li>
    </ol>
</nav>

<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-8">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
            <div class="flex-1">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-white mb-2">
                            {{ $aplikasi->nama_aplikasi }}
                        </h1>
                        <p class="text-blue-100 text-lg">{{ $aplikasi->opd->nama_opd }}</p>
                    </div>
                </div>
                
                <div class="flex flex-wrap items-center gap-3">
                    <span class="px-4 py-2 rounded-full text-sm font-medium
                        {{ $aplikasi->status_aplikasi === 'Aktif' 
                           ? 'bg-green-100 text-green-800 border border-green-200' 
                           : 'bg-red-100 text-red-800 border border-red-200' }}">
                        {{ $aplikasi->status_aplikasi }}
                    </span>
                    @if($aplikasi->jenis_aplikasi)
                        <span class="px-4 py-2 bg-white/10 backdrop-blur-sm text-white rounded-full text-sm font-medium">
                            {{ $aplikasi->jenis_aplikasi }}
                        </span>
                    @endif
                    @if($aplikasi->alamat_domain)
                        <a href="{{ $aplikasi->alamat_domain }}" 
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-full text-sm font-medium hover:shadow-lg transition-all duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Buka Aplikasi
                        </a>
                    @endif
                </div>
            </div>
            
            @auth
            <div class="mt-6 lg:mt-0 lg:ml-8 flex-shrink-0">
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('aplikasi.edit', $aplikasi) }}" 
                       class="inline-flex items-center justify-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Aplikasi
                    </a>
                    <form method="POST" action="{{ route('aplikasi.destroy', $aplikasi) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Yakin ingin menghapus aplikasi ini?')"
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>

<!-- Content Grid -->
<div class="grid gap-8 lg:grid-cols-3">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Description Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                </svg>
                Deskripsi Aplikasi
            </h2>
            <div class="prose prose-lg max-w-none">
                <p class="text-gray-700 leading-relaxed text-lg">
                    {{ $aplikasi->deskripsi_singkat ?: 'Tidak ada deskripsi tersedia untuk aplikasi ini.' }}
                </p>
            </div>
        </div>

        <!-- Application Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Informasi Detail
            </h2>
            
            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 mb-1">Nama Aplikasi</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ $aplikasi->nama_aplikasi }}</dd>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 mb-1">Jenis Aplikasi</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ $aplikasi->jenis_aplikasi ?: 'Tidak ditentukan' }}</dd>
                        </div>
                    </div>

                    @if($aplikasi->alamat_domain)
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 mb-1">Domain / Link</dt>
                            <dd class="text-lg">
                                <a href="{{ $aplikasi->alamat_domain }}" 
                                   class="text-blue-600 hover:text-blue-800 font-semibold break-all" 
                                   target="_blank">
                                    {{ $aplikasi->alamat_domain }}
                                </a>
                            </dd>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 mb-1">Status</dt>
                            <dd>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $aplikasi->status_aplikasi === 'Aktif' 
                                       ? 'bg-green-100 text-green-800 border border-green-200' 
                                       : 'bg-red-100 text-red-800 border border-red-200' }}">
                                    {{ $aplikasi->status_aplikasi }}
                                </span>
                            </dd>
                        </div>
                    </div>

                    @if($aplikasi->status_aplikasi === 'Tidak Aktif' && $aplikasi->penyebab_tidak_aktif)
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 mb-1">Penyebab Tidak Aktif</dt>
                            <dd class="text-lg font-semibold text-red-600">{{ $aplikasi->penyebab_tidak_aktif }}</dd>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-8">
        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Kontak Pengelola
            </h3>
            
            <div class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-2">Nama Pengelola</dt>
                    <dd class="text-lg font-semibold text-gray-900">{{ $aplikasi->nama_pengelola }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-2">WhatsApp</dt>
                    <dd>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $aplikasi->nomor_wa_pengelola) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors duration-200" 
                           target="_blank">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            {{ $aplikasi->nomor_wa_pengelola }}
                        </a>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-2">Perangkat Daerah</dt>
                    <dd class="text-base font-medium text-gray-900">{{ $aplikasi->opd->nama_opd }}</dd>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Timeline
            </h3>
            
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900">Aplikasi dibuat</p>
                        <p class="text-sm text-gray-600">{{ $aplikasi->created_at->format('d M Y, H:i') }} WIB</p>
                        <p class="text-xs text-gray-500">{{ $aplikasi->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                
                @if($aplikasi->updated_at != $aplikasi->created_at)
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900">Terakhir diupdate</p>
                        <p class="text-sm text-gray-600">{{ $aplikasi->updated_at->format('d M Y, H:i') }} WIB</p>
                        <p class="text-xs text-gray-500">{{ $aplikasi->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Back Button -->
<div class="mt-8">
    <a href="{{ route('aplikasi.index') }}" 
       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Aplikasi
    </a>
</div>
@endsection
