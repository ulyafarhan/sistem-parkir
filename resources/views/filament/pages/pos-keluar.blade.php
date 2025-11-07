<x-filament-panels::page>
    <div class="flex flex-col md:flex-row gap-6">

        {{-- Kolom 1: Scanner Kamera & Upload --}}
        <div class="w-full md:w-1/2 bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold mb-2">POS KELUAR SCANNER</h2>
            <p class="text-gray-500 mb-4">Arahkan kamera ke QR Code di karcis digital.</p>
            
            {{-- Wadah untuk scanner --}}
            <div id="reader" class="w-full aspect-square bg-gray-100 rounded-lg overflow-hidden"></div>

            {{-- Input File --}}
            <div class="mt-4 text-center border-t pt-4">
                <label for="qr-input-file" class="block text-sm font-medium text-gray-700 mb-2">
                    Atau upload file karcis (QR):
                </label>
                <input type="file" id="qr-input-file" accept="image/png, image/jpeg" class="
                    block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none
                    file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
                ">
            </div>
        </div>

        {{-- Kolom 2: Hasil Scan --}}
        <div class="w-full md:w-1/2">
            <div id="scan-result" class="bg-white rounded-lg shadow-lg p-6">
                {{-- ... (UI Hasil Scan tidak berubah) ... --}}
                <div id="result-default">
                    <h3 class="text-lg font-semibold text-gray-500">Menunggu hasil scan...</h3>
                </div>
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
                <div id="result-error" class="hidden">
                    <h2 class="text-3xl font-bold text-red-600 mb-4" id="result-error-message"></h2>
                    <button onclick="resetScanner()" class="mt-6 w-full fi-btn fi-btn-size-lg fi-btn-color-danger fi-btn-style-filled">
                        Coba Scan Ulang
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{-- 1. Import Library Scanner (DARI CDN) --}}
    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>


    {{-- ========================================================== --}}
    {{-- == SCRIPT BARU (LOGIKA DIPERBAIKI TOTAL) == --}}
    {{-- ========================================================== --}}
    <script>
        // Ambil elemen-elemen UI
        const resultDefault = document.getElementById('result-default');
        const resultSuccess = document.getElementById('result-success');
        const resultError = document.getElementById('result-error');
        const fileInput = document.getElementById('qr-input-file');
        
        let html5QrcodeScanner; // Variabel untuk menyimpan instance scanner KAMERA

        // Fungsi yang dipanggil saat QR Code berhasil ter-scan (dari kamera ATAU file)
        function onScanSuccess(decodedText, decodedResult) {
            console.log("Scanner membaca ID:", decodedText);

            // Suspend scanner kamera (jika sedang aktif)
            if (html5QrcodeScanner) {
                try {
                    // Coba pause, tapi jangan error jika gagal
                    if (html5QrcodeScanner.getState() === Html5QrcodeScannerState.SCANNING) {
                        html5QrcodeScanner.pause();
                    }
                } catch (e) {
                    console.warn("Gagal pause scanner kamera:", e);
                }
            }

            // Tampilkan loading
            resultDefault.classList.remove('hidden');
            resultError.classList.add('hidden'); // Sembunyikan error sebelumnya
            resultSuccess.classList.add('hidden'); // Sembunyikan sukses sebelumnya
            resultDefault.innerHTML = '<h3 class="text-lg font-semibold text-yellow-600">Memproses tiket...</h3>';

            // Kirim ID Tiket ke Backend (Controller)
            fetch('{{ route("pos-keluar.scan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
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
            
            // Lanjutkan scan kamera
            if (html5QrcodeScanner) {
                try {
                     if (html5QrcodeScanner.getState() !== Html5QrcodeScannerState.SCANNING) {
                        html5QrcodeScanner.resume();
                     }
                } catch (e) {
                    console.warn("Gagal resume scanner kamera:", e);
                }
            }

            // Reset input file
            fileInput.value = "";
        }

        // Inisialisasi scanner saat dokumen siap
        document.addEventListener("DOMContentLoaded", function () {
            
            // Cek apakah library berhasil di-load
            if (typeof Html5QrcodeScanner !== 'undefined' && typeof Html5Qrcode !== 'undefined') {
                
                // LOGIKA 1: Inisialisasi Scanner Kamera
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader",
                    { fps: 10, qrbox: { width: 250, height: 250 } },
                    false
                );
                
                // Render scanner kamera
                html5QrcodeScanner.render(onScanSuccess); // onScanSuccess adalah callback jika kamera berhasil

                // ==========================================================
                // == LOGIKA 2: Inisialisasi Upload File (INI PERBAIKANNYA) ==
                // ==========================================================
                fileInput.addEventListener('change', e => {
                    if (e.target.files.length == 0) {
                        return;
                    }
                    const file = e.target.files[0];
                    
                    // Buat instance baru dari kelas INTI (Html5Qrcode)
                    // BUKAN dari 'html5QrcodeScanner'
                    const html5QrCode = new Html5Qrcode(
                        "reader", // ID ini hanya placeholder, tidak dipakai
                        { formats: [ 0 ] } // 0 = QR_CODE
                    ); 

                    // Panggil .scanFile() pada instance INTI
                    html5QrCode.scanFile(file, true)
                    .then(decodedText => {
                        // JIKA SUKSES, panggil callback yang SAMA
                        onScanSuccess(decodedText, null);
                    })
                    .catch(err => {
                        // JIKA GAGAL
                        console.error("Gagal scan file:", err);
                        resultDefault.classList.add('hidden');
                        document.getElementById('result-error-message').innerText = 'Gagal membaca QR dari file. Pastikan file adalah gambar PNG/JPG yang valid.';
                        resultError.classList.remove('hidden');
                    });
                });

            } else {
                console.error("Library Html5QrcodeScanner GAGAL dimuat.");
                document.getElementById("reader").innerHTML = "<p class='text-red-500'>Error: Gagal memuat library scanner. Cek koneksi internet.</p>";
            }
        });
    </script>
</x-filament-panels::page>