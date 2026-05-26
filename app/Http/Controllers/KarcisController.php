<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKendaraan;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Spatie\Browsershot\Browsershot;

class KarcisController extends Controller
{
    public function download($id_tiket)
    {
        $transaksi = Transaksi::findOrFail($id_tiket);
        $view = view('karcis-printable', ['transaksi' => $transaksi])->render();

        $path = storage_path('app/karcis-' . $id_tiket . '.png');
        Browsershot::html($view)
            ->select('#karcis-untuk-download')
            ->save($path);
        return response()->download($path)->deleteFileAfterSend(true);
    }
    public function generate($id_jenis)
    {
        $jenis = JenisKendaraan::findOrFail($id_jenis);

        $prefix = strtoupper(substr($jenis->nama_jenis, 0, 3));
        $id_tiket = '';

        do {
            $id_tiket = $prefix . '-' . strtoupper(Str::random(5));
        } while (Transaksi::where('id_tiket', $id_tiket)->exists());

        $transaksi = Transaksi::create([
            'id_tiket' => $id_tiket,
            'jam_masuk' => Carbon::now(),
            'id_jenis_fk' => $jenis->id_jenis,
        ]);

        return redirect()->route('karcis.show', ['id_tiket' => $transaksi->id_tiket ])->with('success','');
    }

    public function show($id_tiket)
    {
        $transaksi = Transaksi::findOrFail($id_tiket);

        return view('karcis', [
            'transaksi' => $transaksi
        ]);
    }
}