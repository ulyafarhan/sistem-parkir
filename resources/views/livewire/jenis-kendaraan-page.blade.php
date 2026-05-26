<div class="p-8 bg-white rounded-xl shadow-xl space-y-6">

    <div wire:loading wire:target="generateKarcis">
        <div class="flex items-center gap-3 px-5 py-4 text-blue-800 bg-blue-50 border border-blue-200 rounded-lg animate-pulse">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6l4 2"></path></svg>
            <span class="font-medium">Mencetak karcis, mohon tunggu...</span>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="flex items-center gap-3 px-5 py-4 text-green-800 bg-green-50 border border-green-200 rounded-lg">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="flex items-center gap-3 px-5 py-4 text-red-800 bg-red-50 border border-red-200 rounded-lg">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div>
        <h2 class="text-2xl font-bold text-gray-900">Pilih Jenis Kendaraan</h2>
        <p class="text-gray-600 mt-1">Klik tombol di bawah untuk mencetak karcis masuk.</p>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($jenisKendaraan as $jenis)
            <button 
                wire:click="generateKarcis({{ $jenis->id_jenis }})"
                wire:loading.attr="disabled"
                wire:key="jenis-masuk-{{ $jenis->id_jenis }}"
                class="group block p-6 text-center bg-blue-600 text-white rounded-xl shadow-md transition-all duration-300 ease-in-out hover:bg-blue-700 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <span class="text-2xl font-bold uppercase tracking-wide">
                    {{ $jenis->nama_jenis }}
                </span>
                <span class="block mt-2 text-base font-medium text-blue-100 group-hover:text-white">
                    Rp {{ number_format($jenis->tarif_per_hari, 0, ',', '.') }} / hari
                </span>
            </button>
        @empty
            <div class="p-6 text-center text-gray-500 bg-gray-100 rounded-lg sm:col-span-2 lg:col-span-3">
                Tidak ada data jenis kendaraan yang ditemukan.
            </div>
        @endforelse
    </div>
</div>


@script
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('open-new-tab', (url) => {
            window.open(url, '_blank');
        });
    });
</script>
@endscript