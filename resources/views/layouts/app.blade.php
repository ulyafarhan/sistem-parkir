<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Parkir (Livewire)</title>

    @vite('resources/css/app.css')
    
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>