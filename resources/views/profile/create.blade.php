@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 py-8">
    <div class="max-w-5xl mx-auto px-4">
        
        <!-- Debug Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-400 to-orange-500 p-8 text-center">
                <h1 class="text-3xl font-bold text-white mb-2">Buat Profil Karir</h1>
                <p class="text-orange-100">Lengkapi profil Anda untuk mendapatkan peluang karir terbaik</p>
            </div>

            <!-- Form -->
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="p-8" id="profileForm">
                @csrf
                
                <!-- Personal Information -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                        <span class="bg-orange-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm mr-3">1</span>
                        Informasi Pribadi
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="foto" class="block text-sm font-semibold text-slate-700 mb-2">Foto Profil *</label>
                            <div class="flex items-center space-x-4">
                                <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="foto" id="foto" accept="image/*" required 
                                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all @error('foto') border-red-500 @enderror"
                                           value="{{ old('foto') }}">
                                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG. Maksimal 2MB</p>
                                    @error('foto')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="nama" id="nama" required 
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all @error('nama') border-red-500 @enderror"
                                   placeholder="Masukkan nama lengkap" value="{{ old('nama') }}">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nim" class="block text-sm font-semibold text-slate-700 mb-2">NIM *</label>
                            <input type="text" name="nim" id="nim" required 
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all @error('nim') border-red-500 @enderror"
                                   placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}">
                            @error('nim')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email *</label>
                            <input type="email" name="email" id="email" required 
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all @error('email') border-red-500 @enderror"
                                   placeholder="email@uisi.ac.id" value="{{ old('email', Auth::user()->email) }}">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="prodi" class="block text-sm font-semibold text-slate-700 mb-2">Program Studi *</label>
                            <select name="prodi" id="prodi" required 
                                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all @error('prodi') border-red-500 @enderror">
                                <option value="">Pilih Program Studi</option>
                                <option value="Teknik Logistik" {{ old('prodi') == 'Teknik Logistik' ? 'selected' : '' }}>Teknik Logistik</option>
                                <option value="Teknik Kimia" {{ old('prodi') == 'Teknik Kimia' ? 'selected' : '' }}>Teknik Kimia</option>
                                <option value="Sistem Informasi" {{ old('prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                <option value="Manajemen" {{ old('prodi') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                                <option value="Informatika" {{ old('prodi') == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                                <option value="Ekonomi Syariah" {{ old('prodi') == 'Ekonomi Syariah' ? 'selected' : '' }}>Ekonomi Syariah</option>
                                <option value="Desain Komunikasi Visual" {{ old('prodi') == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                                <option value="Akuntansi" {{ old('prodi') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                                <option value="Manajemen Rekayasa" {{ old('prodi') == 'Manajemen Rekayasa' ? 'selected' : '' }}>Manajemen Rekayasa</option>
                                <option value="Teknologi Agroindustri" {{ old('prodi') == 'Teknologi Agroindustri' ? 'selected' : '' }}>Teknologi Agroindustri</option>
                            </select>
                            @error('prodi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="fakultas" class="block text-sm font-semibold text-slate-700 mb-2">Fakultas *</label>
                            <input type="text" name="fakultas" id="fakultas" required 
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all @error('fakultas') border-red-500 @enderror"
                                   placeholder="Masukkan fakultas" value="{{ old('fakultas') }}">
                            @error('fakultas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="semester" class="block text-sm font-semibold text-slate-700 mb-2">Semester *</label>
                            <select name="semester" id="semester" required 
                                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all @error('semester') border-red-500 @enderror">
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                            @error('semester')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="ringkasan_pribadi" class="block text-sm font-semibold text-slate-700 mb-2">Ringkasan Pribadi</label>
                            <textarea name="ringkasan_pribadi" id="ringkasan_pribadi" rows="4" 
                                      class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                      placeholder="Ceritakan tentang diri Anda, passion, dan tujuan karir...">{{ old('ringkasan_pribadi') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Experience & Skills -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                        <span class="bg-orange-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm mr-3">2</span>
                        Pengalaman & Keahlian
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Organisasi & Kepanitiaan -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pengalaman Organisasi & Kepanitiaan</label>
                            <div id="organisasiContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="organisasi_dan_kepanitiaan[]" 
                                           class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                           placeholder="Contoh: Ketua BEM Fakultas">
                                </div>
                            </div>
                            <button type="button" onclick="addInput('organisasiContainer', 'organisasi_dan_kepanitiaan', 'Contoh: Anggota UKM Musik')" 
                                    class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Organisasi
                            </button>
                        </div>

                        <!-- Proyek & Lomba -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Proyek & Lomba</label>
                            <div id="proyekContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="proyek[]" 
                                           class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                           placeholder="Contoh: Website E-commerce dengan Laravel">
                                </div>
                            </div>
                            <button type="button" onclick="addInput('proyekContainer', 'proyek', 'Contoh: Juara 1 Lomba Programming')" 
                                    class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Proyek
                            </button>
                        </div>

                        <!-- Soft Skills -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Soft Skills</label>
                            <div id="softSkillsContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="soft_skills[]" 
                                           class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                           placeholder="Contoh: Leadership">
                                </div>
                            </div>
                            <button type="button" onclick="addInput('softSkillsContainer', 'soft_skills', 'Contoh: Problem Solving')" 
                                    class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Soft Skill
                            </button>
                        </div>

                        <!-- Hard Skills -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Hard Skills</label>
                            <div id="hardSkillsContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="hard_skills[]" 
                                           class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                           placeholder="Contoh: JavaScript">
                                </div>
                            </div>
                            <button type="button" onclick="addInput('hardSkillsContainer', 'hard_skills', 'Contoh: Python')" 
                                    class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Hard Skill
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Achievements & Portfolio -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                        <span class="bg-orange-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm mr-3">3</span>
                        Pencapaian & Portofolio
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sertifikat & Kursus -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Sertifikat & Kursus</label>
                            <div id="sertifikatContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="sertifikat[]" 
                                           class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                           placeholder="Contoh: Google Analytics Certified">
                                </div>
                            </div>
                            <button type="button" onclick="addInput('sertifikatContainer', 'sertifikat', 'Contoh: AWS Cloud Practitioner')" 
                                    class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Sertifikat
                            </button>
                        </div>

                        <!-- Penghargaan -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Penghargaan</label>
                            <div id="penghargaanContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="penghargaan[]" 
                                           class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                           placeholder="Contoh: Juara 1 Lomba Web Design">
                                </div>
                            </div>
                            <button type="button" onclick="addInput('penghargaanContainer', 'penghargaan', 'Contoh: Beasiswa Prestasi')" 
                                    class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Penghargaan
                            </button>
                        </div>

                        <!-- Minat Karier -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Minat Karier</label>
                            <div id="minatKarierContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="minat_karier[]" 
                                           class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                           placeholder="Contoh: Frontend Developer">
                                </div>
                            </div>
                            <button type="button" onclick="addInput('minatKarierContainer', 'minat_karier', 'Contoh: Data Scientist')" 
                                    class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Minat Karier
                            </button>
                        </div>

                        <!-- Portofolio -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Link Portofolio</label>
                            <div id="portofolioContainer" class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="url" name="portofolio[]" 
                                           class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                           placeholder="https://github.com/username">
                                </div>
                            </div>
                            <button type="button" onclick="addInput('portofolioContainer', 'portofolio', 'https://behance.net/username', 'url')" 
                                    class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Link Portofolio
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center border-t border-gray-200 pt-8">
                    <button type="submit" 
                            class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 px-12 rounded-full text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Profil
                        </span>
                    </button>
                    <p class="text-sm text-gray-500 mt-4">Pastikan semua informasi yang Anda masukkan sudah benar</p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Function to add new input field
function addInput(containerId, fieldName, placeholder, inputType = 'text') {
    const container = document.getElementById(containerId);
    const newInputDiv = document.createElement('div');
    newInputDiv.className = 'flex items-center space-x-2';
    
    newInputDiv.innerHTML = `
        <input type="${inputType}" name="${fieldName}[]" 
               class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
               placeholder="${placeholder}">
        <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600 p-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;
    
    container.appendChild(newInputDiv);
}

// Function to remove input field
function removeInput(button) {
    button.parentElement.remove();
}

// Auto-populate fakultas based on prodi selection
document.getElementById('prodi').addEventListener('change', function() {
    const prodi = this.value;
    const fakultasInput = document.getElementById('fakultas');
    
    // Set fakultas based on prodi
    if (prodi === 'Teknik Logistik' || prodi === 'Teknik Kimia') {
        fakultasInput.value = 'Fakultas Teknik';
    } else if (prodi === 'Sistem Informasi' || prodi === 'Informatika') {
        fakultasInput.value = 'Fakultas Teknologi Informasi';
    } else if (prodi === 'Desain Komunikasi Visual') {
        fakultasInput.value = 'Fakultas Seni dan Desain';
    } else if (prodi === 'Manajemen' || prodi === 'Akuntansi' || prodi === 'Ekonomi Syariah') {
        fakultasInput.value = 'Fakultas Ekonomi dan Bisnis';
    } else if (prodi === 'Manajemen Rekayasa') {
        fakultasInput.value = 'Fakultas Rekayasa Industri';
    } else if (prodi === 'Teknologi Agroindustri') {
        fakultasInput.value = 'Fakultas Teknologi Agroindustri';
    } else {
        fakultasInput.value = '';
    }
});
</script>
@endsection