<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\JenisKendaraanPage;
use App\Livewire\PetugasPage;
use App\Http\Controllers\KarcisController;
use App\Http\Controllers\PosKeluarController;


Route::get('/', JenisKendaraanPage::class)->name('jenis-kendaraan');
Route::get('/petugas', PetugasPage::class)->name('petugas');

Route::prefix('karcis')->name('karcis.')->group(function () {
    Route::get('/generate/{id_jenis}', [KarcisController::class, 'generate'])
         ->name('generate');
    Route::get('/show/{id_tiket}', [KarcisController::class, 'show'])
         ->name('show');
});

Route::middleware('auth')->prefix('pos-keluar')->name('pos-keluar.')->group(function () {
    Route::get('/', [PosKeluarController::class, 'index'])
         ->name('index');
    Route::post('/scan', [PosKeluarController::class, 'prosesKeluar'])
         ->name('scan');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
