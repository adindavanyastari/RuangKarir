<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;

class DashboardController extends Controller
{
    public function index()
    {
        // Get latest 4 internships for dashboard (exclude test data)
        $latestInternships = Internship::active()
                                     ->notExpired()
                                     ->where('nama_perusahaan', 'NOT LIKE', '%test%')
                                     ->where('nama_perusahaan', 'NOT LIKE', '%Test%')
                                     ->where('posisi_magang', 'NOT LIKE', '%test%')
                                     ->where('posisi_magang', 'NOT LIKE', '%Test%')
                                     ->latest()
                                     ->take(4)
                                     ->get();
        
        // Get total internships count (exclude test data)
        $totalInternships = Internship::active()
                                ->where('nama_perusahaan', 'NOT LIKE', '%test%')
                                ->where('nama_perusahaan', 'NOT LIKE', '%Test%')
                                ->where('posisi_magang', 'NOT LIKE', '%test%')
                                ->where('posisi_magang', 'NOT LIKE', '%Test%')
                                ->count();
        
        return view('dashboard', compact('latestInternships', 'totalInternships'));
    }
}
