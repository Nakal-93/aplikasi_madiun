@extends('layouts.app')

@section('title', 'Tambah Aplikasi - Data Aplikasi Kabupaten Madiun')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Aplikasi Baru</h1>
        <p class="mt-2 text-gray-600">Silakan isi form berikut untuk menambahkan data aplikasi</p>
    </div>

    <form method="POST" action="{{ route('aplikasi.store') }}" class="p-6">
        @csrf
        
        <div class="grid gap-6 lg:grid-cols-2">
            <!-- Nama Perangkat Daerah -->
            <div class="relative">
                <label for="opd_search" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Perangkat Daerah <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="text" 
                           id="opd_search" 
                           placeholder="Ketik untuk mencari OPD..."
                           autocomplete="off"
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pr-10">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Hidden select untuk form submission -->
                <select name="opd_id" id="opd_id" required class="hidden">
                    <option value="">Pilih OPD</option>
                    @foreach($opds as $opd)
                        <option value="{{ $opd->id }}" {{ old('opd_id') == $opd->id ? 'selected' : '' }}>
                            {{ $opd->nama_opd }}
                        </option>
                    @endforeach
                </select>
                
                <!-- Dropdown hasil pencarian -->
                <div id="opd_dropdown" class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg hidden max-h-60 overflow-y-auto">
                    <!-- Results will be populated by JavaScript -->
                </div>
                @error('opd_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Aplikasi -->
            <div>
                <label for="nama_aplikasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Aplikasi <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_aplikasi" id="nama_aplikasi" required
                       value="{{ old('nama_aplikasi') }}"
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Masukkan nama aplikasi">
                @error('nama_aplikasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat Domain/Link -->
            <div>
                <label for="alamat_domain" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat Domain / Link
                </label>
                <input type="url" name="alamat_domain" id="alamat_domain"
                       value="{{ old('alamat_domain', 'https://') }}"
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="https://example.com">
                @error('alamat_domain')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Server Type (Admin Only) -->
            @auth
            <div>
                <label for="server_type" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipe Server (Opsional)
                    <span class="text-sm text-gray-500 font-normal">- Hanya Admin</span>
                </label>
                <select name="server_type" id="server_type"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih Tipe Server</option>
                    <option value="Load-Balance" {{ old('server_type') == 'Load-Balance' ? 'selected' : '' }}>Load-Balance</option>
                    <option value="WHM" {{ old('server_type') == 'WHM' ? 'selected' : '' }}>WHM</option>
                </select>
                @error('server_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            @endauth

            <!-- Jenis Aplikasi -->
            <div>
                <label for="jenis_aplikasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Aplikasi <span class="text-red-500">*</span>
                </label>
                <select name="jenis_aplikasi" id="jenis_aplikasi" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih Jenis Aplikasi</option>
                    <option value="Aplikasi Khusus/Daerah" {{ old('jenis_aplikasi') == 'Aplikasi Khusus/Daerah' ? 'selected' : '' }}>
                        Aplikasi Khusus/Daerah
                    </option>
                    <option value="Aplikasi Pusat/Umum" {{ old('jenis_aplikasi') == 'Aplikasi Pusat/Umum' ? 'selected' : '' }}>
                        Aplikasi Pusat/Umum
                    </option>
                    <option value="Aplikasi Lainnya" {{ old('jenis_aplikasi') == 'Aplikasi Lainnya' ? 'selected' : '' }}>
                        Aplikasi Lainnya
                    </option>
                </select>
                @error('jenis_aplikasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aplikasi -->
            <div>
                <label for="status_aplikasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Status Aplikasi <span class="text-red-500">*</span>
                </label>
                <select name="status_aplikasi" id="status_aplikasi" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih Status</option>
                    <option value="Aktif" {{ old('status_aplikasi') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status_aplikasi') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status_aplikasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penyebab Tidak Aktif (Conditional) -->
            <div id="penyebab_tidak_aktif_field" class="hidden">
                <label for="penyebab_tidak_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                    Penyebab Aplikasi Tidak Aktif <span class="text-red-500">*</span>
                </label>
                <textarea name="penyebab_tidak_aktif" id="penyebab_tidak_aktif" rows="3"
                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                          placeholder="Jelaskan penyebab aplikasi tidak aktif...">{{ old('penyebab_tidak_aktif') }}</textarea>
                @error('penyebab_tidak_aktif')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Wajib diisi jika status aplikasi tidak aktif
                </p>
            </div>

            <!-- Nama Pengelola -->
            <div>
                <label for="nama_pengelola" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Pengelola <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_pengelola" id="nama_pengelola" required
                       value="{{ old('nama_pengelola') }}"
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Masukkan nama pengelola">
                @error('nama_pengelola')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nomor WA Pengelola -->
            <div>
                <label for="nomor_wa_pengelola" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor WA Pengelola <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nomor_wa_pengelola" id="nomor_wa_pengelola" required
                       value="{{ old('nomor_wa_pengelola') }}"
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="08xxxxxxxxxx">
                @error('nomor_wa_pengelola')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi Singkat -->
        <div class="mt-6">
            <label for="deskripsi_singkat" class="block text-sm font-medium text-gray-700 mb-2">
                Deskripsi Singkat <span class="text-red-500">*</span>
            </label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="4" required
                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Masukkan deskripsi singkat aplikasi">{{ old('deskripsi_singkat') }}</textarea>
            @error('deskripsi_singkat')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Penyebab Tidak Aktif -->
        <div class="mt-6" id="penyebab_tidak_aktif_container" style="display: none;">
            <label for="penyebab_tidak_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                Penyebab Tidak Aktif
            </label>
            <textarea name="penyebab_tidak_aktif" id="penyebab_tidak_aktif" rows="3"
                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Jelaskan alasan aplikasi tidak aktif">{{ old('penyebab_tidak_aktif') }}</textarea>
            @error('penyebab_tidak_aktif')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('aplikasi.index') }}" 
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                Batal
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                Simpan Aplikasi
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // OPD Autocomplete functionality
    const opdSearch = document.getElementById('opd_search');
    const opdSelect = document.getElementById('opd_id');
    const opdDropdown = document.getElementById('opd_dropdown');
    
    // Data OPD dari server
    const opds = [
        @foreach($opds as $opd)
        {
            id: {{ $opd->id }},
            name: "{{ $opd->nama_opd }}"
        },
        @endforeach
    ];
    
    // Function to filter and display OPD options
    function filterOpds(searchTerm) {
        const filtered = opds.filter(opd => 
            opd.name.toLowerCase().includes(searchTerm.toLowerCase())
        );
        
        if (filtered.length > 0 && searchTerm.length > 0) {
            opdDropdown.innerHTML = '';
            filtered.forEach(opd => {
                const item = document.createElement('div');
                item.className = 'px-4 py-2 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0';
                item.textContent = opd.name;
                item.addEventListener('click', function() {
                    selectOpd(opd.id, opd.name);
                });
                opdDropdown.appendChild(item);
            });
            opdDropdown.classList.remove('hidden');
        } else {
            opdDropdown.classList.add('hidden');
        }
    }
    
    // Function to select an OPD
    function selectOpd(id, name) {
        opdSearch.value = name;
        opdSelect.value = id;
        opdDropdown.classList.add('hidden');
        
        // Trigger change event for validation
        opdSelect.dispatchEvent(new Event('change'));
    }
    
    // Search input event listener
    opdSearch.addEventListener('input', function() {
        const searchTerm = this.value;
        if (searchTerm.length === 0) {
            opdSelect.value = '';
            opdDropdown.classList.add('hidden');
        } else {
            filterOpds(searchTerm);
        }
    });
    
    // Focus event - show all options
    opdSearch.addEventListener('focus', function() {
        if (this.value.length === 0) {
            filterOpds('');
            // Show all options when focused
            opdDropdown.innerHTML = '';
            opds.forEach(opd => {
                const item = document.createElement('div');
                item.className = 'px-4 py-2 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0';
                item.textContent = opd.name;
                item.addEventListener('click', function() {
                    selectOpd(opd.id, opd.name);
                });
                opdDropdown.appendChild(item);
            });
            opdDropdown.classList.remove('hidden');
        }
    });
    
    // Click outside to close dropdown
    document.addEventListener('click', function(event) {
        if (!opdSearch.contains(event.target) && !opdDropdown.contains(event.target)) {
            opdDropdown.classList.add('hidden');
        }
    });
    
    // Handle form submission validation
    opdSearch.closest('form').addEventListener('submit', function(e) {
        if (!opdSelect.value) {
            e.preventDefault();
            opdSearch.focus();
            opdSearch.classList.add('border-red-500');
            
            // Show error message
            let errorMsg = opdSearch.parentNode.querySelector('.opd-error');
            if (!errorMsg) {
                errorMsg = document.createElement('p');
                errorMsg.className = 'mt-1 text-sm text-red-600 opd-error';
                errorMsg.textContent = 'Pilih Perangkat Daerah terlebih dahulu';
                opdSearch.parentNode.appendChild(errorMsg);
            }
        } else {
            opdSearch.classList.remove('border-red-500');
            const errorMsg = opdSearch.parentNode.querySelector('.opd-error');
            if (errorMsg) {
                errorMsg.remove();
            }
        }
    });
    
    // Set initial value if old input exists
    @if(old('opd_id'))
        const selectedOpd = opds.find(opd => opd.id == {{ old('opd_id') }});
        if (selectedOpd) {
            opdSearch.value = selectedOpd.name;
        }
    @endif
    
    // Status Aplikasi functionality - Show/hide penyebab tidak aktif field
    const statusSelect = document.getElementById('status_aplikasi');
    const penyebabField = document.getElementById('penyebab_tidak_aktif_field');
    const penyebabTextarea = document.getElementById('penyebab_tidak_aktif');
    // Auto ensure https:// prefix for domain input
    const domainInput = document.getElementById('alamat_domain');
    if(domainInput){
        if(domainInput.value.trim() === '') domainInput.value = 'https://';
        domainInput.addEventListener('focus', () => {
            if(domainInput.value.trim() === '') domainInput.value = 'https://';
        });
        domainInput.addEventListener('blur', () => {
            const v = domainInput.value.trim();
            if(v !== '' && !v.startsWith('http://') && !v.startsWith('https://')){
                domainInput.value = 'https://' + v.replace(/^\/+/, '');
            }
        });
        domainInput.addEventListener('input', () => {
            if(domainInput.value === '') domainInput.value = 'https://';
        });
    }
    
    function togglePenyebabTidakAktif() {
        if (statusSelect.value === 'Tidak Aktif') {
            penyebabField.classList.remove('hidden');
            penyebabTextarea.setAttribute('required', 'required');
        } else {
            penyebabField.classList.add('hidden');
            penyebabTextarea.removeAttribute('required');
            penyebabTextarea.value = ''; // Clear the field when hidden
        }
    }
    
    statusSelect.addEventListener('change', togglePenyebabTidakAktif);
    
    // Check initial state (for old input)
    @if(old('status_aplikasi') == 'Tidak Aktif')
        penyebabField.classList.remove('hidden');
        penyebabTextarea.setAttribute('required', 'required');
    @endif
});
</script>
@endsection
