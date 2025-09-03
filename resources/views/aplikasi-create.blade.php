@extends('layouts.modern')

@section('title', 'Tambah Aplikasi Baru')
@section('page-title', 'Tambah Aplikasi')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard') }}">Beranda</a></li>
    <li><a href="{{ route('aplikasi.index') }}">Aplikasi</a></li>
    <li><span>Tambah Baru</span></li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('aplikasi.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Form Header -->
        <div class="card bg-gradient-to-br from-primary to-secondary text-primary-content shadow-xl">
            <div class="card-body">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">Daftarkan Aplikasi Baru</h2>
                        <p class="opacity-90">Lengkapi informasi aplikasi yang akan didaftarkan ke sistem</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <div class="card bg-base-200 shadow-xl">
            <div class="card-body space-y-6">
                <!-- Informasi Dasar -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Dasar Aplikasi
                    </h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Nama Aplikasi -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Nama Aplikasi *</span>
                            </label>
                            <input type="text" name="nama" placeholder="Contoh: SIMDA, SIMPEG, E-Planning..." 
                                   class="input input-bordered @error('nama') input-error @enderror" 
                                   value="{{ old('nama') }}" required>
                            @error('nama')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Kategori Aplikasi *</span>
                            </label>
                            <select name="kategori" class="select select-bordered @error('kategori') select-error @enderror" required>
                                <option value="">Pilih Kategori</option>
                                <option value="keuangan" {{ old('kategori') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="kepegawaian" {{ old('kategori') == 'kepegawaian' ? 'selected' : '' }}>Kepegawaian</option>
                                <option value="perencanaan" {{ old('kategori') == 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                                <option value="pelayanan" {{ old('kategori') == 'pelayanan' ? 'selected' : '' }}>Pelayanan Publik</option>
                                <option value="administrasi" {{ old('kategori') == 'administrasi' ? 'selected' : '' }}>Administrasi</option>
                                <option value="infrastruktur" {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur TI</option>
                                <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- OPD -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Organisasi Perangkat Daerah (OPD) *</span>
                            </label>
                            <select name="opd" class="select select-bordered @error('opd') select-error @enderror" required>
                                <option value="">Pilih OPD</option>
                                <option value="Sekretariat Daerah" {{ old('opd') == 'Sekretariat Daerah' ? 'selected' : '' }}>Sekretariat Daerah</option>
                                <option value="Badan Keuangan Daerah" {{ old('opd') == 'Badan Keuangan Daerah' ? 'selected' : '' }}>Badan Keuangan Daerah</option>
                                <option value="Bappeda" {{ old('opd') == 'Bappeda' ? 'selected' : '' }}>Bappeda</option>
                                <option value="Bagian Kepegawaian" {{ old('opd') == 'Bagian Kepegawaian' ? 'selected' : '' }}>Bagian Kepegawaian</option>
                                <option value="DPMPTSP" {{ old('opd') == 'DPMPTSP' ? 'selected' : '' }}>DPMPTSP</option>
                                <option value="Dinas Komunikasi dan Informatika" {{ old('opd') == 'Dinas Komunikasi dan Informatika' ? 'selected' : '' }}>Dinas Komunikasi dan Informatika</option>
                                <option value="Dinas Pendidikan" {{ old('opd') == 'Dinas Pendidikan' ? 'selected' : '' }}>Dinas Pendidikan</option>
                                <option value="Dinas Kesehatan" {{ old('opd') == 'Dinas Kesehatan' ? 'selected' : '' }}>Dinas Kesehatan</option>
                                <option value="Dinas Sosial" {{ old('opd') == 'Dinas Sosial' ? 'selected' : '' }}>Dinas Sosial</option>
                                <option value="Dinas PUPR" {{ old('opd') == 'Dinas PUPR' ? 'selected' : '' }}>Dinas PUPR</option>
                                <option value="Lainnya" {{ old('opd') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('opd')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Status Aplikasi *</span>
                            </label>
                            <select name="status" class="select select-bordered @error('status') select-error @enderror" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif / Beroperasi</option>
                                <option value="pengembangan" {{ old('status') == 'pengembangan' ? 'selected' : '' }}>Dalam Pengembangan</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            @error('status')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Deskripsi Aplikasi *</span>
                        </label>
                        <textarea name="deskripsi" 
                                  placeholder="Jelaskan fungsi, tujuan, dan manfaat aplikasi ini secara detail..."
                                  class="textarea textarea-bordered h-24 @error('deskripsi') textarea-error @enderror" 
                                  required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                </div>

                <!-- Informasi Teknis -->
                <div class="divider">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>

                <div class="space-y-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Informasi Teknis
                    </h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- URL Aplikasi -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">URL/Link Aplikasi</span>
                            </label>
                            <input type="url" name="url" 
                                   placeholder="https://namaaplikasi.madiunkab.go.id"
                                   class="input input-bordered @error('url') input-error @enderror" 
                                   value="{{ old('url') }}">
                            @error('url')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Platform -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Platform/Teknologi</span>
                            </label>
                            <input type="text" name="platform" 
                                   placeholder="Contoh: Laravel, PHP, ASP.NET, Java, dll"
                                   class="input input-bordered @error('platform') input-error @enderror" 
                                   value="{{ old('platform') }}">
                            @error('platform')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Database -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Database</span>
                            </label>
                            <select name="database" class="select select-bordered @error('database') select-error @enderror">
                                <option value="">Pilih Database</option>
                                <option value="MySQL" {{ old('database') == 'MySQL' ? 'selected' : '' }}>MySQL</option>
                                <option value="PostgreSQL" {{ old('database') == 'PostgreSQL' ? 'selected' : '' }}>PostgreSQL</option>
                                <option value="SQL Server" {{ old('database') == 'SQL Server' ? 'selected' : '' }}>SQL Server</option>
                                <option value="Oracle" {{ old('database') == 'Oracle' ? 'selected' : '' }}>Oracle</option>
                                <option value="SQLite" {{ old('database') == 'SQLite' ? 'selected' : '' }}>SQLite</option>
                                <option value="Lainnya" {{ old('database') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('database')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Hosting -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Hosting/Server</span>
                            </label>
                            <select name="hosting" class="select select-bordered @error('hosting') select-error @enderror">
                                <option value="">Pilih Hosting</option>
                                <option value="Internal" {{ old('hosting') == 'Internal' ? 'selected' : '' }}>Server Internal</option>
                                <option value="Cloud" {{ old('hosting') == 'Cloud' ? 'selected' : '' }}>Cloud Hosting</option>
                                <option value="Shared" {{ old('hosting') == 'Shared' ? 'selected' : '' }}>Shared Hosting</option>
                                <option value="VPS" {{ old('hosting') == 'VPS' ? 'selected' : '' }}>VPS</option>
                                <option value="Dedicated" {{ old('hosting') == 'Dedicated' ? 'selected' : '' }}>Dedicated Server</option>
                            </select>
                            @error('hosting')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Kontak PIC -->
                <div class="divider">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>

                <div class="space-y-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Person In Charge (PIC)
                    </h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Nama PIC -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Nama Penanggung Jawab *</span>
                            </label>
                            <input type="text" name="pic_nama" 
                                   placeholder="Nama lengkap PIC aplikasi"
                                   class="input input-bordered @error('pic_nama') input-error @enderror" 
                                   value="{{ old('pic_nama') }}" required>
                            @error('pic_nama')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Jabatan PIC -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Jabatan</span>
                            </label>
                            <input type="text" name="pic_jabatan" 
                                   placeholder="Jabatan dalam organisasi"
                                   class="input input-bordered @error('pic_jabatan') input-error @enderror" 
                                   value="{{ old('pic_jabatan') }}">
                            @error('pic_jabatan')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Email PIC -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Email *</span>
                            </label>
                            <input type="email" name="pic_email" 
                                   placeholder="email@madiunkab.go.id"
                                   class="input input-bordered @error('pic_email') input-error @enderror" 
                                   value="{{ old('pic_email') }}" required>
                            @error('pic_email')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Telepon PIC -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Nomor Telepon</span>
                            </label>
                            <input type="tel" name="pic_telepon" 
                                   placeholder="081234567890"
                                   class="input input-bordered @error('pic_telepon') input-error @enderror" 
                                   value="{{ old('pic_telepon') }}">
                            @error('pic_telepon')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="card bg-base-200 shadow-xl">
            <div class="card-body">
                <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                    <div class="text-sm text-base-content/70">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Field bertanda (*) wajib diisi
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('aplikasi.index') }}" class="btn btn-ghost">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Aplikasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation and enhancements
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');
    
    // Auto-format URL input
    const urlInput = document.querySelector('input[name="url"]');
    if (urlInput) {
        urlInput.addEventListener('blur', function() {
            let value = this.value.trim();
            if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
                this.value = 'https://' + value;
            }
        });
    }
    
    // Phone number formatting
    const phoneInput = document.querySelector('input[name="pic_telepon"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            // Remove non-numeric characters
            this.value = this.value.replace(/\D/g, '');
        });
    }
    
    // Form submission loading state
    form.addEventListener('submit', function() {
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span class="loading loading-spinner loading-sm mr-2"></span>
            Menyimpan...
        `;
    });
    
    // Auto-save to localStorage on form changes
    const formInputs = form.querySelectorAll('input, select, textarea');
    formInputs.forEach(input => {
        // Load saved data
        const savedValue = localStorage.getItem(`form_${input.name}`);
        if (savedValue && !input.value) {
            input.value = savedValue;
        }
        
        // Save on change
        input.addEventListener('change', function() {
            localStorage.setItem(`form_${this.name}`, this.value);
        });
    });
    
    // Clear localStorage on successful submit
    if (document.querySelector('.alert-success')) {
        formInputs.forEach(input => {
            localStorage.removeItem(`form_${input.name}`);
        });
    }
});
</script>
@endpush
