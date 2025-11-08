<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Petugas; 
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class PetugasPage extends Component
{
    use WithPagination;

    // Sesuaikan properti dengan database
    public $nama_petugas;
    public $password;
    public $password_confirmation;
    
    public $selectedId;
    public $isModalOpen = false;

    protected function rules()
    {
        // Validasi untuk user baru
        if (!$this->selectedId) {
            return [
                'nama_petugas' => 'required|string|max:255',
                'password' => 'required|min:6|confirmed',
            ];
        }
        
        // Validasi untuk edit user (password boleh kosong)
        return [
            'nama_petugas' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
        ];
    }

    public function render()
    {
        return view('livewire.petugas-page', [
            // Ambil data dari Model Petugas
            'petugas' => Petugas::paginate(10)
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
        $this->nama_petugas = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedId = null;
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate();

        $data = [
            'nama_petugas' => $this->nama_petugas,
        ];

        // Hanya update password jika diisi
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        // Gunakan Primary Key 'id_petugas'
        if ($this->selectedId) {
            $petugas = Petugas::findOrFail($this->selectedId);
            $petugas->update($data);
        } else {
            Petugas::create($data);
        }

        session()->flash('message', 
            $this->selectedId ? 'Petugas Berhasil Diperbarui.' : 'Petugas Berhasil Dibuat.');

        $this->closeModal();
    }

    public function edit($id)
    {
        // Cari berdasarkan Model Petugas
        $petugas = Petugas::findOrFail($id);
        $this->selectedId = $id;
        $this->nama_petugas = $petugas->nama_petugas;
        
        $this->openModal();
    }

    public function delete($id)
    {
        // Cek agar tidak hapus diri sendiri (jika diperlukan)
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
            return;
        }

        Petugas::findOrFail($id)->delete();
        session()->flash('message', 'Petugas Berhasil Dihapus.');
    }
}