<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display user's own profile (from navbar dropdown) - METHOD DIPERBAIKI
     */
    public function myProfile()
    {
        $profile = Profile::where('user_id', Auth::id())->first();

        if (!$profile) {
            return redirect()->route('profile.create')->with('warning', 'Silakan buat profil terlebih dahulu.');
        }

        return view('profile.my-profile', compact('profile'));
    }

    /**
     * Display search page for students (main page) - METHOD BARU
     */
    public function searchStudents(Request $request): View
    {
        // Clear cache untuk memastikan data fresh - DIPERBAIKI: hapus tagging
        Cache::forget('student_profiles_search');

        $query = Profile::where('user_id', '!=', Auth::id())->orderBy('updated_at', 'desc');

        // Handle search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
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
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        // Handle semester filter
        if ($request->filled('semester')) {
            $semesterRange = $request->semester;
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

        // Handle skills filter (gabungan keahlian dan sertifikasi) - UPDATED
        if ($request->filled('skills')) {
            $query->where(function($q) use ($request) {
                $q->where('hard_skills', 'like', '%' . $request->skills . '%')
                  ->orWhere('soft_skills', 'like', '%' . $request->skills . '%')
                  ->orWhere('sertifikat', 'like', '%' . $request->skills . '%');
            });
        }

        $profiles = $query->paginate(12); // Increased to 12 for better scrolling

        return view('pengguna.search', compact('profiles'));
    }

    /**
     * Display a listing of profiles (untuk admin/public) - DIPERBAIKI TOTAL
     */
    public function index(Request $request)
    {
        // Clear any profile-related cache to ensure fresh data - DIPERBAIKI: hapus tagging
        Cache::forget('profiles_list');
        Cache::forget('profiles_index');

        // Force fresh query with latest updates
        $query = Profile::query()
                       ->orderBy('updated_at', 'desc')
                       ->orderBy('created_at', 'desc');

        // Handle search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('hard_skills', 'like', '%' . $searchTerm . '%')
                  ->orWhere('soft_skills', 'like', '%' . $searchTerm . '%')
                  ->orWhere('minat_karier', 'like', '%' . $searchTerm . '%')
                  ->orWhere('prodi', 'like', '%' . $searchTerm . '%')
                  ->orWhere('sertifikat', 'like', '%' . $searchTerm . '%')
                  ->orWhere('fakultas', 'like', '%' . $searchTerm . '%')
                  ->orWhere('organisasi_dan_kepanitiaan', 'like', '%' . $searchTerm . '%')
                  ->orWhere('proyek', 'like', '%' . $searchTerm . '%');
            });
        }

        // Handle program studi filter
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        // Handle semester filter
        if ($request->filled('semester')) {
            $semesterRange = $request->semester;
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

        // Handle skills filter (gabungan keahlian dan sertifikasi) - UPDATED
        if ($request->filled('skills')) {
            $query->where(function($q) use ($request) {
                $q->where('hard_skills', 'like', '%' . $request->skills . '%')
                  ->orWhere('soft_skills', 'like', '%' . $request->skills . '%')
                  ->orWhere('sertifikat', 'like', '%' . $request->skills . '%');
            });
        }

        // Get paginated results with more items per page
        $profiles = $query->paginate(12)->withQueryString();

        // Get current user profile for comparison
        $currentUserProfile = null;
        if (auth()->check()) {
            $currentUserProfile = Profile::where('user_id', auth()->id())->first();
        }

        // Get statistics for display
        $totalProfiles = Profile::count();
        $recentProfiles = Profile::where('created_at', '>=', now()->subDays(7))->count();
        $activeProfiles = Profile::where('updated_at', '>=', now()->subDays(30))->count();

        return view('pengguna.index', compact('profiles', 'currentUserProfile', 'totalProfiles', 'recentProfiles', 'activeProfiles'));
    }

    /**
     * Show individual profile detail - ENHANCED
     */
    public function show($id): View
    {
        $profile = Profile::findOrFail($id);

        // Get related profiles (same program studi)
        $relatedProfiles = Profile::where('prodi', $profile->prodi)
                                 ->where('id', '!=', $profile->id)
                                 ->limit(3)
                                 ->get();

        // Track profile views (optional)
        $viewCount = Cache::increment("profile_views_{$id}", 1);

        return view('profile.show', compact('profile', 'relatedProfiles', 'viewCount'));
    }

    /**
     * Show create form
     */
    public function create(): View
    {
        // Check if user already has profile
        $existingProfile = Profile::where('user_id', Auth::id())->first();
        if ($existingProfile) {
            return redirect()->route('profile.my-profile')->with('info', 'Anda sudah memiliki profil.');
        }

        return view('profile.create');
    }

    /**
     * Store a newly created profile - UNTUK PENGGUNA BARU - ENHANCED
     */
    public function store(Request $request): RedirectResponse
    {
        // Debug: Log semua data yang diterima
        Log::info('Profile Store Request Data:', ['data' => $request->all()]);

        // Cek apakah user sudah punya profile
        $existingProfile = Profile::where('user_id', Auth::id())->first();
        if ($existingProfile) {
            return redirect()->route('profile.my-profile')->with('warning', 'Anda sudah memiliki profil.');
        }

        // Validasi input - DIPERBAIKI DAN DIPERLUAS
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:profiles',
            'prodi' => 'required|string|max:100',
            'fakultas' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:14',
            'email' => 'required|email|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
            'ringkasan_pribadi' => 'nullable|string|max:1000',
            'organisasi_dan_kepanitiaan.*' => 'nullable|string|max:255',
            'proyek.*' => 'nullable|string|max:255',
            'soft_skills.*' => 'nullable|string|max:100',
            'hard_skills.*' => 'nullable|string|max:100',
            'sertifikat.*' => 'nullable|string|max:255',
            'penghargaan.*' => 'nullable|string|max:255',
            'minat_karier.*' => 'nullable|string|max:100',
            'portofolio.*' => 'nullable|url|max:255',
        ]);

        // Debug: Log validated data
        Log::info('Validated Data:', ['data' => $validatedData]);

        try {
            // Start database transaction
            DB::beginTransaction();

            // Handle foto upload - DIPERBAIKI
            $fotoPath = 'icon'; // default
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('profile-photos', $filename, 'public');
                $fotoPath = 'storage/' . $path;

                Log::info('Photo uploaded to:', ['path' => $fotoPath]);
            }

            // Buat profile baru - DIPERBAIKI
            $profile = new Profile();
            $profile->user_id = Auth::id();
            $profile->nama = $request->nama;
            $profile->nim = $request->nim;
            $profile->prodi = $request->prodi;
            $profile->fakultas = $request->fakultas;
            $profile->semester = $request->semester;
            $profile->email = $request->email;
            $profile->foto = $fotoPath;
            $profile->ringkasan_pribadi = $request->ringkasan_pribadi ?? '';

            // Handle array inputs untuk CREATE - ENHANCED
            $arrayFields = [
                'organisasi_dan_kepanitiaan',
                'proyek',
                'soft_skills',
                'hard_skills',
                'sertifikat',
                'penghargaan',
                'minat_karier',
                'portofolio'
            ];

            foreach ($arrayFields as $field) {
                $value = '';
                if ($request->has($field) && $request->$field) {
                    if (is_array($request->$field)) {
                        // Filter empty values and join with comma
                        $filteredValues = array_filter($request->$field, function($val) {
                            return !empty(trim($val));
                        });
                        $value = implode(', ', $filteredValues);
                    } else {
                        $value = trim($request->$field);
                    }
                }
                $profile->$field = $value;

                Log::info("Field {$field}:", ['value' => $value]);
            }

            // Simpan ke database - DIPERBAIKI
            $saved = $profile->save();

            Log::info('Profile save result:', ['saved' => $saved, 'profile_id' => $profile->id]);

            if ($saved) {
                // Clear cache after creating new profile - DIPERBAIKI: hapus tagging
                Cache::forget('profiles_list');
                Cache::forget('profiles_index');

                // Commit transaction
                DB::commit();

                Log::info('Profile berhasil disimpan, redirecting to my-profile');
                return redirect()->route('profile.my-profile')->with('success', 'Profil berhasi disimpan dan diperbarui!');
            } else {
                DB::rollback();
                Log::error('Gagal menyimpan profile');
                return back()->withInput()->with('error', 'Gagal menyimpan profil. Silakan coba lagi.');
            }

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saving profile:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the user's profile information - UNTUK PENGGUNA LAMA EDIT - ENHANCED TOTAL
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Debug log - DIPERBAIKI: parameter kedua harus array
        Log::info('=== PROFILE UPDATE DEBUG ===');
        Log::info('Request data:', ['data' => $request->all()]);
        Log::info('Profile ID:', ['id' => $id]);
        Log::info('User ID:', ['user_id' => Auth::id()]);

        $profile = Profile::findOrFail($id);

        // Validasi bahwa user hanya bisa update profil sendiri
        if ($profile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi input - DIPERBAIKI DAN DIPERLUAS
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:profiles,nim,' . $profile->id,
            'prodi' => 'required|string|max:100',
            'fakultas' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:14',
            'email' => 'required|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ringkasan_pribadi' => 'nullable|string|max:1000',
            'organisasi_dan_kepanitiaan.*' => 'nullable|string|max:255',
            'proyek.*' => 'nullable|string|max:255',
            'soft_skills.*' => 'nullable|string|max:100',
            'hard_skills.*' => 'nullable|string|max:100',
            'sertifikat.*' => 'nullable|string|max:255',
            'penghargaan.*' => 'nullable|string|max:255',
            'minat_karier.*' => 'nullable|string|max:100',
            'portofolio.*' => 'nullable|url|max:255',
        ]);

        Log::info('Validated data:', ['data' => $validatedData]);

        try {
            // Start database transaction
            DB::beginTransaction();

            // Store old values for comparison
            $oldValues = $profile->toArray();

            // Update basic fields - DIPERBAIKI
            $profile->nama = $request->nama;
            $profile->nim = $request->nim;
            $profile->prodi = $request->prodi;
            $profile->fakultas = $request->fakultas;
            $profile->semester = $request->semester;
            $profile->email = $request->email;
            $profile->ringkasan_pribadi = $request->ringkasan_pribadi ?? '';

            // Handle array fields - DIPERBAIKI TOTAL
            $arrayFields = [
                'organisasi_dan_kepanitiaan',
                'proyek',
                'soft_skills',
                'hard_skills',
                'sertifikat',
                'penghargaan',
                'minat_karier',
                'portofolio'
            ];

            foreach ($arrayFields as $field) {
                $value = '';

                // Cek apakah field ada di request
                if ($request->has($field)) {
                    $fieldData = $request->input($field);

                    if (is_array($fieldData)) {
                        // Filter empty values and join with comma
                        $filteredValues = array_filter($fieldData, function($val) {
                            return !empty(trim($val));
                        });
                        $value = implode(', ', $filteredValues);
                    } else if (is_string($fieldData)) {
                        $value = trim($fieldData);
                    }
                }

                $profile->$field = $value;
                Log::info("Updated field {$field}:", ['old' => $oldValues[$field] ?? '', 'new' => $value]);
            }

            // Handle foto upload jika ada - DIPERBAIKI
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika bukan icon
                if ($profile->foto && $profile->foto !== 'icon' && Storage::disk('public')->exists(str_replace('storage/', '', $profile->foto))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $profile->foto));
                    Log::info('Old photo deleted:', ['path' => $profile->foto]);
                }

                $file = $request->file('foto');
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('profile-photos', $filename, 'public');
                $profile->foto = 'storage/' . $path;

                Log::info('New photo uploaded:', ['path' => $profile->foto]);
            }

            // Force update timestamp untuk memastikan perubahan terdeteksi
            $profile->touch();

            // Simpan perubahan - DIPERBAIKI
            $saved = $profile->save();

            Log::info('Profile update result:', ['saved' => $saved]);

            if ($saved) {
                // Clear cache setelah update untuk memastikan data fresh - DIPERBAIKI: hapus tagging
                Cache::forget('profiles_list');
                Cache::forget('profiles_index');
                Cache::forget('student_profiles_search');

                // Clear specific profile cache
                Cache::forget("profile_{$id}");

                // Commit transaction
                DB::commit();

                Log::info('Profile berhasil diupdate, redirecting to my-profile');
                return redirect()->route('profile.my-profile')->with('success', 'Profil berhasil disimpan dan diperbarui!');
            } else {
                DB::rollback();
                Log::error('Gagal mengupdate profile');
                return back()->withInput()->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
            }

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating profile:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Delete the user's account - ENHANCED
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $profile = Profile::findOrFail($id);

        // Validasi bahwa user hanya bisa hapus profil sendiri
        if ($profile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            DB::beginTransaction();

            // Hapus foto profil jika ada
            if ($profile->foto && $profile->foto !== 'icon' && Storage::exists('public/' . str_replace('storage/', '', $profile->foto))) {
                Storage::delete('public/' . str_replace('storage/', '', $profile->foto));
                Log::info('Profile photo deleted:', ['path' => $profile->foto]);
            }

            $profile->delete();

            // Clear cache after deletion - DIPERBAIKI: hapus tagging
            Cache::forget('profiles_list');
            Cache::forget('profiles_index');
            Cache::forget("profile_{$id}");

            DB::commit();

            Log::info('Profile deleted successfully:', ['profile_id' => $id]);
            return redirect()->route('dashboard')->with('success', 'Profil berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting profile:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus profil.');
        }
    }

    /**
     * Get filtered list of profiles - ENHANCED
     */
    public function filteredList(Request $request): View
    {
        $query = Profile::query()->orderBy('updated_at', 'desc');

        // Filter pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('hard_skills', 'like', "%{$search}%")
                  ->orWhere('soft_skills', 'like', "%{$search}%")
                  ->orWhere('minat_karier', 'like', "%{$search}%")
                  ->orWhere('prodi', 'like', "%{$search}%")
                  ->orWhere('fakultas', 'like', "%{$search}%");
            });
        }

        // Filter Prodi
        if ($request->has('prodi') && !empty($request->prodi)) {
            $query->where('prodi', $request->prodi);
        }

        // Filter Semester
        if ($request->has('semester') && !empty($request->semester)) {
            $semesterRange = $request->semester;
            if ($semesterRange == '1-2') {
                $query->whereIn('semester', [1, 2]);
            } elseif ($semesterRange == '3-4') {
                $query->whereIn('semester', [3, 4]);
            } elseif ($semesterRange == '5-6') {
                $query->whereIn('semester', [5, 6]);
            } elseif ($semesterRange == '7-8') {
                $query->whereIn('semester', [7, 8]);
            } else {
                $query->where('semester', $semesterRange);
            }
        }

        // Filter Skills
        if ($request->has('skills') && !empty($request->skills)) {
            $skills = $request->skills;
            $query->where(function($q) use ($skills) {
                $q->where('hard_skills', 'like', "%{$skills}%")
                  ->orWhere('soft_skills', 'like', "%{$skills}%")
                  ->orWhere('sertifikat', 'like', "%{$skills}%");
            });
        }

        $profiles = $query->paginate(12)->withQueryString();

        return view('pengguna.index', compact('profiles'));
    }

    /**
     * Get profile statistics - NEW METHOD
     */
    public function getStatistics()
    {
        $stats = [
            'total_profiles' => Profile::count(),
            'recent_profiles' => Profile::where('created_at', '>=', now()->subDays(7))->count(),
            'active_profiles' => Profile::where('updated_at', '>=', now()->subDays(30))->count(),
            'programs' => Profile::distinct('prodi')->count('prodi'),
            'top_skills' => $this->getTopSkills(),
            'top_programs' => $this->getTopPrograms(),
        ];

        return response()->json($stats);
    }

    /**
     * Get top skills - HELPER METHOD
     */
    private function getTopSkills($limit = 10)
    {
        $profiles = Profile::whereNotNull('hard_skills')
                          ->orWhereNotNull('soft_skills')
                          ->get();

        $skillCounts = [];

        foreach ($profiles as $profile) {
            // Count hard skills
            if ($profile->hard_skills) {
                $hardSkills = explode(',', $profile->hard_skills);
                foreach ($hardSkills as $skill) {
                    $skill = trim($skill);
                    if (!empty($skill)) {
                        $skillCounts[$skill] = ($skillCounts[$skill] ?? 0) + 1;
                    }
                }
            }

            // Count soft skills
            if ($profile->soft_skills) {
                $softSkills = explode(',', $profile->soft_skills);
                foreach ($softSkills as $skill) {
                    $skill = trim($skill);
                    if (!empty($skill)) {
                        $skillCounts[$skill] = ($skillCounts[$skill] ?? 0) + 1;
                    }
                }
            }
        }

        arsort($skillCounts);
        return array_slice($skillCounts, 0, $limit, true);
    }

    /**
     * Get top programs - HELPER METHOD
     */
    private function getTopPrograms($limit = 10)
    {
        return Profile::select('prodi', DB::raw('count(*) as count'))
                     ->groupBy('prodi')
                     ->orderBy('count', 'desc')
                     ->limit($limit)
                     ->pluck('count', 'prodi')
                     ->toArray();
    }

    /**
     * Export profiles to CSV - NEW METHOD
     */
    public function exportCsv(Request $request)
    {
        $query = Profile::query();

        // Apply same filters as index
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('prodi', 'like', '%' . $searchTerm . '%');
            });
        }

        $profiles = $query->get();

        $filename = 'profiles_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($profiles) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, [
                'ID', 'Nama', 'NIM', 'Program Studi', 'Fakultas', 'Semester',
                'Email', 'Hard Skills', 'Soft Skills', 'Minat Karier',
                'Created At', 'Updated At'
            ]);

            // CSV data
            foreach ($profiles as $profile) {
                fputcsv($file, [
                    $profile->id,
                    $profile->nama,
                    $profile->nim,
                    $profile->prodi,
                    $profile->fakultas,
                    $profile->semester,
                    $profile->email,
                    $profile->hard_skills,
                    $profile->soft_skills,
                    $profile->minat_karier,
                    $profile->created_at,
                    $profile->updated_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}