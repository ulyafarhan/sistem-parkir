<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karcis Parkir - {{ $transaksi->id_tiket }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-sm text-center">
        <h1 class="text-2xl font-bold mb-4">KARCIS PARKIR DIGITAL</h1>
        
        <div class="mb-6">
            <p class="text-gray-600">Jam Masuk:</p>
            <p class="text-3xl font-mono font-bold text-blue-600">
                {{ \Carbon\Carbon::parse($transaksi->jam_masuk)->format('H:i:s') }}
            </p>
            <p class="text-gray-500 text-sm">
                {{ \Carbon\Carbon::parse($transaksi->jam_masuk)->format('d F Y') }}
            </p>
        </div>

        <div class="mb-6">
            <p class="text-gray-600">Jenis Kendaraan:</p>
            <p class="text-2xl font-semibold">
                {{ $transaksi->jenisKendaraan->nama_jenis }}
            </p>
        </div>

        {{-- 1. KEMBALIKAN KE SVG (INI TIDAK BUTUH IMAGICK) --}}
        <div class="flex justify-center mb-4" id="qrcode-container">
            {!! QrCode::size(250)->generate($transaksi->id_tiket) !!}
        </div>
        
        <p class="text-lg font-bold font-mono text-gray-800 mb-4">
            {{ $transaksi->id_tiket }}
        </p>

        {{-- 2. TAMBAHKAN TOMBOL DOWNLOAD --}}
        <button onclick="downloadQR()" class="
            bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow
            hover:bg-blue-700 transition duration-200 mb-4
        ">
            Download Karcis (QR)
        </button>

        <p class="text-sm text-red-600">
            Simpan karcis ini untuk proses keluar.
        </p>
    </div>

    {{-- 3. TAMBAHKAN SCRIPT UNTUK FUNGSI DOWNLOAD --}}
    <script>
        function downloadQR() {
            // Ambil elemen SVG
            const svgElement = document.querySelector("#qrcode-container svg");
            
            // Konversi SVG ke teks
            const serializer = new XMLSerializer();
            let svgString = serializer.serializeToString(svgElement);

            // Buat file virtual
            const blob = new Blob([svgString], {type: "image/svg+xml"});
            const url = URL.createObjectURL(blob);
            
            // Buat link download palsu
            const link = document.createElement("a");
            link.href = url;
            // Tentukan nama file download
            link.download = "karcis-{{ $transaksi->id_tiket }}.svg"; 
            
            // Klik link palsu secara otomatis
            document.body.appendChild(link);
            link.click();
            
            // Hapus link palsu
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        }
    </script>

</body>
</html>