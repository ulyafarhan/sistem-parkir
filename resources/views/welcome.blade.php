<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Parkir Digital Modern - Solusi terintegrasi untuk manajemen parkir dengan teknologi QR code, monitoring real-time, dan laporan otomatis.">
    <meta name="keywords" content="sistem parkir, parkir digital, manajemen parkir, QR code parkir">
    <title>SmartParking Pro - Sistem Parkir Digital Modern & Terintegrasi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .card-hover img {
            transition: transform 0.3s ease;
        }
        .card-hover:hover img {
            transform: scale(1.1);
        }
        
        .btn-hover {
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-in {
            opacity: 0;
            transform: translateX(-30px);
            animation: slideIn 0.8s ease forwards;
        }
        
        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }
        
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .tech-badge {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border: 1px solid rgba(102, 126, 234, 0.2);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .feature-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-white">

    <div class="flex flex-col min-h-screen">
        
        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200/50">
            <nav class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <a href="/" class="text-2xl font-bold gradient-text">
                        SmartParking Pro
                    </a>

                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#fitur" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Fitur Unggulan</a>
                        <a href="#alur" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Cara Kerja</a>
                        <a href="#teknologi" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Teknologi</a>
                        <a href="#erd" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">ERD</a>
                        <a href="#tim" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Tim Kami</a>
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" 
                           class="hidden md:inline-block px-6 py-3 font-semibold text-white gradient-bg rounded-xl btn-hover shadow-lg">
                            Login Dashboard
                        </a>
                        <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                    <div class="flex flex-col space-y-4">
                        <a href="#fitur" class="text-gray-600 hover:text-gray-900 font-medium">Fitur Unggulan</a>
                        <a href="#alur" class="text-gray-600 hover:text-gray-900 font-medium">Cara Kerja</a>
                        <a href="#teknologi" class="text-gray-600 hover:text-gray-900 font-medium">Teknologi</a>
                        <a href="#tim" class="text-gray-600 hover:text-gray-900 font-medium">Tim Kami</a>
                        <a href="{{ route('login') }}" class="px-6 py-3 font-semibold text-white gradient-bg rounded-xl btn-hover shadow-lg text-center">
                            Login Dashboard
                        </a>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <main class="flex-grow pt-20">
            <section class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50"></div>
                <div class="relative container mx-auto px-6 py-20 md:py-32">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div class="space-y-8 fade-in">
                            <div class="inline-flex items-center px-4 py-2 bg-blue-50 rounded-full border border-blue-200">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                <span class="text-sm font-medium text-gray-700">Proyek Sistem Manajemen Basis Data</span>
                            </div>
                            
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                                <span class="text-gray-900">Sistem Informasi</span>
                                <br>
                                <span class="gradient-text">Manajemen Parkir</span>
                                <br>
                                <span class="text-gray-900">Berbasis QR Code</span>
                            </h1>
                            
                            <p class="text-xl text-gray-600 leading-relaxed max-w-lg">
                                Sistem parkir digital yang dibangun menggunakan Laravel, Livewire, dan database MySQL. 
                                Menyediakan solusi lengkap untuk pengelolaan parkir dengan teknologi QR code.
                            </p>
                            
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('login') }}" 
                                   class="px-8 py-4 font-semibold text-white gradient-bg rounded-xl btn-hover shadow-lg text-center">
                                    Akses Dashboard
                                </a>
                                <a href="#erd" class="px-8 py-4 font-semibold text-gray-700 bg-white rounded-xl btn-hover shadow-lg border border-gray-200">
                                    Lihat ERD
                                </a>
                            </div>

                            <div class="flex items-center space-x-8 pt-4">
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">3</div>
                                    <div class="text-sm text-gray-600">Tabel Database</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">QR</div>
                                    <div class="text-sm text-gray-600">Code System</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">Real-time</div>
                                    <div class="text-sm text-gray-600">Processing</div>
                                </div>
                            </div>
                        </div>

                        <div class="relative lg:block hidden">
                                <div class="relative float-animation">
                                    <img src="{{ asset('images/parkir.jpg') }}" 
                                         alt="Dashboard SmartParking Pro" 
                                         class="w-full h-96 object-cover rounded-2xl shadow-2xl">
                                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl float-animation"></div>
                                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl float-animation" style="animation-delay: 1s;"></div>
                                </div>
                            </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="fitur" class="py-20 md:py-32 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            Arsitektur Sistem & 
                            <span class="gradient-text">Teknologi</span>
                        </h2>
                        <p class="text-xl text-gray-600">
                            Sistem ini dibangun menggunakan teknologi modern dengan arsitektur yang terstruktur dan scalable.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 slide-in">
                            <div class="w-16 h-16 feature-icon rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Backend Architecture</h3>
                            <p class="text-gray-600 mb-6">Menggunakan Laravel 11 dengan struktur MVC yang terorganisir. Database MySQL dengan 3 tabel utama: users, jenis_kendaraan, dan transaksi.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Laravel 11 Framework</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>MySQL Database</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>RESTful API Architecture</li>
                            </ul>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 slide-in" style="animation-delay: 0.1s;">
                            <div class="w-16 h-16 feature-icon rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Frontend Interface</h3>
                            <p class="text-gray-600 mb-6">Menggunakan Livewire untuk komponen interaktif dan Tailwind CSS untuk styling yang responsif. Interface yang intuitif untuk operator parkir.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Livewire Components</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Tailwind CSS Framework</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Responsive Design</li>
                            </ul>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 slide-in" style="animation-delay: 0.2s;">
                            <div class="w-16 h-16 feature-icon rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">QR Code System</h3>
                            <p class="text-gray-600 mb-6">Generate QR code unik untuk setiap transaksi menggunakan library endroid/qr-code. Validasi otomatis saat kendaraan keluar.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>QR Code Generation</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Unique Transaction ID</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Automatic Validation</li>
                            </ul>
                        </div>

                        <!-- Feature 4 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 slide-in" style="animation-delay: 0.3s;">
                            <div class="w-16 h-16 feature-icon rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Keamanan Tingkat Tinggi</h3>
                            <p class="text-gray-600 mb-6">Sistem keamanan berlapis dengan enkripsi data, backup otomatis, dan proteksi terhadap akses tidak sah.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Enkripsi end-to-end</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Backup otomatis harian</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Multi-level authentication</li>
                            </ul>
                        </div>

                        <!-- Feature 5 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 slide-in" style="animation-delay: 0.4s;">
                            <div class="w-16 h-16 feature-icon rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Manajemen Multi-User</h3>
                            <p class="text-gray-600 mb-6">Kelola berbagai level akses untuk admin, operator, dan manajer dengan hak istimewa yang dapat dikustomisasi.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Role-based access control</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Audit trail lengkap</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>User management sederhana</li>
                            </ul>
                        </div>

                        <!-- Feature 6 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 slide-in" style="animation-delay: 0.5s;">
                            <div class="w-16 h-16 feature-icon rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Support 24/7</h3>
                            <p class="text-gray-600 mb-6">Tim support kami siap membantu kapan saja. Tersedia via WhatsApp, email, dan telepon dengan response time < 1 jam.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Support multibahasa</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Remote assistance</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Training gratis untuk tim</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ERD Section -->
            <section id="erd" class="py-20 md:py-32 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            Entity Relationship Diagram
                            <span class="gradient-text"> (ERD)</span>
                        </h2>
                        <p class="text-xl text-gray-600">
                            Struktur database yang menunjukkan relasi antar tabel dalam sistem parkir ini.
                        </p>
                    </div>

                    <div class="max-w-4xl mx-auto">
                        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                            <!-- Area untuk menampilkan gambar ERD -->
                            <div class="mb-8">
                                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 text-center">
                                    <div class="mb-4">
                                        <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Entity Relationship Diagram (ERD)</h4>
                                    <p class="text-gray-500 mb-2">Gambar ERD akan ditampilkan di sini</p>
                                    <p class="text-sm text-gray-400 mb-2">Sistem akan otomatis mencari file <code class="bg-gray-200 px-2 py-1 rounded text-xs">erd-sistem-parkir.png</code> di folder images</p>
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                                        <p class="text-sm text-blue-800 font-medium mb-1">📋 Contoh ERD Tersedia:</p>
                                        <ul class="text-sm text-blue-700 space-y-1">
                                            <li>• <code>erd-sistem-parkir.svg</code> - File contoh (tersedia)</li>
                                            <li>• <code>generate-erd-png.html</code> - Generator PNG</li>
                                            <li>• <code>README_ERD.md</code> - Panduan lengkap</li>
                                        </ul>
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        <p>Format yang didukung: PNG, JPG, JPEG, SVG</p>
                                        <p>Rekomendasi ukuran: 1200x800px atau proporsional</p>
                                        <p>File default: erd-sistem-parkir.png atau erd-sistem-parkir.svg</p>
                                    </div>
                                    <!-- Tempat untuk menampilkan gambar ERD -->
                                    <div id="erd-image-container" class="mt-4 hidden">
                                        <img id="erd-image" src="" alt="Entity Relationship Diagram" class="max-w-full h-auto rounded-lg shadow-md mb-4">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="erdHandler.replaceImage()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                                                Ganti Gambar
                                            </button>
                                            <button onclick="erdHandler.removeImage()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">
                                                Hapus Gambar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Tabel sebagai Teks -->
                            <div class="grid md:grid-cols-3 gap-8">
                                <!-- Users Table -->
                                <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                                    <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                        users
                                    </h3>
                                    <div class="space-y-2 text-sm text-gray-700">
                                        <div>• id (PK)</div>
                                        <div>• name</div>
                                        <div>• email</div>
                                        <div>• password</div>
                                        <div>• role</div>
                                        <div>• shift</div>
                                        <div>• created_at</div>
                                        <div>• updated_at</div>
                                    </div>
                                </div>

                                <!-- Jenis Kendaraan Table -->
                                <div class="bg-green-50 rounded-xl p-6 border border-green-200">
                                    <h3 class="text-lg font-bold text-green-900 mb-4 flex items-center">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                        jenis_kendaraan
                                    </h3>
                                    <div class="space-y-2 text-sm text-gray-700">
                                        <div>• id (PK)</div>
                                        <div>• nama_kendaraan</div>
                                        <div>• tarif_per_jam</div>
                                        <div>• tarif_per_hari</div>
                                        <div>• created_at</div>
                                        <div>• updated_at</div>
                                    </div>
                                </div>

                                <!-- Transaksi Table -->
                                <div class="bg-purple-50 rounded-xl p-6 border border-purple-200">
                                    <h3 class="text-lg font-bold text-purple-900 mb-4 flex items-center">
                                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                                        transaksi
                                    </h3>
                                    <div class="space-y-2 text-sm text-gray-700">
                                        <div>• id (PK)</div>
                                        <div>• qr_code</div>
                                        <div>• jenis_kendaraan_id (FK)</div>
                                        <div>• plat_nomor</div>
                                        <div>• jam_masuk</div>
                                        <div>• jam_keluar</div>
                                        <div>• tarif</div>
                                        <div>• user_id (FK)</div>
                                        <div>• created_at</div>
                                        <div>• updated_at</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">Relasi Database:</h4>
                                <div class="text-sm text-gray-600 space-y-1">
                                    <div>• <strong>users</strong> → <strong>transaksi</strong> (One to Many)</div>
                                    <div>• <strong>jenis_kendaraan</strong> → <strong>transaksi</strong> (One to Many)</div>
                                    <div>• <strong>transaksi</strong> memiliki dua Foreign Key: user_id dan jenis_kendaraan_id</div>
                                </div>
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <h5 class="font-medium text-blue-900 mb-2">Penjelasan Relasi:</h5>
                                    <div class="text-xs text-blue-800 space-y-1">
                                        <div>• <strong>users → transaksi:</strong> Satu petugas dapat membuat banyak transaksi parkir</div>
                                        <div>• <strong>jenis_kendaraan → transaksi:</strong> Satu jenis kendaraan dapat memiliki banyak transaksi</div>
                                        <div>• <strong>transaksi:</strong> Tabel yang menghubungkan users dan jenis_kendaraan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- How It Works -->
            <section id="alur" class="py-20 md:py-32 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            Alur Kerja 
                            <span class="gradient-text">Sistem Parkir</span>
                        </h2>
                        <p class="text-xl text-gray-600">
                            Proses bisnis sistem parkir dari awal masuk hingga keluar area parkir.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center group">
                            <div class="relative mb-8">
                                <div class="w-20 h-20 gradient-bg rounded-3xl flex items-center justify-center mx-auto mb-4 card-hover group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-2xl font-bold text-white">1</span>
                                </div>
                                <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-px h-16 bg-gradient-to-b from-blue-500 to-transparent md:hidden"></div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Entry Process</h3>
                            <p class="text-gray-600">Operator memilih jenis kendaraan dan memasukkan plat nomor. Sistem otomatis generate QR code unik dan mencatat waktu masuk.</p>
                        </div>

                        <div class="text-center group">
                            <div class="relative mb-8">
                                <div class="w-20 h-20 gradient-bg rounded-3xl flex items-center justify-center mx-auto mb-4 card-hover group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-2xl font-bold text-white">2</span>
                                </div>
                                <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-px h-16 bg-gradient-to-b from-blue-500 to-transparent md:hidden"></div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Parking Session</h3>
                            <p class="text-gray-600">Data transaksi tersimpan dalam database dengan status aktif. QR code menjadi tiket digital selama kendaraan parkir.</p>
                        </div>

                        <div class="text-center group">
                            <div class="relative mb-8">
                                <div class="w-20 h-20 gradient-bg rounded-3xl flex items-center justify-center mx-auto mb-4 card-hover group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-2xl font-bold text-white">3</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Exit Process</h3>
                            <p class="text-gray-600">Scan QR code untuk proses keluar. Sistem otomatis menghitung tarif berdasarkan durasi dan jenis kendaraan.</p>
                        </div>
                    </div>

                    <div class="mt-16 text-center fade-in">
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 max-w-4xl mx-auto">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Butuh waktu berapa lama untuk implementasi?</h3>
                            <p class="text-lg text-gray-600 mb-6">Rata-rata klien kami butuh hanya <strong class="text-blue-600">2-3 hari kerja</strong> untuk go live penuh. Termasuk setup, training, dan data migration.</p>
                            <div class="flex flex-wrap justify-center gap-4">
                                <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                                    <span class="text-sm text-gray-600">Setup Hardware:</span>
                                    <span class="font-semibold text-gray-900 ml-2">4 jam</span>
                                </div>
                                <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                                    <span class="text-sm text-gray-600">Training Tim:</span>
                                    <span class="font-semibold text-gray-900 ml-2">1 hari</span>
                                </div>
                                <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                                    <span class="text-sm text-gray-600">Go Live:</span>
                                    <span class="font-semibold text-gray-900 ml-2">1 hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Technology Stack -->
            <section id="teknologi" class="py-20 md:py-32 bg-gray-900 text-white">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">
                            Dibangun dengan 
                            <span class="text-blue-400">Teknologi Terbaik</span>
                        </h2>
                        <p class="text-xl text-gray-300">
                            Menggunakan stack teknologi modern yang terbukti handal, aman, dan scalable untuk masa depan.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="bg-gray-800 rounded-2xl p-6 card-hover text-center border border-gray-700">
                            <div class="w-16 h-16 bg-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-white">L</span>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Laravel</h3>
                            <p class="text-gray-400 text-sm">Framework PHP paling powerful untuk aplikasi enterprise</p>
                        </div>

                        <div class="bg-gray-800 rounded-2xl p-6 card-hover text-center border border-gray-700">
                            <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-white">T</span>
                            </div>
                            <h3 class="text-lg font-bold mb-2">TailwindCSS</h3>
                            <p class="text-gray-400 text-sm">Utility-first CSS framework untuk UI yang cepat dan responsif</p>
                        </div>

                        <div class="bg-gray-800 rounded-2xl p-6 card-hover text-center border border-gray-700">
                            <div class="w-16 h-16 bg-yellow-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-white">A</span>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Alpine.js</h3>
                            <p class="text-gray-400 text-sm">JavaScript framework ringan untuk interaktivitas modern</p>
                        </div>

                        <div class="bg-gray-800 rounded-2xl p-6 card-hover text-center border border-gray-700">
                            <div class="w-16 h-16 bg-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-white">L</span>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Livewire</h3>
                            <p class="text-gray-400 text-sm">Full-stack framework untuk Laravel tanpa write JavaScript</p>
                        </div>
                    </div>

                    <div class="mt-16 bg-gradient-to-r from-blue-900 to-purple-900 rounded-2xl p-8 fade-in">
                        <div class="grid md:grid-cols-3 gap-8 text-center">
                            <div class="pulse-animation" style="animation-delay: 0.1s;">
                                <div class="text-3xl font-bold text-blue-400 mb-2">99.9%</div>
                                <div class="text-gray-300">Uptime Guarantee</div>
                            </div>
                            <div class="pulse-animation" style="animation-delay: 0.2s;">
                                <div class="text-3xl font-bold text-green-400 mb-2">< 50ms</div>
                                <div class="text-gray-300">Response Time</div>
                            </div>
                            <div class="pulse-animation" style="animation-delay: 0.3s;">
                                <div class="text-3xl font-bold text-purple-400 mb-2">256-bit</div>
                                <div class="text-gray-300">Encryption</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section id="tim" class="py-20 md:py-32 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            Dibuat oleh 
                            <span class="gradient-text">Kelompok 6 - Tim Ahli</span>
                        </h2>
                        <p class="text-xl text-gray-600">
                            Mahasiswa Sistem Informasi yang passionate dalam membangun solusi nyata.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                        <!-- Anggota 1 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 text-center slide-in">
                            <img src="{{ asset('images/ulyafarhan.jpg') }}" 
                                 alt="Ulya Farhan" 
                                 class="w-24 h-24 rounded-full mx-auto mb-6 object-cover shadow-lg">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Ulya Farhan</h3>
                            <p class="text-blue-600 font-medium mb-4">240170155</p>
                            <p class="text-gray-600 text-sm mb-4">Full-Stack Developer & System Architect</p>
                            <div class="flex flex-wrap justify-center gap-2">
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">Laravel</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">Livewire</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">PHP</span>
                            </div>
                        </div>

                        <!-- Anggota 2 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 text-center slide-in" style="animation-delay: 0.1s;">
                            <img src="{{ asset('images/reifan-avatar.svg') }}" 
                                 alt="Reifan Aldi Putra Faisa" 
                                 class="w-24 h-24 rounded-full mx-auto mb-6 object-cover shadow-lg">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Reifan Aldi Putra Faisa</h3>
                            <p class="text-blue-600 font-medium mb-4">240170161</p>
                            <p class="text-gray-600 text-sm mb-4">Data Analyst & UI/UX Designer</p>
                            <div class="flex flex-wrap justify-center gap-2">
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">Data Analysis</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">UI/UX</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">Figma</span>
                            </div>
                        </div>

                        <!-- Anggota 3 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 text-center slide-in" style="animation-delay: 0.2s;">
                            <img src="{{ asset('images/atika-avatar.svg') }}" 
                                 alt="Atika Sofia" 
                                 class="w-24 h-24 rounded-full mx-auto mb-6 object-cover shadow-lg">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Atika Sofia</h3>
                            <p class="text-blue-600 font-medium mb-4">240170000</p>
                            <p class="text-gray-600 text-sm mb-4">Frontend Developer & Quality Assurance</p>
                            <div class="flex flex-wrap justify-center gap-2">
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">TailwindCSS</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">Alpine.js</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">Testing</span>
                            </div>
                        </div>

                        <!-- Anggota 4 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 text-center slide-in" style="animation-delay: 0.3s;">
                            <img src="{{ asset('images/arif-avatar.svg') }}" 
                                 alt="Arif Maulana" 
                                 class="w-24 h-24 rounded-full mx-auto mb-6 object-cover shadow-lg">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Arif Maulana</h3>
                            <p class="text-blue-600 font-medium mb-4">240170159</p>
                            <p class="text-gray-600 text-sm mb-4">Backend Developer & API Specialist</p>
                            <div class="flex flex-wrap justify-center gap-2">
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">PHP</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">MySQL</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">REST API</span>
                            </div>
                        </div>

                        <!-- Anggota 5 -->
                        <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-100 text-center slide-in" style="animation-delay: 0.4s;">
                            <img src="{{ asset('images/ramzy-avatar.svg') }}" 
                                 alt="Ramzy" 
                                 class="w-24 h-24 rounded-full mx-auto mb-6 object-cover shadow-lg">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Ramzy</h3>
                            <p class="text-blue-600 font-medium mb-4">240170163</p>
                            <p class="text-gray-600 text-sm mb-4">Security Analyst & DevOps</p>
                            <div class="flex flex-wrap justify-center gap-2">
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">Security</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">DevOps</span>
                                <span class="tech-badge px-3 py-1 rounded-full text-xs font-medium">Git</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 text-center fade-in">
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 max-w-4xl mx-auto">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Tentang Proyek Ini</h3>
                            <p class="text-lg text-gray-600 mb-6">
                                Sistem parkir digital ini dikembangkan sebagai proyek akhir mata kuliah <strong class="text-blue-600">Sistem Manajemen Basis Data</strong>.
                                Kami berkomitmen untuk membangun solusi nyata yang dapat digunakan untuk transformasi digital di sektor parkir.
                            </p>
                            <div class="flex flex-wrap justify-center gap-3">
                                <span class="tech-badge px-4 py-2 rounded-full font-medium">TALL Stack</span>
                                <span class="tech-badge px-4 py-2 rounded-full font-medium">MySQL Database</span>
                                <span class="tech-badge px-4 py-2 rounded-full font-medium">QR Code Technology</span>
                                <span class="tech-badge px-4 py-2 rounded-full font-medium">Real-time System</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">Sistem Parkir QR Code</h3>
                        <p class="text-gray-400 text-sm">
                            Proyek sistem informasi manajemen parkir berbasis QR code menggunakan Laravel 11 dan MySQL.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-4">Navigasi</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#erd" class="hover:text-white transition-colors">Entity Relationship Diagram</a></li>
                            <li><a href="#alur" class="hover:text-white transition-colors">Alur Sistem</a></li>
                            <li><a href="#arsitektur" class="hover:text-white transition-colors">Arsitektur & Teknologi</a></li>
                            <li><a href="#tentang" class="hover:text-white transition-colors">Tentang Proyek</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-4">Informasi Proyek</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li>Stack: Laravel 11, Livewire, MySQL</li>
                            <li>QR Code: endroid/qr-code library</li>
                            <li>Frontend: Tailwind CSS</li>
                            <li>Database: 3 tabel utama</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold">Kontak</h4>
                        <div class="space-y-2 text-gray-400">
                            <p class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                hello@smartparkingpro.com
                            </p>
                            <p class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                +62 812-3456-7890
                            </p>
                            <p class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Jakarta, Indonesia
                            </p>
                        </div>
                    </div>

                <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                    <p>&copy; 2024 - Proyek Sistem Informasi Manajemen Parkir</p>
                </div>
                </div>
            </footer>
        </div>

        <script>
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        // Close mobile menu if open
                        mobileMenu.classList.add('hidden');
                    }
                });
            });

            // Add scroll effect to header
            window.addEventListener('scroll', () => {
                const header = document.querySelector('header');
                if (window.scrollY > 50) {
                    header.classList.add('bg-white/95', 'shadow-lg');
                    header.classList.remove('bg-white/90');
                } else {
                    header.classList.remove('bg-white/95', 'shadow-lg');
                    header.classList.add('bg-white/90');
                }
            });

            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('.fade-in, .slide-in').forEach(el => {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            });

            // ERD Image Handler
            class ERDImageHandler {
                constructor() {
                    this.imageContainer = document.getElementById('erd-image-container');
                    this.imageElement = document.getElementById('erd-image');
                    this.defaultContainer = document.querySelector('.bg-gray-100.border-2.border-dashed');
                    this.init();
                }

                init() {
                    // Coba load gambar ERD yang sudah ada
                    this.loadExistingERD();
                    
                    // Buat input file tersembunyi untuk upload
                    this.createFileInput();
                    
                    // Tambahkan event listener untuk klik pada area upload
                    this.setupClickHandler();
                }

                createFileInput() {
                    this.fileInput = document.createElement('input');
                    this.fileInput.type = 'file';
                    this.fileInput.accept = 'image/png,image/jpg,image/jpeg,image/svg+xml';
                    this.fileInput.style.display = 'none';
                    this.fileInput.addEventListener('change', (e) => this.handleFileSelect(e));
                    document.body.appendChild(this.fileInput);
                }

                setupClickHandler() {
                    if (this.defaultContainer) {
                        this.defaultContainer.style.cursor = 'pointer';
                        this.defaultContainer.addEventListener('click', () => {
                            this.fileInput.click();
                        });
                    }
                }

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file && this.validateFile(file)) {
                        this.displayImage(file);
                    }
                }

                validateFile(file) {
                    const validTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/svg+xml'];
                    const maxSize = 5 * 1024 * 1024; // 5MB

                    if (!validTypes.includes(file.type)) {
                        alert('Format file tidak valid. Gunakan PNG, JPG, JPEG, atau SVG.');
                        return false;
                    }

                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        return false;
                    }

                    return true;
                }

                displayImage(file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageElement.src = e.target.result;
                        this.imageContainer.classList.remove('hidden');
                        this.hideDefaultContainer();
                        this.saveToLocalStorage(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }

                hideDefaultContainer() {
                    if (this.defaultContainer) {
                        this.defaultContainer.style.display = 'none';
                    }
                }

                showDefaultContainer() {
                    if (this.defaultContainer) {
                        this.defaultContainer.style.display = 'block';
                    }
                }

                saveToLocalStorage(imageData) {
                    try {
                        localStorage.setItem('erdImage', imageData);
                        localStorage.setItem('erdImageTimestamp', new Date().toISOString());
                    } catch (error) {
                        console.warn('Tidak dapat menyimpan ke localStorage:', error);
                    }
                }

                loadExistingERD() {
                    try {
                        // Coba load dari localStorage dulu
                        const savedImage = localStorage.getItem('erdImage');
                        if (savedImage) {
                            this.imageElement.src = savedImage;
                            this.imageContainer.classList.remove('hidden');
                            this.hideDefaultContainer();
                            return;
                        }

                        // Jika tidak ada di localStorage, coba load dari file default
                        this.loadDefaultERDImage();
                    } catch (error) {
                        console.warn('Tidak dapat memuat dari localStorage:', error);
                        this.loadDefaultERDImage();
                    }
                }

                loadDefaultERDImage() {
                    const defaultImagePath = '/images/erd-sistem-parkir.png';
                    const fallbackSvgPath = '/images/erd-sistem-parkir.svg';
                    
                    fetch(defaultImagePath)
                        .then(response => {
                            if (response.ok) {
                                this.imageElement.src = defaultImagePath;
                                this.imageContainer.classList.remove('hidden');
                                this.hideDefaultContainer();
                            } else {
                                console.log('Default ERD PNG image not found, trying SVG...');
                                return fetch(fallbackSvgPath);
                            }
                        })
                        .then(response => {
                            if (response && response.ok) {
                                this.imageElement.src = fallbackSvgPath;
                                this.imageContainer.classList.remove('hidden');
                                this.hideDefaultContainer();
                            } else if (response && !response.ok) {
                                console.log('Default ERD SVG image not found at', fallbackSvgPath);
                            }
                        })
                        .catch(error => {
                            console.log('Error loading default ERD image:', error);
                        });
                }

                removeImage() {
                    this.imageElement.src = '';
                    this.imageContainer.classList.add('hidden');
                    this.showDefaultContainer();
                    
                    try {
                        localStorage.removeItem('erdImage');
                        localStorage.removeItem('erdImageTimestamp');
                    } catch (error) {
                        console.warn('Tidak dapat menghapus dari localStorage:', error);
                    }
                }

                // Method untuk mengganti gambar
                replaceImage() {
                    this.fileInput.click();
                }
            }

            // Inisialisasi ERD Image Handler saat halaman dimuat
            let erdHandler;
            document.addEventListener('DOMContentLoaded', () => {
                erdHandler = new ERDImageHandler();
            });

            // Fungsi global untuk digunakan jika diperlukan
            window.erdHandler = {
                removeImage: () => erdHandler?.removeImage(),
                replaceImage: () => erdHandler?.replaceImage()
            };
        </script>
    </body>
</html>