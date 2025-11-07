<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosKeluarController;
use App\Http\Controllers\KarcisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk menangani logika Gerbang Masuk
Route::get('/karcis/generate/{id_jenis}', [KarcisController::class, 'generate'])
    ->middleware('auth') // Wajib login (auth)
    ->name('karcis.generate');

// Rute untuk menampilkan karcis (QR Code) di tab baru
Route::get('/karcis/show/{id_tiket}', [KarcisController::class, 'show'])
    ->middleware('auth')
    ->name('karcis.show');

// Rute ini akan dipanggil oleh JavaScript scanner
Route::post('/pos-keluar/scan', [PosKeluarController::class, 'scan'])
    ->middleware('auth') // Wajib login (auth)
    ->name('pos-keluar.scan');