@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-100">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-orange-500 via-orange-600 to-orange-700 text-white py-16 overflow-hidden">
        <div class="absolute inset-0 bg-black/5"></div>
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                Career <span class="text-orange-200">Opportunities</span>
            </h1>
            <p class="text-lg md:text-xl text-orange-100 mb-6 max-w-2xl mx-auto leading-relaxed">
                Discover premium internship opportunities for UISI students
            </p>
            
            <div class="flex flex-wrap justify-center items-center gap-4 text-orange-100">
                <div class="flex items-center space-x-2 bg-white/15 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="font-medium text-sm">{{ $internships->total() ?? 0 }} Active Positions</span>
                </div>
                <div class="flex items-center space-x-2 bg-white/15 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                    <svg class="w-4 h-4 text-orange-200" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium text-sm">100% Free Access</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-orange-100">
            <form method="GET" action="{{ route('peluang') }}" class="flex flex-col lg:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search companies, positions, locations..."
                               class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-gray-700 placeholder-gray-400 text-sm transition-all">
                    </div>
                </div>
                <div class="flex gap-3">
                    <button type="submit" 
                            class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 flex items-center space-x-2 font-medium text-sm shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Search</span>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('peluang') }}" 
                           class="bg-gray-500 text-white px-4 py-3 rounded-xl hover:bg-gray-600 transition-all duration-300 flex items-center shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
            
            <!-- Search Results Info - DIPERBAIKI -->
            <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between text-gray-600 gap-2">
                <div class="text-sm">
                    @if(request('search'))
                        Showing 
                        <span class="font-semibold text-orange-600">{{ $internships->firstItem() ?? 0 }}</span>
                        to 
                        <span class="font-semibold text-orange-600">{{ $internships->lastItem() ?? 0 }}</span>
                        of 
                        <span class="font-semibold">{{ $internships->total() }}</span>
                        results for "<strong class="text-orange-600">{{ request('search') }}</strong>"
                    @else
                        Showing 
                        <span class="font-semibold text-orange-600">{{ $internships->firstItem() ?? 0 }}</span>
                        to 
                        <span class="font-semibold text-orange-600">{{ $internships->lastItem() ?? 0 }}</span>
                        of 
                        <span class="font-semibold">{{ $internships->total() }}</span>
                        opportunities
                    @endif
                </div>
                
                @if($internships->total() > 0)
                    <div class="bg-orange-100 px-3 py-1 rounded-full text-xs font-medium text-orange-700">
                        Page {{ $internships->currentPage() }} of {{ $internships->lastPage() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Internships Grid - LEBIH BANYAK CARD -->
        @if($internships->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
                @foreach($internships as $internship)
                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-orange-100 group">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-5 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -translate-y-10 translate-x-10"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1 min-w-0">
                                        <h2 class="text-lg font-bold mb-1 leading-tight truncate">
                                            {{ $internship->nama_perusahaan }}
                                        </h2>
                                        <h3 class="text-orange-100 font-medium text-sm mb-2 line-clamp-2">
                                            {{ $internship->posisi_magang }}
                                        </h3>
                                    </div>
                                    <div class="ml-2 flex-shrink-0">
                                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/30">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-2">
                                    <div class="bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full border border-white/30">
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="font-medium text-xs">{{ ucfirst($internship->lokasi_magang) }}</span>
                                        </div>
                                    </div>
                                    <div class="bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full border border-white/30">
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="font-medium text-xs">{{ $internship->durasi_magang }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5">
                            <!-- Description -->
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-800 mb-2 text-sm">Job Description</h4>
                                <p class="text-gray-600 text-xs leading-relaxed line-clamp-3">
                                    {{ Str::limit($internship->deskripsi_pekerjaan, 120) }}
                                </p>
                            </div>

                            <!-- Benefits -->
                            @if($internship->benefit)
                                <div class="mb-4 bg-gradient-to-r from-green-50 to-emerald-50 p-3 rounded-lg border border-green-200">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <h4 class="font-semibold text-green-800 text-xs">Benefits</h4>
                                    </div>
                                    <p class="text-green-700 font-medium text-xs">{{ Str::limit($internship->benefit, 50) }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer -->
                        <div class="px-5 pb-5">
                            <a href="{{ route('peluang.show', $internship->id) }}" 
                               class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 px-4 rounded-lg font-medium text-sm text-center block hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                <div class="flex items-center justify-center space-x-2">
                                    <span>View Details</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            <div class="flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg border border-orange-100 p-4">
                    <div class="flex items-center justify-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($internships->onFirstPage())
                            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </span>
                        @else
                            <a href="{{ $internships->previousPageUrl() }}" 
                               class="px-4 py-2 text-orange-600 bg-orange-50 hover:bg-orange-100 rounded-lg transition-all duration-300 flex items-center font-medium border border-orange-200 hover:border-orange-300">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $start = max($internships->currentPage() - 2, 1);
                            $end = min($start + 4, $internships->lastPage());
                            $start = max($end - 4, 1);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $internships->url(1) }}" 
                               class="px-3 py-2 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-all duration-300 border border-gray-200 hover:border-orange-200">
                                1
                            </a>
                            @if($start > 2)
                                <span class="px-2 py-2 text-gray-400">...</span>
                            @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $internships->currentPage())
                                <span class="px-4 py-2 text-white bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg font-bold shadow-md">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $internships->url($i) }}" 
                                   class="px-3 py-2 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-all duration-300 border border-gray-200 hover:border-orange-200 font-medium">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor

                        @if($end < $internships->lastPage())
                            @if($end < $internships->lastPage() - 1)
                                <span class="px-2 py-2 text-gray-400">...</span>
                            @endif
                            <a href="{{ $internships->url($internships->lastPage()) }}" 
                               class="px-3 py-2 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-all duration-300 border border-gray-200 hover:border-orange-200">
                                {{ $internships->lastPage() }}
                            </a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($internships->hasMorePages())
                            <a href="{{ $internships->nextPageUrl() }}" 
                               class="px-4 py-2 text-orange-600 bg-orange-50 hover:bg-orange-100 rounded-lg transition-all duration-300 flex items-center font-medium border border-orange-200 hover:border-orange-300">
                                Next
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed flex items-center">
                                Next
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        @endif
                    </div>

                    {{-- Page Info --}}
                    <div class="mt-3 text-center">
                        <span class="text-xs text-gray-500">
                            Showing {{ $internships->firstItem() }} to {{ $internships->lastItem() }} of {{ $internships->total() }} results
                        </span>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    @if(request('search'))
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No Results Found</h3>
                        <p class="text-gray-600 mb-6 text-sm leading-relaxed">
                            No opportunities found matching "<strong class="text-orange-600 font-medium">{{ request('search') }}</strong>". 
                            Try using different keywords.
                        </p>
                        <a href="{{ route('peluang') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium text-sm rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            View All Opportunities
                        </a>
                    @else
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No Opportunities Available</h3>
                        <p class="text-gray-600 mb-6 text-sm leading-relaxed">
                            Currently no internship opportunities are available. 
                            Please check back later for new positions!
                        </p>
                        <a href="{{ route('welcome') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium text-sm rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Home
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Responsive grid adjustments */
@media (max-width: 768px) {
    .grid-cols-1.md\:grid-cols-2.xl\:grid-cols-4 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }
}

@media (min-width: 768px) and (max-width: 1279px) {
    .grid-cols-1.md\:grid-cols-2.xl\:grid-cols-4 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (min-width: 1280px) {
    .grid-cols-1.md\:grid-cols-2.xl\:grid-cols-4 {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }
}

/* Pagination hover effects */
.pagination-link {
    transition: all 0.3s ease;
}

.pagination-link:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
</style>
@endsection
