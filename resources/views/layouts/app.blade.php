<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Parkir</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-bold text-xl text-blue-600">Sistem Parkir</span>
                </div>
                
                @auth
                <div class="hidden sm:ml-6 sm:flex sm:space-x-4">
                    <a href="{{ route('home') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('home') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('gerbang-masuk') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('gerbang-masuk') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Gerbang Masuk
                    </a>
                    <a href="{{ route('manajemen-kendaraan') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('manajemen-kendaraan') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Manajemen Kendaraan
                    </a>
                    <a href="{{ route('pos-keluar.index') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('pos-keluar.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Pos Keluar
                    </a>
                    <a href="{{ route('riwayat-transaksi') }}" 
                    class="px-3 py-2 rounded-md text-sm font-medium 
                            {{ request()->routeIs('riwayat-transaksi') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Riwayat Transaksi
                    </a>
                    <a href="{{ route('petugas') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('petugas') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Manajemen Petugas
                    </a>
                    </div>
                @endauth

                <div class="flex items-center">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-3 py-2 rounded-md text-sm font-medium text-red-600 hover:bg-red-100">
                                Logout ({{ Auth::user()->nama_petugas }})
                            </button>
                        </form>
                    @else
                         <a href="{{ route('login') }}" 
                           class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <main class="container mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Menggunakan @yield('slot') agar konsisten dengan @section('slot') --}}
        @yield('slot')
        
        {{-- $slot digunakan jika layout ini dipakai sebagai komponen Livewire/Blade --}}
        {{ $slot ?? '' }}
    </main>

    @livewireScripts
</body>
</html>