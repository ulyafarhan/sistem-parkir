<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use Livewire\WithPagination;

class RiwayatTransaksiPage extends Component
{
    use WithPagination;

    public function render()
    {
        $transaksis = Transaksi::with(['jenisKendaraan', 'petugas'])
                                ->latest()
                                ->paginate(10);

        return view('livewire.riwayat-transaksi-page', [
            'transaksis' => $transaksis
        ])
        ->layout('layouts.app', [
            'title' => 'Riwayat Transaksi' 
        ]);
    }
}