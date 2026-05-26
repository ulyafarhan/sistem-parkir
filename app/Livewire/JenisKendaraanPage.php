<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JenisKendaraan;

class JenisKendaraanPage extends Component
{
    public function render()
    {
        $jenisKendaraan = JenisKendaraan::all();

        return view('livewire.jenis-kendaraan-page', [
            'jenisKendaraan' => $jenisKendaraan
        ])
        ->layout('layouts.app', [
            'title' => 'Gerbang Masuk'
        ]);
    }

    public function generateKarcis($id_jenis)
    {
        $url = route('karcis.generate', ['id_jenis' => $id_jenis]);
        $this->dispatch('open-new-tab', $url);
    }
}