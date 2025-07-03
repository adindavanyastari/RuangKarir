<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-amber-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">RK</span>
                        </div>
                        <span class="font-bold text-xl text-gray-800">Ruang Karir</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-700 hover:text-orange-600">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('peluang')" :active="request()->routeIs('peluang*')" class="text-gray-700 hover:text-orange-600">
                        {{ __('Peluang Magang') }}
                    </x-nav-link>

                    <!-- Admin Menu - Hanya untuk khususkuliah3690@gmail.com -->
                    @auth
                        @if(Auth::user()->email === 'khususkuliah3690@gmail.com')
                            <x-nav-link :href="route('admin.internships.index')" :active="request()->routeIs('admin.internships*')" class="text-gray-700 hover:text-orange-600">
                                {{ __('Kelola Lowongan') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown / Auth Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-amber-400 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                    @if(Auth::user()->email === 'khususkuliah3690@gmail.com')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            Admin
                                        </span>
                                    @endif
                                </div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Guest Navigation -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                           class="text-gray-700 hover:text-orange-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-gradient-to-r from-orange-500 to-amber-500 text-white px-6 py-2 rounded-full hover:from-orange-600 hover:to-amber-600 transition-all duration-200 font-medium text-sm shadow-lg hover:shadow-xl transform hover:scale-105">
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('peluang')" :active="request()->routeIs('peluang*')">
                {{ __('Peluang Magang') }}
            </x-responsive-nav-link>

            <!-- Admin Menu Mobile -->
            @auth
                @if(Auth::user()->email === 'khususkuliah3690@gmail.com')
                    <x-responsive-nav-link :href="route('admin.internships.index')" :active="request()->routeIs('admin.internships*')">
                        {{ __('Kelola Lowongan') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-amber-400 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    @if(Auth::user()->email === 'khususkuliah3690@gmail.com')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 mt-1">
                            Admin
                        </span>
                    @endif
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <!-- Guest Mobile Menu -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}"
                       class="block text-gray-700 hover:text-orange-600 px-3 py-2 rounded-md text-base font-medium">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                       class="block bg-gradient-to-r from-orange-500 to-amber-500 text-white px-3 py-2 rounded-md text-base font-medium text-center">
                        Sign Up
                    </a>
                </div>
            </div>
        @endauth
    </div>
</nav>
