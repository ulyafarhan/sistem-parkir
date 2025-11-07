<x-filament-panels::page>
    <div class="flex flex-col md:flex-row gap-6">

        {{-- Kolom 1: Scanner Kamera --}}
        <div class="w-full md:w-1/2 bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold mb-2">POS KELUAR SCANNER</h2>
            <p class="text-gray-500 mb-4">Arahkan kamera ke QR Code di karcis digital.</p>
            
            {{-- Wadah untuk scanner --}}
            <div id="reader" class="w-full aspect-square bg-gray-100 rounded-lg overflow-hidden"></div>
        </div>

        {{-- Kolom 2: Hasil Scan --}}
        <div class="w-full md:w-1/2">
            <div id="scan-result" class="bg-white rounded-lg shadow-lg p-6">
                {{-- Pesan default --}}
                <div id="result-default">
                    <h3 class="text-lg font-semibold text-gray-500">Menunggu hasil scan...</h3>
                </div>

                {{-- Template untuk hasil sukses (disembunyikan) --}}
                <div id="result-success" class="hidden">
                    <h2 class="text-3xl font-bold text-green-600 mb-4" id="result-message"></h2>
                    
                    <p class="text-2xl font-mono text-blue-700 font-bold mb-4" id="result-id-tiket"></p>

                    <div class="space-y-2 text-lg">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jenis Kendaraan:</span>
                            <span class="font-semibold" id="result-jenis"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Durasi:</span>
                            <span class="font-semibold" id="result-hari"></span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between items-center text-3xl">
                            <span class="font-bold">TOTAL BAYAR:</span>
                            <span class="font-bold text-blue-600" id="result-biaya"></span>
                        </div>
                    </div>

                    <button onclick="resetScanner()" class="mt-6 w-full fi-btn fi-btn-size-lg fi-btn-color-primary fi-btn-style-filled">
                        Scan Berikutnya
                    </button>
                </div>

                {{-- Template untuk hasil error (disembunyikan) --}}
                <div id="result-error" class="hidden">
                    <h2 class="text-3xl font-bold text-red-600 mb-4" id="result-error-message"></h2>
                    <button onclick="resetScanner()" class="mt-6 w-full fi-btn fi-btn-size-lg fi-btn-color-danger fi-btn-style-filled">
                        Coba Scan Ulang
                    </button>
                </div>

            </div>
        </div>
    </div>


    {{-- 1. Import Library Scanner --}}
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

    <script>
        // Ambil elemen-elemen UI
        const resultDefault = document.getElementById('result-default');
        const resultSuccess = document.getElementById('result-success');
        const resultError = document.getElementById('result-error');
        let html5QrcodeScanner;

        // Fungsi yang dipanggil saat QR Code berhasil ter-scan
        function onScanSuccess(decodedText, decodedResult) {
            // Hentikan scanner agar tidak scan berulang-ulang
            html5QrcodeScanner.pause();

            // Tampilkan loading (opsional)
            resultDefault.innerHTML = '<h3 class="text-lg font-semibold text-yellow-600">Memproses tiket...</h3>';

            // Kirim ID Tiket ke Backend (Controller)
            fetch('{{ route("pos-keluar.scan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // Token CSRF wajib untuk proteksi Laravel
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                },
                body: JSON.stringify({
                    id_tiket: decodedText 
                })
            })
            .then(response => response.json())
            .then(data => {
                // Sembunyikan pesan default
                resultDefault.classList.add('hidden');

                if (data.status === 'success') {
                    // Tampilkan UI Sukses
                    document.getElementById('result-message').innerText = data.message;
                    document.getElementById('result-id-tiket').innerText = data.data.id_tiket;
                    document.getElementById('result-jenis').innerText = data.data.jenis;
                    document.getElementById('result-hari').innerText = data.data.total_hari + ' Hari';
                    document.getElementById('result-biaya').innerText = 'Rp ' + data.data.total_biaya;
                    resultSuccess.classList.remove('hidden');
                } else {
                    // Tampilkan UI Error
                    document.getElementById('result-error-message').innerText = data.message;
                    resultError.classList.remove('hidden');
                }
            })
            .catch(error => {
                // Tampilkan UI Error jika fetch gagal
                resultDefault.classList.add('hidden');
                document.getElementById('result-error-message').innerText = 'Error: Gagal terhubung ke server.';
                resultError.classList.remove('hidden');
                console.error('Error:', error);
            });
        }

        // Fungsi untuk mereset UI dan menyalakan scanner lagi
        function resetScanner() {
            resultSuccess.classList.add('hidden');
            resultError.classList.add('hidden');
            resultDefault.classList.remove('hidden');
            resultDefault.innerHTML = '<h3 class="text-lg font-semibold text-gray-500">Menunggu hasil scan...</h3>';
            
            // Lanjutkan scan
            html5QrcodeScanner.resume();
        }

        // Inisialisasi scanner saat dokumen siap
        document.addEventListener("DOMContentLoaded", function () {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", // ID dari div scanner
                { 
                    fps: 10, // Frames per second
                    qrbox: { width: 250, height: 250 } // Ukuran kotak scan
                },
                false // verbose=false
            );
            
            // Render scanner
            html5QrcodeScanner.render(onScanSuccess);
        });

    </script>
</x-filament-panels::page>