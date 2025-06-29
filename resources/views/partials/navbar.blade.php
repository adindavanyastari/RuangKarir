<nav class="bg-gray-800 text-white px-4 py-3 flex justify-between items-center">
    <h1 class="text-xl font-bold">Ruang Karir</h1>
    <div>
        {{-- Jika mau tambahkan login nanti, baru aktifkan ini --}}
        {{-- 
        @auth
            <span class="mr-4">Halo, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="px-3">Login</a>
            <a href="{{ route('register') }}" class="px-3">Register</a>
        @endauth 
        --}}
    </div>
</nav>
