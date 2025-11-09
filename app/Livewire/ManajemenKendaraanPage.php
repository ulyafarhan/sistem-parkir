<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JenisKendaraan;
use Livewire\WithPagination; 

class ManajemenKendaraanPage extends Component
{
    use WithPagination; 

    public $nama_jenis;
    public $tarif_per_hari;
    
    public $selectedId;
    public $isModalOpen = false;

    protected $rules = [
        'nama_jenis' => 'required|string|max:255',
        'tarif_per_hari' => 'required|numeric|min:0',
    ];
    
    public function render()
    {
        $jenisKendaraansPaginated = JenisKendaraan::paginate(10);

        return view('livewire.manajemen-kendaraan-page', [
            'jenisKendaraans' => $jenisKendaraansPaginated
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
        $this->nama_jenis = '';
        $this->tarif_per_hari = '';
        $this->selectedId = null;
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate();

        JenisKendaraan::updateOrCreate(
            ['id_jenis' => $this->selectedId], 
            [
                'nama_jenis' => $this->nama_jenis,
                'tarif_per_hari' => $this->tarif_per_hari,
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
        $this->nama_jenis = $jenis->nama_jenis;
        $this->tarif_per_hari = $jenis->tarif_per_hari;
        
        $this->openModal();
    }

    public function delete($id)
    {
        JenisKendaraan::findOrFail($id)->delete();
        session()->flash('message', 'Jenis Kendaraan Berhasil Dihapus.');
    }
}