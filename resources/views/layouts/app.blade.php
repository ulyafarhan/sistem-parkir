<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Parkir</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">

    <nav class="bg-white shadow-md mb-8">
        <div class="container mx-auto px-8">
            <div class="flex justify-between items-center h-16">
                <div class="font-bold text-xl text-blue-600">Sistem Parkir</div>
                <div class="flex space-x-4">
                    <a href="{{ route('jenis-kendaraan') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('jenis-kendaraan') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Gerbang Masuk
                    </a>
                    
                    <a href="{{ route('pos-keluar.index') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('pos-keluar.index') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Pos Keluar
                    </a>

                    <a href="{{ route('petugas') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('petugas') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Manajemen Petugas
                    </a>

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-3 py-2 rounded-md text-sm font-medium text-red-600 hover:bg-red-100">
                                Logout ({{ Auth::user()->nama_petugas }})
                            </button>
                        </form>
                    @endauth

                </div>
            </div>
        </div>
    </nav>
    <main>
        {{-- Ganti $slot menjadi @yield('slot') agar bisa di-extend --}}
        @yield('slot', $slot ?? '')
    </main>

    @livewireScripts
</body>
</html>