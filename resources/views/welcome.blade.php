<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Parkir Digital Modern - Solusi terintegrasi untuk manajemen parkir dengan teknologi QR code, monitoring real-time, dan laporan otomatis.">
    <meta name="keywords" content="sistem parkir, parkir digital, manajemen parkir, QR code parkir">
    <title>Sistem Parkir - Kelompok 6 Sistem Manajemen Basis Data</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --brand-primary: #4338ca;
            --brand-primary-light: #eef2ff;
            --brand-secondary: #06b6d4; 
            --text-decoration: #C29D67;
        }
        * {
            font-family: 'Inter', sans-serif;
        }
        .text-brand {
            color: var(--brand-primary);
        }
        .text-decoration{
            color: var(--text-decoration);
        }
        .bg-brand {
            background-color: var(--brand-primary);
        }
        .border-brand {
            border-color: var(--brand-primary);
        }
        .btn-primary {
            background-color: var(--brand-primary);
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(67, 56, 202, 0.25);
            background-color: #3730a3;
        }
        .btn-secondary {
            background-color: white;
            color: var(--brand-primary);
            border: 2px solid var(--brand-primary);
            transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-3px);
            background-color: var(--brand-primary-light);
        }
        .section-padding {
            padding-top: 6rem;
            padding-bottom: 6rem;
        }
        @media (max-width: 768px) {
            .section-padding {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }
        }
        .card-hover {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }
        .feature-card {
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
            border-color: var(--brand-primary);
        }
        .tech-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            transition: transform 0.3s ease;
        }
        .feature-card:hover .tech-icon {
            transform: scale(1.1);
        }
        .team-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }
        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: -60px auto 16px auto;
            border: 4px solid white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased text-gray-800 bg-white leading-relaxed tracking-tight">

    <div class="flex flex-col min-h-screen">
        
        <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-gray-200/80 shadow-sm" aria-label="Main Navigation">
            <nav class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <a href="/" class="text-2xl font-bold text-brand" aria-label="Homepage">
                        <i class="fas fa-parking mr-2"></i>Sistem Parkir
                    </a>

                    <div class="hidden md:flex items-center space-x-8" role="menubar">
                        <a href="#informasi-sistem" class="text-gray-600 hover:text-brand font-medium transition-colors duration-300" role="menuitem">Informasi</a>
                        <a href="#fitur" class="text-gray-600 hover:text-brand font-medium transition-colors duration-300" role="menuitem">Fitur</a>
                        <a href="#database-erd" class="text-gray-600 hover:text-brand font-medium transition-colors duration-300" role="menuitem">Database</a>
                        <a href="#alur" class="text-gray-600 hover:text-brand font-medium transition-colors duration-300" role="menuitem">Alur Kerja</a>
                        <a href="#teknologi" class="text-gray-600 hover:text-brand font-medium transition-colors duration-300" role="menuitem">Teknologi</a>
                        <a href="#tim" class="text-gray-600 hover:text-brand font-medium transition-colors duration-300" role="menuitem">Tim</a>
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" 
                           class="hidden md:inline-block px-6 py-3 font-semibold rounded-xl btn-primary shadow-lg">
                            Login
                        </a>
                        <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200" role="dialog" aria-modal="true">
                    <div class="flex flex-col space-y-4 pt-4">
                        <a href="#informasi-sistem" class="text-gray-600 hover:text-brand font-medium block px-4 py-2 rounded-md hover:bg-gray-100">Informasi</a>
                        <a href="#fitur" class="text-gray-600 hover:text-brand font-medium block px-4 py-2 rounded-md hover:bg-gray-100">Fitur</a>
                        <a href="#database-erd" class="text-gray-600 hover:text-brand font-medium block px-4 py-2 rounded-md hover:bg-gray-100">Database</a>
                        <a href="#alur" class="text-gray-600 hover:text-brand font-medium block px-4 py-2 rounded-md hover:bg-gray-100">Alur Kerja</a>
                        <a href="#teknologi" class="text-gray-600 hover:text-brand font-medium block px-4 py-2 rounded-md hover:bg-gray-100">Teknologi</a>
                        <a href="#tim" class="text-gray-600 hover:text-brand font-medium block px-4 py-2 rounded-md hover:bg-gray-100">Tim</a>
                        <a href="{{ route('login') }}" class="mt-4 px-6 py-3 font-semibold rounded-xl btn-primary shadow-lg text-center">
                            Login
                        </a>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-grow">
            
            <section id="hero" class="relative bg-cover bg-bottom bg-no-repeat h-screen flex items-center -z-1000" style="background-image: url('{{ asset('images/background-parkir.png') }}');">
                <div class="absolute inset-0 bg-black opacity-60"></div>
                <div class="container mx-auto px-6 relative">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div data-aos="fade-right">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tighter mb-6">
                                <span class="text-white">Sistem Informasi</span>
                                <br>
                                <span class="text-decoration">Manajemen Parkir</span>
                            </h1>
                            <p class="text-xl text-gray-200 leading-relaxed max-w-2xl mx-auto lg:mx-0 mb-8">
                                Solusi modern untuk mengelola kendaraan yang masuk dan keluar dari area parkir, serta menghitung biaya parkir secara otomatis.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-start">
                                <a href="{{ route('login') }}" 
                                   class="inline-block px-8 py-4 font-semibold rounded-xl btn-primary shadow-lg text-lg text-center">
                                    Akses Dashboard
                                </a>
                                <a href="#informasi-sistem" 
                                   class="inline-block px-8 py-4 font-semibold rounded-xl btn-secondary text-lg text-center">
                                    Pelajari Sistem
                                </a>
                            </div>
                        </div>
                        <div data-aos="fade-left" class="hidden lg:block">
                            
                        </div>
                    </div>
                </div>
            </section>

            <section id="informasi-sistem" class="section-padding bg-white">
                <div class="container mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        
                        <div data-aos="fade-right">
                            <span class="text-brand font-bold uppercase tracking-widest">Tentang Sistem</span>
                            
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 my-4">
                                Manajemen Parkir Digital yang Efisien
                            </h2>
                            
                            <div class="space-y-5 text-lg text-gray-600 leading-relaxed">
                                <p>
                                    Sistem parkir ini adalah aplikasi web yang dibangun menggunakan Laravel untuk mengelola kendaraan yang masuk dan keluar dari area parkir, serta menghitung biaya parkir secara otomatis.
                                </p>
                                <p>
                                    Sistem ini memungkinkan petugas untuk mencatat kendaraan yang masuk dan keluar secara terstruktur, menghitung biaya berdasarkan durasi, dan menyediakan laporan transaksi.
                                </p>
                            </div>
                        </div>

                        <div data-aos="fade-left" class="flex justify-center items-center">
                            <div class="rounded-2xl shadow-lg border border-gray-200">
                                <img src="{{ asset('images/parkir.jpg') }}" 
                                     alt="Sistem Parkir Digital" 
                                     class="w-full rounded-xl shadow-2xl object-cover" 
                                     style="aspect-ratio: 4 / 3;">
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section id="fitur" class="section-padding bg-slate-50">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                        <p class="text-lg text-gray-600">
                            Sistem ini dirancang dengan fitur-fitur canggih untuk menyederhanakan dan mengoptimalkan manajemen parkir.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="flex items-center mb-4">
                                <div class="tech-icon bg-gradient-to-br from-indigo-500 to-indigo-600 text-white mr-4">
                                    <i class="fas fa-users text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Manajemen Petugas</h3>
                            </div>
                            <p class="text-gray-600">Mengelola data petugas yang bertanggung jawab di setiap pos.</p>
                        </div>

                        <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="flex items-center mb-4">
                                <div class="tech-icon bg-gradient-to-br from-cyan-500 to-cyan-600 text-white mr-4">
                                    <i class="fas fa-car text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Manajemen Jenis Kendaraan</h3>
                            </div>
                            <p class="text-gray-600">Mengatur jenis kendaraan (misalnya, motor, mobil) beserta tarif parkir per hari.</p>
                        </div>

                        <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="flex items-center mb-4">
                                <div class="tech-icon bg-gradient-to-br from-emerald-500 to-emerald-600 text-white mr-4">
                                    <i class="fas fa-file-invoice text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Pencatatan Transaksi</h3>
                            </div>
                            <p class="text-gray-600">Mencatat setiap kendaraan yang masuk dan keluar, lengkap dengan waktu dan petugas yang melayani.</p>
                        </div>

                        <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="flex items-center mb-4">
                                <div class="tech-icon bg-gradient-to-br from-amber-500 to-amber-600 text-white mr-4">
                                    <i class="fas fa-calculator text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Perhitungan Biaya Otomatis</h3>
                            </div>
                            <p class="text-gray-600">Sistem secara otomatis menghitung total biaya parkir berdasarkan durasi dan jenis kendaraan.</p>
                        </div>

                        <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="flex items-center mb-4">
                                <div class="tech-icon bg-gradient-to-br from-rose-500 to-rose-600 text-white mr-4">
                                    <i class="fas fa-chart-bar text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Laporan Riwayat Transaksi</h3>
                            </div>
                            <p class="text-gray-600">Menyediakan laporan lengkap mengenai semua transaksi yang pernah terjadi.</p>
                        </div>
                        
                        </div>
                </div>
            </section>

            <section id="database-erd" class="section-padding bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Struktur Database & ERD</h2>
                        <p class="text-lg text-gray-600">
                            Visualisasi Entity-Relationship Diagram (ERD) dan penjelasan struktur tabel yang menjadi fondasi sistem.
                        </p>
                    </div>

                    <div class="grid lg:grid-cols-2 gap-12 items-start mb-16">
                        <div data-aos="fade-right">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Visualisasi ERD</h3>
                            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                                <div class="bg-slate-50 p-6 md:p-8 flex justify-center items-center">
                                    <img src="{{ asset('images/erd-sistem-parkir.svg') }}" 
                                         alt="Visualisasi ERD Sistem Parkir" 
                                         class="w-full max-w-sm object-contain rounded-xl shadow-lg bg-white">
                                </div>
                                <div class="px-6 py-4 border-t border-gray-200 bg-white">
                                    <p class="text-sm text-gray-600 italic text-center">
                                        Representasi visual dari relasi tabel database sistem parkir.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6" data-aos="fade-left">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Relasi Kunci</h3>
                             <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-200">
                                <h4 class="text-lg font-semibold text-indigo-800 mb-3 flex items-center">
                                    <i class="fas fa-link mr-2"></i>
                                    Users → Transaksi
                                </h4>
                                <p class="text-indigo-700">Relasi: <strong>One-to-Many</strong></p>
                                <p class="text-indigo-600 text-sm mt-2">Satu User (petugas) dapat melayani banyak Transaksi. Didefinisikan dalam model <code class="text-xs">User.php</code>.</p>
                            </div>

                            <div class="bg-cyan-50 p-6 rounded-xl border border-cyan-200">
                                <h4 class="text-lg font-semibold text-cyan-800 mb-3 flex items-center">
                                    <i class="fas fa-link mr-2"></i>
                                    Jenis Kendaraan → Transaksi
                                </h4>
                                <p class="text-cyan-700">Relasi: <strong>One-to-Many</strong></p>
                                <p class="text-cyan-600 text-sm mt-2">Satu JenisKendaraan dapat dimiliki oleh banyak Transaksi. Didefinisikan dalam model <code class="text-xs">JenisKendaraan.php</code>.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-8 rounded-2xl border border-gray-200" data-aos="fade-up">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Struktur Tabel Database</h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                                <h4 class="text-lg font-semibold text-brand mb-4 flex items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    Tabel users
                                </h4>
                                <div class="space-y-2 text-sm">
                                    <p><span class="text-red-600 font-medium">id (PK)</span></p>
                                    <p><span class="text-gray-700">nama_petugas</span></p>
                                    <p><span class="text-gray-700">email</span></p>
                                    <p><span class="text-gray-700">password</span></p>
                                    <p><span class="text-gray-700">shift</span></p>
                                </div>
                            </div>

                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                                <h4 class="text-lg font-semibold text-cyan-600 mb-4 flex items-center">
                                    <i class="fas fa-car mr-2"></i>
                                    Tabel tabel_jenis_kendaraan
                                </h4>
                                <div class="space-y-2 text-sm">
                                    <p><span class="text-red-600 font-medium">id_jenis (PK)</span></p>
                                    <p><span class="text-gray-700">nama_jenis</span></p>
                                    <p><span class="text-gray-700">tarif_per_hari</span></p>
                                </div>
                            </div>

                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                                <h4 class="text-lg font-semibold text-emerald-600 mb-4 flex items-center">
                                    <i class="fas fa-file-invoice mr-2"></i>
                                    Tabel tabel_transaksi
                                </h4>
                                <div class="space-y-2 text-sm">
                                    <p><span class="text-red-600 font-medium">id_tiket (PK)</span></p>
                                    <p><span class="text-gray-700">jam_masuk</span></p>
                                    <p><span class="text-gray-700">jam_keluar</span></p>
                                    <p><span class="text-gray-700">total_biaya</span></p>
                                    <p><span class="text-green-600 font-medium">id_jenis_fk (FK)</span></p>
                                    <p><span class="text-green-600 font-medium">id_petugas_fk (FK)</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="alur" class="section-padding bg-slate-50">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Alur Kerja Sistem</h2>
                        <p class="text-lg text-gray-600">
                            Proses kerja sistem parkir, dari kendaraan masuk hingga keluar, sesuai alur data.
                        </p>
                    </div>
                    <div class="relative">
                        <div class="hidden md:block absolute top-12 left-0 w-full h-1 bg-indigo-100 rounded-full" aria-hidden="true">
                            <div class="h-1 bg-brand w-1/2"></div>
                        </div>
                        <div class="relative grid md:grid-cols-3 gap-12">
                            
                            <article class="text-center" data-aos="fade-up" data-aos-delay="100">
                                <div class="mb-6 inline-flex items-center justify-center w-24 h-24 bg-brand text-white rounded-full border-4 border-indigo-100 shadow-lg">
                                    <span class="text-4xl font-bold">1</span>
                                </div>
                                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kendaraan Masuk</h3>
                                    <p class="text-gray-600">Petugas memilih jenis kendaraan. Sistem menghasilkan ID tiket unik dan mencatat waktu masuk.</p>
                                </div>
                            </article>
                            
                            <article class="text-center" data-aos="fade-up" data-aos-delay="300">
                                <div class="mb-6 inline-flex items-center justify-center w-24 h-24 bg-brand text-white rounded-full border-4 border-indigo-100 shadow-lg">
                                    <span class="text-4xl font-bold">2</span>
                                </div>
                                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kendaraan Keluar</h3>
                                    <p class="text-gray-600">Petugas memasukkan ID tiket. Sistem mencatat waktu keluar dan otomatis menghitung total biaya parkir.</p>
                                </div>
                            </article>
                            
                            <article class="text-center" data-aos="fade-up" data-aos-delay="500">
                                <div class="mb-6 inline-flex items-center justify-center w-24 h-24 bg-brand text-white rounded-full border-4 border-indigo-100 shadow-lg">
                                    <span class="text-4xl font-bold">3</span>
                                </div>
                                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">Laporan</h3>
                                    <p class="text-gray-600">Admin atau manajer dapat melihat seluruh riwayat transaksi yang tersimpan untuk keperluan audit atau analisis.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>

            <section id="teknologi" class="section-padding bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Teknologi yang Digunakan</h2>
                        <p class="text-lg text-gray-600">
                            Tumpukan teknologi modern yang digunakan untuk membangun sistem parkir digital ini.
                        </p>
                    </div>

                    <div class="space-y-16">
                        <div data-aos="fade-up">
                            <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Backend & Framework</h3>
                            <div class="grid md:grid-cols-3 gap-8">
                                <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 shadow-lg card-hover">
                                    <i class="fab fa-laravel text-6xl text-red-500 mx-auto mb-4"></i>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Laravel</h4>
                                    <p class="text-gray-600">Framework PHP modern dengan arsitektur MVC yang powerful.</p>
                                </div>
                                <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 shadow-lg card-hover">
                                    <i class="fas fa-database text-6xl text-blue-500 mx-auto mb-4"></i>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">MySQL</h4>
                                    <p class="text-gray-600">Database relasional yang handal untuk menyimpan data sistem.</p>
                                </div>
                                <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 shadow-lg card-hover">
                                    <i class="fab fa-php text-6xl text-indigo-400 mx-auto mb-4"></i>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">PHP</h4>
                                    <p class="text-gray-600">Bahasa pemrograman server-side yang menjadi inti Laravel.</p>
                                </div>
                            </div>
                        </div>

                        <div data-aos="fade-up">
                            <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Frontend & UI</h3>
                            <div class="grid md:grid-cols-4 gap-8">
                                <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 shadow-lg card-hover">
                                    <i class="fab fa-hotjar text-6xl text-orange-500 mx-auto mb-4"></i>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Livewire</h4>
                                    <p class="text-gray-600">Framework full-stack untuk membangun antarmuka dinamis.</p>
                                </div>
                                <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 shadow-lg card-hover">
                                    <i class="fab fa-css3-alt text-6xl text-cyan-500 mx-auto mb-4"></i>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Tailwind CSS</h4>
                                    <p class="text-gray-600">Utility-first CSS framework untuk styling cepat.</p>
                                </div>
                                <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 shadow-lg card-hover">
                                    <i class="fab fa-js text-6xl text-yellow-400 mx-auto mb-4"></i>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Alpine.js</h4>
                                    <p class="text-gray-600">Framework JavaScript minimalis untuk fungsionalitas reaktif.</p>
                                </div>
                                <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 shadow-lg card-hover">
                                    <i class="fab fa-html5 text-6xl text-orange-400 mx-auto mb-4"></i>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Blade</h4>
                                    <p class="text-gray-600">Template engine bawaan Laravel yang powerful.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="tim" class="section-padding bg-slate-50">
                <div class="container mx-auto px-6">
                    <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tim Kami</h2>
                        <p class="text-lg text-gray-600">
                            Kelompok 6 Sistem Manajemen Basis Data yang terdiri dari individu-individu berbakat dan berdedikasi.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-20">
                        <div class="team-card text-center" data-aos="fade-up" data-aos-delay="100">
                            <div class="pt-8 px-8 pb-8">
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Anggota Tim 1</h3>
                                <p class="text-brand font-medium mb-4">Backend Developer</p>
                                <div class="flex justify-center space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-linkedin text-2xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-github text-2xl"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="team-card text-center" data-aos="fade-up" data-aos-delay="200">
                            <div class="pt-8 px-8 pb-8">
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Anggota Tim 2</h3>
                                <p class="text-brand font-medium mb-4">Frontend Developer</p>
                                <div class="flex justify-center space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-linkedin text-2xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-github text-2xl"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="team-card text-center" data-aos="fade-up" data-aos-delay="300">
                            <div class="pt-8 px-8 pb-8">
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Anggota Tim 3</h3>
                                <p class="text-brand font-medium mb-4">Database Designer</p>
                                <div class="flex justify-center space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-linkedin text-2xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-github text-2xl"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="team-card text-center" data-aos="fade-up" data-aos-delay="400">
                            <div class="pt-8 px-8 pb-8">
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Anggota Tim 4</h3>
                                <p class="text-brand font-medium mb-4">UI/UX Designer</p>
                                <div class="flex justify-center space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-linkedin text-2xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-github text-2xl"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="team-card text-center" data-aos="fade-up" data-aos-delay="500">
                            <div class="pt-8 px-8 pb-8">
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Anggota Tim 5</h3>
                                <p class="text-brand font-medium mb-4">Project Manager</p>
                                <div class="flex justify-center space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-linkedin text-2xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-github text-2xl"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="team-card text-center" data-aos="fade-up" data-aos-delay="600">
                            <div class="pt-8 px-8 pb-8">
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Anggota Tim 6</h3>
                                <p class="text-brand font-medium mb-4">Quality Assurance</p>
                                <div class="flex justify-center space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-linkedin text-2xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-brand transition-colors"><i class="fab fa-github text-2xl"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-gray-900 text-white py-16">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-3 gap-12">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-parking mr-2 text-brand"></i>Sistem Parkir
                        </h3>
                        <p class="text-gray-400">
                            Solusi modern untuk manajemen parkir dengan teknologi QR code dan integrasi database yang powerful.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Navigasi Cepat</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#informasi-sistem" class="hover:text-white transition-colors">Informasi Sistem</a></li>
                            <li><a href="#fitur" class="hover:text-white transition-colors">Fitur</a></li>
                            <li><a href="#database-erd" class="hover:text-white transition-colors">Database & ERD</a></li>
                            <li><a href="#alur" class="hover:text-white transition-colors">Alur Kerja</a></li>
                            <li><a href="#teknologi" class="hover:text-white transition-colors">Teknologi</a></li>
                            <li><a href="#tim" class="hover:text-white transition-colors">Tim Kami</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                        <p class="text-gray-400 mb-4">Kelompok 6 - Sistem Manajemen Basis Data</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors" aria-label="GitHub"><i class="fab fa-github text-xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors" aria-label="LinkedIn"><i class="fab fa-linkedin text-xl"></i></a>
                            <a href="mailto:kelompok6@sistemparkir.com" class="text-gray-400 hover:text-white transition-colors" aria-label="Email"><i class="fas fa-envelope text-xl"></i></a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                    <p>&copy; 2024 Sistem Parkir - Kelompok 6 Sistem Manajemen Basis Data. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    if (window.innerWidth < 768) {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });

        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('bg-white/95');
                header.classList.remove('bg-white/90');
            } else {
                header.classList.add('bg-white/90');
                header.classList.remove('bg-white/95');
            }
        });
    </script>
</body>
</html>