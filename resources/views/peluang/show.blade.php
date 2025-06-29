@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 py-6">
    <div class="max-w-5xl mx-auto px-4">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('peluang') }}" 
               class="inline-flex items-center space-x-2 text-orange-600 hover:text-orange-800 font-medium transition-colors text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Kembali ke Daftar Peluang</span>
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-orange-200">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 md:p-8">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                    <div class="flex-1">
                        <h1 class="text-2xl md:text-3xl font-bold mb-2">{{ $internship->posisi_magang }}</h1>
                        <p class="text-lg text-orange-100 mb-4">{{ $internship->nama_perusahaan }}</p>
                        
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ ucfirst($internship->lokasi_magang) }}
                            </span>
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $internship->durasi_magang }}
                            </span>
                            @if($internship->benefit)
                                <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ Str::limit($internship->benefit, 20) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- Deskripsi Pekerjaan -->
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center">
                                <span class="bg-orange-100 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </span>
                                Deskripsi Pekerjaan
                            </h2>
                            <div class="prose prose-sm max-w-none">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line text-sm">{{ $internship->deskripsi_pekerjaan }}</p>
                            </div>
                        </div>

                        <!-- Kualifikasi -->
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center">
                                <span class="bg-orange-100 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </span>
                                Kualifikasi
                            </h2>
                            <div class="prose prose-sm max-w-none">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line text-sm">{{ $internship->kualifikasi }}</p>
                            </div>
                        </div>

                        <!-- Cara Melamar -->
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center">
                                <span class="bg-orange-100 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </span>
                                Cara Melamar
                            </h2>
                            <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line text-sm">{{ $internship->cara_melamar }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        
                        <!-- Contact Info -->
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-5 sticky top-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-4 h-4 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Informasi Kontak
                            </h3>
                            
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <svg class="w-4 h-4 text-orange-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-600 mb-1">Email Kontak</p>
                                        <p class="text-orange-600 font-medium break-all text-sm">{{ $internship->kontak_email }}</p>
                                    </div>
                                </div>
                                
                                @if($internship->kontak_telepon)
                                    <div class="flex items-start space-x-3">
                                        <svg class="w-4 h-4 text-orange-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-xs text-gray-600 mb-1">Nomor Telepon</p>
                                            <p class="text-orange-600 font-medium text-sm">{{ $internship->kontak_telepon }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Important Notice -->
                            <div class="mt-5 pt-5 border-t border-orange-200">
                                <h4 class="font-semibold text-gray-900 mb-3 flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tips Melamar
                                </h4>
                                <ul class="text-xs text-gray-700 space-y-2">
                                    <li class="flex items-start">
                                        <span class="text-orange-600 mr-2 mt-1 text-xs">•</span>
                                        <span>Pastikan Anda memenuhi semua kualifikasi yang dipersyaratkan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-orange-600 mr-2 mt-1 text-xs">•</span>
                                        <span>Siapkan dokumen lamaran sesuai dengan cara melamar yang tertera</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-orange-600 mr-2 mt-1 text-xs">•</span>
                                        <span>Perhatikan deadline pendaftaran yang telah ditentukan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-orange-600 mr-2 mt-1 text-xs">•</span>
                                        <span>Hubungi email kontak untuk informasi lebih lanjut</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
