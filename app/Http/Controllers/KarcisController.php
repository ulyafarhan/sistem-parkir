<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import model
use App\Models\JenisKendaraan;
use App\Models\Transaksi;
// Import helper
use Illuminate\Support\Str;
use Carbon\Carbon;

class KarcisController extends Controller
{
    /**
     * Fungsi ini dipanggil saat tombol [MASUK] ditekan.
     * Tugas: INSERT data baru dan redirect ke halaman karcis.
     */
    public function generate($id_jenis)
    {
        // 1. Ambil data Jenis Kendaraan
        $jenis = JenisKendaraan::findOrFail($id_jenis);

        // 2. Buat ID Tiket Unik (sesuai brief)
        $prefix = strtoupper(substr($jenis->nama_jenis, 0, 3));
        $id_tiket = '';

        // -- PERBAIKAN: Loop untuk memastikan ID unik --
        // Terus generate ID baru jika ID yang ada sudah dipakai
        do {
            $id_tiket = $prefix . '-' . strtoupper(Str::random(5));
        } while (Transaksi::where('id_tiket', $id_tiket)->exists());
        // ---------------------------------------------

        // 3. Simpan (INSERT) data transaksi baru
        $transaksi = Transaksi::create([
            'id_tiket' => $id_tiket,
            'jam_masuk' => Carbon::now(),
            'id_jenis_fk' => $jenis->id_jenis,
            // jam_keluar, total_biaya, id_petugas_fk akan NULL/default
        ]);

        // 4. Redirect ke tab baru untuk menampilkan karcis
        return redirect()->route('karcis.show', ['id_tiket' => $transaksi->id_tiket]);
    }

    /**
     * Fungsi ini dipanggil untuk menampilkan Karcis Digital (QR Code).
     */
    public function show($id_tiket)
    {
        $transaksi = Transaksi::findOrFail($id_tiket);

        // Tampilkan view 'karcis.blade.php'
        return view('karcis', [
            'transaksi' => $transaksi
        ]);
    }
}