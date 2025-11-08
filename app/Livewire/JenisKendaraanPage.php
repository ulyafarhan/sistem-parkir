<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JenisKendaraan;
use Livewire\WithPagination;

class JenisKendaraanPage extends Component
{
    use WithPagination;

    public $nama;
    public $tarif_per_jam;
    
    public $selectedId;
    public $isModalOpen = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'tarif_per_jam' => 'required|numeric|min:0',
    ];

    public function render()
    {
        return view('livewire.jenis-kendaraan-page', [
            'jenisKendaraans' => JenisKendaraan::paginate(10)
        ])->layout('layouts.app'); 
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetForm()
    {
        $this->nama = '';
        $this->tarif_per_jam = '';
        $this->selectedId = null;
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate();

        JenisKendaraan::updateOrCreate(
            ['id_jenis_kendaraan' => $this->selectedId], 
            [
                'nama' => $this->nama,
                'tarif_per_jam' => $this->tarif_per_jam,
            ]
        );

        session()->flash('message', 
            $this->selectedId ? 'Jenis Kendaraan Berhasil Diperbarui.' : 'Jenis Kendaraan Berhasil Disimpan.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $jenis = JenisKendaraan::findOrFail($id);
        $this->selectedId = $id;
        $this->nama = $jenis->nama;
        $this->tarif_per_jam = $jenis->tarif_per_jam;
        
        $this->openModal();
    }

    public function delete($id)
    {
        JenisKendaraan::findOrFail($id)->delete();
        session()->flash('message', 'Jenis Kendaraan Berhasil Dihapus.');
    }
}