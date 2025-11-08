@extends('layouts.app')

@section('slot')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Pemantauan Real-time</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white rounded-lg shadow-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Pendapatan (Hari Ini)</h2>
            <p class="text-5xl font-bold text-green-600">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Kendaraan Saat Ini Di Dalam</h2>
            <p class="text-5xl font-bold text-blue-600">
                {{ $kendaraanDiDalam }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Petugas Terdaftar</h2>
            <p class="text-5xl font-bold text-purple-600">
                {{ $totalPetugas }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">
                Petugas Shift {{ $shiftSekarang }}
            </h2>
            @if($petugasBertugas->isEmpty())
                <p class="text-gray-500 italic">Tidak ada petugas.</p>
            @else
                <ul class="list-disc list-inside space-y-1">
                    @foreach($petugasBertugas as $petugas)
                        <li class="text-xl font-semibold text-gray-900">{{ $petugas->nama_petugas }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow-xl p-6 col-span-1 md:col-span-2 lg:col-span-4">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Aktivitas Hari Ini</h2>
            <div class="flex flex-wrap gap-x-8 gap-y-2">
                <div>
                    <span class="text-4xl font-bold text-blue-500">{{ $masukHariIni }}</span>
                    <span class="text-xl text-gray-600">Masuk</span>
                </div>
                <div>
                    <span class="text-4xl font-bold text-green-500">{{ $keluarHariIni }}</span>
                    <span class="text-xl text-gray-600">Keluar</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Aksi Cepat</h2>
            <a href="{{ route('gerbang-masuk') }}" class="block text-center bg-blue-600 text-white font-semibold py-4 px-6 rounded-lg shadow-lg hover:bg-blue-700 transition duration-200 text-lg">
                Ke Gerbang Masuk &rarr;
            </a>
            <a href="{{ route('pos-keluar.index') }}" class="block text-center bg-green-600 text-white font-semibold py-4 px-6 rounded-lg shadow-lg hover:bg-green-700 transition duration-200 text-lg">
                Ke Pos Keluar &rarr;
            </a>
        </div>

        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">5 Kendaraan Terakhir Masuk (Masih Di Dalam)</h2>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Tiket</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Masuk</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($kendaraanTerakhirDiDalam as $trx)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $trx->id_tiket }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trx->jenisKendaraan->nama_jenis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trx->jam_masuk }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada kendaraan di dalam.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection