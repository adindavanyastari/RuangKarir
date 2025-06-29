<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{
    // Method untuk halaman admin index
    public function adminIndex()
    {
        // Cek apakah user adalah admin
        if (Auth::user()->email !== 'khususkuliah3690@gmail.com') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        $internships = Internship::with('creator')
                                ->latest()
                                ->paginate(10);
        return view('admin.internships.index', compact('internships'));
    }

    // Method untuk halaman create
    public function create()
    {
        // Cek apakah user adalah admin
        if (Auth::user()->email !== 'khususkuliah3690@gmail.com') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat membuat lowongan.');
        }

        return view('admin.internships.create');
    }

    // Method untuk menyimpan data
    public function store(Request $request)
    {
        // Cek apakah user adalah admin
        if (Auth::user()->email !== 'khususkuliah3690@gmail.com') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat membuat lowongan.');
        }

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'posisi_magang' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi' => 'required|string',
            'durasi_magang' => 'required|string|max:100',
            'lokasi_magang' => 'required|in:onsite,remote,hybrid',
            'benefit' => 'nullable|string',
            'deadline_pendaftaran' => 'required|date|after:today',
            'cara_melamar' => 'required|string',
            'kontak_email' => 'required|email',
            'kontak_telepon' => 'nullable|string|max:20',
        ]);

        $data = $request->all();
        
        // Set created_by ke user yang sedang login (admin)
        $data['created_by'] = Auth::id();
        
        // Set default untuk is_active
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Internship::create($data);

        return redirect()->route('admin.internships.index')
                        ->with('success', 'Lowongan magang berhasil ditambahkan!');
    }

    // Method untuk halaman public index (peluang) dengan search
    public function index(Request $request)
    {
        $query = Internship::active()->notExpired();
        
        // Handle search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_perusahaan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('posisi_magang', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('lokasi_magang', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('durasi_magang', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('benefit', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        $internships = $query->latest()->paginate(12)->withQueryString();
        
        return view('peluang.index', compact('internships'));
    }

    // Method untuk detail internship
    public function show($id)
    {
        $internship = Internship::findOrFail($id);
        return view('peluang.show', compact('internship'));
    }

    // Method untuk edit
    public function edit($id)
    {
        // Cek apakah user adalah admin
        if (Auth::user()->email !== 'khususkuliah3690@gmail.com') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengedit lowongan.');
        }

        $internship = Internship::findOrFail($id);
        return view('admin.internships.edit', compact('internship'));
    }

    // Method untuk update
    public function update(Request $request, $id)
    {
        // Cek apakah user adalah admin
        if (Auth::user()->email !== 'khususkuliah3690@gmail.com') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengupdate lowongan.');
        }

        $internship = Internship::findOrFail($id);
        
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'posisi_magang' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi' => 'required|string',
            'durasi_magang' => 'required|string|max:100',
            'lokasi_magang' => 'required|in:onsite,remote,hybrid',
            'benefit' => 'nullable|string',
            'deadline_pendaftaran' => 'required|date',
            'cara_melamar' => 'required|string',
            'kontak_email' => 'required|email',
            'kontak_telepon' => 'nullable|string|max:20',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $internship->update($data);

        return redirect()->route('admin.internships.index')
                        ->with('success', 'Lowongan magang berhasil diperbarui!');
    }

    // Method untuk delete
    public function destroy($id)
    {
        // Cek apakah user adalah admin
        if (Auth::user()->email !== 'khususkuliah3690@gmail.com') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat menghapus lowongan.');
        }

        $internship = Internship::findOrFail($id);
        $internship->delete();

        return redirect()->route('admin.internships.index')
                        ->with('success', 'Lowongan magang berhasil dihapus!');
    }
}
