<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\JenisKendaraanPage;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', JenisKendaraanPage::class);