<!DOCTYPE html>
<html lang="id">
<head>
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
                        Jenis Kendaraan
                    </a>
                    <a href="{{ route('users') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium 
                              {{ request()->routeIs('users') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Manajemen User
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>