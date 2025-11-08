@extends('layouts.app')

{{-- 
  Gunakan @section('slot') karena layout utama kita menggunakan @yield('slot') 
  Ini menggantikan @section('content') yang lama
--}}
@section('slot')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Pemantauan</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-lg shadow-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Pendapatan Hari Ini</h2>
            <p class="text-5xl font-bold text-green-600">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Jumlah Kendaraan di Dalam</h2>
            <p class="text-5xl font-bold text-blue-600">
                {{ $kendaraanDiDalam }}
                <span class="text-3xl text-gray-500">Kendaraan</span>
            </p>
        </div>

    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="flex space-x-4">
            <a href="{{ route('gerbang-masuk') }}" class="bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-blue-700 transition duration-200 text-lg">
                Ke Gerbang Masuk &rarr;
            </a>
            <a href="{{ route('pos-keluar.index') }}" class="bg-green-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-green-700 transition duration-200 text-lg">
                Ke Pos Keluar &rarr;
            </a>
        </div>
    </div>
</div>
@endsection