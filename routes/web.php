<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

// Landing Page / Welcome Route - TAMBAHAN BARU
Route::get('/', function () {
    // Jika user sudah login, redirect ke dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    
    // Jika belum login, tampilkan landing page
    $totalInternships = \App\Models\Internship::count();
    $latestInternships = \App\Models\Internship::latest()->take(4)->get();
    
    return view('welcome', compact('totalInternships', 'latestInternships'));
})->name('welcome');

// Rute Google Login
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Job Routes (bisa diakses tanpa login untuk browsing)
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// ROUTE PELUANG - TAMBAHAN BARU (bisa diakses tanpa login)
Route::get('/peluang', [InternshipController::class, 'index'])->name('peluang');
Route::get('/peluang/{id}', [InternshipController::class, 'show'])->name('peluang.show');

// About page (bisa diakses tanpa login)
Route::get('/about', function () {
    return view('about');
})->name('about');

// DEBUG ROUTE - HAPUS SETELAH SELESAI TESTING
Route::get('/debug-admin', function() {
    if (Auth::check()) {
        $currentEmail = Auth::user()->email;
        $adminEmails = ['khususkuliah3690@gmail.com'];
        $isAdmin = in_array($currentEmail, $adminEmails);
        
        return response()->json([
            'logged_in' => true,
            'current_email' => $currentEmail,
            'admin_emails' => $adminEmails,
            'is_admin' => $isAdmin,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name
        ]);
    } else {
        return response()->json([
            'logged_in' => false,
            'message' => 'User not logged in'
        ]);
    }
})->name('debug.admin');

// Rute hanya untuk pengguna login
Route::middleware('auth')->group(function () {
    // Dashboard (beranda) - DIPERBAIKI MENGGUNAKAN CONTROLLER
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil pengguna - ROUTE CREATE SELALU BISA DIAKSES
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');

    // Route untuk melihat profil sendiri (dari dropdown navbar) - ROUTE BARU DENGAN MIDDLEWARE
    Route::get('/my-profile', function() {
        // Cek apakah user punya profile
        $profile = \App\Models\Profile::where('user_id', Auth::id())->first();
        if (!$profile) {
            return redirect()->route('profile.create')->with('warning', 'Silakan buat profil terlebih dahulu.');
        }
        
        $controller = new ProfileController();
        return $controller->myProfile();
    })->name('profile.my-profile');

    // Route untuk pencarian mahasiswa (halaman utama) - ROUTE DIUBAH DENGAN MIDDLEWARE
    Route::get('/pengguna', function() {
        $controller = new ProfileController();
        return $controller->searchStudents(request());
    })->name('pengguna.index');

    // Route untuk melihat detail profil pengguna lain - DIPERBAIKI: LANGSUNG KE CONTROLLER
    Route::get('/profile/{id}', function($id) {
        $controller = new ProfileController();
        return $controller->show($id);
    })->name('profile.show');

    // Route untuk edit dan update profil - HANYA BISA DIAKSES JIKA SUDAH PUNYA PROFILE
    Route::get('/profile/{id}/edit', function($id) {
        $profile = \App\Models\Profile::findOrFail($id);
        
        // Validasi bahwa user hanya bisa edit profil sendiri
        if ($profile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('profile.edit', compact('profile'));
    })->name('profile.edit');
    
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk melihat semua profil (admin/public) - DENGAN MIDDLEWARE
    Route::get('/profiles', function() {
        // Cek apakah user punya profile
        $userProfile = \App\Models\Profile::where('user_id', Auth::id())->first();
        if (!$userProfile) {
            return redirect()->route('profile.create')->with('warning', 'Silakan buat profil terlebih dahulu untuk mengakses daftar profil.');
        }
        
        $controller = new ProfileController();
        return $controller->index(request());
    })->name('profile.index');

    // User management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Job application routes (hanya untuk user login)
    Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');
    Route::get('/my-applications', [JobController::class, 'myApplications'])->name('jobs.my-applications');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('welcome'); // UBAH KE WELCOME
    })->name('logout');
});

// Rute untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    // Form Login
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // Proses Login - DIPERBAIKI UNTUK MENANGANI GOOGLE LOGIN
    Route::post('/login', function (Request $request) {
        $credentials = $request->only('email', 'password');
        
        // Cek apakah user ada di database
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan. Silakan daftar terlebih dahulu atau gunakan Google Login.'])->withInput();
        }
        
        // Cek apakah user login dengan Google (password null)
        if (is_null($user->password)) {
            return back()->withErrors(['email' => 'Akun ini terdaftar melalui Google. Silakan gunakan tombol "Continue with Google" untuk masuk.'])->withInput();
        }
        
        // Coba login dengan kredensial
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    });

    // Form Register
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    // Proses Register
    Route::post('/register', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms' => 'required|accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    });
});

// Admin routes untuk mengelola lowongan magang
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Index - Kelola Lowongan
    Route::get('/internships', function() {
        $currentEmail = Auth::user()->email;
        $adminEmails = ['khususkuliah3690@gmail.com'];
        
        \Log::info('Admin access attempt', [
            'current_email' => $currentEmail,
            'admin_emails' => $adminEmails,
            'is_admin' => in_array($currentEmail, $adminEmails)
        ]);
        
        if (!Auth::check() || !in_array($currentEmail, $adminEmails)) {
            abort(403, "Akses ditolak. Email Anda: {$currentEmail}. Email admin yang diizinkan: " . implode(', ', $adminEmails));
        }
        
        $controller = new InternshipController();
        return $controller->adminIndex();
    })->name('internships.index');
    
    // Admin Create - Tambah Lowongan
    Route::get('/internships/create', function() {
        $currentEmail = Auth::user()->email;
        $adminEmails = ['khususkuliah3690@gmail.com'];
        
        if (!Auth::check() || !in_array($currentEmail, $adminEmails)) {
            abort(403, "Akses ditolak. Email Anda: {$currentEmail}. Email admin yang diizinkan: " . implode(', ', $adminEmails));
        }
        
        $controller = new InternshipController();
        return $controller->create();
    })->name('internships.create');
    
    // Admin Store - Simpan Lowongan
    Route::post('/internships', function(Request $request) {
        $currentEmail = Auth::user()->email;
        $adminEmails = ['khususkuliah3690@gmail.com'];
        
        if (!Auth::check() || !in_array($currentEmail, $adminEmails)) {
            abort(403, "Akses ditolak. Email Anda: {$currentEmail}. Email admin yang diizinkan: " . implode(', ', $adminEmails));
        }
        
        $controller = new InternshipController();
        return $controller->store($request);
    })->name('internships.store');
    
    // Admin Edit
    Route::get('/internships/{id}/edit', function($id) {
        $currentEmail = Auth::user()->email;
        $adminEmails = ['khususkuliah3690@gmail.com'];
        
        if (!Auth::check() || !in_array($currentEmail, $adminEmails)) {
            abort(403, "Akses ditolak. Email Anda: {$currentEmail}. Email admin yang diizinkan: " . implode(', ', $adminEmails));
        }
        
        $controller = new InternshipController();
        return $controller->edit($id);
    })->name('internships.edit');
    
    // Admin Update
    Route::put('/internships/{id}', function(Request $request, $id) {
        $currentEmail = Auth::user()->email;
        $adminEmails = ['khususkuliah3690@gmail.com'];
        
        if (!Auth::check() || !in_array($currentEmail, $adminEmails)) {
            abort(403, "Akses ditolak. Email Anda: {$currentEmail}. Email admin yang diizinkan: " . implode(', ', $adminEmails));
        }
        
        $controller = new InternshipController();
        return $controller->update($request, $id);
    })->name('internships.update');
    
    // Admin Delete
    Route::delete('/internships/{id}', function($id) {
        $currentEmail = Auth::user()->email;
        $adminEmails = ['khususkuliah3690@gmail.com'];
        
        if (!Auth::check() || !in_array($currentEmail, $adminEmails)) {
            abort(403, "Akses ditolak. Email Anda: {$currentEmail}. Email admin yang diizinkan: " . implode(', ', $adminEmails));
        }
        
        $controller = new InternshipController();
        return $controller->destroy($id);
    })->name('internships.destroy');
});

// Include auth routes jika menggunakan Laravel Breeze/Jetstream
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
