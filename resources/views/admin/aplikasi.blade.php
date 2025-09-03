@extends('layouts.app')

@section('title', 'Kelola Aplikasi - Admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Aplikasi</h1>
                <p class="mt-2 text-gray-600">Manajemen data aplikasi Kabupaten Madiun</p>
            </div>
            <a href="{{ route('aplikasi.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Aplikasi
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow rounded-lg p-6">
        <form method="GET" action="{{ route('admin.aplikasi') }}" class="space-y-4">
            <div class="grid gap-4 lg:grid-cols-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Nama aplikasi atau pengelola..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Aplikasi</label>
                    <select id="jenis" 
                            name="jenis"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Jenis</option>
                        <option value="Web" {{ request('jenis') === 'Web' ? 'selected' : '' }}>Web</option>
                        <option value="Mobile" {{ request('jenis') === 'Mobile' ? 'selected' : '' }}>Mobile</option>
                        <option value="Desktop" {{ request('jenis') === 'Desktop' ? 'selected' : '' }}>Desktop</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" 
                            name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="Aktif" {{ request('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ request('status') === 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div>
                    <label for="opd" class="block text-sm font-medium text-gray-700 mb-1">OPD</label>
                    <select id="opd" 
                            name="opd"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua OPD</option>
                        @foreach($opds as $opd)
                            <option value="{{ $opd->id }}" {{ request('opd') == $opd->id ? 'selected' : '' }}>
                                {{ $opd->nama_opd }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-between">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter
                </button>

                @if(request()->hasAny(['search', 'jenis', 'status', 'opd']))
                    <a href="{{ route('admin.aplikasi') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results Summary -->
    <div class="bg-white shadow rounded-lg p-4">
        <div class="flex justify-between items-center text-sm text-gray-600">
            <span>Menampilkan {{ $aplikasis->firstItem() ?? 0 }} - {{ $aplikasis->lastItem() ?? 0 }} dari {{ $aplikasis->total() }} aplikasi</span>
            <span>{{ $aplikasis->links() }}</span>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aplikasi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jenis
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pengelola
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            OPD
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dibuat
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($aplikasis as $aplikasi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('aplikasi.show', $aplikasi) }}" class="hover:text-blue-600">
                                            {{ $aplikasi->nama_aplikasi }}
                                        </a>
                                    </div>
                                    @if($aplikasi->alamat_domain)
                                        <div class="text-sm text-gray-500">
                                            <a href="{{ $aplikasi->alamat_domain }}" 
                                               class="text-blue-600 hover:text-blue-800" 
                                               target="_blank">
                                                {{ Str::limit($aplikasi->alamat_domain, 30) }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $aplikasi->jenis_aplikasi === 'Web' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $aplikasi->jenis_aplikasi === 'Mobile' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $aplikasi->jenis_aplikasi === 'Desktop' ? 'bg-purple-100 text-purple-800' : '' }}">
                                    {{ $aplikasi->jenis_aplikasi }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $aplikasi->status_aplikasi === 'Aktif' 
                                       ? 'bg-green-100 text-green-800' 
                                       : 'bg-red-100 text-red-800' }}">
                                    {{ $aplikasi->status_aplikasi }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $aplikasi->nama_pengelola }}</div>
                                <div class="text-sm text-gray-500">{{ $aplikasi->nomor_wa_pengelola }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ Str::limit($aplikasi->opd->nama_opd, 25) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $aplikasi->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('aplikasi.show', $aplikasi) }}" 
                                       class="text-blue-600 hover:text-blue-900"
                                       title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('aplikasi.edit', $aplikasi) }}" 
                                       class="text-yellow-600 hover:text-yellow-900"
                                       title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('aplikasi.destroy', $aplikasi) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Yakin ingin menghapus aplikasi {{ $aplikasi->nama_aplikasi }}?')"
                                                class="text-red-600 hover:text-red-900"
                                                title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center">
                                <div class="text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada aplikasi</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        @if(request()->hasAny(['search', 'jenis', 'status', 'opd']))
                                            Tidak ada aplikasi yang sesuai dengan filter yang dipilih.
                                        @else
                                            Belum ada aplikasi yang terdaftar.
                                        @endif
                                    </p>
                                    <div class="mt-6">
                                        <a href="{{ route('aplikasi.create') }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Tambah Aplikasi Pertama
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($aplikasis->hasPages())
        <div class="bg-white shadow rounded-lg px-6 py-4">
            {{ $aplikasis->links() }}
        </div>
    @endif
</div>
@endsection
