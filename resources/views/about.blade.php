@extends('layouts.app')

@section('content')
<!-- HERO SECTION ABOUT -->
<section style="background: linear-gradient(135deg, #f97316, #ea580c, #dc2626);" class="py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Tentang Ruang Karir</h1>
            <p class="text-xl md:text-2xl opacity-90 max-w-3xl mx-auto">
                Jembatan karir bagi mahasiswa UISI untuk meraih peluang magang, kerja, dan riset bersama dosen terbaik menuju masa depan gemilang
            </p>
        </div>
    </div>
</section>

<!-- TENTANG APLIKASI -->
<section style="background-color: white;" class="py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 style="color: #1f2937;" class="text-3xl md:text-4xl font-bold mb-6">Apa itu Ruang Karir?</h2>
                <p style="color: #6b7280;" class="text-lg leading-relaxed mb-6">
                    Ruang Karir adalah platform karir digital yang dirancang khusus untuk mahasiswa dan alumni Universitas Internasional Semen Indonesia (UISI). Kami menyediakan akses eksklusif ke ribuan peluang kerja, magang, dan pengembangan karir dari perusahaan-perusahaan terpercaya.
                </p>
                <p style="color: #6b7280;" class="text-lg leading-relaxed mb-8">
                    Dengan teknologi terdepan dan jaringan industri yang luas, kami berkomitmen untuk membantu setiap mahasiswa UISI menemukan jalur karir yang sesuai dengan passion dan keahlian mereka.
                </p>

                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div style="color: #ea580c;" class="text-3xl font-bold mb-2">5,000+</div>
                        <p style="color: #6b7280;" class="text-sm">Mahasiswa Terdaftar</p>
                    </div>
                    <div class="text-center">
                        <div style="color: #ea580c;" class="text-3xl font-bold mb-2">1,200+</div>
                        <p style="color: #6b7280;" class="text-sm">Lowongan Tersedia</p>
                    </div>
                </div>
            </div>

            <div style="background: linear-gradient(135deg, #fed7aa, #fb923c);" class="rounded-2xl p-8 text-center">
                <svg style="color: #ea580c;" class="h-24 w-24 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 style="color: #1f2937;" class="text-2xl font-bold mb-4">Visi Kami</h3>
                <p style="color: #4b5563;" class="text-lg">
                    Menjadi platform karir terdepan yang menghubungkan talenta terbaik UISI dengan peluang karir yang tepat di era digital.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FITUR UNGGULAN -->
<section style="background-color: #f9fafb;" class="py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 style="color: #1f2937;" class="text-3xl md:text-4xl font-bold mb-4">Mengapa Memilih Ruang Karir?</h2>
            <p style="color: #6b7280;" class="text-xl max-w-3xl mx-auto">
                Kami menyediakan solusi lengkap untuk perjalanan karir mahasiswa UISI
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-8">
            <!-- Feature 1 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <h3 style="color: #1f2937;" class="text-xl font-bold mb-4">Lowongan Eksklusif</h3>
                <p style="color: #6b7280;" class="leading-relaxed">
                    Akses ke ribuan lowongan kerja dan magang dari perusahaan BUMN, startup unicorn, dan korporasi multinasional yang hanya tersedia untuk mahasiswa UISI.
                </p>
            </div>

            <!-- Feature 2 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 style="color: #1f2937;" class="text-xl font-bold mb-4">Profil Profesional</h3>
                <p style="color: #6b7280;" class="leading-relaxed">
                    Buat profil profesional yang menarik dengan portofolio digital, riwayat pendidikan, dan keahlian yang dapat dilihat langsung oleh recruiter.
                </p>
            </div>

            <!-- Feature 3 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 style="color: #1f2937;" class="text-xl font-bold mb-4">Verifikasi UISI</h3>
                <p style="color: #6b7280;" class="leading-relaxed">
                    Semua pengguna diverifikasi sebagai mahasiswa atau alumni UISI, memberikan kredibilitas tinggi kepada perusahaan partner kami.
                </p>
            </div>

            <!-- Feature 4 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 style="color: #1f2937;" class="text-xl font-bold mb-4">Proses Cepat</h3>
                <p style="color: #6b7280;" class="leading-relaxed">
                    Sistem aplikasi yang streamlined memungkinkan proses lamaran yang cepat dan efisien, dengan notifikasi real-time untuk setiap update.
                </p>
            </div>

            <!-- Feature 5 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 style="color: #1f2937;" class="text-xl font-bold mb-4">Program Magang</h3>
                <p style="color: #6b7280;" class="leading-relaxed">
                    Temukan berbagai peluang magang eksklusif yang dirancang untuk mengembangkan keahlian praktis dan pengalaman kerja nyata di dunia industri.
                </p>
            </div>

            <!-- Feature 6 -->
            <div style="background-color: white;" class="rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300">
                <div style="background: linear-gradient(135deg, #fb923c, #ea580c);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 style="color: #1f2937;" class="text-xl font-bold mb-4">Kolaborasi Penelitian</h3>
                <p style="color: #6b7280;" class="leading-relaxed">
                    Ikuti proyek penelitian bersama dosen dan akademisi UISI untuk memperluas wawasan dan memperdalam pengalaman akademik serta profesional.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- MISI & NILAI -->
<section style="background-color: white;" class="py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 style="color: #1f2937;" class="text-3xl font-bold mb-6">Misi Kami</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div style="background-color: #ea580c;" class="w-2 h-2 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                        <p style="color: #6b7280;" class="text-lg">Menyediakan akses mudah ke peluang karir terbaik untuk mahasiswa UISI</p>
                    </div>
                    <div class="flex items-start">
                        <div style="background-color: #ea580c;" class="w-2 h-2 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                        <p style="color: #6b7280;" class="text-lg">Membangun jembatan antara dunia akademis dan industri profesional</p>
                    </div>
                    <div class="flex items-start">
                        <div style="background-color: #ea580c;" class="w-2 h-2 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                        <p style="color: #6b7280;" class="text-lg">Mendukung pengembangan karir berkelanjutan setiap mahasiswa</p>
                    </div>
                    <div class="flex items-start">
                        <div style="background-color: #ea580c;" class="w-2 h-2 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                        <p style="color: #6b7280;" class="text-lg">Menciptakan ekosistem karir yang inklusif dan berkelanjutan</p>
                    </div>
                </div>
            </div>

            <div>
                <h2 style="color: #1f2937;" class="text-3xl font-bold mb-6">Nilai-Nilai Kami</h2>
                <div class="space-y-6">
                    <div style="background-color: #fff7ed;" class="p-6 rounded-xl">
                        <h3 style="color: #ea580c;" class="text-xl font-bold mb-2">Integritas</h3>
                        <p style="color: #6b7280;">Kami berkomitmen pada transparansi dan kejujuran dalam setiap layanan yang kami berikan.</p>
                    </div>
                    <div style="background-color: #fff7ed;" class="p-6 rounded-xl">
                        <h3 style="color: #ea580c;" class="text-xl font-bold mb-2">Inovasi</h3>
                        <p style="color: #6b7280;">Terus mengembangkan teknologi dan metode terbaru untuk memberikan pengalaman terbaik.</p>
                    </div>
                    <div style="background-color: #fff7ed;" class="p-6 rounded-xl">
                        <h3 style="color: #ea580c;" class="text-xl font-bold mb-2">Kolaborasi</h3>
                        <p style="color: #6b7280;">Membangun kemitraan yang kuat dengan industri dan institusi pendidikan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KONTAK & DUKUNGAN -->
<section style="background: linear-gradient(135deg, #ea580c, #dc2626);" class="py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center text-white mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Bantuan?</h2>
            <p class="text-xl opacity-90">Tim support kami siap membantu Anda 24/7</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-8">
            <div class="text-center">
                <div style="background-color: rgba(255, 255, 255, 0.1);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Email</h3>
                <p class="text-orange-100">ruangkarir@uisi.ac.id</p>
            </div>

            <div class="text-center">
                <div style="background-color: rgba(255, 255, 255, 0.1);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Telepon</h3>
                <p class="text-orange-100">(031) 8298-1234</p>
            </div>

            <div class="text-center col-span-2 md:col-span-1">
                <div style="background-color: rgba(255, 255, 255, 0.1);" class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Alamat</h3>
                <p class="text-orange-100">Komplek PT. Semen Indonesia (Persero) Tbk. Jl. Veteran, Gresik 61122, Jawa Timur.</p>
            </div>
        </div>
    </div>
</section>
@endsection
