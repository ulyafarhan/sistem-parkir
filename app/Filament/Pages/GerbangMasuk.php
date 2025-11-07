<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
// Import model
use App\Models\JenisKendaraan;
use Illuminate\Database\Eloquent\Collection;

class GerbangMasuk extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square';

    protected static string $view = 'filament.pages.gerbang-masuk';

    // Set rute kustom sesuai brief [cite: 120]
    protected static ?string $slug = 'gerbang-masuk';
    
    // Properti untuk menyimpan data jenis kendaraan
    public Collection $jenisKendaraan;

    // Method ini dijalankan saat halaman dibuka
    public function mount(): void
    {
        // Ambil semua data tarif untuk membuat tombol
        $this->jenisKendaraan = JenisKendaraan::all();
    }
}