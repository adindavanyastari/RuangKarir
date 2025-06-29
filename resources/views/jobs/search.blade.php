@extends('layouts.app')

@section('content')
<!-- HERO SECTION PENCARIAN -->
<section style="background: linear-gradient(135deg, #f97316, #ea580c, #dc2626);" class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center text-white mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Hasil Pencarian Lowongan</h1>
            @if(request('keyword'))
                <p class="text-lg opacity-90">
                    Menampilkan hasil untuk: <span class="font-semibold">"{{ request('keyword') }}"</span>
                </p>
            @endif
        </div>
    </div>
</section>

<!-- PENCARIAN SECTION -->
<section style="background: linear-gradient(135deg, #fff7ed, #fed7aa);" class="py-8">
    <div class="max-w-6xl mx-auto px-4">
        <div style="background-color: white;" class="rounded-2xl shadow-xl p-6">
            <form action="{{ route('jobs.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2 relative">
                    <svg style="color: #9ca3af;" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari posisi, perusahaan, atau kata kunci..." 
                           style="padding-left: 2.5rem; border: 1px solid #e5e7eb;" class="w-full h-12 text-base rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all">
                </div>

                <div class="relative">
                    <svg style="color: #9ca3af;" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <select name="location" style="padding-left: 2.5rem; border: 1px solid #e5e7eb; background-color: white;" class="w-full h-12 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all appearance-none">
                        <option value="">Semua Lokasi</option>
                        <option value="jakarta" {{ request('location') == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                        <option value="bandung" {{ request('location') == 'bandung' ? 'selected' : '' }}>Bandung</option>
                        <option value="surabaya" {{ request('location') == 'surabaya' ? 'selected' : '' }}>Surabaya</option>
                        <option value="yogyakarta" {{ request('location') == 'yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                        <option value="remote" {{ request('location') == 'remote' ? 'selected' : '' }}>Remote</option>
                    </select>
                </div>

                <button type="submit" style="background-color: #ea580c; color: white;" class="h-12 text-base font-semibold rounded-lg transition-all flex items-center justify-center hover:bg-orange-700">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari Sekarang
                </button>
            </form>
        </div>
    </div>
</section>

<!-- HASIL PENCARIAN -->
<section style="background-color: #f9fafb;" class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 style="color: #1f2937;" class="text-2xl font-bold">Hasil Pencarian</h2>
                <p style="color: #6b7280;" class="text-sm mt-1">Ditemukan 24 lowongan yang sesuai</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <span style="color: #6b7280;" class="text-sm">Urutkan:</span>
                <select style="border: 1px solid #e5e7eb; background-color: white;" class="px-3 py-2 rounded-lg text-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-200">
                    <option>Terbaru</option>
                    <option>Gaji Tertinggi</option>
                    <option>Relevansi</option>
                </select>
            </div>
        </div>

        <!-- Grid Hasil Pencarian -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Search Result 1 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="h-2"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div style="background-color: #fed7aa;" class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <svg style="color: #ea580c;" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span style="background-color: #dcfce7; color: #166534;" class="px-3 py-1 rounded-full text-sm font-medium">Full Time</span>
                    </div>
                    
                    <h3 style="color: #1f2937;" class="text-xl font-bold mb-2">Senior Data Analyst</h3>
                    <p style="color: #ea580c;" class="font-semibold mb-2">PT. Analytics Pro</p>
                    <p style="color: #6b7280;" class="text-sm mb-4">Mencari senior data analyst dengan pengalaman 3+ tahun untuk menganalisis big data dan business intelligence.</p>
                    
                    <div class="flex items-center justify-between text-sm mb-4">
                        <div class="flex items-center">
                            <svg style="color: #6b7280;" class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span style="color: #6b7280;">Jakarta</span>
                        </div>
                        <div class="flex items-center">
                            <svg style="color: #6b7280;" class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <span style="color: #6b7280;">12-18 Juta</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span style="background-color: #dcfce7; color: #166534;" class="px-2 py-1 rounded text-xs">Python</span>
                        <span style="background-color: #fef3c7; color: #92400e;" class="px-2 py-1 rounded text-xs">SQL</span>
                        <span style="background-color: #dbeafe; color: #1e40af;" class="px-2 py-1 rounded text-xs">Power BI</span>
                    </div>
                    
                    <button style="background-color: #ea580c; color: white;" class="w-full py-2 rounded-lg font-semibold hover:bg-orange-700 transition-colors">
                        Lamar Sekarang
                    </button>
                </div>
            </div>

            <!-- Search Result 2 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="h-2"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div style="background-color: #fed7aa;" class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <svg style="color: #ea580c;" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span style="background-color: #e0e7ff; color: #3730a3;" class="px-3 py-1 rounded-full text-sm font-medium">Internship</span>
                    </div>
                    
                    <h3 style="color: #1f2937;" class="text-xl font-bold mb-2">Data Analyst Intern</h3>
                    <p style="color: #ea580c;" class="font-semibold mb-2">PT. Startup Analytics</p>
                    <p style="color: #6b7280;" class="text-sm mb-4">Program magang 6 bulan untuk fresh graduate yang ingin memulai karir sebagai data analyst.</p>
                    
                    <div class="flex items-center justify-between text-sm mb-4">
                        <div class="flex items-center">
                            <svg style="color: #6b7280;" class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span style="color: #6b7280;">Remote</span>
                        </div>
                        <div class="flex items-center">
                            <svg style="color: #6b7280;" class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <span style="color: #6b7280;">3-5 Juta</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span style="background-color: #dcfce7; color: #166534;" class="px-2 py-1 rounded text-xs">Excel</span>
                        <span style="background-color: #fef3c7; color: #92400e;" class="px-2 py-1 rounded text-xs">SQL</span>
                        <span style="background-color: #f3e8ff; color: #7c3aed;" class="px-2 py-1 rounded text-xs">Tableau</span>
                    </div>
                    
                    <button style="background-color: #ea580c; color: white;" class="w-full py-2 rounded-lg font-semibold hover:bg-orange-700 transition-colors">
                        Lamar Sekarang
                    </button>
                </div>
            </div>

            <!-- Search Result 3 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="h-2"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div style="background-color: #fed7aa;" class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <svg style="color: #ea580c;" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span style="background-color: #fef3c7; color: #92400e;" class="px-3 py-1 rounded-full text-sm font-medium">Part Time</span>
                    </div>
                    
                    <h3 style="color: #1f2937;" class="text-xl font-bold mb-2">Junior Data Analyst</h3>
                    <p style="color: #ea580c;" class="font-semibold mb-2">PT. Data Insights</p>
                    <p style="color: #6b7280;" class="text-sm mb-4">Posisi part-time untuk data analyst junior dengan fleksibilitas waktu kerja yang baik.</p>
                    
                    <div class="flex items-center justify-between text-sm mb-4">
                        <div class="flex items-center">
                            <svg style="color: #6b7280;" class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span style="color: #6b7280;">Bandung</span>
                        </div>
                        <div class="flex items-center">
                            <svg style="color: #6b7280;" class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <span style="color: #6b7280;">6-9 Juta</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span style="background-color: #dcfce7; color: #166534;" class="px-2 py-1 rounded text-xs">Python</span>
                        <span style="background-color: #fef3c7; color: #92400e;" class="px-2 py-1 rounded text-xs">R</span>
                        <span style="background-color: #dbeafe; color: #1e40af;" class="px-2 py-1 rounded text-xs">Excel</span>
                    </div>
                    
                    <button style="background-color: #ea580c; color: white;" class="w-full py-2 rounded-lg font-semibold hover:bg-orange-700 transition-colors">
                        Lamar Sekarang
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <div class="flex space-x-2">
                <button style="background-color: #ea580c; color: white;" class="px-4 py-2 rounded-lg font-medium">1</button>
                <button style="background-color: white; color: #6b7280; border: 1px solid #e5e7eb;" class="px-4 py-2 rounded-lg font-medium hover:bg-gray-50">2</button>
                <button style="background-color: white; color: #6b7280; border: 1px solid #e5e7eb;" class="px-4 py-2 rounded-lg font-medium hover:bg-gray-50">3</button>
                <button style="background-color: white; color: #6b7280; border: 1px solid #e5e7eb;" class="px-4 py-2 rounded-lg font-medium hover:bg-gray-50">Next</button>
            </div>
        </div>
    </div>
</section>
@endsection