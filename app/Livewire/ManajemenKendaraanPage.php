<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JenisKendaraan;
use Livewire\WithPagination;

class ManajemenKendaraanPage extends Component
{
    use WithPagination;

    public $nama_jenis, $tarif_per_hari;
    public $selectedId;
    public $isOpen = false;

    protected $rules = [
        'nama_jenis' => 'required|string|max:255',
        'tarif_per_hari' => 'required|numeric|min:0',
    ];

    public function render()
    {
        return view('livewire.manajemen-kendaraan-page', [
            'jenisKendaraanList' => JenisKendaraan::paginate(10)
        ])
        ->layout('layouts.app', [
            'title' => 'Manajemen Kendaraan'
        ]);
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetForm()
    {
        $this->reset(['nama_jenis', 'tarif_per_hari', 'selectedId']);
    }

    public function save()
    {
        $this->validate();

        JenisKendaraan::updateOrCreate(['id_jenis' => $this->selectedId], [
            'nama_jenis' => $this->nama_jenis,
            'tarif_per_hari' => $this->tarif_per_hari,
        ]);

        session()->flash('message', 
            $this->selectedId ? 'Jenis Kendaraan Berhasil Diupdate.' : 'Jenis Kendaraan Berhasil Dibuat.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $jenis = JenisKendaraan::findOrFail($id);
        $this->selectedId = $id;
        $this->nama_jenis = $jenis->nama_jenis;
        $this->tarif_per_hari = $jenis->tarif_per_hari;
        
        $this->isOpen = true;
    }

    public function delete($id)
    {
        try {
            JenisKendaraan::find($id)->delete();
            session()->flash('message', 'Jenis Kendaraan Berhasil Dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus: Jenis kendaraan ini mungkin masih digunakan di tabel transaksi.');
        }
    }
}