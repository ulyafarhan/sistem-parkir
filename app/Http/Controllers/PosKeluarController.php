<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\JenisKendaraan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PosKeluarController extends Controller
{
    /**
     * Menampilkan halaman scanner Pos Keluar.
     */
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
    public function prosesKeluar(Request $request)
    {
        $request->validate([
            'id_tiket' => 'required|string|exists:tabel_transaksi,id_tiket',
        ]);

        $id_tiket = $request->id_tiket;
        $transaksi = Transaksi::find($id_tiket);

        // 1. Validasi Tiket (Pastikan belum pernah keluar)
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
        // Hitung selisih waktu dalam jam
        $total_jam = $jam_keluar->diffInHours($jam_masuk);

        // Hitung total_hari dengan rumus: ceil($total_jam / 24)
        $total_hari = ceil($total_jam / 24);

        // Pastikan minimal 1 hari
        $total_hari = max(1, $total_hari);
        
        // 4. Hitung Total Biaya
        $total_biaya = $total_hari * $tarif_per_hari;

        // 5. Update Database
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