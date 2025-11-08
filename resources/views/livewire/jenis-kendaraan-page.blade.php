<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6">Manajemen Jenis Kendaraan</h1>

    <button wire:click="openModal()" class="btn btn-primary mb-4">
        Tambah Baru
    </button>
    
    @if (session()->has('message'))
        <div class="alert alert-success shadow-lg mb-4" role="alert">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <div class="modal {{ $isModalOpen ? 'modal-open' : '' }}">
        <div class="modal-box">
            <form wire:submit.prevent="store">
                <h3 class="font-bold text-lg mb-4">{{ $selectedId ? 'Edit' : 'Tambah' }} Jenis Kendaraan</h3>
                
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text">Nama Kendaraan</span>
                    </label>
                    <input type="text" wire:model="nama" class="input input-bordered w-full">
                    @error('nama')
                        <label class="label">
                            <span class="label-text-alt text-red-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text">Tarif per Jam</span>
                    </label>
                    <input type="number" wire:model="tarif_per_jam" class="input input-bordered w-full">
                    @error('tarif_per_jam')
                        <label class="label">
                            <span class="label-text-alt text-red-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="modal-action mt-6">
                    <button type="button" wire:click="closeModal()" class="btn">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto shadow-md rounded-lg">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tarif per Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jenisKendaraans as $jenis)
                    <tr>
                        <td>{{ $jenis->nama }}</td>
                        <td>Rp {{ number_format($jenis->tarif_per_jam) }}</td>
                        <td>
                            <button wire:click="edit({{ $jenis->id }})" class="btn btn-ghost btn-xs">Edit</button>
                            <button wire:click="delete({{ $jenis->id }})" onclick="return confirm('Yakin hapus?')" class="btn btn-ghost btn-xs text-red-500">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            Tidak ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $jenisKendaraans->links('pagination::tailwind') }}
    </div>
</div>