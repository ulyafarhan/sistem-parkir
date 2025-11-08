<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Informasi Parkir</title>
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            
            @if (Route::has('login'))
                <div class="absolute top-0 right-0 p-6">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Login Panel Admin</a>
                    @endauth
                </div>
            @endif

            <div class="max-w-3xl mx-auto p-8 text-center">
                <h1 class="text-5xl font-bold text-blue-600 mb-6">
                    Sistem Informasi Parkir
                </h1>
                <p class="text-xl text-gray-700 mb-8">
                    Sebuah sistem terkomputerisasi untuk mengelola alur parkir kendaraan menggunakan Karcis Digital berbasis QR Code.
                </p>
                <p class="text-gray-500">
                    Proyek ini dibuat untuk menggantikan pencatatan manual dan menyediakan panel administrasi untuk pemantauan data.
                </p>
                <p class="text-gray-500 mt-4 font-semibold">
                    (Kelompok 6)
                </p>
            </div>
        </div>
    </body>
</html>