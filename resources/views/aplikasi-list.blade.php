@extends('layouts.modern')

@section('title', 'Semua Aplikasi')
@section('page-title', 'Daftar Aplikasi')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard') }}">Beranda</a></li>
    <li><span>Aplikasi</span></li>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Filter and Search Section -->
    <div class="card bg-base-200 shadow-lg">
        <div class="card-body">
            <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                <!-- Search Input -->
                <div class="form-control w-full lg:w-auto lg:flex-1">
                    <div class="input-group">
                        <input type="text" placeholder="Cari aplikasi..." class="input input-bordered w-full" id="searchInput">
                        <button class="btn btn-square btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Filter Dropdown -->
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-outline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter Kategori
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a data-filter="all">Semua Kategori</a></li>
                        <li><a data-filter="keuangan">Keuangan</a></li>
                        <li><a data-filter="kepegawaian">Kepegawaian</a></li>
                        <li><a data-filter="perencanaan">Perencanaan</a></li>
                        <li><a data-filter="pelayanan">Pelayanan Publik</a></li>
                        <li><a data-filter="administrasi">Administrasi</a></li>
                    </ul>
                </div>

                <!-- Add New Button -->
                <a href="{{ route('aplikasi.create') }}" class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Aplikasi
                </a>
            </div>
        </div>
    </div>

    <!-- Application Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="applicationGrid">
        <!-- Sample Applications -->
        @php
        $sampleAplikasi = [
            [
                'nama' => 'SIMDA (Sistem Informasi Manajemen Daerah)',
                'deskripsi' => 'Sistem manajemen keuangan dan aset daerah untuk optimalisasi pengelolaan anggaran dan pelaporan keuangan.',
                'kategori' => 'Keuangan',
                'badge_color' => 'badge-primary',
                'gradient' => 'from-primary to-secondary',
                'opd' => 'Badan Keuangan Daerah',
                'status' => 'Aktif',
                'url' => 'https://simda.madiunkab.go.id',
                'updated_at' => '2 hari lalu'
            ],
            [
                'nama' => 'SIMPEG (Sistem Informasi Kepegawaian)',
                'deskripsi' => 'Aplikasi pengelolaan data kepegawaian dan administrasi SDM aparatur sipil negara di lingkungan Pemkab Madiun.',
                'kategori' => 'Kepegawaian',
                'badge_color' => 'badge-secondary',
                'gradient' => 'from-secondary to-accent',
                'opd' => 'Bagian Kepegawaian',
                'status' => 'Aktif',
                'url' => 'https://simpeg.madiunkab.go.id',
                'updated_at' => '5 hari lalu'
            ],
            [
                'nama' => 'E-Planning (Perencanaan Elektronik)',
                'deskripsi' => 'Platform digital untuk penyusunan dan monitoring rencana pembangunan daerah secara terintegrasi.',
                'kategori' => 'Perencanaan',
                'badge_color' => 'badge-accent',
                'gradient' => 'from-accent to-info',
                'opd' => 'Bappeda',
                'status' => 'Aktif',
                'url' => 'https://eplanning.madiunkab.go.id',
                'updated_at' => '1 minggu lalu'
            ],
            [
                'nama' => 'SIPKD (Sistem Informasi Pengelolaan Keuangan Daerah)',
                'deskripsi' => 'Aplikasi untuk pengelolaan anggaran, penatausahaan, dan pertanggungjawaban keuangan daerah.',
                'kategori' => 'Keuangan',
                'badge_color' => 'badge-primary',
                'gradient' => 'from-info to-success',
                'opd' => 'Badan Keuangan Daerah',
                'status' => 'Maintenance',
                'url' => 'https://sipkd.madiunkab.go.id',
                'updated_at' => '3 hari lalu'
            ],
            [
                'nama' => 'E-Office (Electronic Office)',
                'deskripsi' => 'Sistem perkantoran elektronik untuk manajemen surat menyurat dan workflow administrasi.',
                'kategori' => 'Administrasi',
                'badge_color' => 'badge-warning',
                'gradient' => 'from-warning to-error',
                'opd' => 'Sekretariat Daerah',
                'status' => 'Aktif',
                'url' => 'https://eoffice.madiunkab.go.id',
                'updated_at' => '4 hari lalu'
            ],
            [
                'nama' => 'Mal Pelayanan Publik Online',
                'deskripsi' => 'Portal terintegrasi untuk berbagai layanan publik online kepada masyarakat Kabupaten Madiun.',
                'kategori' => 'Pelayanan Publik',
                'badge_color' => 'badge-success',
                'gradient' => 'from-success to-primary',
                'opd' => 'DPMPTSP',
                'status' => 'Aktif',
                'url' => 'https://mpp.madiunkab.go.id',
                'updated_at' => '1 hari lalu'
            ]
        ];
        @endphp

        @foreach($sampleAplikasi as $app)
        <div class="card bg-base-100 shadow-lg card-hover application-card" data-category="{{ strtolower($app['kategori']) }}">
            <!-- App Icon -->
            <figure class="px-6 pt-6">
                <div class="w-16 h-16 bg-gradient-to-br {{ $app['gradient'] }} rounded-xl flex items-center justify-center">
                    @if($app['kategori'] == 'Keuangan')
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    @elseif($app['kategori'] == 'Kepegawaian')
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    @elseif($app['kategori'] == 'Perencanaan')
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    @elseif($app['kategori'] == 'Administrasi')
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    @endif
                </div>
            </figure>

            <div class="card-body">
                <!-- Title and Status -->
                <div class="flex items-start justify-between">
                    <h3 class="card-title text-base leading-tight">{{ $app['nama'] }}</h3>
                    @if($app['status'] == 'Aktif')
                        <div class="badge badge-success badge-sm">Aktif</div>
                    @elseif($app['status'] == 'Maintenance')
                        <div class="badge badge-warning badge-sm">Maintenance</div>
                    @else
                        <div class="badge badge-ghost badge-sm">{{ $app['status'] }}</div>
                    @endif
                </div>

                <!-- Description -->
                <p class="text-sm text-base-content/70 mt-2">{{ $app['deskripsi'] }}</p>

                <!-- Category and OPD -->
                <div class="flex items-center justify-between mt-4">
                    <div class="badge {{ $app['badge_color'] }} badge-sm">{{ $app['kategori'] }}</div>
                    <div class="text-xs text-base-content/50">{{ $app['opd'] }}</div>
                </div>

                <!-- URL -->
                <div class="flex items-center mt-2 text-xs text-primary">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    <a href="{{ $app['url'] }}" target="_blank" class="hover:underline">{{ $app['url'] }}</a>
                </div>

                <!-- Footer with Date and Actions -->
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-base-300">
                    <div class="flex items-center text-xs text-base-content/50">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $app['updated_at'] }}
                    </div>
                    <div class="card-actions">
                        <div class="dropdown dropdown-left dropdown-end">
                            <label tabindex="0" class="btn btn-ghost btn-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-40">
                                <li><a href="{{ $app['url'] }}" target="_blank">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Buka Aplikasi
                                </a></li>
                                <li><a>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Detail
                                </a></li>
                                @auth
                                <li><a>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    <div class="text-center py-16 hidden" id="emptyState">
        <svg class="w-16 h-16 text-base-content/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="text-lg font-semibold text-base-content/70 mb-2">Tidak ada aplikasi ditemukan</h3>
        <p class="text-base-content/50">Coba ubah filter atau kata kunci pencarian Anda.</p>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        <div class="btn-group">
            <button class="btn btn-disabled">«</button>
            <button class="btn btn-active">1</button>
            <button class="btn">2</button>
            <button class="btn">3</button>
            <button class="btn">»</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const applicationGrid = document.getElementById('applicationGrid');
    const emptyState = document.getElementById('emptyState');
    const filterButtons = document.querySelectorAll('[data-filter]');
    
    let currentFilter = 'all';
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        filterApplications();
    });
    
    // Filter functionality
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentFilter = this.getAttribute('data-filter');
            filterApplications();
        });
    });
    
    function filterApplications() {
        const searchTerm = searchInput.value.toLowerCase();
        const cards = document.querySelectorAll('.application-card');
        let visibleCount = 0;
        
        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();
            const category = card.getAttribute('data-category');
            
            const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
            const matchesFilter = currentFilter === 'all' || category === currentFilter;
            
            if (matchesSearch && matchesFilter) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show/hide empty state
        if (visibleCount === 0) {
            applicationGrid.style.display = 'none';
            emptyState.classList.remove('hidden');
        } else {
            applicationGrid.style.display = 'grid';
            emptyState.classList.add('hidden');
        }
    }
    
    // Card hover animations
    const cards = document.querySelectorAll('.card-hover');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
