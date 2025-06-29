@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 py-8">
    <div class="max-w-7xl mx-auto px-4">
        
        <!-- Success/Error Messages -->
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
        
        <!-- Header Profile -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-orange-400 to-orange-500 h-40 relative">
                <!-- Profile Photo -->
                <div class="absolute -bottom-20 left-8">
                    <div class="relative">
                        <div class="w-40 h-40 rounded-full border-4 border-white overflow-hidden bg-white shadow-lg">
                            @if($profile->foto)
                                <img src="{{ asset($profile->foto) }}" alt="Profile Photo" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Header Actions -->
                <div class="absolute top-6 right-6">
                    <button id="editModeToggle" onclick="toggleEditMode()" 
                            class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-2 rounded-full text-sm font-medium transition-all flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span id="editModeText">Edit Profil</span>
                    </button>
                </div>
            </div>
            
            <!-- Basic Info -->
            <div class="pt-24 pb-8 px-8">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
                    <div class="flex-1">
                        <div class="mb-4">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $profile->nama }}</h1>
                            <div class="flex items-center text-gray-600 mb-2">
                                <span class="font-medium">{{ $profile->prodi }}</span>
                                <span class="mx-2">•</span>
                                <span>Semester {{ $profile->semester }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $profile->fakultas }}</span>
                            </div>
                            <p class="text-gray-500 mb-4">NIM: {{ $profile->nim }}</p>
                        </div>
                        
                        @if($profile->ringkasan_pribadi)
                        <div class="bg-orange-50 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">Ringkasan Pribadi</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $profile->ringkasan_pribadi }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Career Interests -->
                    <div class="mt-6 lg:mt-0 lg:ml-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Minat Karier</h3>
                            <div class="flex flex-wrap gap-2">
                                @if($profile->minat_karier)
                                    @foreach(explode(',', $profile->minat_karier) as $minat)
                                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">{{ trim($minat) }}</span>
                                    @endforeach
                                @else
                                    <span class="text-gray-500 text-sm">Belum diisi</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form untuk Edit (Hidden by default) -->
        <form id="profileForm" action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            @method('PUT')
            
            <!-- Basic Info Form -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Dasar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil</label>
                        <input type="file" name="foto" accept="image/*" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ $profile->nama }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NIM</label>
                        <input type="text" name="nim" value="{{ $profile->nim }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ $profile->email }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi</label>
                        <select name="prodi" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="Teknik Logistik" {{ $profile->prodi == 'Teknik Logistik' ? 'selected' : '' }}>Teknik Logistik</option>
                            <option value="Teknik Kimia" {{ $profile->prodi == 'Teknik Kimia' ? 'selected' : '' }}>Teknik Kimia</option>
                            <option value="Sistem Informasi" {{ $profile->prodi == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                            <option value="Manajemen" {{ $profile->prodi == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                            <option value="Informatika" {{ $profile->prodi == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                            <option value="Ekonomi Syariah" {{ $profile->prodi == 'Ekonomi Syariah' ? 'selected' : '' }}>Ekonomi Syariah</option>
                            <option value="Desain Komunikasi Visual" {{ $profile->prodi == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                            <option value="Akuntansi" {{ $profile->prodi == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                            <option value="Manajemen Rekayasa" {{ $profile->prodi == 'Manajemen Rekayasa' ? 'selected' : '' }}>Manajemen Rekayasa</option>
                            <option value="Teknologi Agroindustri" {{ $profile->prodi == 'Teknologi Agroindustri' ? 'selected' : '' }}>Teknologi Agroindustri</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Fakultas</label>
                        <input type="text" name="fakultas" value="{{ $profile->fakultas }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Semester</label>
                        <select name="semester" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @for($i = 1; $i <= 14; $i++)
                                <option value="{{ $i }}" {{ $profile->semester == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ringkasan Pribadi</label>
                        <textarea name="ringkasan_pribadi" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Ceritakan tentang diri Anda...">{{ $profile->ringkasan_pribadi }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Keahlian</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hard Skills</label>
                        <div id="hardSkillsContainer" class="space-y-2">
                            @if($profile->hard_skills)
                                @foreach(explode(',', $profile->hard_skills) as $index => $skill)
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="hard_skills[]" value="{{ trim($skill) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        @if($index > 0)
                                            <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="hard_skills[]" placeholder="Masukkan hard skill..."
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addSkillInput('hardSkillsContainer', 'hard_skills')" 
                                class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Hard Skill
                        </button>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Soft Skills</label>
                        <div id="softSkillsContainer" class="space-y-2">
                            @if($profile->soft_skills)
                                @foreach(explode(',', $profile->soft_skills) as $index => $skill)
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="soft_skills[]" value="{{ trim($skill) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        @if($index > 0)
                                            <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="soft_skills[]" placeholder="Masukkan soft skill..."
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addSkillInput('softSkillsContainer', 'soft_skills')" 
                                class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Soft Skill
                        </button>
                    </div>
                </div>
            </div>

            <!-- Experience Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Pengalaman & Proyek</h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Organisasi & Kepanitiaan</label>
                        <div id="orgContainer" class="space-y-2">
                            @if($profile->organisasi_dan_kepanitiaan)
                                @foreach(explode(',', $profile->organisasi_dan_kepanitiaan) as $index => $org)
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="organisasi_dan_kepanitiaan[]" value="{{ trim($org) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        @if($index > 0)
                                            <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="organisasi_dan_kepanitiaan[]" placeholder="Masukkan organisasi..."
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addListInput('orgContainer', 'organisasi_dan_kepanitiaan')" 
                                class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Organisasi
                        </button>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Proyek & Lomba</label>
                        <div id="projectContainer" class="space-y-2">
                            @if($profile->proyek)
                                @foreach(explode(',', $profile->proyek) as $index => $project)
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="proyek[]" value="{{ trim($project) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        @if($index > 0)
                                            <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="proyek[]" placeholder="Masukkan proyek..."
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addListInput('projectContainer', 'proyek')" 
                                class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Proyek
                        </button>
                    </div>
                </div>
            </div>

            <!-- Achievements Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Pencapaian</h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sertifikat & Kursus</label>
                        <div id="certContainer" class="space-y-2">
                            @if($profile->sertifikat)
                                @foreach(explode(',', $profile->sertifikat) as $index => $cert)
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="sertifikat[]" value="{{ trim($cert) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        @if($index > 0)
                                            <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="sertifikat[]" placeholder="Masukkan sertifikat..."
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addListInput('certContainer', 'sertifikat')" 
                                class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Sertifikat
                        </button>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Penghargaan</label>
                        <div id="awardContainer" class="space-y-2">
                            @if($profile->penghargaan)
                                @foreach(explode(',', $profile->penghargaan) as $index => $award)
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="penghargaan[]" value="{{ trim($award) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        @if($index > 0)
                                            <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="penghargaan[]" placeholder="Masukkan penghargaan..."
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addListInput('awardContainer', 'penghargaan')" 
                                class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Penghargaan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Career & Portfolio Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Minat Karier & Portofolio</h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Minat Karier</label>
                        <div id="careerContainer" class="space-y-2">
                            @if($profile->minat_karier)
                                @foreach(explode(',', $profile->minat_karier) as $index => $career)
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="minat_karier[]" value="{{ trim($career) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        @if($index > 0)
                                            <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="minat_karier[]" placeholder="Masukkan minat karier..."
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addListInput('careerContainer', 'minat_karier')" 
                                class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Minat Karier
                        </button>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Link Portofolio</label>
                        <div id="portfolioContainer" class="space-y-2">
                            @if($profile->portofolio)
                                @foreach(explode(',', $profile->portofolio) as $index => $portfolio)
                                    <div class="flex items-center space-x-2">
                                        <input type="url" name="portofolio[]" value="{{ trim($portfolio) }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        @if($index > 0)
                                            <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center space-x-2">
                                    <input type="url" name="portofolio[]" placeholder="https://..."
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addListInput('portfolioContainer', 'portofolio')" 
                                class="mt-2 text-orange-500 hover:text-orange-600 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Link Portofolio
                        </button>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="toggleEditMode()" 
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>

        <!-- Display Mode (Default) -->
        <div id="displayMode">
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Skills Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            Keahlian
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Hard Skills -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Hard Skills</h3>
                                <div class="space-y-2">
                                    @if($profile->hard_skills)
                                        @foreach(explode(',', $profile->hard_skills) as $skill)
                                            <div class="bg-orange-50 border border-orange-200 px-3 py-2 rounded-lg">
                                                <span class="text-orange-800 font-medium">{{ trim($skill) }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-gray-500 text-sm">Belum ada hard skills yang ditambahkan</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Soft Skills -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Soft Skills</h3>
                                <div class="space-y-2">
                                    @if($profile->soft_skills)
                                        @foreach(explode(',', $profile->soft_skills) as $skill)
                                            <div class="bg-blue-50 border border-blue-200 px-3 py-2 rounded-lg">
                                                <span class="text-blue-800 font-medium">{{ trim($skill) }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-gray-500 text-sm">Belum ada soft skills yang ditambahkan</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Experience & Projects -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Pengalaman & Proyek
                        </h2>
                        
                        <!-- Organisasi -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                Organisasi & Kepanitiaan
                            </h3>
                            @if($profile->organisasi_dan_kepanitiaan)
                                <div class="space-y-2">
                                    @foreach(explode(',', $profile->organisasi_dan_kepanitiaan) as $org)
                                        <div class="bg-gray-50 border-l-4 border-orange-500 px-4 py-3 rounded-r-lg">
                                            <p class="text-gray-700 font-medium">{{ trim($org) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Belum ada pengalaman organisasi</p>
                            @endif
                        </div>
                        
                        <!-- Proyek -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                Proyek & Lomba
                            </h3>
                            @if($profile->proyek)
                                <div class="space-y-2">
                                    @foreach(explode(',', $profile->proyek) as $project)
                                        <div class="bg-gray-50 border-l-4 border-blue-500 px-4 py-3 rounded-r-lg">
                                            <p class="text-gray-700 font-medium">{{ trim($project) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Belum ada proyek yang ditambahkan</p>
                            @endif
                        </div>
                    </div>

                    <!-- Achievements -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            Pencapaian
                        </h2>
                        
                        <!-- Sertifikat -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                Sertifikat & Kursus
                            </h3>
                            @if($profile->sertifikat)
                                <div class="space-y-2">
                                    @foreach(explode(',', $profile->sertifikat) as $cert)
                                        <div class="bg-green-50 border-l-4 border-green-500 px-4 py-3 rounded-r-lg">
                                            <p class="text-gray-700 font-medium">{{ trim($cert) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Belum ada sertifikat yang ditambahkan</p>
                            @endif
                        </div>
                        
                        <!-- Penghargaan -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                Penghargaan
                            </h3>
                            @if($profile->penghargaan)
                                <div class="space-y-2">
                                    @foreach(explode(',', $profile->penghargaan) as $award)
                                        <div class="bg-yellow-50 border-l-4 border-yellow-500 px-4 py-3 rounded-r-lg">
                                            <p class="text-gray-700 font-medium">{{ trim($award) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Belum ada penghargaan yang ditambahkan</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    
                    <!-- Contact Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Kontak</h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $profile->email }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Portfolio Links -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Portofolio</h2>
                        
                        <div class="space-y-3">
                            @if($profile->portofolio)
                                @foreach(explode(',', $profile->portofolio) as $link)
                                    @if(trim($link))
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <a href="{{ trim($link) }}" target="_blank" class="flex items-center text-orange-600 hover:text-orange-700 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            {{ trim($link) }}
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-gray-500 text-sm">Belum ada link portofolio</p>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Statistik Profil</h2>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Kelengkapan Profil</span>
                                <span class="font-semibold text-orange-600">
                                    @php
                                        $fields = ['nama', 'nim', 'email', 'prodi', 'fakultas', 'semester', 'foto', 'ringkasan_pribadi', 'organisasi_dan_kepanitiaan', 'proyek', 'soft_skills', 'hard_skills', 'sertifikat', 'penghargaan', 'minat_karier', 'portofolio'];
                                        $filled = 0;
                                        foreach($fields as $field) {
                                            if($profile->$field) $filled++;
                                        }
                                        $percentage = round(($filled / count($fields)) * 100);
                                    @endphp
                                    {{ $percentage }}%
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-200">
                                <div class="text-sm text-gray-600">
                                    <p>Profil dibuat: {{ $profile->created_at->format('d M Y') }}</p>
                                    <p>Terakhir diupdate: {{ $profile->updated_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let isEditMode = false;

function toggleEditMode() {
    const displayMode = document.getElementById('displayMode');
    const profileForm = document.getElementById('profileForm');
    const editModeText = document.getElementById('editModeText');
    const editModeToggle = document.getElementById('editModeToggle');
    
    isEditMode = !isEditMode;
    
    if (isEditMode) {
        displayMode.style.display = 'none';
        profileForm.style.display = 'block';
        editModeText.textContent = 'Batal Edit';
        editModeToggle.classList.remove('bg-white', 'bg-opacity-20');
        editModeToggle.classList.add('bg-red-500');
    } else {
        displayMode.style.display = 'block';
        profileForm.style.display = 'none';
        editModeText.textContent = 'Edit Profil';
        editModeToggle.classList.remove('bg-red-500');
        editModeToggle.classList.add('bg-white', 'bg-opacity-20');
    }
}

function addSkillInput(containerId, fieldName) {
    const container = document.getElementById(containerId);
    const newInput = document.createElement('div');
    newInput.className = 'flex items-center space-x-2';
    newInput.innerHTML = `
        <input type="text" name="${fieldName}[]" placeholder="Masukkan ${fieldName.includes('hard') ? 'hard' : 'soft'} skill..."
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
        <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;
    container.appendChild(newInput);
}

function addListInput(containerId, fieldName) {
    const container = document.getElementById(containerId);
    const newInput = document.createElement('div');
    newInput.className = 'flex items-center space-x-2';
    
    let placeholder = 'Masukkan item...';
    let inputType = 'text';
    
    if (fieldName === 'portofolio') {
        placeholder = 'https://...';
        inputType = 'url';
    } else if (fieldName === 'organisasi_dan_kepanitiaan') {
        placeholder = 'Masukkan organisasi...';
    } else if (fieldName === 'proyek') {
        placeholder = 'Masukkan proyek...';
    } else if (fieldName === 'sertifikat') {
        placeholder = 'Masukkan sertifikat...';
    } else if (fieldName === 'penghargaan') {
        placeholder = 'Masukkan penghargaan...';
    } else if (fieldName === 'minat_karier') {
        placeholder = 'Masukkan minat karier...';
    }
    
    newInput.innerHTML = `
        <input type="${inputType}" name="${fieldName}[]" placeholder="${placeholder}"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
        <button type="button" onclick="removeInput(this)" class="text-red-500 hover:text-red-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;
    container.appendChild(newInput);
}

function removeInput(button) {
    button.parentElement.remove();
}
</script>
@endsection