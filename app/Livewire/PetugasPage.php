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

    protected function rules()
    {
        return [
            'nama_petugas' => 'required|string|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($this->selectedId),
            ],
            'password' => $this->isEditing ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
            'shift' => 'nullable|string|in:Pagi,Sore,Malam',
        ];
    }

    public function mount()
    {
        $this->loadPetugas();
    }

    public function loadPetugas()
    {
        $this->petugasList = User::all();
    }

    public function resetForm()
    {
        $this->reset(['nama_petugas', 'email', 'password', 'password_confirmation', 'shift', 'selectedId', 'isEditing']);
    }

    public function save()
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

        if ($this->isEditing) {
            User::find($this->selectedId)->update($data);
        } else {
            User::create($data);
        }

        $this->loadPetugas();
        $this->resetForm();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->selectedId = $user->id;
        $this->nama_petugas = $user->nama_petugas;
        $this->email = $user->email;
        $this->shift = $user->shift;
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        User::find($id)->delete();
        $this->loadPetugas();
    }

    public function render()
    {
        return view('livewire.petugas-page')->layout('layouts.app');
    }
}