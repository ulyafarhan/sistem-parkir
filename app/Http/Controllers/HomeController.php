<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi; // Import model Transaksi
use Carbon\Carbon; // Import Carbon

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil data untuk widget 
        $totalPendapatanHariIni = Transaksi::whereDate('jam_keluar', Carbon::today())
                                            ->sum('total_biaya');
                                            
        $jumlahKendaraanDiDalam = Transaksi::whereNull('jam_keluar')
                                           ->count();
        
        // Kirim data ke view
        return view('home', [
            'totalPendapatan' => $totalPendapatanHariIni,
            'kendaraanDiDalam' => $jumlahKendaraanDiDalam,
        ]);
    }
}