<div>
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
            <div class="w-11/12 max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">{{ $userId ? 'Edit Petugas' : 'Tambah Petugas' }}</h2>
                
                <form wire:submit.prevent="store">
                    <div class="mb-4">
                        <label for="nama_petugas" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" wire:model.defer="nama_petugas" id="nama_petugas" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nama_petugas') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" wire:model.defer="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" wire:model.defer="password" id="password" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="{{ $userId ? 'Kosongkan jika tidak ganti' : '' }}">
                        @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="shift" class="block text-sm font-medium text-gray-700">Shift</label>
                        <select wire:model.defer="shift" id="shift" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Shift</option>
                            <option value="Pagi">Pagi</option>
                            <option value="Sore">Sore</option>
                            <option value="Malam">Malam</option>
                        </select>
                        @error('shift') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Batal</button>
                        <button type="submit" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">{{ $userId ? 'Update' : 'Simpan' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($isDeleteOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
            <div class="w-11/12 max-w-lg p-6 mx-auto bg-white rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
                <p class="mb-6">Anda yakin ingin menghapus petugas ini?</p>
                <div class="flex justify-end space-x-4">
                    <button type="button" wire:click="closeDeleteModal" class="px-4 py-2 font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="button" wire:click.prevent="delete" class="px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-700">Hapus</button>
                </div>
            </div>
        </div>
    @endif

    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <button wire:click="create" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Tambah Petugas
            </button>
        </div>
        
        @if (session()->has('message'))
            <div class="px-4 py-3 mb-4 font-medium text-green-800 bg-green-100 border border-green-200 rounded-md">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="px-4 py-3 mb-4 font-medium text-red-800 bg-red-100 border border-red-200 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Shift</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $index => $user)
                        <tr wire:key="user-{{ $user->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $users->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->nama_petugas }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 
                                    @if($user->shift == 'Pagi') bg-blue-100 text-blue-800
                                    @elseif($user->shift == 'Sore') bg-yellow-100 text-yellow-800
                                    @elseif($user->shift == 'Malam') bg-gray-700 text-gray-100
                                    @else bg-gray-100 text-gray-800
                                    @endif
                                    rounded-full">
                                    {{ $user->shift ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <button wire:click="edit({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button wire:click="confirmDelete({{ $user->id }})" class="ml-4 text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500">
                                Tidak ada data petugas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>