<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\JenisKendaraanPage;
use App\Livewire\PetugasPage;
use App\Http\Controllers\KarcisController;
use App\Http\Controllers\PosKeluarController;
use App\Http\Controllers\HomeController; // Tambahkan ini

/*
|--------------------------------------------------------------------------
| Rute Publik
|--------------------------------------------------------------------------
|
| Rute ini dapat diakses oleh siapa saja.
|
*/

// 1. Homepage Publik (Sesuai Spesifikasi )
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
|
| Seluruh rute ini diproteksi oleh autentikasi.
|
*/
Auth::routes(); // Menangani /login, /register, /logout

Route::middleware('auth')->group(function () {

    // 2. Dashboard Admin (setelah login) 
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // 3. Halaman Gerbang Masuk (Dipisah) 
    Route::get('/gerbang-masuk', JenisKendaraanPage::class)->name('gerbang-masuk');

    // 4. Halaman Manajemen Petugas [cite: 1600]
    Route::get('/petugas', PetugasPage::class)->name('petugas');

    // 5. Rute internal untuk generate karcis (dipanggil dari Gerbang Masuk)
    Route::get('/karcis/generate/{id_jenis}', [KarcisController::class, 'generate'])
         ->name('karcis.generate');

    // 6. Halaman Pos Keluar [cite: 1607]
    Route::prefix('pos-keluar')->name('pos-keluar.')->group(function () {
        Route::get('/', [PosKeluarController::class, 'index'])
             ->name('index');
        Route::post('/scan', [PosKeluarController::class, 'prosesKeluar'])
             ->name('scan');
    });
    
    // TODO: Tambahkan rute untuk Manajemen Tarif dan Riwayat Transaksi
    // Sesuai spesifikasi [cite: 1600, 1601]
});