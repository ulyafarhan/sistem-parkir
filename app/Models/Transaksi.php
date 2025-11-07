<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Relasi N:1 ke JenisKendaraan (Satu Transaksi punya satu Jenis)
     */
    public function jenisKendaraan(): BelongsTo
    {
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_fk');
    }

    /**
     * Relasi N:1 ke User/Petugas (Satu Transaksi di-handle satu Petugas)
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_petugas_fk');
    }
}