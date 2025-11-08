<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\JenisKendaraanPage;
use App\Livewire\PetugasPage;
use App\Livewire\RiwayatTransaksiPage; // <-- TAMBAHKAN IMPORT INI
use App\Http\Controllers\KarcisController;
use App\Http\Controllers\PosKeluarController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Rute Publik
|--------------------------------------------------------------------------
*/

// 1. Homepage Publik (Sesuai Spesifikasi)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rute untuk menampilkan karcis (harus publik agar tab baru berfungsi)
Route::prefix('karcis')->name('karcis.')->group(function () {
    Route::get('/show/{id_tiket}', [KarcisController::class, 'show'])
         ->name('show');
});

/*
|--------------------------------------------------------------------------
| Rute Admin (Panel Operasional)
|--------------------------------------------------------------------------
*/
Auth::routes(); // Menangani /login, /register, /logout

Route::middleware('auth')->group(function () {

    // 2. Dashboard Admin
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // 3. Halaman Gerbang Masuk
    Route::get('/gerbang-masuk', JenisKendaraanPage::class)->name('gerbang-masuk');

    // 4. Halaman Manajemen Petugas
    Route::get('/petugas', PetugasPage::class)->name('petugas');

    // 5. Rute internal untuk generate karcis
    Route::get('/karcis/generate/{id_jenis}', [KarcisController::class, 'generate'])
         ->name('karcis.generate');

    // 6. Halaman Pos Keluar
    Route::prefix('pos-keluar')->name('pos-keluar.')->group(function () {
        Route::get('/', [PosKeluarController::class, 'index'])
             ->name('index');
        Route::post('/scan', [PosKeluarController::class, 'prosesKeluar'])
             ->name('scan');
    });
    
    // 7. Halaman Riwayat Transaksi (INI YANG BARU)
    Route::get('/riwayat-transaksi', RiwayatTransaksiPage::class)->name('riwayat-transaksi');

});