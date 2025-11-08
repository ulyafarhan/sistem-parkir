<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasPage extends Component
{
    public $petugasList = [];
    public $nama_petugas, $email, $password, $password_confirmation;
    public $shift;

    public $selectedId, $isEditing = false;

    /**
     * Aturan validasi
     */
    protected function rules()
    {
        return [ // <-- Ini '[' di baris 21
            'nama_petugas' => 'required|string|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($this->selectedId),
            ],
            'password' => $this->isEditing ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
            'shift' => 'nullable|string|in:Pagi,Sore,Malam',
        ]; // <-- INI PERBAIKANNYA (di baris 29). Harus ];
    }

    /**
     * Dipanggil saat komponen di-load
     */
    public function mount()
    {
        $this->loadPetugas();
    }

    /**
     * Mengambil data petugas terbaru
     */
    public function loadPetugas()
    {
        $this->petugasList = User::all();
    }

    /**
     * Reset form
     */
    public function resetForm()
    {
        $this->reset(['nama_petugas', 'email', 'password', 'password_confirmation', 'shift', 'selectedId', 'isEditing']);
    }

    /**
     * Menyimpan data (Update atau Create)
     */
    public function save()
    {
        $this->validate();

        $data = [
            'nama_petugas' => $this->nama_petugas,
            'email' => $this->email,
            'shift' => $this->shift,
        ];

        // Hanya update password jika diisi
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->isEditing) {
            // Update data
            User::find($this->selectedId)->update($data);
        } else {
            // Buat data baru
            User::create($data);
        }

        $this->loadPetugas();
        $this->resetForm();
    }

    /**
     * Menyiapkan form untuk mode edit
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->selectedId = $user->id;
        $this->nama_petugas = $user->nama_petugas;
        $this->email = $user->email;
        $this->shift = $user->shift;
        $this->isEditing = true;
    }

    /**
     * Batal mode edit
     */
    public function cancelEdit()
    {
        $this->resetForm();
    }

    /**
     * Menghapus petugas
     */
    public function delete($id)
    {
        // Jangan biarkan user menghapus akunnya sendiri
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        User::find($id)->delete();
        $this->loadPetugas();
    }

    /**
     * Merender view
     */
    public function render()
    {
        return view('livewire.petugas-page')->layout('layouts.app');
    }
}