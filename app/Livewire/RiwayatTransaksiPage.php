<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use Livewire\WithPagination; // Kita tambahkan pagination

class RiwayatTransaksiPage extends Component
{
    use WithPagination;

    public function render()
    {
        // Ambil data transaksi, urutkan dari yang terbaru, dan beri pagination
        $transaksis = Transaksi::with(['jenisKendaraan', 'petugas']) // Load relasi
                                ->latest() // Urutkan dari terbaru
                                ->paginate(10); // 10 data per halaman

        return view('livewire.riwayat-transaksi-page', [
            'transaksis' => $transaksis
        ])->layout('layouts.app');
    }
}