<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class PetugasPage extends Component
{
    use WithPagination;

    public $nama_petugas, $email, $password, $shift;
    public $userId;
    public $isOpen = false;
    public $isDeleteOpen = false;

    protected function rules()
    {
        return [
            'nama_petugas' => 'required|string|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($this->userId),
            ],
            'password' => $this->userId ? 'nullable|min:8' : 'required|min:8',
            'shift' => 'nullable|string|in:Pagi,Sore,Malam',
        ];
    }

    public function render()
    {
        return view('livewire.petugas-page', [
            'users' => User::paginate(10)
        ])
        ->layout('layouts.app', [
            'title' => 'Manajemen Petugas'
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    public function openDeleteModal()
    {
        $this->isDeleteOpen = true;
    }

    public function closeDeleteModal()
    {
        $this->isDeleteOpen = false;
    }

    private function resetInputFields()
    {
        $this->reset(['nama_petugas', 'email', 'password', 'shift', 'userId']);
    }

    public function store()
    {
        $this->validate();

        $data = [
            'nama_petugas' => $this->nama_petugas,
            'email' => $this->email,
            'shift' => $this->shift,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        session()->flash('message', 
            $this->userId ? 'Petugas Berhasil Diupdate.' : 'Petugas Berhasil Dibuat.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->nama_petugas = $user->nama_petugas;
        $this->email = $user->email;
        $this->shift = $user->shift;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->userId = $id;
        $this->openDeleteModal();
    }

    public function delete()
    {
        if ($this->userId == auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            $this->closeDeleteModal();
            return;
        }
        
        User::find($this->userId)->delete();
        session()->flash('message', 'Petugas Berhasil Dihapus.');
        $this->closeDeleteModal();
    }
}