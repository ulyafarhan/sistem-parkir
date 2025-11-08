<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\JenisKendaraanPage;
use App\Livewire\UserPage;


Route::get('/', JenisKendaraanPage::class)->name('jenis-kendaraan');
Route::get('/users', UserPage::class)->name('users');