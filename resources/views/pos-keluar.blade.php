{{-- Halaman ini menggunakan layout app --}}
@extends('layouts.app')

@section('slot')
<div class="container mx-auto">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Pos Keluar</h1>

        {{-- 1. Area untuk Menampilkan Kamera Scanner --}}
        <div id="scanner-container" class="w-full rounded-lg overflow-hidden border-4 border-gray-300 mb-4" style="max-width: 500px; margin: auto;">
            <div id="reader" style="width: 100%;"></div>
        </div>

        {{-- 2. Area untuk Menampilkan Hasil Scan --}}
        <div id="result-container" class="text-center">
            
            {{-- Pesan Status Awal --}}
            <div id="status-awal" class="text-gray-500">
                <p>Arahkan QR Code karcis ke kamera.</p>
            </div>

            {{-- Pesan Error --}}
            <div id="error-message" class="hidden bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Error!</p>
                <p id="error-text"></p>
            </div>

            {{-- Pesan Sukses --}}
            <div id="success-message" class="hidden bg-green-100 border-l-4 border-green-500 text-green-800 p-4" role="alert">
                <p class="font-bold text-xl mb-4">Scan Berhasil!</p>
                
                <div class="text-left text-lg text-gray-900 space-y-2">
                    <p class="text-center mb-4">
                        <strong class="block text-2xl text-gray-700">Total Biaya:</strong>
                        <span class="text-6xl font-mono font-bold text-green-700" id="success-biaya">Rp 0</span>
                    </p>
                    <hr class="my-3">
                    <div class="grid grid-cols-2 gap-x-4">
                        <strong class="text-gray-600">ID Tiket:</strong>
                        <span id="success-id" class="font-mono text-right"></span>
                        
                        <strong class="text-gray-600">Jenis:</strong>
                        <span id="success-jenis" class="font-semibold text-right"></span>
                        
                        <strong class="text-gray-600">Masuk:</strong>
                        <span id="success-masuk" class="text-sm text-right"></span>
                        
                        <strong class="text-gray-600">Keluar:</strong>
                        <span id="success-keluar" class="text-sm text-right"></span>
                        
                        <strong class="text-gray-600">Durasi:</strong>
                        <span id="success-durasi" class="font-semibold text-right"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- 3. Load Library Scanner dan Axios (untuk API call) --}}
<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // Ambil elemen pesan
    const statusAwal = document.getElementById('status-awal');
    const errorContainer = document.getElementById('error-message');
    const errorText = document.getElementById('error-text');
    const successContainer = document.getElementById('success-message');

    function showSuccess(data) {
        // Sembunyikan semua, tampilkan sukses
        statusAwal.classList.add('hidden');
        errorContainer.classList.add('hidden');
        successContainer.classList.remove('hidden');

        // Isi data sukses
        document.getElementById('success-biaya').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.total_biaya);
        document.getElementById('success-id').innerText = data.id_tiket;
        document.getElementById('success-jenis').innerText = data.nama_jenis;
        document.getElementById('success-masuk').innerText = data.jam_masuk;
        document.getElementById('success-keluar').innerText = data.jam_keluar;
        document.getElementById('success-durasi').innerText = data.durasi_hari + ' Hari';
    }

    function showError(message, isProcessing = false) {
        // Sembunyikan semua, tampilkan error
        statusAwal.classList.add('hidden');
        successContainer.classList.add('hidden');
        errorContainer.classList.remove('hidden');
        
        // Ubah warna jika hanya memproses
        if(isProcessing) {
            errorContainer.classList.remove('bg-red-100', 'border-red-500', 'text-red-700');
            errorContainer.classList.add('bg-blue-100', 'border-blue-500', 'text-blue-700');
            errorContainer.querySelector('p.font-bold').innerText = 'Memproses...';
        } else {
            errorContainer.classList.add('bg-red-100', 'border-red-500', 'text-red-700');
            errorContainer.classList.remove('bg-blue-100', 'border-blue-500', 'text-blue-700');
            errorContainer.querySelector('p.font-bold').innerText = 'Error!';
        }
        errorText.innerText = message;
    }

    function resetScannerView() {
        successContainer.classList.add('hidden');
        errorContainer.classList.add('hidden');
        statusAwal.classList.remove('hidden');
    }

    /**
     * Dipanggil ketika scanner berhasil membaca QR Code.
     */
    function onScanSuccess(decodedText, decodedResult) {
        // Hentikan scanner agar tidak scan berulang kali
        html5QrcodeScanner.pause();

        // Tampilkan pesan "Memproses..."
        showError('Sedang memvalidasi tiket: ' + decodedText, true);

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
                resetScannerView();
                html5QrcodeScanner.resume();
            }, 5000); // 5 detik
        })
        .catch(function (error) {
            // Jika backend merespon error (cth: tiket tidak valid)
            let msg = error.response?.data?.message || 'Gagal terhubung ke server.';
            showError(msg, false);

            // Mulai ulang scanner setelah 5 detik
            setTimeout(() => {
                resetScannerView();
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