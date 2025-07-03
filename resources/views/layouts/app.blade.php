<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Karir UISI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'orange-primary': '#f97316',
                        'orange-secondary': '#fb923c',
                        'orange-light': '#fed7aa',
                        'orange-dark': '#ea580c',
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom CSS dengan warna orange yang konsisten */
        :root {
            --orange-primary: #f97316;
            --orange-secondary: #fb923c;
            --orange-light: #fed7aa;
            --orange-dark: #ea580c;
            --orange-50: #fff7ed;
            --orange-100: #ffedd5;
            --orange-200: #fed7aa;
            --orange-300: #fdba74;
            --orange-400: #fb923c;
            --orange-500: #f97316;
            --orange-600: #ea580c;
            --orange-700: #c2410c;
            --orange-800: #9a3412;
            --orange-900: #7c2d12;
        }

        .bg-orange-gradient {
            background: linear-gradient(135deg, var(--orange-secondary), var(--orange-primary), var(--orange-dark)) !important;
        }

        .bg-orange-light-gradient {
            background: linear-gradient(135deg, var(--orange-50), var(--orange-100)) !important;
        }

        .text-orange-primary {
            color: var(--orange-primary) !important;
        }

        .bg-orange-primary {
            background-color: var(--orange-primary) !important;
        }

        .border-orange-primary {
            border-color: var(--orange-primary) !important;
        }

        /* Hover effects untuk navigasi */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--orange-primary) !important;
            background-color: var(--orange-50);
            transform: translateY(-1px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 4px;
            left: 50%;
            background-color: var(--orange-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 70%;
        }

        .nav-link.active {
            color: var(--orange-primary) !important;
            background-color: var(--orange-50);
            font-weight: 600;
        }

        .nav-link.active::after {
            width: 70%;
        }

        body {
            background-color: white !important;
        }

        /* Button styles */
        .btn-orange {
            background: linear-gradient(135deg, var(--orange-primary), var(--orange-secondary));
            color: white;
            transition: all 0.3s ease;
        }

        .btn-orange:hover {
            background: linear-gradient(135deg, var(--orange-600), var(--orange-dark));
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }

        .btn-orange-outline {
            border: 2px solid var(--orange-primary);
            color: var(--orange-primary);
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-orange-outline:hover {
            background: var(--orange-primary);
            color: white;
            transform: translateY(-1px);
        }
    </style>
</head>

<body class="bg-white">

    <!-- Navbar dengan Gradient -->
    <nav
        class="bg-gradient-to-r from-white via-orange-50 to-orange-100 shadow-lg sticky top-0 z-50 border-b border-orange-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('welcome') }}"
                class="text-2xl font-bold text-orange-primary hover:text-orange-600 transition-colors">
                Ruang Karir
            </a>

            <!-- Mobile toggle -->
            <div class="md:hidden flex justify-end gap-2">
                @guest
                    <div>
                        <a href="{{ route('register') }}"
                            class="px-4 py-1.5 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-4 py-1.5 text-sm font-medium text-gray-700 hover:text-orange-600 bg-white border border-gray-200 rounded-lg hover:border-orange-300 transition-all duration-300 shadow-sm hover:shadow-md">
                            Sign In
                        </a>
                    </div>
                @endguest

                <button class="text-gray-600 hover:text-orange-600 transition-colors" onclick="toggleNavbar()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu -->
            <div id="nav-menu" class="hidden sm:flex space-x-1 items-center">
                @php
                    $currentRoute = Route::currentRouteName();
                @endphp

                @auth
                    @php
                        $userProfile = \App\Models\Profile::where('user_id', Auth::id())->first();
                        $isAdmin = in_array(Auth::user()->email, ['khususkuliah3690@gmail.com']);
                    @endphp
                    <a href="{{ route('dashboard') }}" class="nav-link {{ $currentRoute == 'dashboard' ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('pengguna.index') }}"
                        class="nav-link {{ $currentRoute == 'pengguna.index' ? 'active' : '' }}">
                        Students
                    </a>
                    <a href="{{ route('peluang') }}"
                        class="nav-link {{ str_contains($currentRoute, 'peluang') ? 'active' : '' }}">
                        Opportunities
                    </a>
                    <a href="{{ route('about') }}" class="nav-link {{ $currentRoute == 'about' ? 'active' : '' }}">
                        About
                    </a>

                    <!-- Admin Menu -->
                    @if ($isAdmin)
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-1 nav-link text-orange-600 hover:text-orange-700 hover:bg-orange-50 focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Admin</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-orange-200 py-2 z-50">
                                <div class="px-4 py-2 border-b border-orange-200">
                                    <p class="text-xs font-medium text-orange-600 uppercase tracking-wide">Admin Panel</p>
                                </div>
                                <a href="{{ route('admin.internships.index') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    Manage Jobs
                                </a>
                                <a href="{{ route('admin.internships.create') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add New Job
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 focus:outline-none hover:scale-105 transition-transform ml-4">
                            <div
                                class="w-10 h-10 rounded-full overflow-hidden border-2 border-orange-200 hover:border-orange-300 transition-colors shadow-sm">
                                @if ($userProfile && $userProfile->foto && $userProfile->foto !== 'icon')
                                    <img src="{{ asset($userProfile->foto) }}" alt="Profile"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-orange-gradient flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-orange-200 py-2 z-50">
                            @if ($userProfile)
                                <div class="px-4 py-3 border-b border-orange-100">
                                    <p class="text-sm font-medium text-gray-900">{{ $userProfile->nama }}</p>
                                    <p class="text-xs text-gray-500">{{ $userProfile->email }}</p>
                                    @if ($isAdmin)
                                        <span
                                            class="inline-block mt-1 px-2 py-1 bg-orange-100 text-orange-600 text-xs font-medium rounded-full">Admin</span>
                                    @endif
                                </div>
                                <a href="{{ route('profile.my-profile') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    View Profile
                                </a>
                            @else
                                <a href="{{ route('profile.create') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Create Profile
                                </a>
                            @endif

                            <div class="border-t border-orange-100 mt-2 pt-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-orange-600 hover:bg-orange-50 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- GUEST NAVIGATION -->
                    <a href="{{ route('welcome') }}" class="nav-link {{ $currentRoute == 'welcome' ? 'active' : '' }}">
                        Start Here
                    </a>
                    <a href="{{ route('about') }}" class="nav-link {{ $currentRoute == 'about' ? 'active' : '' }}">
                        About
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-6 py-2.5 text-sm font-medium text-gray-700 hover:text-orange-600 bg-white border border-gray-200 rounded-lg hover:border-orange-300 transition-all duration-300 shadow-sm hover:shadow-md">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="sm:hidden hidden bg-gradient-to-r from-white via-orange-50 to-orange-100 border-t border-orange-200">
            <div class="px-4 py-2 space-y-1">
                @auth
                    @php
                        $isAdminMobile = in_array(Auth::user()->email, ['khususkuliah3690@gmail.com']);
                    @endphp

                    <a href="{{ route('dashboard') }}"
                        class="block py-3 text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-lg px-3 transition-colors font-medium">Dashboard</a>
                    <a href="{{ route('pengguna.index') }}"
                        class="block py-3 text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-lg px-3 transition-colors font-medium">Students</a>
                    <a href="{{ route('peluang') }}"
                        class="block py-3 text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-lg px-3 transition-colors font-medium">Opportunities</a>
                    <a href="{{ route('about') }}"
                        class="block py-3 text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-lg px-3 transition-colors font-medium">About</a>

                    @if ($isAdminMobile)
                        <div class="border-t border-orange-200 pt-2 mt-2">
                            <p class="text-xs font-medium text-orange-600 uppercase tracking-wide mb-2 px-3">Admin Panel
                            </p>
                            <a href="{{ route('admin.internships.index') }}"
                                class="block py-3 text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-lg px-3 transition-colors font-medium">Manage
                                Jobs</a>
                            <a href="{{ route('admin.internships.create') }}"
                                class="block py-3 text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-lg px-3 transition-colors font-medium">Add
                                New Job</a>
                        </div>
                    @endif
                @else
                    <!-- MOBILE GUEST NAVIGATION -->
                    <a href="{{ route('welcome') }}"
                        class="block py-3 text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-lg px-3 transition-colors font-medium">Start
                        Here</a>
                    <a href="{{ route('about') }}"
                        class="block py-3 text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-lg px-3 transition-colors font-medium">About</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-4xl mx-auto px-4 mt-4">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @elseif (session('warning'))
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('warning') }}
                </div>
            </div>
        @elseif (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer dengan Media Sosial Lengkap -->
    <footer class="bg-gradient-to-br from-orange-600 via-orange-700 to-orange-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 text-orange-100">Ruang Karir UISI</h3>
                <p class="text-orange-200 mb-4 leading-relaxed">Exclusive career platform for UISI students. Discover
                    the best opportunities to build your professional future.</p>
            </div>

            <div class="grid grid-cols-2 gap-4 md:col-span-2">
                <div>
                    <h4 class="font-semibold mb-4 text-orange-100">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('dashboard') }}"
                                class="text-orange-200 hover:text-orange-100 transition-colors">Dashboard</a></li>
                        <li><a href="{{ route('pengguna.index') }}"
                                class="text-orange-200 hover:text-orange-100 transition-colors">Students</a></li>
                        <li><a href="{{ route('peluang') }}"
                                class="text-orange-200 hover:text-orange-100 transition-colors">Opportunities</a></li>
                        <li><a href="{{ route('about') }}"
                                class="text-orange-200 hover:text-orange-100 transition-colors">About</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4 text-orange-100">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-orange-200">ruangkarir@uisi.ac.id</li>
                        <li class="text-orange-200">(031) 3985482</li>
                        <li class="text-orange-200">Komplek PT Semen Indonesia<br>Jl. Veteran, Gresik 61122</li>
                    </ul>
                </div>
            </div>


            <div>
                <h4 class="font-semibold mb-4 text-orange-100">Follow Us</h4>
                <div class="grid grid-cols-2 gap-3">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/kariruisi?igsh=eDBtb2Q5emp1Mm1h" target="_blank"
                        class="flex items-center space-x-2 text-orange-200 hover:text-orange-100 transition-colors bg-orange-700/30 p-3 rounded-lg hover:bg-orange-600/40">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.004 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.864 3.708 13.713 3.708 12.416s.49-2.448 1.418-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.928.875 1.418 2.026 1.418 3.323s-.49 2.448-1.418 3.275c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.404c-.315 0-.595-.122-.807-.315-.21-.21-.315-.49-.315-.807s.105-.595.315-.807c.21-.21.49-.315.807-.315s.595.105.807.315c.21.21.315.49.315.807s-.105.595-.315.807c-.21.193-.49.315-.807.315z" />
                        </svg>
                        <span class="text-sm font-medium">Instagram</span>
                    </a>

                    <!-- YouTube -->
                    <a href="https://youtube.com/@sayauisi?si=wJm50vBDt39LQXGu" target="_blank"
                        class="flex items-center space-x-2 text-orange-200 hover:text-orange-100 transition-colors bg-orange-700/30 p-3 rounded-lg hover:bg-orange-600/40">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                        <span class="text-sm font-medium">YouTube</span>
                    </a>

                    <!-- Website -->
                    <a href="https://uisi.ac.id/" target="_blank"
                        class="flex items-center space-x-2 text-orange-200 hover:text-orange-100 transition-colors bg-orange-700/30 p-3 rounded-lg hover:bg-orange-600/40">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        <span class="text-sm font-medium">Website</span>
                    </a>

                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@sayauisi?_t=ZS-8xWuGukS5GX&_r=1" target="_blank"
                        class="flex items-center space-x-2 text-orange-200 hover:text-orange-100 transition-colors bg-orange-700/30 p-3 rounded-lg hover:bg-orange-600/40">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                        </svg>
                        <span class="text-sm font-medium">TikTok</span>
                    </a>

                    <!-- Twitter -->
                    <a href="https://x.com/sayauisi?t=LqywSSqTlJURFLaqLVcvyA&s=08" target="_blank"
                        class="flex items-center space-x-2 text-orange-200 hover:text-orange-100 transition-colors bg-orange-700/30 p-3 rounded-lg hover:bg-orange-600/40 col-span-2">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Twitter / X</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 pt-8 mt-8 border-t border-orange-600 text-center">
            <p class="text-orange-200">&copy; {{ date('Y') }} Ruang Karir UISI. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function toggleNavbar() {
            // const menu = document.getElementById('nav-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            // menu.classList.toggle('hidden');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>

</html>
