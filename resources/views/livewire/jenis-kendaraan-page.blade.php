<div class="container mx-auto p-8">

    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Gerbang Masuk</h2>
        <p class="text-gray-600 mb-6">Klik tombol di bawah ini untuk mensimulasikan kendaraan masuk dan men-generate karcis QR Code.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($jenisList as $jenis)
                {{-- Ini adalah link, bukan tombol livewire, dengan target="_blank" --}}
                <a href="{{ route('karcis.generate', ['id_jenis' => $jenis->id_jenis]) }}"
                target="_blank"
                class="block text-center bg-blue-600 text-white font-bold py-6 px-8 rounded-lg shadow-xl 
                        hover:bg-blue-700 transition duration-200 text-3xl">
                    
                    MASUK {{ $jenis->nama_jenis }}
                    <span class="block text-lg font-normal">Rp {{ number_format($jenis->tarif_per_hari, 0, ',', '.') }} / hari</span>
                </a>
            @endforeach
        </div>
    </div>


    <h1 class="text-3xl font-bold mb-6 text-gray-800">Manajemen Jenis Kendaraan</h1>

    <button wire:click="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 shadow-lg">
        Tambah Jenis Kendaraan
    </button>
    
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                <form wire:submit.prevent="store">
                    <h3 class="text-2xl font-medium mb-4">{{ $selectedId ? 'Edit' : 'Tambah' }} Jenis Kendaraan</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Kendaraan</label>
                        <input type="text" wire:model="nama_jenis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('nama_jenis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tarif per Hari</label>
                        <input type="number" wire:model="tarif_per_hari" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('tarif_per_hari') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarif per Hari</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($jenisKendaraans as $jenis)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $jenis->nama_jenis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($jenis->tarif_per_hari) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="edit({{ $jenis->id_jenis }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button wire:click="delete({{ $jenis->id_jenis }})" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $jenisKendaraans->links() }}
    </div>
</div>