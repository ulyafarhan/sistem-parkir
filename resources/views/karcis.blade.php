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

        {{-- 
          Ini adalah QR Code yang akan di-scan [cite: 37]
          Isinya adalah 'id_tiket'
        --}}
        <div class="flex justify-center mb-4">
            {!! QrCode::size(250)->generate($transaksi->id_tiket) !!}
        </div>
        
        <p class="text-lg font-bold font-mono text-gray-800 mb-4">
            {{ $transaksi->id_tiket }}
        </p>

        <p class="text-sm text-red-600">
            Simpan karcis ini untuk proses keluar.
        </p>
    </div>

</body>
</html>