<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\JenisKendaraan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PosKeluarController extends Controller
{
    public function index()
    {
        return view('pos-keluar');
    }

    public function prosesKeluar(Request $request)
    {
        $request->validate([
            'id_tiket' => 'required|string|exists:tabel_transaksi,id_tiket',
        ]);

        $id_tiket = $request->id_tiket;

        $transaksi = Transaksi::where('id_tiket', $id_tiket)->first();

        if (!$transaksi) {
             return response()->json([
                'status' => 'error',
                'message' => 'Transaksi tidak ditemukan meskipin valid.',
            ], 404);
        }

        if ($transaksi->jam_keluar !== null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket Sudah Digunakan (ID: ' . $id_tiket . ')',
            ], 422);
        }

        $jenis = $transaksi->jenisKendaraan;
        $jam_masuk = Carbon::parse($transaksi->jam_masuk);
        $jam_keluar = Carbon::now();
        $tarif_per_hari = $jenis->tarif_per_hari;
        
        $total_menit = $jam_keluar->diffInMinutes($jam_masuk);

        $total_jam = $total_menit / 60;
        
        $total_hari = ceil($total_jam / 24);

        $total_hari = max(1, $total_hari);
        
        $total_biaya = $total_hari * $tarif_per_hari;

        $transaksi->update([
            'jam_keluar' => $jam_keluar,
            'total_biaya' => $total_biaya,
            'id_petugas_fk' => Auth::id(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Keluar!',
            'data' => [
                'id_tiket' => $transaksi->id_tiket,
                'nama_jenis' => $jenis->nama_jenis,
                'jam_masuk' => $jam_masuk->format('d/m/Y H:i:s'),
                'jam_keluar' => $jam_keluar->format('d/m/Y H:i:s'),
                'durasi_hari' => $total_hari,
                'total_biaya' => $total_biaya,
            ]
        ]);
    }
}