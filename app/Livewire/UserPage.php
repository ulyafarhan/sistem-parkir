<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserPage extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    
    public $selectedId;
    public $isModalOpen = false;

    protected function rules()
    {
        if (!$this->selectedId) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ];
        }
        
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->selectedId,
            'password' => 'nullable|min:6|confirmed',
        ];
    }

    protected $messages = [
        'email.unique' => 'Email ini sudah terdaftar.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function render()
    {
        return view('livewire.user-page', [
            'users' => User::paginate(10)
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
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedId = null;
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->selectedId], $data);

        session()->flash('message', 
            $this->selectedId ? 'User Berhasil Diperbarui.' : 'User Berhasil Dibuat.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->selectedId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        
        $this->openModal();
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
            return;
        }

        User::findOrFail($id)->delete();
        session()->flash('message', 'User Berhasil Dihapus.');
    }
}