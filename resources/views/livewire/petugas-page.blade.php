<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Petugas</h1>

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-xl p-6 mb-8">
        <h2 class="text-2xl font-bold mb-4">{{ $isEditing ? 'Edit Petugas' : 'Tambah Petugas Baru' }}</h2>
        
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="nama_petugas" class="block text-sm font-medium text-gray-700">Nama Petugas</label>
                    <input wire:model="nama_petugas" id="nama_petugas" type="text"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nama_petugas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email (Untuk Login)</label>
                    <input wire:model="email" id="email" type="email"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="shift" class="block text-sm font-medium text-gray-700">Shift</label>
                    <select wire:model="shift" id="shift" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Shift</option>
                        <option value="Pagi">Pagi (08:00 - 16:00)</option>
                        <option value="Sore">Sore (16:00 - 00:00)</option> <option value="Malam">Malam (00:00 - 08:00)</option>
                    </select>
                    @error('shift') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="md:col-span-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input wire:model="password" id="password" type="password"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="{{ $isEditing ? '(Isi jika ingin ganti password)' : '' }}">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-1">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input wire:model="password_confirmation" id="password_confirmation" type="password"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 mt-6">
                @if ($isEditing)
                    <button wire:click="cancelEdit" type="button"
                            class="bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-600 transition duration-200">
                        Batal
                    </button>
                @endif
                <button type="submit"
                        class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                    {{ $isEditing ? 'Update Petugas' : 'Simpan Petugas' }}
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petugas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shift (BARU)</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($petugasList as $petugas)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $petugas->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $petugas->nama_petugas }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $petugas->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            @if($petugas->shift == 'Pagi')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pagi
                                </span>
                            @elseif($petugas->shift == 'Sore') <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Sore
                                </span>
                            @elseif($petugas->shift == 'Malam')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Malam
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button wire:click="edit({{ $petugas->id }})"
                                    class="text-indigo-600 hover:text-indigo-900">
                                Edit
                            </button>
                            <button wire:click="delete({{ $petugas->id }})"
                                    wire:confirm="Anda yakin ingin menghapus {{ $petugas->nama_petugas }}?"
                                    class="text-red-600 hover:text-red-900">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            Belum ada data petugas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>