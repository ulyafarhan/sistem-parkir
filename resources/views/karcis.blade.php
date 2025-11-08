<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karcis Parkir - {{ $transaksi->id_tiket }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">
        
        <div class="text-center border-b-2 border-dashed border-gray-300 pb-4 mb-4">
            <h1 class="text-2xl font-bold text-gray-800">KARCIS PARKIR DIGITAL</h1>
            <p class="text-gray-600">Sistem Informasi Parkir</p>
        </div>

        <div class="mb-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600 font-medium">Jenis Kendaraan:</span>
                <span class="text-xl font-bold text-gray-900">
                    {{ $transaksi->jenisKendaraan->nama_jenis }}
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600 font-medium">Tarif:</span>
                <span class="text-lg font-semibold text-gray-800">
                    Rp {{ number_format($transaksi->jenisKendaraan->tarif_per_hari, 0, ',', '.') }} / Hari
                </span>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-center">
            <p class="text-gray-600 text-sm">Jam Masuk:</p>
            <p class="text-4xl font-mono font-bold text-blue-600">
                {{ \Carbon\Carbon::parse($transaksi->jam_masuk)->format('H:i:s') }}
            </p>
            <p class="text-gray-500 text-md">
                {{ \Carbon\Carbon::parse($transaksi->jam_masuk)->format('d F Y') }}
            </p>
        </div>

        <div class="flex flex-col items-center mb-6">
            <div class="p-2 border border-gray-300 rounded-lg" id="qrcode-container">
                {!! QrCode::size(250)->generate($transaksi->id_tiket) !!}
            </div>
            <p class="text-xl font-bold font-mono text-gray-800 mt-4 tracking-wider">
                {{ $transaksi->id_tiket }}
            </p>
        </div>

        <button onclick="downloadQR()" class="
            w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg shadow
            hover:bg-blue-700 transition duration-200 mb-4 text-center
        ">
            Download Karcis (PNG)
        </button>

        <p class="text-sm text-red-600 text-center font-medium">
            Simpan karcis ini untuk proses keluar.
        </p>
    </div>

    <script>
        function downloadQR() {
            const svgElement = document.querySelector("#qrcode-container svg");
            
            // Beri padding putih di sekitar QR Code
            const padding = 20;
            const qrSize = 250; // Sesuaikan dengan QrCode::size()
            const canvas = document.createElement("canvas");
            canvas.width = qrSize + (padding * 2);
            canvas.height = qrSize + (padding * 2);
            
            const ctx = canvas.getContext("2d");
            
            // Latar belakang putih
            ctx.fillStyle = "#ffffff";
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            const img = new Image();
            img.src = 'data:image/svg+xml;base64,' + btoa(new XMLSerializer().serializeToString(svgElement));

            img.onload = function() {
                // Gambar QR di tengah canvas
                ctx.drawImage(img, padding, padding, qrSize, qrSize);
                
                const dataUrl = canvas.toDataURL("image/png");
                const link = document.createElement("a");
                link.href = dataUrl;
                link.download = "karcis-{{ $transaksi->id_tiket }}.png";
                link.click();
            };
        }
    </script>

</body>
</html>