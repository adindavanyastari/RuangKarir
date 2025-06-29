<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;

class PeluangController extends Controller
{
    public function index(Request $request)
    {
        $query = Internship::active();

        // Handle search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_perusahaan', 'like', '%' . $searchTerm . '%')
                  ->orWhere('posisi_magang', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi_pekerjaan', 'like', '%' . $searchTerm . '%')
                  ->orWhere('kualifikasi', 'like', '%' . $searchTerm . '%');
            });
        }

        // Handle location filter
        if ($request->filled('lokasi')) {
            $query->where('lokasi_magang', $request->lokasi);
        }

        // Handle duration filter
        if ($request->filled('durasi')) {
            $query->where('durasi_magang', 'like', '%' . $request->durasi . '%');
        }

        $internships = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('peluang', compact('internships'));
    }
}