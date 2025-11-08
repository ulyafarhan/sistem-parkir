<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today();
        $now = Carbon::now();

        // 1. Tentukan Shift Saat Ini berdasarkan Waktu
        $jam = $now->hour; // Ambil jam saat ini (0-23)
        $shiftSekarang = '';

        if ($jam >= 8 && $jam < 16) { // 08:00 - 15:59
            $shiftSekarang = 'Pagi';
        } elseif ($jam >= 16 && $jam < 24) { // 16:00 - 23:59
            $shiftSekarang = 'Sore';
        } else { // 00:00 - 07:59
            $shiftSekarang = 'Malam';
        }

        // 2. Ambil Petugas yang sedang bertugas
        $petugasBertugas = User::where('shift', $shiftSekarang)->get();

        // 3. Statistik Lainnya
        $totalPendapatan = Transaksi::whereDate('jam_keluar', $today)->sum('total_biaya');
        $kendaraanDiDalam = Transaksi::whereNull('jam_keluar')->count();
        $totalPetugas = User::count();
        $masukHariIni = Transaksi::whereDate('jam_masuk', $today)->count();
        $keluarHariIni = Transaksi::whereDate('jam_keluar', $today)->count();
        $kendaraanTerakhirDiDalam = Transaksi::with('jenisKendaraan')
                                        ->whereNull('jam_keluar')
                                        ->orderBy('jam_masuk', 'desc')
                                        ->take(5)
                                        ->get();

        // Kirim semua data ke view
        return view('home', [
            'totalPendapatan' => $totalPendapatan,
            'kendaraanDiDalam' => $kendaraanDiDalam,
            'masukHariIni' => $masukHariIni,
            'keluarHariIni' => $keluarHariIni,
            'totalPetugas' => $totalPetugas,
            'kendaraanTerakhirDiDalam' => $kendaraanTerakhirDiDalam,
            'shiftSekarang' => $shiftSekarang, // <-- DATA BARU
            'petugasBertugas' => $petugasBertugas, // <-- DATA BARU
        ]);
    }
}