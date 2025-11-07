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

        // 6. Hitung durasi (dalam jam, TAPI DENGAN DESIMAL/PRESISI)
        //    Gunakan diffInMinutes untuk akurasi, lalu bagi 60
        $total_jam_presisi = $jam_masuk->diffInMinutes($jam_keluar) / 60;

        // 7. Hitung total hari (Rumus: ceil(total_jam_presisi / 24))
        //    Ini akan membulatkan ke atas per 24 jam.
        //    Cth: 24.01 jam (hasil dari 24 jam 1 menit) -> ceil(24.01 / 24) -> ceil(1.0004) -> 2 hari
        $total_hari = ceil($total_jam_presisi / 24);

        // 8. Pastikan minimal 1 hari
        //    Jika parkir 1 menit (0.016 jam), ceil(0.016 / 24) = 1.
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