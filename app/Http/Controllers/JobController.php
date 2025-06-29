<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JobController extends Controller
{
    /**
     * Display a listing of jobs.
     */
    public function index(): View
    {
        // Dummy data untuk sementara - nanti bisa diganti dengan database
        $jobs = [
            [
                'id' => 1,
                'title' => 'Frontend Developer',
                'company' => 'PT Teknologi Maju',
                'location' => 'Jakarta',
                'type' => 'Full Time',
                'salary' => 'Rp 8.000.000 - 12.000.000',
                'description' => 'Mencari Frontend Developer berpengalaman dengan React.js dan Vue.js untuk mengembangkan aplikasi web modern.',
                'requirements' => 'Minimal S1 Teknik Informatika, Pengalaman 2+ tahun React.js, Menguasai HTML/CSS/JavaScript',
                'posted_at' => '2024-01-15',
                'company_logo' => 'images/company-1.png'
            ],
            [
                'id' => 2,
                'title' => 'UI/UX Designer',
                'company' => 'Startup Digital Indonesia',
                'location' => 'Bandung',
                'type' => 'Internship',
                'salary' => 'Rp 3.000.000 - 5.000.000',
                'description' => 'Kesempatan magang sebagai UI/UX Designer untuk mengembangkan interface aplikasi mobile dan web.',
                'requirements' => 'Mahasiswa DKV/Informatika, Portfolio design, Menguasai Figma/Adobe XD',
                'posted_at' => '2024-01-14',
                'company_logo' => 'images/company-2.png'
            ],
            [
                'id' => 3,
                'title' => 'Data Analyst',
                'company' => 'Bank Nasional Indonesia',
                'location' => 'Jakarta',
                'type' => 'Full Time',
                'salary' => 'Rp 10.000.000 - 15.000.000',
                'description' => 'Posisi Data Analyst untuk menganalisis data perbankan dan memberikan insights bisnis.',
                'requirements' => 'S1 Statistik/Matematika/Informatika, Menguasai Python/R, SQL, Excel Advanced',
                'posted_at' => '2024-01-13',
                'company_logo' => 'images/company-3.png'
            ],
            [
                'id' => 4,
                'title' => 'Digital Marketing Specialist',
                'company' => 'E-commerce Terkemuka',
                'location' => 'Remote',
                'type' => 'Contract',
                'salary' => 'Rp 6.000.000 - 9.000.000',
                'description' => 'Mengelola strategi digital marketing untuk meningkatkan brand awareness dan penjualan online.',
                'requirements' => 'S1 Marketing/Komunikasi, Pengalaman Google Ads/Facebook Ads, SEO/SEM',
                'posted_at' => '2024-01-12',
                'company_logo' => 'images/company-4.png'
            ]
        ];

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Search jobs based on criteria.
     */
    public function search(Request $request): View
    {
        $keyword = $request->get('keyword');
        $location = $request->get('location');

        // Dummy data untuk hasil pencarian
        $allJobs = [
            [
                'id' => 1,
                'title' => 'Frontend Developer',
                'company' => 'PT Teknologi Maju',
                'location' => 'Jakarta',
                'type' => 'Full Time',
                'salary' => 'Rp 8.000.000 - 12.000.000',
                'description' => 'Mencari Frontend Developer berpengalaman dengan React.js',
                'posted_at' => '2024-01-15',
                'company_logo' => 'images/company-1.png'
            ],
            [
                'id' => 2,
                'title' => 'UI/UX Designer',
                'company' => 'Startup Digital',
                'location' => 'Bandung',
                'type' => 'Internship',
                'salary' => 'Rp 3.000.000 - 5.000.000',
                'description' => 'Kesempatan magang sebagai UI/UX Designer',
                'posted_at' => '2024-01-14',
                'company_logo' => 'images/company-2.png'
            ],
            [
                'id' => 3,
                'title' => 'Data Analyst',
                'company' => 'Bank Nasional',
                'location' => 'Jakarta',
                'type' => 'Full Time',
                'salary' => 'Rp 10.000.000 - 15.000.000',
                'description' => 'Posisi Data Analyst untuk menganalisis data perbankan',
                'posted_at' => '2024-01-13',
                'company_logo' => 'images/company-3.png'
            ]
        ];

        // Filter berdasarkan keyword dan lokasi
        $jobs = collect($allJobs)->filter(function ($job) use ($keyword, $location) {
            $matchKeyword = !$keyword || 
                stripos($job['title'], $keyword) !== false || 
                stripos($job['company'], $keyword) !== false ||
                stripos($job['description'], $keyword) !== false;
            
            $matchLocation = !$location || 
                strtolower($job['location']) === strtolower($location);
            
            return $matchKeyword && $matchLocation;
        })->values()->all();

        return view('jobs.search', compact('jobs', 'keyword', 'location'));
    }

    /**
     * Display the specified job.
     */
    public function show(string $id): View
    {
        // Dummy data untuk detail job
        $job = [
            'id' => $id,
            'title' => 'Frontend Developer',
            'company' => 'PT Teknologi Maju',
            'location' => 'Jakarta',
            'type' => 'Full Time',
            'salary' => 'Rp 8.000.000 - 12.000.000',
            'description' => 'Mencari Frontend Developer berpengalaman dengan React.js dan Vue.js. Kandidat harus memiliki pengalaman minimal 2 tahun dalam pengembangan web modern dan mampu bekerja dalam tim yang dinamis.',
            'requirements' => [
                'Minimal S1 Teknik Informatika atau sejenisnya',
                'Pengalaman 2+ tahun dengan React.js dan Vue.js',
                'Menguasai HTML5, CSS3, JavaScript ES6+',
                'Familiar dengan Git dan version control',
                'Pengalaman dengan REST API integration',
                'Kemampuan komunikasi yang baik',
                'Mampu bekerja dalam tim'
            ],
            'benefits' => [
                'Gaji kompetitif sesuai pengalaman',
                'Asuransi kesehatan',
                'Tunjangan transport',
                'Flexible working hours',
                'Pelatihan dan pengembangan karir',
                'Bonus performance'
            ],
            'posted_at' => '2024-01-15',
            'deadline' => '2024-02-15',
            'company_logo' => 'images/company-1.png',
            'company_description' => 'PT Teknologi Maju adalah perusahaan teknologi terdepan yang fokus pada pengembangan solusi digital inovatif.'
        ];

        return view('jobs.show', compact('job'));
    }

    /**
     * Apply for a job (hanya untuk user login)
     */
    public function apply(Request $request, string $id): RedirectResponse
    {
        // Logic untuk apply job
        // Nanti bisa ditambahkan validasi dan penyimpanan ke database
        
        return redirect()->back()->with('success', 'Lamaran berhasil dikirim!');
    }

    /**
     * Show user's job applications
     */
    public function myApplications(): View
    {
        // Dummy data aplikasi user
        $applications = [
            [
                'id' => 1,
                'job_title' => 'Frontend Developer',
                'company' => 'PT Teknologi Maju',
                'applied_at' => '2024-01-16',
                'status' => 'Under Review'
            ]
        ];

        return view('jobs.my-applications', compact('applications'));
    }
}