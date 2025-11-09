<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\JenisKendaraanPage;
use App\Livewire\PetugasPage;
use App\Livewire\RiwayatTransaksiPage; 
use App\Livewire\ManajemenKendaraanPage;
use App\Http\Controllers\KarcisController;
use App\Http\Controllers\PosKeluarController;
use App\Livewire\DashboardPage;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('karcis')->name('karcis.')->group(function () {
    Route::get('/show/{id_tiket}', [KarcisController::class, 'show'])
         ->name('show');
    Route::get('/download/{id_tiket}', [KarcisController::class, 'download'])
         ->name('download');
});

Auth::routes(); 

Route::middleware('auth')->group(function () {

    Route::get('/home', DashboardPage::class)->name('home');
    
    Route::get('/gerbang-masuk', JenisKendaraanPage::class)->name('gerbang-masuk');

    Route::get('/petugas', PetugasPage::class)->name('petugas');

    Route::get('/karcis/generate/{id_jenis}', [KarcisController::class, 'generate'])
         ->name('karcis.generate');

    Route::prefix('pos-keluar')->name('pos-keluar.')->group(function () {
        Route::get('/', [PosKeluarController::class, 'index'])
             ->name('index');
        Route::post('/scan', [PosKeluarController::class, 'prosesKeluar'])
             ->name('scan');
    });
    
    Route::get('/riwayat-transaksi', RiwayatTransaksiPage::class)->name('riwayat-transaksi');

    Route::get('/manajemen-kendaraan', ManajemenKendaraanPage::class)->name('manajemen-kendaraan');

});