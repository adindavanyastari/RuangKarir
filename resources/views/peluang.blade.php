@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6">Peluang Magang</h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Temukan peluang magang terbaik untuk mengembangkan karir Anda
            </p>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <form action="{{ route('peluang') }}" method="GET" class="space-y-6">
                <!-- Search Input -->
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan perusahaan, posisi, atau deskripsi..." 
                           class="pl-10 w-full h-12 text-base border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                </div>

                <!-- Filters -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Location Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Lokasi Kerja</label>
                        <select name="lokasi" class="w-full h-12 border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                            <option value="">Semua Lokasi</option>
                            <option value="onsite" {{ request('lokasi') == 'onsite' ? 'selected' : '' }}>Onsite</option>
                            <option value="remote" {{ request('lokasi') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ request('lokasi') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <!-- Duration Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Durasi</label>
                        <select name="durasi" class="w-full h-12 border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                            <option value="">Semua Durasi</option>
                            <option value="3 bulan" {{ request('durasi') == '3 bulan' ? 'selected' : '' }}>3 Bulan</option>
                            <option value="6 bulan" {{ request('durasi') == '6 bulan' ? 'selected' : '' }}>6 Bulan</option>
                            <option value="1 tahun" {{ request('durasi') == '1 tahun' ? 'selected' : '' }}>1 Tahun</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full h-12 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center">
                            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari Magang
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($internships as $internship)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="p-6">
                        <!-- Company & Position -->
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-slate-800 mb-2">{{ $internship->posisi_magang }}</h3>
                            <p class="text-blue-600 font-semibold">{{ $internship->nama_perusahaan }}</p>
                        </div>

                        <!-- Location & Duration -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                {{ ucfirst($internship->lokasi_magang) }}
                            </span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                {{ $internship->durasi_magang }}
                            </span>
                        </div>

                        <!-- Description Preview -->
                        <p class="text-slate-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($internship->deskripsi_pekerjaan, 120) }}
                        </p>

                        <!-- Deadline -->
                        <div class="mb-4">
                            <div class="flex items-center text-sm">
                                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-slate-600">Deadline: {{ $internship->deadline_pendaftaran->format('d M Y') }}</span>
                            </div>
                            @if($internship->days_left <= 7)
                                <p class="text-red-600 text-xs mt-1 font-medium">
                                    {{ $internship->days_left }} hari lagi!
                                </p>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('internships.show', $internship->id) }}" 
                           class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-semibold transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-slate-900">Tidak ada lowongan magang</h3>
                    <p class="mt-1 text-sm text-slate-500">Belum ada lowongan magang yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($internships->hasPages())
            <div class="mt-8">
                {{ $internships->links() }}
            </div>
        @endif
    </div>
</div>
@endsection