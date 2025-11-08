<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class PosKeluarController extends Controller
{
    public function scan(Request $request): JsonResponse
    {
        $id_tiket = trim($request->input('id_tiket'));

        $transaksi = Transaksi::find($id_tiket);

        if (!$transaksi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket tidak valid atau tidak ditemukan.'
            ], 404);
        }

        if ($transaksi->jam_keluar) {
            return response()->json([
                'status' => 'error',
                'message' => 'TIKET SUDAH DIGUNAKAN (Keluar pada: ' . $transaksi->jam_keluar . ')'
            ], 400);
        }

        $jam_masuk = Carbon::parse($transaksi->jam_masuk);
        $jam_keluar = Carbon::now();

        $total_jam_presisi = $jam_masuk->diffInMinutes($jam_keluar) / 60;

        $total_hari = ceil($total_jam_presisi / 24);

        $total_hari = max(1, $total_hari);

        $tarif_per_hari = $transaksi->jenisKendaraan->tarif_per_hari;

        $total_biaya = $total_hari * $tarif_per_hari;

        $transaksi->update([
            'jam_keluar' => $jam_keluar,
            'total_biaya' => $total_biaya,
            'id_petugas_fk' => Auth::id()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Scan Berhasil!',
            'data' => [
                'id_tiket' => $transaksi->id_tiket,
                'jenis' => $transaksi->jenisKendaraan->nama_jenis,
                'total_hari' => $total_hari,
                'total_biaya' => number_format($total_biaya, 0, ',', '.'),
            ]
        ]);
    }
}