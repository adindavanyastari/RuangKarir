@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.internships.index') }}" 
                   class="text-slate-600 hover:text-slate-800 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>
            <h1 class="text-3xl font-bold text-slate-800">Tambah Lowongan Magang</h1>
            <p class="text-slate-600 mt-2">Buat lowongan magang baru untuk ditampilkan di halaman peluang</p>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <strong>Terdapat kesalahan:</strong>
                </div>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('admin.internships.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Nama Perusahaan -->
                    <div class="md:col-span-2">
                        <label for="nama_perusahaan" class="block text-sm font-medium text-slate-700 mb-2">
                            Nama Perusahaan *
                        </label>
                        <input type="text" 
                               id="nama_perusahaan" 
                               name="nama_perusahaan" 
                               value="{{ old('nama_perusahaan') }}"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <!-- Posisi Magang -->
                    <div class="md:col-span-2">
                        <label for="posisi_magang" class="block text-sm font-medium text-slate-700 mb-2">
                            Posisi Magang *
                        </label>
                        <input type="text" 
                               id="posisi_magang" 
                               name="posisi_magang" 
                               value="{{ old('posisi_magang') }}"
                               placeholder="contoh: Frontend Developer Intern, Marketing Intern"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <!-- Lokasi Magang -->
                    <div>
                        <label for="lokasi_magang" class="block text-sm font-medium text-slate-700 mb-2">
                            Lokasi Magang *
                        </label>
                        <select id="lokasi_magang" 
                                name="lokasi_magang" 
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="">Pilih Lokasi</option>
                            <option value="onsite">Onsite</option>
                            <option value="remote">Remote</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>

                    <!-- Durasi Magang -->
                    <div>
                        <label for="durasi_magang" class="block text-sm font-medium text-slate-700 mb-2">
                            Durasi Magang *
                        </label>
                        <input type="text" 
                               id="durasi_magang" 
                               name="durasi_magang" 
                               value="{{ old('durasi_magang') }}"
                               placeholder="contoh: 3 bulan, 6 bulan"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <!-- Deadline Pendaftaran -->
                    <div>
                        <label for="deadline_pendaftaran" class="block text-sm font-medium text-slate-700 mb-2">
                            Deadline Pendaftaran *
                        </label>
                        <input type="date" 
                               id="deadline_pendaftaran" 
                               name="deadline_pendaftaran" 
                               value="{{ old('deadline_pendaftaran') }}"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <!-- Kontak Email -->
                    <div>
                        <label for="kontak_email" class="block text-sm font-medium text-slate-700 mb-2">
                            Email Kontak *
                        </label>
                        <input type="email" 
                               id="kontak_email" 
                               name="kontak_email" 
                               value="{{ old('kontak_email') }}"
                               placeholder="hr@perusahaan.com"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <!-- Kontak Telepon -->
                    <div>
                        <label for="kontak_telepon" class="block text-sm font-medium text-slate-700 mb-2">
                            Nomor Telepon
                        </label>
                        <input type="text" 
                               id="kontak_telepon" 
                               name="kontak_telepon" 
                               value="{{ old('kontak_telepon') }}"
                               placeholder="08123456789"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Benefit -->
                    <div>
                        <label for="benefit" class="block text-sm font-medium text-slate-700 mb-2">
                            Benefit/Gaji
                        </label>
                        <input type="text" 
                               id="benefit" 
                               name="benefit" 
                               value="{{ old('benefit') }}"
                               placeholder="contoh: Rp 2.000.000/bulan, Sertifikat, Unpaid"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Deskripsi Pekerjaan -->
                    <div class="md:col-span-2">
                        <label for="deskripsi_pekerjaan" class="block text-sm font-medium text-slate-700 mb-2">
                            Deskripsi Pekerjaan *
                        </label>
                        <textarea id="deskripsi_pekerjaan" 
                                  name="deskripsi_pekerjaan" 
                                  rows="4"
                                  placeholder="Jelaskan tugas dan tanggung jawab yang akan dikerjakan oleh intern..."
                                  class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  required>{{ old('deskripsi_pekerjaan') }}</textarea>
                    </div>

                    <!-- Kualifikasi -->
                    <div class="md:col-span-2">
                        <label for="kualifikasi" class="block text-sm font-medium text-slate-700 mb-2">
                            Kualifikasi *
                        </label>
                        <textarea id="kualifikasi" 
                                  name="kualifikasi" 
                                  rows="4"
                                  placeholder="Sebutkan persyaratan dan kualifikasi yang dibutuhkan..."
                                  class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  required>{{ old('kualifikasi') }}</textarea>
                    </div>

                    <!-- Cara Melamar -->
                    <div class="md:col-span-2">
                        <label for="cara_melamar" class="block text-sm font-medium text-slate-700 mb-2">
                            Cara Melamar *
                        </label>
                        <textarea id="cara_melamar" 
                                  name="cara_melamar" 
                                  rows="3"
                                  placeholder="Jelaskan langkah-langkah untuk melamar posisi ini..."
                                  class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  required>{{ old('cara_melamar') }}</textarea>
                    </div>

                    <!-- Status Aktif -->
                    <div class="md:col-span-2">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   checked
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-slate-700">
                                Aktifkan lowongan ini (akan ditampilkan di halaman peluang)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-slate-200">
                    <a href="{{ route('admin.internships.index') }}" 
                       class="px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan Lowongan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection