<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JenisKendaraan;

class JenisKendaraanPage extends Component
{
    public function render()
    {
        $allJenisKendaraans = JenisKendaraan::all();

        return view('livewire.jenis-kendaraan-page', [
            'jenisList' => $allJenisKendaraans, 
        ])->layout('layouts.app'); 
    }
}