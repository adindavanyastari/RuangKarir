@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-100">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-orange-500 via-orange-600 to-red-600 text-white py-12 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-tight">
                    Discover <span class="text-orange-200">Students</span>
                </h1>
                <p class="text-lg md:text-xl text-orange-100 mb-6 max-w-2xl mx-auto leading-relaxed">
                    Connect with fellow students, discover talents, and build your professional network
                </p>

                @php
                    $profile = \App\Models\Profile::where('user_id', Auth::id())->first();
                    $totalStudents = \App\Models\Profile::count();
                    $activeStudents = \App\Models\Profile::where('updated_at', '>=', now()->subDays(30))->count();
                @endphp

                <div class="flex flex-wrap justify-center items-center gap-6 text-orange-100">
                    <div class="flex items-center space-x-2 bg-white/15 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="font-medium text-sm">{{ $totalStudents }} Students</span>
                    </div>
                    <div class="flex items-center space-x-2 bg-white/15 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                        <svg class="w-4 h-4 text-orange-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium text-sm">{{ $activeStudents }} Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        @php
            // Get other users' profiles with search functionality
            $query = \App\Models\Profile::where('user_id', '!=', Auth::id())->orderBy('updated_at', 'desc');

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

            $otherProfiles = $query->paginate(9);
        @endphp

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-orange-200">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Find Students</h2>
                <p class="text-gray-600">Search and connect with talented students across different programs</p>
            </div>

            <form method="GET" action="{{ route('pengguna.index') }}" class="space-y-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Search Input -->
                    <div class="col-span-2 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Search Students</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search by name, skills, interests..."
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-gray-700 placeholder-gray-400 transition-all">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Program Studi Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Program</label>
                        <select name="prodi" class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-gray-700 transition-all">
                            <option value="">All Programs</option>
                            <option value="Manajemen" {{ request('prodi') == 'Manajemen' ? 'selected' : '' }}>Management</option>
                            <option value="Akuntansi" {{ request('prodi') == 'Akuntansi' ? 'selected' : '' }}>Accounting</option>
                            <option value="Ekonomi Syariah" {{ request('prodi') == 'Ekonomi Syariah' ? 'selected' : '' }}>Islamic Economics</option>
                            <option value="Teknik Kimia" {{ request('prodi') == 'Teknik Kimia' ? 'selected' : '' }}>Chemical Engineering</option>
                            <option value="Teknik Logistik" {{ request('prodi') == 'Teknik Logistik' ? 'selected' : '' }}>Logistics Engineering</option>
                            <option value="Sistem Informasi" {{ request('prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Information Systems</option>
                            <option value="Informatika" {{ request('prodi') == 'Informatika' ? 'selected' : '' }}>Informatics</option>
                            <option value="Manajemen Rekayasa" {{ request('prodi') == 'Manajemen Rekayasa' ? 'selected' : '' }}>Engineering Management</option>
                            <option value="Teknologi Industri Pertanian" {{ request('prodi') == 'Teknologi Industri Pertanian' ? 'selected' : '' }}>Agricultural Industrial Technology</option>
                            <option value="Desain Komunikasi Visual" {{ request('prodi') == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Visual Communication Design</option>
                        </select>
                    </div>

                    <!-- Semester Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Semester</label>
                        <select name="semester" class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-gray-700 transition-all">
                            <option value="">All Semesters</option>
                            <option value="1-2" {{ request('semester') == '1-2' ? 'selected' : '' }}>Semester 1-2</option>
                            <option value="3-4" {{ request('semester') == '3-4' ? 'selected' : '' }}>Semester 3-4</option>
                            <option value="5-6" {{ request('semester') == '5-6' ? 'selected' : '' }}>Semester 5-6</option>
                            <option value="7-8" {{ request('semester') == '7-8' ? 'selected' : '' }}>Semester 7-8</option>
                        </select>
                    </div>
                </div>

                <!-- Certification Filter -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Certifications</label>
                        <input type="text" name="sertifikasi" value="{{ request('sertifikasi') }}"
                               placeholder="Search by certifications..."
                               class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 text-gray-700 placeholder-gray-400 transition-all">
                    </div>
                    <div class="flex items-end space-x-3">
                        <button type="submit"
                                class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        <a href="{{ route('pengguna.index') }}"
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-sm hover:shadow-md">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Active Filters -->
            @if(request()->hasAny(['search', 'prodi', 'semester', 'sertifikasi']))
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2 items-center mb-3">
                        <span class="text-sm font-semibold text-gray-700">Active filters:</span>
                        @if(request('search'))
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                Search: "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('prodi'))
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                Program: {{ request('prodi') }}
                            </span>
                        @endif
                        @if(request('semester'))
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                Semester: {{ request('semester') }}
                            </span>
                        @endif
                        @if(request('sertifikasi'))
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                Certification: {{ request('sertifikasi') }}
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500">
                        Found {{ $otherProfiles->total() }} students
                    </p>
                </div>
            @endif
        </div>

        <!-- Students Grid -->
        @if($otherProfiles->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6 mb-8">
                @foreach($otherProfiles as $otherProfile)
                    <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-orange-200 group">
                        <!-- Profile Header -->
                        <div class="p-6 pb-4">
                            <div class="md:flex items-center mb-4">
                                <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 mr-4 flex-shrink-0 ring-2 ring-orange-100 mb-2 md:mb-0">
                                    @if($otherProfile->foto && $otherProfile->foto !== 'icon')
                                        <img src="{{ asset($otherProfile->foto) }}" alt="Profile Photo" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-orange-400 to-orange-500 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $otherProfile->nama }}</h3>
                                    <p class="text-sm text-orange-600 font-semibold truncate">{{ $otherProfile->prodi }}</p>
                                    <p class="text-xs text-gray-500">Semester {{ $otherProfile->semester }} • {{ $otherProfile->fakultas }}</p>
                                </div>
                            </div>

                            <!-- Skills Preview -->
                            @if($otherProfile->hard_skills)
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Skills:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice(explode(',', $otherProfile->hard_skills), 0, 3) as $skill)
                                            <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-medium">{{ trim($skill) }}</span>
                                        @endforeach
                                        @if(count(explode(',', $otherProfile->hard_skills)) > 3)
                                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">+{{ count(explode(',', $otherProfile->hard_skills)) - 3 }} more</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Summary -->
                            @if($otherProfile->ringkasan_pribadi)
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">{{ Str::limit($otherProfile->ringkasan_pribadi, 100) }}</p>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <div class="px-6 pb-6">
                            <a href="{{ route('profile.show', $otherProfile->id) }}"
                               class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center justify-center shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View Profile
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            <div class="flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg border border-orange-200 p-4">
                    <div class="flex items-center justify-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($otherProfiles->onFirstPage())
                            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </span>
                        @else
                            <a href="{{ $otherProfiles->previousPageUrl() }}"
                               class="px-4 py-2 text-orange-600 bg-orange-50 hover:bg-orange-100 rounded-lg transition-all duration-300 flex items-center font-medium border border-orange-200 hover:border-orange-300">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $start = max($otherProfiles->currentPage() - 2, 1);
                            $end = min($start + 4, $otherProfiles->lastPage());
                            $start = max($end - 4, 1);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $otherProfiles->url(1) }}"
                               class="px-3 py-2 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-all duration-300 border border-gray-200 hover:border-orange-200">
                                1
                            </a>
                            @if($start > 2)
                                <span class="px-2 py-2 text-gray-400">...</span>
                            @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $otherProfiles->currentPage())
                                <span class="px-4 py-2 text-white bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg font-bold shadow-md">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $otherProfiles->url($i) }}"
                                   class="px-3 py-2 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-all duration-300 border border-gray-200 hover:border-orange-200 font-medium">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor

                        @if($end < $otherProfiles->lastPage())
                            @if($end < $otherProfiles->lastPage() - 1)
                                <span class="px-2 py-2 text-gray-400">...</span>
                            @endif
                            <a href="{{ $otherProfiles->url($otherProfiles->lastPage()) }}"
                               class="px-3 py-2 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-all duration-300 border border-gray-200 hover:border-orange-200">
                                {{ $otherProfiles->lastPage() }}
                            </a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($otherProfiles->hasMorePages())
                            <a href="{{ $otherProfiles->nextPageUrl() }}"
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
                            Showing {{ $otherProfiles->firstItem() }} to {{ $otherProfiles->lastItem() }} of {{ $otherProfiles->total() }} students
                        </span>
                    </div>
                </div>
            </div>
        @else
            <!-- No Students Found -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    @if(request()->hasAny(['search', 'prodi', 'semester', 'sertifikasi']))
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No Students Found</h3>
                        <p class="text-gray-600 mb-6 text-sm leading-relaxed">
                            No students found matching your search criteria.
                            Try adjusting your filters or search terms.
                        </p>
                        <a href="{{ route('pengguna.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold text-sm rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            View All Students
                        </a>
                    @else
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No Students Yet</h3>
                        <p class="text-gray-600 mb-6 text-sm leading-relaxed">
                            Be the first to create a profile and connect with other students!
                        </p>
                        @php
                            $profile = \App\Models\Profile::where('user_id', Auth::id())->first();
                        @endphp
                        @if(!$profile)
                            <a href="{{ route('profile.create') }}"
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold text-sm rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create Your Profile
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        @endif

        @php
            $profile = \App\Models\Profile::where('user_id', Auth::id())->first();
        @endphp
        @if(!$profile)
        <!-- Create Profile CTA -->
        <div class="bg-gradient-to-r from-orange-500 via-orange-600 to-red-600 rounded-2xl shadow-xl p-8 text-center text-white mt-8">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold mb-4">Create Your Profile</h2>
                <p class="text-lg text-orange-100 mb-6 leading-relaxed">
                    Join our student network and showcase your skills, projects, and achievements to connect with peers and opportunities.
                </p>
                <a href="{{ route('profile.create') }}"
                   class="inline-flex items-center px-8 py-4 bg-white text-orange-600 font-bold rounded-xl hover:bg-orange-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Get Started Now
                </a>
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

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Enhanced hover effects */
.group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
@endsection
