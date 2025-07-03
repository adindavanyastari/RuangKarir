@extends('layouts.app')

@section('content')
<!-- HERO SECTION DENGAN FOTO -->
<section class="bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 py-20 lg:py-32 relative overflow-hidden">
    <!-- SPACE FOTO HEADER - 1920x800px -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero.png') }}" alt="UISI Campus Background" class="w-full h-full object-cover opacity-20">
        <!-- Judul: "Hero Dashboard - UISI Campus Students Career Background" -->
    </div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">Ruang Karir UISI</h1>
            <p class="text-xl md:text-2xl opacity-90 max-w-3xl mx-auto mb-12">
                Platform karir eksklusif untuk mahasiswa UISI. Temukan peluang terbaik untuk membangun masa depan profesionalmu.
            </p>

            <!-- STATISTIK HERO -->
            <div class="grid grid-cols-3 md:grid-cols-3 gap-2 md:gap-8 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-2 md:p-8 border border-white/20">
                    <div class="text-lg md:text-3xl font-bold mb-2">5,000+</div>
                    <div class="sm:text-sm text-orange-100">Mahasiswa Aktif</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-2  md:p-8 border border-white/20">
                    <div class="text-lg md:text-3xl font-bold mb-2">{{ $totalInternships }}+</div>
                    <div class="sm:text-sm text-orange-100">Peluang Karir</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-2  md:p-8 border border-white/20">
                    <div class="text-lg md:text-3xl font-bold mb-2">500+</div>
                    <div class="sm:text-sm text-orange-100">Partner Perusahaan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LOWONGAN MAGANG TERBARU - WITH DETAILED INFORMATION -->
<section class="py-20 bg-gradient-to-br from-slate-50 to-orange-50" id="lowongan">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-slate-800 mb-4">Lowongan Magang & Internship Terbaru</h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Peluang magang eksklusif dari perusahaan terpercaya untuk mahasiswa UISI
            </p>
        </div>

        <!-- Form Pencarian Lowongan -->
        <div class="max-w-3xl mx-auto mb-12">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <form action="{{ route('peluang') }}" method="GET" class="flex gap-4">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari lowongan berdasarkan perusahaan, posisi, lokasi, atau benefit..."
                               class="pl-10 w-full h-12 text-base border border-slate-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all">
                    </div>
                    <button type="submit"
                            class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Cari</span>
                    </button>
                </form>
            </div>
        </div>

        @if($latestInternships->count() > 0)
            <div class="grid grid-cols-2 gap-2 md:gap-8">
                @foreach($latestInternships as $internship)
                    <!-- Internship Card - With Complete Information -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-4 md:p-8">
                            <div class="md:flex items-center mb-6">
                                <!-- Company Logo Placeholder -->
                                <div class="w-16 h-16 bg-gradient-to-r from-orange-400 to-amber-400 rounded-lg flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-xl">{{ substr($internship->nama_perusahaan, 0, 2) }}</span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-800">{{ $internship->posisi_magang }}</h3>
                                    <p class="text-slate-600">{{ $internship->nama_perusahaan }}</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">{{ ucfirst($internship->lokasi_magang) }}</span>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $internship->durasi_magang }}</span>
                                @if($internship->benefit)
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">{{ Str::limit($internship->benefit, 20) }}</span>
                                @endif
                            </div>

                            <div class="space-y-4 mb-6">
                                <div>
                                    <h4 class="font-semibold text-slate-800">Deskripsi:</h4>
                                    <p class="text-slate-600">
                                        {{ Str::limit($internship->deskripsi_pekerjaan, 150) }}
                                    </p>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-slate-800">Kualifikasi:</h4>
                                    <p class="text-slate-600">
                                        {{ Str::limit($internship->kualifikasi, 120) }}
                                    </p>
                                </div>

                                @if($internship->benefit)
                                <div>
                                    <h4 class="font-semibold text-slate-800">Benefit:</h4>
                                    <p class="text-slate-600">{{ $internship->benefit }}</p>
                                </div>
                                @endif
                            </div>

                            <div class="md:flex items-center justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <span class="text-sm text-slate-500">📍 {{ ucfirst($internship->lokasi_magang) }}</span>
                                    <span class="text-sm text-slate-500">⏰ {{ $internship->durasi_magang }}</span>
                                </div>
                                <div class="text-sm font-medium text-orange-600">Deadline: {{ $internship->deadline_pendaftaran->format('d M Y') }}</div>
                            </div>

                            <a href="{{ route('peluang.show', $internship->id) }}" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors text-center block">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Lowongan</h3>
                <p class="text-gray-600">Lowongan magang akan segera tersedia. Pantau terus halaman ini!</p>
            </div>
        @endif

        <div class="text-center mt-12">
            <a href="{{ route('peluang') }}" class="inline-flex items-center bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">
                Lihat Semua Lowongan
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- CALL TO ACTION BANNER (REPLACING ARTIKEL SECTION) -->
<section class="py-20 bg-white-500">
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-gradient-to-br from-orange-500 via-orange-300 to-red-400 rounded-3xl overflow-hidden shadow-xl">
            <div class="grid md:grid-cols-2 items-center">
                <div class="order-2 md:order-1 p-8 md:p-12 lg:p-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Gabung Sekarang di Ruang Karir UISI!
                    </h2>
                    <p class="text-xl text-white mb-8">
                        Platform profil profesional khusus mahasiswa UISI yang ingin menemukan peluang magang terbaik dan untuk dosen atau industri yang sedang mencari talenta berkualitas.
                        Bangun portofolio profesionalmu, tampilkan keahlian terbaik. Mahasiswa siap berkembang. Dosen siap menemukan. Semua dimulai dari sini. Ayo wujudkan masa depan karirmu di Ruang Karir!
                    </p>
                    <a href="{{ route('profile.my-profile') }}"
                        class="inline-flex items-center bg-white hover:bg-gray-100 text-orange-700 font-semibold py-3 px-6 rounded-lg transition-colors mt-6">
                        Lengkapi Profilmu Sekarang!
                    </a>
                </div>
                <div class="h-full order-1 md:order-2">
                    <!-- SPACE FOTO CTA - 800x600px -->
                    <img src="{{ asset('images/cta1.png') }}" alt="Career Growth" class="h-full w-full object-cover">
                    <!-- Judul: "CTA Banner - Career Growth Opportunities" -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PENCARIAN PROFIL MAHASISWA - ENHANCED JOBSTREET STYLE -->
<section class="bg-gradient-to-br from-slate-50 to-orange-50 py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6">Temukan Talenta Mahasiswa UISI</h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Jelajahi profil mahasiswa terbaik UISI sesuai kebutuhan perusahaan Anda dan temukan talenta potensial untuk program magang, proyek, atau rekrutmen
            </p>
        </div>

        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('pengguna.index') }}" method="GET" class="space-y-6">
                    @csrf
                    <!-- Search Input -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama, keahlian, atau sertifikasi..."
                               class="pl-10 w-full h-12 text-base border border-slate-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all">
                    </div>

                    <!-- Enhanced Filters - Jobstreet Style -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <!-- Program Studi Filter -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Program Studi</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <select name="prodi" class="pl-10 w-full h-12 border border-slate-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all appearance-none bg-white">
                                    <option value="">Semua Prodi</option>
                                    @php
                                        $prodis = [
                                            'Teknik Logistik',
                                            'Teknik Kimia',
                                            'Sistem Informasi',
                                            'Manajemen',
                                            'Informatika',
                                            'Ekonomi Syariah',
                                            'Desain Komunikasi Visual',
                                            'Akuntansi',
                                            'Manajemen Rekayasa',
                                            'Teknologi Agroindustri'
                                        ];
                                    @endphp
                                    @foreach($prodis as $prodi)
                                        <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Semester Filter -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Semester</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <select name="semester" class="pl-10 w-full h-12 border border-slate-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all appearance-none bg-white">
                                    <option value="">Semua Semester</option>
                                    <option value="1-2" {{ request('semester') == '1-2' ? 'selected' : '' }}>Semester&nbsp;1‑2</option>
                                    <option value="3-4" {{ request('semester') == '3-4' ? 'selected' : '' }}>Semester&nbsp;3‑4</option>
                                    <option value="5-6" {{ request('semester') == '5-6' ? 'selected' : '' }}>Semester&nbsp;5‑6</option>
                                    <option value="7-8" {{ request('semester') == '7-8' ? 'selected' : '' }}>Semester&nbsp;7‑8</option>
                                </select>
                            </div>
                        </div>

                        <!-- Sertifikasi / Keahlian Khusus (Free‑text) -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Sertifikasi atau Keahlian Khusus</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                <input type="text" name="skills" value="{{ request('skills') }}" placeholder="Contoh: AWS, UI/UX, Data Analyst"
                                       class="pl-10 w-full h-12 border border-slate-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="h-12 bg-orange-600 hover:bg-orange-700 text-white text-base font-semibold rounded-lg transition-all flex items-center justify-center px-8 w-full md:w-auto">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Talenta
                    </button>

                    <div class="flex flex-wrap gap-2 mt-6">
                    <span class="text-sm text-slate-600">Filter populer:</span>
                    <a href="{{ route('pengguna.index', ['search' => 'Sistem Informasi']) }}" class="px-3 py-1 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-full text-sm transition-colors">Sistem Informasi</a>
                    <a href="{{ route('pengguna.index', ['search' => 'UI/UX']) }}" class="px-3 py-1 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-full text-sm transition-colors">UI/UX Design</a>
                    <a href="{{ route('pengguna.index', ['search' => 'Data Analysis']) }}" class="px-3 py-1 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-full text-sm transition-colors">Data Analysis</a>
                    <a href="{{ route('pengguna.index', ['search' => 'Certified Public Accountant (CPA)']) }}" class="px-3 py-1 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-full text-sm transition-colors">Certified Public Accountant (CPA)</a>
                    <a href="{{ route('pengguna.index', ['search' => 'Microsoft Office Specialist (MOS) Word']) }}" class="px-3 py-1 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-full text-sm transition-colors">Microsoft Office Specialist (MOS) Word</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- RATING & TESTIMONI APLIKASI -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-slate-800 mb-4">Dipercaya Ribuan Mahasiswa</h2>
            <div class="flex items-center justify-center mb-6">
                <div class="flex text-orange-400 text-3xl mr-4">
                    <span>★★★★★</span>
                </div>
                <div class="text-left">
                    <div class="text-2xl font-bold text-slate-800">4.8/5</div>
                    <div class="text-sm text-slate-600">Dari 2,847 ulasan</div>
                </div>
            </div>
        </div>

        <!-- SPACE FOTO TESTIMONI - 1200x400px -->
        <div class="mb-12">
            <img src="{{ asset('images/testimoni-banner.png') }}" alt="Testimoni Mahasiswa UISI" class="w-full h-[120px] md:h-[400px] object-cover rounded-2xl shadow-lg">
            <!-- Judul: "Testimoni Banner - Mahasiswa UISI Success Stories" -->
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimoni 1 -->
            <div class="bg-orange-50 p-6 rounded-xl shadow-lg">
                <div class="flex items-center mb-4">
                    <!-- SPACE FOTO PROFIL - 80x80px -->
                    <img src="{{ asset('images/profile-1.png') }}" alt="Sarah Putri" class="w-12 h-12 rounded-full object-cover mr-4">
                    <!-- Judul: "Profile Photo - Sarah Putri Mahasiswa SI" -->
                    <div>
                        <h4 class="font-semibold text-slate-800">Aszra Aurelita A.F</h4>
                        <p class="text-sm text-slate-600">Sistem Informasi '21</p>
                    </div>
                </div>
                <div class="flex text-orange-400 mb-3">★★★★★</div>
                <p class="text-slate-700 text-sm leading-relaxed">"Platform yang luar biasa! Berkat Ruang Karir, saya berhasil mendapat internship di Gojek. Interface-nya user-friendly dan lowongannya berkualitas."</p>
            </div>

            <!-- Testimoni 2 -->
            <div class="bg-orange-50 p-6 rounded-xl shadow-lg">
                <div class="flex items-center mb-4">
                    <!-- SPACE FOTO PROFIL - 80x80px -->
                    <img src="{{ asset('images/profile-2.png') }}" alt="Ahmad Rizki" class="w-12 h-12 rounded-full object-cover mr-4">
                    <!-- Judul: "Profile Photo - Ahmad Rizki Mahasiswa TI" -->
                    <div>
                        <h4 class="font-semibold text-slate-800">Citra Maulidyah H</h4>
                        <p class="text-sm text-slate-600">Management '20</p>
                    </div>
                </div>
                <div class="flex text-orange-400 mb-3">★★★★★</div>
                <p class="text-slate-700 text-sm leading-relaxed">"Fitur portofolio digitalnya sangat membantu showcase project saya. Recruiter jadi lebih mudah melihat kemampuan teknis yang saya miliki."</p>
            </div>

            <!-- Testimoni 3 -->
            <div class="bg-orange-50 p-6 rounded-xl shadow-lg">
                <div class="flex items-center mb-4">
                    <!-- SPACE FOTO PROFIL - 80x80px -->
                    <img src="{{ asset('images/profile-3.png') }}" alt="Maya Sari" class="w-12 h-12 rounded-full object-cover mr-4">
                    <!-- Judul: "Profile Photo - Maya Sari Mahasiswa DKV" -->
                    <div>
                        <h4 class="font-semibold text-slate-800">Adinda Vany Astari</h4>
                        <p class="text-sm text-slate-600">DKV '22</p>
                    </div>
                </div>
                <div class="flex text-orange-400 mb-3">★★★★☆</div>
                <p class="text-slate-700 text-sm leading-relaxed">"Networking dengan alumni dan mahasiswa lain sangat terbantu. Banyak insight karir yang bermanfaat dari komunitas di platform ini."</p>
            </div>
        </div>
    </div>
</section>

<!-- FITUR UNGGULAN DENGAN FOTO -->
<section class="py-20 bg-gradient-to-br from-orange-50 to-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-slate-800 mb-4">Fitur Unggulan Ruang Karir</h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Platform lengkap yang dirancang khusus untuk mendukung perjalanan karir mahasiswa UISI
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
            <!-- Feature 1 -->
            <div class="group hover:shadow-xl transition-all duration-300 border-0 shadow-lg rounded-2xl overflow-hidden bg-white">
                <!-- SPACE FOTO FITUR - 400x200px -->
                <img src="{{ asset('images/1.png') }}" alt="Profil Profesional" class="w-full h-48 object-cover">
                <!-- Judul: "Feature Profile - Professional Student Profile Interface" -->
                <div class="p-6">
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Profil Profesional</h3>
                    <p class="text-slate-600 leading-relaxed">Buat profil yang menarik dengan portofolio, pengalaman, dan keahlian yang dapat dilihat oleh recruiter terbaik.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="group hover:shadow-xl transition-all duration-300 border-0 shadow-lg rounded-2xl overflow-hidden bg-white">
                <!-- SPACE FOTO FITUR - 400x200px -->
                <img src="{{ asset('images/2.png') }}" alt="Portofolio Digital" class="w-full h-48 object-cover">
                <!-- Judul: "Feature Portfolio - Digital Portfolio Showcase" -->
                <div class="p-6">
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Portofolio Digital</h3>
                    <p class="text-slate-600 leading-relaxed">Tunjukkan karya terbaikmu dalam format digital yang mudah diakses dan dibagikan kepada calon perusahaan.</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="group hover:shadow-xl transition-all duration-300 border-0 shadow-lg rounded-2xl overflow-hidden bg-white">
                <!-- SPACE FOTO FITUR - 400x200px -->
                <img src="{{ asset('images/3.png') }}" alt="Lowongan Eksklusif" class="w-full h-48 object-cover">
                <!-- Judul: "Feature Jobs - Exclusive Job Opportunities" -->
                <div class="p-6">
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Lowongan Eksklusif</h3>
                    <p class="text-slate-600 leading-relaxed">Akses ribuan lowongan kerja dan magang dari perusahaan BUMN, startup, dan korporasi terpercaya.</p>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="group hover:shadow-xl transition-all duration-300 border-0 shadow-lg rounded-2xl overflow-hidden bg-white">
                <!-- SPACE FOTO FITUR - 400x200px -->
                <img src="{{ asset('images/4.png') }}" alt="Sertifikasi & Pelatihan" class="w-full h-48 object-cover">
                <!-- Judul: "Feature Training - Certification and Training Programs" -->
                <div class="p-6">
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Sertifikasi & Pelatihan</h3>
                    <p class="text-slate-600 leading-relaxed">Ikuti program pelatihan dan dapatkan sertifikasi yang diakui industri untuk meningkatkan kompetensi.</p>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="group hover:shadow-xl transition-all duration-300 border-0 shadow-lg rounded-2xl overflow-hidden bg-white">
                <!-- SPACE FOTO FITUR - 400x200px -->
                <img src="{{ asset('images/5.png') }}" alt="Career Analytics" class="w-full h-48 object-cover">
                <!-- Judul: "Feature Analytics - Career Progress Analytics Dashboard" -->
                <div class="p-6">
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Karir Analytics</h3>
                    <p class="text-slate-600 leading-relaxed">Pantau perkembangan karir dengan analytics mendalam tentang profil dan aplikasi lamaran kerja.</p>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="group hover:shadow-xl transition-all duration-300 border-0 shadow-lg rounded-2xl overflow-hidden bg-white">
                <!-- SPACE FOTO FITUR - 400x200px -->
                <img src="{{ asset('images/6.png') }}" alt="Verifikasi UISI" class="w-full h-48 object-cover">
                <!-- Judul: "Feature Verification - UISI Student Verification System" -->
                <div class="p-6">
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Verifikasi UISI</h3>
                    <p class="text-slate-600 leading-relaxed">Platform eksklusif dengan verifikasi mahasiswa UISI untuk memastikan kualitas dan kredibilitas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PARTNER PERUSAHAAN -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-800 mb-4">Dipercaya Perusahaan Terkemuka</h2>
            <p class="text-lg text-slate-600">Lebih dari 500+ perusahaan mempercayai platform kami untuk mencari talenta terbaik</p>
        </div>

        <!-- SPACE FOTO PARTNER - 1200x300px -->
        <div class="mb-8 flex flex-wrap justify-center gap-8 p-8 w-full rounded-2xl shadow-lg">
            <img src="{{ asset('images/BCA.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/bni.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/Garuda-Indonesia-logo.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/Indosat_Ooredoo.svg') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/Logo_PLN.svg') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/Logo-BRI.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/logo-gofood-baru.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/logo-PG.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/logo-SID.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/Pertamina_Logo.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/PT-Freeport-Indonesia.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/SIG_Logo.svg') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/silog.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/Telkom_Indonesia.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/telkomse.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/Unilever-Logo.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <img src="{{ asset('images/wilmar.png') }}" alt="Partner Perusahaan" class="h-[50px] object-cover ">
            <!-- Judul: "Company Partners - Logo Perusahaan Partner BUMN Swasta" -->
        </div>

        {{-- <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-60">
            <!-- SPACE LOGO PERUSAHAAN - 150x80px masing-masing -->
            <img src="{{ asset('images/a.png') }}" alt="BNI" class="h-12 object-contain mx-auto filter grayscale hover:grayscale-0 transition-all">
            <!-- Judul: "Logo BNI - Bank Negara Indonesia" -->

            <img src="{{ asset('images/b.png') }}" alt="Telkom" class="h-12 object-contain mx-auto filter grayscale hover:grayscale-0 transition-all">
            <!-- Judul: "Logo Telkom - Telkom Indonesia" -->

            <img src="{{ asset('images/c.png') }}" alt="Pertamina" class="h-12 object-contain mx-auto filter grayscale hover:grayscale-0 transition-all">
            <!-- Judul: "Logo Pertamina - PT Pertamina" -->

            <img src="{{ asset('images/d.png') }}" alt="Gojek" class="h-12 object-contain mx-auto filter grayscale hover:grayscale-0 transition-all">
            <!-- Judul: "Logo Gojek - PT Gojek Indonesia" -->

            <img src="{{ asset('images/e.png') }}" alt="Tokopedia" class="h-12 object-contain mx-auto filter grayscale hover:grayscale-0 transition-all">
            <!-- Judul: "Logo Tokopedia - PT Tokopedia" -->

            <img src="{{ asset('images/f.png') }}" alt="Shopee" class="h-12 object-contain mx-auto filter grayscale hover:grayscale-0 transition-all">
            <!-- Judul: "Logo Shopee - Shopee Indonesia" -->
        </div> --}}
    </div>
</section>

<!-- CTA SECTION DENGAN STATISTIK -->
<section class="bg-gradient-to-br from-orange-600 via-orange-700 to-red-700 py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Bergabunglah dengan Komunitas Karir UISI</h2>
            <p class="text-xl text-orange-100 max-w-3xl mx-auto mb-8">
                Dapatkan akses eksklusif ke peluang karir terbaik, networking dengan alumni sukses, dan bimbingan karir profesional
            </p>
        </div>

        <!-- SPACE FOTO CTA - 800x300px -->
        <div class="mb-12">
            <img src="{{ asset('images/cta.png') }}" alt="Success Stories" class="w-full h-[300px] object-cover rounded-2xl shadow-2xl mx-auto max-w-4xl">
            <!-- Judul: "CTA Success Stories - Mahasiswa UISI Career Success" -->
        </div>

        <div class="grid grid-cols-3 gap-2 md:gap-8 mb-12">
            <div class="text-center">
                <div class="bg-white/10 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">5,000+</h3>
                <p class="text-orange-100">Mahasiswa Terdaftar</p>
            </div>
            <div class="text-center">
                <div class="bg-white/10 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">{{ $totalInternships }}+</h3>
                <p class="text-orange-100">Lowongan Tersedia</p>
            </div>
            <div class="text-center">
                <div class="bg-white/10 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">85%</h3>
                <p class="text-orange-100">Tingkat Penempatan</p>
            </div>
        </div>

        <div class="text-center">
            <div class="flex gap-2 md:gap-4 justify-center">
                <a href="{{ route('profile.my-profile') }}" class="inline-flex items-center justify-center bg-white text-orange-600 hover:bg-orange-50 font-bold px-4 py-2 text-sm md:px-8 md:py-4 md:text-lg rounded-full shadow-lg transition-all">
                    Lihat Profil Saya
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
                <a href="{{ route('peluang') }}" class="inline-flex items-center justify-center border-2 border-white text-white hover:bg-white/10 font-bold px-4 py-2 text-sm md:px-8 md:py-4 md:text-lg rounded-full transition-all">
                    Jelajahi Lowongan
                </a>
            </div>
            <p class="text-orange-200 text-sm mt-4">Gratis untuk semua mahasiswa UISI yang terverifikasi</p>
        </div>
    </div>
</section>
@endsection
