<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Manajemen User</h1>

    <button wire:click="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 shadow-lg">
        Tambah User Baru
    </button>
    
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                <form wire:submit.prevent="store">
                    <h3 class="text-2xl font-medium mb-4">{{ $selectedId ? 'Edit' : 'Tambah' }} User</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        @if ($selectedId)
                            <span class="text-xs text-gray-500 italic">Kosongkan jika tidak ingin mengubah password</span>
                        @endif
                        <input type="password" wire:model="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input type="password" wire:model="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" wire:click="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="edit({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button wire:click="delete({{ $user->id }})" onclick="return confirm('Yakin hapus user ini?')" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data user.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>