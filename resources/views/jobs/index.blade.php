<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Internship::where('is_active', true)
                          ->where('deadline_pendaftaran', '>=', Carbon::today());

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('posisi_magang', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nama_perusahaan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('deskripsi_pekerjaan', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Location filter
        if ($request->filled('lokasi')) {
            $query->where('lokasi_magang', $request->lokasi);
        }

        // Duration filter
        if ($request->filled('durasi')) {
            $query->where('durasi_magang', 'LIKE', "%{$request->durasi}%");
        }

        $internships = $query->orderBy('created_at', 'desc')->paginate(5);

        // Add days_left attribute to each internship
        $internships->getCollection()->transform(function ($internship) {
            $internship->days_left = Carbon::today()->diffInDays($internship->deadline_pendaftaran, false);
            return $internship;
        });

        return view('peluang', compact('internships'));
    }

    public function show($id)
    {
        $internship = Internship::findOrFail($id);
        
        // Add days_left attribute
        $internship->days_left = Carbon::today()->diffInDays($internship->deadline_pendaftaran, false);
        
        return view('peluang.show', compact('internship'));
    }

    // Admin methods
    public function adminIndex()
    {
        $internships = Internship::orderBy('created_at', 'desc')->paginate(10);
        
        // Add is_expired attribute
        $internships->getCollection()->transform(function ($internship) {
            $internship->is_expired = Carbon::today()->gt($internship->deadline_pendaftaran);
            return $internship;
        });
        
        return view('admin.internships.index', compact('internships'));
    }

    public function create()
    {
        return view('admin.internships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'posisi_magang' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi' => 'required|string',
            'lokasi_magang' => 'required|in:onsite,remote,hybrid',
            'durasi_magang' => 'required|string|max:100',
            'deadline_pendaftaran' => 'required|date|after:today',
            'cara_melamar' => 'required|string',
            'kontak_email' => 'required|email',
            'kontak_telepon' => 'nullable|string|max:20',
            'benefit' => 'nullable|string',
        ]);

        Internship::create($request->all());

        return redirect()->route('admin.internships.index')
                        ->with('success', 'Lowongan magang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $internship = Internship::findOrFail($id);
        return view('admin.internships.edit', compact('internship'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'posisi_magang' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi' => 'required|string',
            'lokasi_magang' => 'required|in:onsite,remote,hybrid',
            'durasi_magang' => 'required|string|max:100',
            'deadline_pendaftaran' => 'required|date',
            'cara_melamar' => 'required|string',
            'kontak_email' => 'required|email',
            'kontak_telepon' => 'nullable|string|max:20',
            'benefit' => 'nullable|string',
        ]);

        $internship = Internship::findOrFail($id);
        $internship->update($request->all());

        return redirect()->route('admin.internships.index')
                        ->with('success', 'Lowongan magang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $internship = Internship::findOrFail($id);
        $internship->delete();

        return redirect()->route('admin.internships.index')
                        ->with('success', 'Lowongan magang berhasil dihapus!');
    }
}