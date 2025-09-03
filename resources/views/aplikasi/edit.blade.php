@extends('layouts.app')

@section('title', 'Edit ' . $aplikasi->nama_aplikasi)

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Aplikasi</h1>
        <p class="mt-1 text-gray-600">Perbarui informasi aplikasi {{ $aplikasi->nama_aplikasi }}</p>
    </div>

    <form method="POST" action="{{ route('aplikasi.update', $aplikasi) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-6 lg:grid-cols-2">
            <!-- Nama Aplikasi -->
            <div>
                <label for="nama_aplikasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Aplikasi <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_aplikasi" 
                       name="nama_aplikasi" 
                       value="{{ old('nama_aplikasi', $aplikasi->nama_aplikasi) }}"
                       required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_aplikasi') border-red-500 @enderror">
                @error('nama_aplikasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Aplikasi -->
            <div>
                <label for="jenis_aplikasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Aplikasi <span class="text-red-500">*</span>
                </label>
                <select id="jenis_aplikasi" 
                        name="jenis_aplikasi" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jenis_aplikasi') border-red-500 @enderror">
                    <option value="">Pilih Jenis Aplikasi</option>
                    <option value="Aplikasi Khusus/Daerah" {{ old('jenis_aplikasi', $aplikasi->jenis_aplikasi) === 'Aplikasi Khusus/Daerah' ? 'selected' : '' }}>Aplikasi Khusus/Daerah</option>
                    <option value="Aplikasi Pusat/Umum" {{ old('jenis_aplikasi', $aplikasi->jenis_aplikasi) === 'Aplikasi Pusat/Umum' ? 'selected' : '' }}>Aplikasi Pusat/Umum</option>
                    <option value="Aplikasi Lainnya" {{ old('jenis_aplikasi', $aplikasi->jenis_aplikasi) === 'Aplikasi Lainnya' ? 'selected' : '' }}>Aplikasi Lainnya</option>
                </select>
                @error('jenis_aplikasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat Domain -->
            <div>
                <label for="alamat_domain" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat Domain / Link
                </label>
                <input type="url" 
                       id="alamat_domain" 
                       name="alamat_domain" 
                       value="{{ old('alamat_domain', $aplikasi->alamat_domain) }}"
                       placeholder="https://example.com"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('alamat_domain') border-red-500 @enderror">
                @error('alamat_domain')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aplikasi -->
            <div>
                <label for="status_aplikasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Status Aplikasi <span class="text-red-500">*</span>
                </label>
                <select id="status_aplikasi" 
                        name="status_aplikasi" 
                        required
                        onchange="togglePenyebabTidakAktif()"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status_aplikasi') border-red-500 @enderror">
                    <option value="">Pilih Status</option>
                    <option value="Aktif" {{ old('status_aplikasi', $aplikasi->status_aplikasi) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status_aplikasi', $aplikasi->status_aplikasi) === 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status_aplikasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Pengelola -->
            <div>
                <label for="nama_pengelola" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Pengelola <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_pengelola" 
                       name="nama_pengelola" 
                       value="{{ old('nama_pengelola', $aplikasi->nama_pengelola) }}"
                       required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_pengelola') border-red-500 @enderror">
                @error('nama_pengelola')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nomor WhatsApp -->
            <div>
                <label for="nomor_wa_pengelola" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor WhatsApp Pengelola <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nomor_wa_pengelola" 
                       name="nomor_wa_pengelola" 
                       value="{{ old('nomor_wa_pengelola', $aplikasi->nomor_wa_pengelola) }}"
                       required
                       placeholder="08123456789"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nomor_wa_pengelola') border-red-500 @enderror">
                @error('nomor_wa_pengelola')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- OPD -->
        <div class="relative">
            <label for="opd_search_edit" class="block text-sm font-medium text-gray-700 mb-2">
                Perangkat Daerah <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="text" 
                       id="opd_search_edit" 
                       placeholder="Ketik untuk mencari OPD..."
                       autocomplete="off"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10 @error('opd_id') border-red-500 @enderror">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Hidden select untuk form submission -->
            <select id="opd_id" 
                    name="opd_id" 
                    required
                    class="hidden">
                <option value="">Pilih Perangkat Daerah</option>
                @foreach($opds as $opd)
                    <option value="{{ $opd->id }}" {{ old('opd_id', $aplikasi->opd_id) == $opd->id ? 'selected' : '' }}>
                        {{ $opd->nama_opd }}
                    </option>
                @endforeach
            </select>
            
            <!-- Dropdown hasil pencarian -->
            <div id="opd_dropdown_edit" class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg hidden max-h-60 overflow-y-auto">
                <!-- Results will be populated by JavaScript -->
            </div>
            
            @error('opd_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Penyebab Tidak Aktif -->
        <div id="penyebab_tidak_aktif_group" 
             style="display: {{ old('status_aplikasi', $aplikasi->status_aplikasi) === 'Tidak Aktif' ? 'block' : 'none' }}">
            <label for="penyebab_tidak_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                Penyebab Tidak Aktif
            </label>
            <textarea id="penyebab_tidak_aktif" 
                      name="penyebab_tidak_aktif" 
                      rows="3"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('penyebab_tidak_aktif') border-red-500 @enderror"
                      placeholder="Jelaskan mengapa aplikasi tidak aktif">{{ old('penyebab_tidak_aktif', $aplikasi->penyebab_tidak_aktif) }}</textarea>
            @error('penyebab_tidak_aktif')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi_singkat" class="block text-sm font-medium text-gray-700 mb-2">
                Deskripsi Singkat <span class="text-red-500">*</span>
            </label>
            <textarea id="deskripsi_singkat" 
                      name="deskripsi_singkat" 
                      rows="4"
                      required
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi_singkat') border-red-500 @enderror"
                      placeholder="Deskripsikan fungsi dan kegunaan aplikasi">{{ old('deskripsi_singkat', $aplikasi->deskripsi_singkat) }}</textarea>
            @error('deskripsi_singkat')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between pt-6">
            <a href="{{ route('aplikasi.show', $aplikasi) }}" 
               class="inline-flex items-center px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>

            <button type="submit" 
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Aplikasi
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // OPD Autocomplete functionality for edit page
    const opdSearchEdit = document.getElementById('opd_search_edit');
    const opdSelectEdit = document.getElementById('opd_id');
    const opdDropdownEdit = document.getElementById('opd_dropdown_edit');
    
    // Data OPD dari server
    const opdsEdit = [
        @foreach($opds as $opd)
        {
            id: {{ $opd->id }},
            name: "{{ $opd->nama_opd }}"
        },
        @endforeach
    ];
    
    // Function to filter and display OPD options
    function filterOpdsEdit(searchTerm) {
        const filtered = opdsEdit.filter(opd => 
            opd.name.toLowerCase().includes(searchTerm.toLowerCase())
        );
        
        if (filtered.length > 0 && searchTerm.length > 0) {
            opdDropdownEdit.innerHTML = '';
            filtered.forEach(opd => {
                const item = document.createElement('div');
                item.className = 'px-4 py-2 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0';
                item.textContent = opd.name;
                item.addEventListener('click', function() {
                    selectOpdEdit(opd.id, opd.name);
                });
                opdDropdownEdit.appendChild(item);
            });
            opdDropdownEdit.classList.remove('hidden');
        } else {
            opdDropdownEdit.classList.add('hidden');
        }
    }
    
    // Function to select an OPD
    function selectOpdEdit(id, name) {
        opdSearchEdit.value = name;
        opdSelectEdit.value = id;
        opdDropdownEdit.classList.add('hidden');
        
        // Trigger change event for validation
        opdSelectEdit.dispatchEvent(new Event('change'));
    }
    
    // Search input event listener
    opdSearchEdit.addEventListener('input', function() {
        const searchTerm = this.value;
        if (searchTerm.length === 0) {
            opdSelectEdit.value = '';
            opdDropdownEdit.classList.add('hidden');
        } else {
            filterOpdsEdit(searchTerm);
        }
    });
    
    // Focus event - show all options
    opdSearchEdit.addEventListener('focus', function() {
        if (this.value.length === 0) {
            // Show all options when focused
            opdDropdownEdit.innerHTML = '';
            opdsEdit.forEach(opd => {
                const item = document.createElement('div');
                item.className = 'px-4 py-2 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0';
                item.textContent = opd.name;
                item.addEventListener('click', function() {
                    selectOpdEdit(opd.id, opd.name);
                });
                opdDropdownEdit.appendChild(item);
            });
            opdDropdownEdit.classList.remove('hidden');
        }
    });
    
    // Click outside to close dropdown
    document.addEventListener('click', function(event) {
        if (!opdSearchEdit.contains(event.target) && !opdDropdownEdit.contains(event.target)) {
            opdDropdownEdit.classList.add('hidden');
        }
    });
    
    // Set initial value from current application
    const currentOpdId = {{ $aplikasi->opd_id }};
    const currentOpd = opdsEdit.find(opd => opd.id == currentOpdId);
    if (currentOpd) {
        opdSearchEdit.value = currentOpd.name;
    }
    
    // Handle form submission validation
    opdSearchEdit.closest('form').addEventListener('submit', function(e) {
        if (!opdSelectEdit.value) {
            e.preventDefault();
            opdSearchEdit.focus();
            opdSearchEdit.classList.add('border-red-500');
            
            // Show error message
            let errorMsg = opdSearchEdit.parentNode.querySelector('.opd-error');
            if (!errorMsg) {
                errorMsg = document.createElement('p');
                errorMsg.className = 'mt-1 text-sm text-red-600 opd-error';
                errorMsg.textContent = 'Pilih Perangkat Daerah terlebih dahulu';
                opdSearchEdit.parentNode.appendChild(errorMsg);
            }
        } else {
            opdSearchEdit.classList.remove('border-red-500');
            const errorMsg = opdSearchEdit.parentNode.querySelector('.opd-error');
            if (errorMsg) {
                errorMsg.remove();
            }
        }
    });
});

function togglePenyebabTidakAktif() {
    const statusSelect = document.getElementById('status_aplikasi');
    const penyebabGroup = document.getElementById('penyebab_tidak_aktif_group');
    
    if (statusSelect.value === 'Tidak Aktif') {
        penyebabGroup.style.display = 'block';
    } else {
        penyebabGroup.style.display = 'none';
        document.getElementById('penyebab_tidak_aktif').value = '';
    }
}
</script>
@endsection
