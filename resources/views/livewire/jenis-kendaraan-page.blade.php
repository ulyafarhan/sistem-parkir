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