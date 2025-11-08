<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Petugas; // Pastikan ini Petugas, bukan User

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tabel_transaksi';
    protected $primaryKey = 'id_tiket';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_tiket',
        'jam_masuk',
        'jam_keluar',
        'total_biaya',
        'id_jenis_fk',
        'id_petugas_fk',
    ];

    public function jenisKendaraan(): BelongsTo
    {
        // ==============================================================
        // PERBAIKAN:
        // Tambahkan parameter ketiga ('id_jenis') 
        // untuk memberi tahu Laravel bahwa Primary Key di tabel 
        // JenisKendaraan adalah 'id_jenis', BUKAN 'id'.
        // ==============================================================
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_fk', 'id_jenis');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'id_petugas_fk', 'id_petugas');
    }
}