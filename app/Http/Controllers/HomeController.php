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

        $jam = $now->hour;
        $shiftSekarang = '';

        if ($jam >= 8 && $jam < 16) {
            $shiftSekarang = 'Pagi';
        } elseif ($jam >= 16 && $jam < 24) {
            $shiftSekarang = 'Sore';
        } else {
            $shiftSekarang = 'Malam';
        }

        $petugasBertugas = User::where('shift', $shiftSekarang)->get();

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

        return view('home', [
            'totalPendapatan' => $totalPendapatan,
            'kendaraanDiDalam' => $kendaraanDiDalam,
            'masukHariIni' => $masukHariIni,
            'keluarHariIni' => $keluarHariIni,
            'totalPetugas' => $totalPetugas,
            'kendaraanTerakhirDiDalam' => $kendaraanTerakhirDiDalam,
            'shiftSekarang' => $shiftSekarang,
            'petugasBertugas' => $petugasBertugas,
        ]);
    }
}