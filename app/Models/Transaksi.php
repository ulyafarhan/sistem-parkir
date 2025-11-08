<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // <-- TAMBAHKAN BARIS INI

class Transaksi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'tabel_transaksi'; // Pastikan ini sesuai dengan migrasi

    /**
     * Primary key dari tabel.
     *
     * @var string
     */
    protected $primaryKey = 'id_tiket';

    /**
     * Tipe data primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_tiket',
        'jam_masuk',
        'jam_keluar',
        'total_biaya',
        'id_jenis_fk',
        'id_petugas_fk',
    ];

    /**
     * Relasi ke JenisKendaraan.
     */
    public function jenisKendaraan()
    {
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_fk', 'id_jenis');
    }

    /**
     * Relasi ke Petugas (User).
     * INI ADALAH PERBAIKANNYA
     */
    public function petugas()
    {
        // Ubah App\Models\Petugas::class menjadi User::class
        return $this->belongsTo(User::class, 'id_petugas_fk', 'id');
    }
}