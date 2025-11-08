<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasPage extends Component
{
    public $petugasList = []; // Ganti nama variabel agar tidak bingung
    public $nama_petugas, $email, $password, $password_confirmation;
    
    public $selectedId, $isEditing = false;

    // Aturan validasi
    protected function rules()
    {
        return [
            'nama_petugas' => 'required|string|max:255',
            // Pastikan email unik, KECUALI untuk ID yang sedang diedit
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->selectedId),
            ],
            // Password hanya wajib saat membuat baru
            'password' => $this->isEditing ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
        ];
    }

    public function mount()
    {
        $this->loadPetugas();
    }

    // Fungsi untuk me-load data
    public function loadPetugas()
    {
        $this->petugasList = User::all(); // <-- DIUBAH: Mengambil dari User
    }

    // Fungsi untuk reset form
    public function resetForm()
    {
        $this->reset(['nama_petugas', 'email', 'password', 'password_confirmation', 'selectedId', 'isEditing']);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama_petugas' => $this->nama_petugas,
            'email' => $this->email,
        ];

        // Hanya update password jika diisi
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->isEditing) {
            // Update data
            $user = User::find($this->selectedId); // <-- DIUBAH
            if ($user) {
                $user->update($data);
            }
        } else {
            // Buat data baru
            User::create($data); // <-- DIUBAH
        }

        $this->loadPetugas();
        $this->resetForm();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // <-- DIUBAH
        $this->selectedId = $user->id;
        $this->nama_petugas = $user->nama_petugas;
        $this->email = $user->email;
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    public function delete($id)
    {
        // Jangan biarkan user menghapus akunnya sendiri
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        User::find($id)->delete(); // <-- DIUBAH
        $this->loadPetugas();
    }

    public function render()
    {
        return view('livewire.petugas-page')->layout('layouts.app');
    }
}