@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 py-8">
    <div class="max-w-6xl mx-auto px-4">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('pengguna.index') }}" 
               class="inline-flex items-center text-orange-600 hover:text-orange-700 font-medium transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Pengguna
            </a>
        </div>

        <!-- Profile Header -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border-t-4 border-orange-500">
            <div class="bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 h-40 relative">
                <div class="absolute -bottom-16 left-8">
                    <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden bg-white shadow-lg">
                        @if($profile->foto && $profile->foto !== 'icon')
                            <img src="{{ asset($profile->foto) }}" alt="Profile Photo" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-orange-400 to-orange-500 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="pt-20 pb-8 px-8">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
                    <div class="flex-1">
                        <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $profile->nama }}</h1>
                        <div class="space-y-2 mb-6">
                            <p class="text-xl text-orange-600 font-semibold">{{ $profile->prodi }}</p>
                            <p class="text-lg text-gray-600">{{ $profile->fakultas }} • Semester {{ $profile->semester }}</p>
                            <p class="text-gray-500 font-mono bg-gray-100 inline-block px-3 py-1 rounded-full text-sm">NIM: {{ $profile->nim }}</p>
                        </div>
                        
                        @if($profile->ringkasan_pribadi)
                        <div class="mt-6 p-6 bg-gradient-to-r from-orange-50 to-orange-100 rounded-xl border-l-4 border-orange-500">
                            <h3 class="font-bold text-orange-900 mb-3 text-lg flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Tentang Saya
                            </h3>
                            <p class="text-gray-700 leading-relaxed text-lg">{{ $profile->ringkasan_pribadi }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-6 lg:mt-0 lg:ml-8">
                        @if($profile->minat_karier)
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wide">Minat Karier</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $profile->minat_karier) as $minat)
                                    <span class="bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 px-4 py-2 rounded-full text-sm font-semibold shadow-sm">{{ trim($minat) }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Quick Contact Info -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wide">Kontak</h3>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:{{ $profile->email }}" class="text-orange-600 hover:text-orange-700 font-medium">{{ $profile->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Skills Section -->
                @if($profile->hard_skills || $profile->soft_skills)
                <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-orange-500">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center mb-8">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        Keahlian & Kompetensi
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @if($profile->hard_skills)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                Hard Skills
                            </h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach(explode(',', $profile->hard_skills) as $skill)
                                    <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 px-4 py-2 rounded-lg text-sm font-semibold shadow-sm hover:shadow-md transition-shadow">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        @if($profile->soft_skills)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                Soft Skills
                            </h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach(explode(',', $profile->soft_skills) as $skill)
                                    <span class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 px-4 py-2 rounded-lg text-sm font-semibold shadow-sm hover:shadow-md transition-shadow">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Experience & Projects -->
                @if($profile->organisasi_dan_kepanitiaan || $profile->proyek)
                <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-orange-500">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center mb-8">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        </div>
                        Pengalaman & Proyek
                    </h2>
                    
                    @if($profile->organisasi_dan_kepanitiaan)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-8 bg-orange-500 rounded-full mr-4"></div>
                            Organisasi & Kepanitiaan
                        </h3>
                        <div class="space-y-4">
                            @foreach(explode(',', $profile->organisasi_dan_kepanitiaan) as $org)
                                <div class="bg-gradient-to-r from-orange-50 to-orange-100 border border-orange-200 px-6 py-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                    <p class="text-gray-800 font-medium text-lg">{{ trim($org) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if($profile->proyek)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-8 bg-green-500 rounded-full mr-4"></div>
                            Proyek & Lomba
                        </h3>
                        <div class="space-y-4">
                            @foreach(explode(',', $profile->proyek) as $project)
                                <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 px-6 py-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                    <p class="text-gray-800 font-medium text-lg">{{ trim($project) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Achievements -->
                @if($profile->sertifikat || $profile->penghargaan)
                <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-orange-500">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center mb-8">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        Pencapaian & Sertifikasi
                    </h2>
                    
                    @if($profile->sertifikat)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-8 bg-yellow-500 rounded-full mr-4"></div>
                            Sertifikat & Kursus
                        </h3>
                        <div class="space-y-4">
                            @foreach(explode(',', $profile->sertifikat) as $cert)
                                <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 border border-yellow-200 px-6 py-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                    <p class="text-gray-800 font-medium text-lg">{{ trim($cert) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if($profile->penghargaan)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-8 bg-purple-500 rounded-full mr-4"></div>
                            Penghargaan
                        </h3>
                        <div class="space-y-4">
                            @foreach(explode(',', $profile->penghargaan) as $award)
                                <div class="bg-gradient-to-r from-purple-50 to-purple-100 border border-purple-200 px-6 py-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                    <p class="text-gray-800 font-medium text-lg">{{ trim($award) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                
                <!-- Portfolio Links -->
                @if($profile->portofolio)
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-orange-500">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        </div>
                        Portofolio
                    </h2>
                    
                    <div class="space-y-3">
                        @foreach(explode(',', $profile->portofolio) as $link)
                            @if(trim($link))
                            <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg p-4 hover:shadow-md transition-shadow border border-orange-200">
                                <a href="{{ trim($link) }}" target="_blank" class="flex items-center text-orange-600 hover:text-orange-700 transition-colors font-medium">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    <span class="break-all">{{ trim($link) }}</span>
                                </a>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Profile Information -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-orange-500">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Informasi Profil
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg border border-orange-200">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-2 2m8-2l2 2m-2-2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V9"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Bergabung</p>
                                <p class="font-semibold text-gray-900">{{ $profile->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg border border-orange-200">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Terakhir Update</p>
                                <p class="font-semibold text-gray-900">{{ $profile->updated_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Profiles -->
                @if(isset($relatedProfiles) && $relatedProfiles->count() > 0)
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-orange-500">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        Mahasiswa Serupa
                    </h2>
                    
                    <div class="space-y-4">
                        @foreach($relatedProfiles as $related)
                        <div class="border border-orange-200 rounded-lg p-4 hover:shadow-md transition-shadow bg-gradient-to-r from-orange-50 to-orange-100">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 mr-3 flex-shrink-0">
                                    @if($related->foto && $related->foto !== 'icon')
                                        <img src="{{ asset($related->foto) }}" alt="Foto" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-orange-400 to-orange-500 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 truncate">{{ $related->nama }}</h4>
                                    <p class="text-sm text-orange-600 font-medium">{{ $related->prodi }}</p>
                                    <p class="text-xs text-gray-500">Semester {{ $related->semester }}</p>
                                </div>
                            </div>
                            <a href="{{ route('profile.show', $related->id) }}" 
                               class="text-orange-600 hover:text-orange-700 text-sm font-semibold flex items-center justify-center w-full py-2 bg-white rounded-lg border border-orange-200 hover:bg-orange-50 transition-colors">
                                Lihat Profil 
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
