<div>
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
            <div class="w-11/12 max-w-lg p-6 mx-auto bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">{{ $selectedId ? 'Edit Jenis Kendaraan' : 'Tambah Jenis Kendaraan' }}</h2>
                
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="nama_jenis" class="block text-sm font-medium text-gray-700">Nama Jenis</label>
                        <input type="text" wire:model.defer="nama_jenis" id="nama_jenis" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nama_jenis') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="tarif_per_hari" class="block text-sm font-medium text-gray-700">Tarif per Hari</label>
                        <input type="number" wire:model.defer="tarif_per_hari" id="tarif_per_hari" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('tarif_per_hari') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" wire:click="resetForm" class="px-4 py-2 font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Batal</button>
                        <button type="submit" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">{{ $selectedId ? 'Update' : 'Simpan' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <button wire:click="openModal" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Tambah Jenis Kendaraan
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID Jenis</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Jenis</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tarif per Hari</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($jenisKendaraanList as $jenis)
                        <tr wire:key="jenis-{{ $jenis->id_jenis }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $jenis->id_jenis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $jenis->nama_jenis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($jenis->tarif_per_hari, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <button wire:click="edit({{ $jenis->id_jenis }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button wire:click="delete({{ $jenis->id_jenis }})" wire:confirm="Anda yakin ingin menghapus data ini?" class="ml-4 text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-sm text-center text-gray-500">
                                Tidak ada data jenis kendaraan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $jenisKendaraanList->links() }}
        </div>
    </div>
</div>