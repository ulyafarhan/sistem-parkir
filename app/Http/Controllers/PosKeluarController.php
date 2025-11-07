<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import semua yang kita butuhkan
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class PosKeluarController extends Controller
{
    /**
     * Menerima data scan, menghitung biaya, dan update database.
     */
    public function scan(Request $request): JsonResponse
    {
        // 1. Ambil id_tiket dari request JavaScript
        $id_tiket = trim($request->input('id_tiket'));

        // 2. Temukan transaksi
        $transaksi = Transaksi::find($id_tiket);

        // 3. Validasi: Tiket tidak ditemukan
        if (!$transaksi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket tidak valid atau tidak ditemukan.'
            ], 404);
        }

        // 4. Validasi: Tiket sudah pernah keluar
        if ($transaksi->jam_keluar) {
            return response()->json([
                'status' => 'error',
                'message' => 'TIKET SUDAH DIGUNAKAN (Keluar pada: ' . $transaksi->jam_keluar . ')'
            ], 400);
        }

        // --- Mulai Logika Bisnis Inti Sesuai Brief  ---

        // 5. Tentukan timestamp
        $jam_masuk = Carbon::parse($transaksi->jam_masuk);
        $jam_keluar = Carbon::now();

        // 6. Hitung durasi (dalam jam)
        $total_jam = $jam_masuk->diffInHours($jam_keluar);

        // 7. Hitung total hari (Rumus: ceil(jam / 24))
        $total_hari = ceil($total_jam / 24);

        // 8. Pastikan minimal 1 hari
        $total_hari = max(1, $total_hari);

        // 9. Ambil tarif
        $tarif_per_hari = $transaksi->jenisKendaraan->tarif_per_hari;

        // 10. Hitung total biaya
        $total_biaya = $total_hari * $tarif_per_hari;

        // 11. Simpan (UPDATE) ke database
        $transaksi->update([
            'jam_keluar' => $jam_keluar,
            'total_biaya' => $total_biaya,
            'id_petugas_fk' => Auth::id() // Ambil ID Petugas yang sedang login
        ]);

        // --- Selesai Logika Bisnis ---

        // 12. Kirim balasan sukses ke JavaScript
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