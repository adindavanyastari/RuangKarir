@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 py-8">
    <div class="max-w-6xl mx-auto px-4">
        
        @php
            $profile = \App\Models\Profile::where('user_id', Auth::id())->first();
            
            // Get other users' profiles with search functionality
            $query = \App\Models\Profile::where('user_id', '!=', Auth::id());
            
            // Handle search functionality
            if (request()->filled('search')) {
                $searchTerm = request('search');
                $query->where(function($q) use ($searchTerm) {
                    $q->where('nama', 'like', '%' . $searchTerm . '%')
                      ->orWhere('hard_skills', 'like', '%' . $searchTerm . '%')
                      ->orWhere('soft_skills', 'like', '%' . $searchTerm . '%')
                      ->orWhere('minat_karier', 'like', '%' . $searchTerm . '%')
                      ->orWhere('prodi', 'like', '%' . $searchTerm . '%')
                      ->orWhere('sertifikat', 'like', '%' . $searchTerm . '%');
                });
            }
            
            // Handle program studi filter
            if (request()->filled('prodi')) {
                $query->where('prodi', request('prodi'));
            }
            
            // Handle semester filter
            if (request()->filled('semester')) {
                $semesterRange = request('semester');
                if ($semesterRange == '1-2') {
                    $query->whereIn('semester', [1, 2]);
                } elseif ($semesterRange == '3-4') {
                    $query->whereIn('semester', [3, 4]);
                } elseif ($semesterRange == '5-6') {
                    $query->whereIn('semester', [5, 6]);
                } elseif ($semesterRange == '7-8') {
                    $query->whereIn('semester', [7, 8]);
                }
            }
            
            // Handle sertifikasi filter
            if (request()->filled('sertifikasi')) {
                $query->where('sertifikat', 'like', '%' . request('sertifikasi') . '%');
            }
            
            $otherProfiles = $query->paginate(6);
        @endphp

        @if($profile)
        <!-- My Profile Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-orange-400 to-orange-500 h-32 relative">
                <div class="absolute -bottom-16 left-8">
                    <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden bg-white">
                        @if($profile->foto)
                            <img src="{{ asset($profile->foto) }}" alt="Profile Photo" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="absolute top-4 right-4">
                    <button onclick="toggleEditMode()" id="editBtn" 
                            class="bg-white text-orange-500 px-4 py-2 rounded-lg font-semibold hover:bg-orange-50 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profil
                    </button>
                </div>
                <div class="absolute top-4 left-8">
                    <span class="bg-white bg-opacity-20 text-white px-3 py-1 rounded-full text-sm font-medium">
                        Profil Saya
                    </span>
                </div>
            </div>
            
            <div class="pt-20 pb-8 px-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $profile->nama }}</h1>
                        <p class="text-lg text-gray-600 mb-1">{{ $profile->prodi }} - Semester {{ $profile->semester }}</p>
                        <p class="text-gray-500 mb-1">{{ $profile->fakultas }}</p>
                        <p class="text-gray-500">NIM: {{ $profile->nim }}</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="flex flex-wrap gap-2">
                            @if($profile->minat_karier)
                                @foreach(explode(',', $profile->minat_karier) as $minat)
                                    <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">{{ trim($minat) }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($profile->ringkasan_pribadi)
                <div class="mt-6 p-4 bg-orange-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Ringkasan Pribadi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $profile->ringkasan_pribadi }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Other Users Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-500 to-red-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white mb-2">Daftar Pengguna Lain</h2>
                <p class="text-blue-100">Temukan dan terhubung dengan mahasiswa lain</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="p-6 border-b border-gray-200">
                <form method="GET" action="{{ route('profile.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search Input -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pengguna</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Cari berdasarkan nama, keahlian, minat karier..."
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oranye-500 focus:border-oranye-500">
                                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Program Studi Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                            <select name="prodi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Program Studi</option>
                                <option value="Teknik Informatika" {{ request('prodi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                <option value="Sistem Informasi" {{ request('prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                <option value="Teknik Komputer" {{ request('prodi') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                                <option value="Desain Komunikasi Visual" {{ request('prodi') == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                            </select>
                        </div>

                        <!-- Semester Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                            <select name="semester" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Semester</option>
                                <option value="1-2" {{ request('semester') == '1-2' ? 'selected' : '' }}>Semester 1-2</option>
                                <option value="3-4" {{ request('semester') == '3-4' ? 'selected' : '' }}>Semester 3-4</option>
                                <option value="5-6" {{ request('semester') == '5-6' ? 'selected' : '' }}>Semester 5-6</option>
                                <option value="7-8" {{ request('semester') == '7-8' ? 'selected' : '' }}>Semester 7-8</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sertifikasi Filter -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sertifikasi</label>
                            <input type="text" name="sertifikasi" value="{{ request('sertifikasi') }}" 
                                   placeholder="Cari berdasarkan sertifikasi..."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                            <a href="{{ route('profile.index') }}" 
                               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-medium transition-colors">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Active Filters -->
                @if(request()->hasAny(['search', 'prodi', 'semester', 'sertifikasi']))
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-wrap gap-2 items-center">
                            <span class="text-sm font-medium text-gray-700">Filter aktif:</span>
                            @if(request('search'))
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                    Pencarian: "{{ request('search') }}"
                                </span>
                            @endif
                            @if(request('prodi'))
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                    Prodi: {{ request('prodi') }}
                                </span>
                            @endif
                            @if(request('semester'))
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                                    Semester: {{ request('semester') }}
                                </span>
                            @endif
                            @if(request('sertifikasi'))
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">
                                    Sertifikasi: {{ request('sertifikasi') }}
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            Ditemukan {{ $otherProfiles->total() }} pengguna
                        </p>
                    </div>
                @endif
            </div>

            <!-- Users Grid -->
            <div class="p-6">
                @if($otherProfiles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($otherProfiles as $otherProfile)
                            <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                                <!-- Profile Header -->
                                <div class="flex items-center mb-4">
                                    <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 mr-4 flex-shrink-0">
                                        @if($otherProfile->foto)
                                            <img src="{{ asset($otherProfile->foto) }}" alt="Foto Profil" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-gray-900 truncate">{{ $otherProfile->nama }}</h3>
                                        <p class="text-sm text-gray-600 truncate">{{ $otherProfile->prodi }}</p>
                                        <p class="text-xs text-gray-500">Semester {{ $otherProfile->semester }}</p>
                                    </div>
                                </div>

                                <!-- Skills Preview -->
                                @if($otherProfile->hard_skills)
                                    <div class="mb-4">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Keahlian:</h4>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(array_slice(explode(',', $otherProfile->hard_skills), 0, 2) as $skill)
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">{{ trim($skill) }}</span>
                                            @endforeach
                                            @if(count(explode(',', $otherProfile->hard_skills)) > 2)
                                                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">+{{ count(explode(',', $otherProfile->hard_skills)) - 2 }} lainnya</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- Summary -->
                                @if($otherProfile->ringkasan_pribadi)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ Str::limit($otherProfile->ringkasan_pribadi, 80) }}</p>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                    <a href="mailto:{{ $otherProfile->email }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        Hubungi
                                    </a>
                                    <a href="{{ route('profile.show', $otherProfile->id) }}" 
                                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center">
                        {{ $otherProfiles->withQueryString()->links() }}
                    </div>
                @else
                    <!-- No Other Users -->
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada pengguna ditemukan</h3>
                        <p class="text-gray-600">
                            @if(request()->hasAny(['search', 'prodi', 'semester', 'sertifikasi']))
                                Coba ubah kriteria pencarian atau filter yang digunakan.
                            @else
                                Belum ada pengguna lain yang membuat profil.
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>

        @else
        <!-- No Profile Found -->
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Profil Belum Dibuat</h2>
            <p class="text-gray-600 mb-8">Anda belum memiliki profil. Silakan buat profil terlebih dahulu untuk melanjutkan.</p>
            <a href="{{ route('profile.create') }}" 
               class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                Buat Profil Sekarang
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Edit Modal (same as before) -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900" id="modalTitle">Edit Profil</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <form id="editForm" action="{{ route('profile.update', $profile->id ?? 0) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div id="modalContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                
                <div class="flex justify-end space-x-4 mt-6 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()" 
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Same JavaScript as before for edit functionality
let isEditMode = false;

function toggleEditMode() {
    isEditMode = !isEditMode;
    const editBtns = document.querySelectorAll('.edit-btn');
    const mainEditBtn = document.getElementById('editBtn');
    
    if (isEditMode) {
        editBtns.forEach(btn => btn.classList.remove('hidden'));
        mainEditBtn.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Selesai Edit
        `;
        mainEditBtn.classList.add('bg-red-50', 'text-red-600');
        mainEditBtn.classList.remove('text-orange-500');
    } else {
        editBtns.forEach(btn => btn.classList.add('hidden'));
        mainEditBtn.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Profil
        `;
        mainEditBtn.classList.remove('bg-red-50', 'text-red-600');
        mainEditBtn.classList.add('text-orange-500');
    }
}

function editSection(section) {
    const modal = document.getElementById('editModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    
    let title = '';
    let content = '';
    
    @if($profile)
    switch(section) {
        case 'experience':
            title = 'Edit Pengalaman & Proyek';
            content = `
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pengalaman Organisasi & Kepanitiaan</label>
                        <textarea name="organisasi_dan_kepanitiaan" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Ketua BEM, Anggota UKM, Panitia acara, dll...">{{ $profile->organisasi_dan_kepanitiaan }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Proyek & Lomba</label>
                        <textarea name="proyek" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Website e-commerce, Aplikasi mobile, Juara lomba, dll...">{{ $profile->proyek }}</textarea>
                    </div>
                </div>
            `;
            break;
            
        case 'skills':
            title = 'Edit Keahlian';
            content = `
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hard Skills</label>
                        <textarea name="hard_skills" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="JavaScript, Python, Figma, Photoshop, dll...">{{ $profile->hard_skills }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma (,)</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Soft Skills</label>
                        <textarea name="soft_skills" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Leadership, Komunikasi, Problem Solving, dll...">{{ $profile->soft_skills }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma (,)</p>
                    </div>
                </div>
            `;
            break;
            
        case 'achievements':
            title = 'Edit Pencapaian';
            content = `
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sertifikat & Kursus</label>
                        <textarea name="sertifikat" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Google Analytics, AWS Certified, Coursera, dll...">{{ $profile->sertifikat }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Penghargaan</label>
                        <textarea name="penghargaan" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Juara lomba, Beasiswa, Dean's List, dll...">{{ $profile->penghargaan }}</textarea>
                    </div>
                </div>
            `;
            break;
            
        case 'contact':
            title = 'Edit Kontak';
            content = `
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ $profile->email }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                               placeholder="email@uisi.ac.id">
                    </div>
                </div>
            `;
            break;
            
        case 'portfolio':
            title = 'Edit Portofolio';
            content = `
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Link Portofolio</label>
                        <textarea name="portofolio" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="GitHub: github.com/username, Behance: behance.net/username, dll...">{{ $profile->portofolio }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma (,)</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Minat Karier</label>
                        <textarea name="minat_karier" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Frontend Developer, Data Scientist, UI/UX Designer, dll...">{{ $profile->minat_karier }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma (,)</p>
                    </div>
                </div>
            `;
            break;
    }
    @endif
    
    modalTitle.textContent = title;
    modalContent.innerHTML = content;
    modal.classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
@endsection