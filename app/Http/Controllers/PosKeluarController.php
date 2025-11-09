<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\JenisKendaraan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Zxing\QrReader;

class PosKeluarController extends Controller
{
    public function index()
    {
        // Kita hanya perlu menampilkan view-nya.
        // Logika scanner akan ditangani oleh JavaScript di view.
        return view('pos-keluar');
    }

    /**
     * Memproses tiket yang di-scan.
     * Ini adalah endpoint API yang akan dipanggil oleh JavaScript.
     */
    public function scan(Request $request)
    {
        $request->validate([
            'id_tiket' => 'required|string|exists:tabel_transaksi,id_tiket',
        ]);

        $id_tiket = $request->id_tiket;
        $transaksi = Transaksi::find($id_tiket);

        // 1. Validasi Tiket (Pastikan belum pernah keluar) [cite: 1611]
        if ($transaksi->jam_keluar !== null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket Sudah Digunakan (ID: ' . $id_tiket . ')',
            ], 422);
        }

        // 2. Ambil data untuk kalkulasi
        $jenis = $transaksi->jenisKendaraan; // Relasi ke JenisKendaraan
        $jam_masuk = Carbon::parse($transaksi->jam_masuk);
        $jam_keluar = Carbon::now();
        $tarif_per_hari = $jenis->tarif_per_hari;

        // 3. Hitung Durasi (Logika Bisnis Sesuai Spesifikasi) 
        
        // --- PERBAIKAN LOGIKA DIMULAI ---
        
        // Hitung selisih waktu dalam menit untuk presisi
        $total_menit = $jam_keluar->diffInMinutes($jam_masuk);

        // Ubah menit ke jam (dalam desimal, cth: 90 menit = 1.5 jam)
        $total_jam = $total_menit / 60;
        
        // Hitung total_hari dengan rumus: ceil($total_jam / 24) 
        // Cth: 1.5 jam -> ceil(1.5 / 24) -> ceil(0.0625) -> 1 hari
        // Cth: 25 jam -> ceil(25 / 24) -> ceil(1.04) -> 2 hari
        $total_hari = ceil($total_jam / 24);

        // Pastikan minimal 1 hari [cite: 1705]
        $total_hari = max(1, $total_hari);
        
        // --- PERBAIKAN LOGIKA SELESAI ---

        // 4. Hitung Total Biaya
        $total_biaya = $total_hari * $tarif_per_hari;

        // 5. Update Database [cite: 1614, 1708]
        $transaksi->update([
            'jam_keluar' => $jam_keluar,
            'total_biaya' => $total_biaya,
            'id_petugas_fk' => Auth::id(), // Menggunakan Petugas yang sedang login
        ]);

        // 6. Kirim respon sukses ke scanner
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