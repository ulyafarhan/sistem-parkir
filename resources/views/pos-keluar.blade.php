{{-- Halaman ini menggunakan layout app --}}
@extends('layouts.app')

@section('slot')
<div class="container mx-auto p-8">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Pos Keluar</h1>

        {{-- 1. Area untuk Menampilkan Kamera Scanner --}}
        <div id="scanner-container" class="w-full rounded-lg overflow-hidden border-4 border-gray-300 mb-4" style="max-width: 500px; margin: auto;">
            <div id="reader" style="width: 100%;"></div>
        </div>

        {{-- 2. Area untuk Menampilkan Hasil Scan --}}
        <div id="result-container" class="text-center">
            
            {{-- Pesan Error --}}
            <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline" id="error-text"></span>
            </div>

            {{-- Pesan Sukses --}}
            <div id="success-message" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Scan Berhasil!</strong>
                
                <div class="mt-4 text-left text-lg text-gray-900">
                    <p><strong>Total Biaya:</strong></p>
                    <p class="text-5xl font-mono font-bold text-center" id="success-biaya">Rp 0</p>
                    <hr class="my-2">
                    <p><strong>ID Tiket:</strong> <span id="success-id" class="font-mono"></span></p>
                    <p><strong>Jenis:</strong> <span id="success-jenis"></span></p>
                    <p><strong>Masuk:</strong> <span id="success-masuk"></span></p>
                    <p><strong>Keluar:</strong> <span id="success-keluar"></span></p>
                    <p><strong>Durasi:</strong> <span id="success-durasi"></span> Hari</p>
                </div>
            </div>

            <p class="text-gray-500">Arahkan QR Code karcis ke kamera.</p>
        </div>
    </div>
</div>

{{-- 3. Load Library Scanner dan Axios (untuk API call) --}}
<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // Ambil elemen pesan
    const errorContainer = document.getElementById('error-message');
    const errorText = document.getElementById('error-text');
    const successContainer = document.getElementById('success-message');

    function showSuccess(data) {
        // Sembunyikan error, tampilkan sukses
        errorContainer.classList.add('hidden');
        successContainer.classList.remove('hidden');

        // Isi data sukses
        document.getElementById('success-biaya').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.total_biaya);
        document.getElementById('success-id').innerText = data.id_tiket;
        document.getElementById('success-jenis').innerText = data.nama_jenis;
        document.getElementById('success-masuk').innerText = data.jam_masuk;
        document.getElementById('success-keluar').innerText = data.jam_keluar;
        document.getElementById('success-durasi').innerText = data.durasi_hari;
    }

    function showError(message) {
        // Sembunyikan sukses, tampilkan error
        successContainer.classList.add('hidden');
        errorContainer.classList.remove('hidden');
        errorText.innerText = message;
    }

    /**
     * Dipanggil ketika scanner berhasil membaca QR Code.
     */
    function onScanSuccess(decodedText, decodedResult) {
        // Hentikan scanner agar tidak scan berulang kali
        html5QrcodeScanner.pause();

        // Tampilkan pesan "Memproses..."
        showError('Sedang memproses tiket: ' + decodedText + '...');

        // Kirim data ke backend menggunakan Axios
        axios.post("{{ route('pos-keluar.scan') }}", {
            _token: "{{ csrf_token() }}",
            id_tiket: decodedText
        })
        .then(function (response) {
            // Jika backend merespon sukses
            showSuccess(response.data.data);
            
            // Mulai ulang scanner setelah 5 detik
            setTimeout(() => {
                successContainer.classList.add('hidden');
                html5QrcodeScanner.resume();
            }, 5000); // 5 detik
        })
        .catch(function (error) {
            // Jika backend merespon error (cth: tiket tidak valid)
            let msg = error.response.data.message || 'Gagal terhubung ke server.';
            showError(msg);

            // Mulai ulang scanner setelah 5 detik
            setTimeout(() => {
                errorContainer.classList.add('hidden');
                html5QrcodeScanner.resume();
            }, 5000); // 5 detik
        });
    }

    /**
     * Inisialisasi scanner
     */
    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", // ID elemen <div>
        { 
            fps: 10, // Frames per second
            qrbox: { width: 250, height: 250 } // Ukuran kotak scan
        },
        false // verbose=false
    );

    // Render scanner
    html5QrcodeScanner.render(onScanSuccess);

</script>
@endsection