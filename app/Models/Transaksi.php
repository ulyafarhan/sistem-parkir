<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tabel_transaksi';

    protected $primaryKey = 'id_tiket';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'jam_masuk' => 'datetime',
        'jam_keluar' => 'datetime',
    ];
    protected $fillable = [
        'id_tiket',
        'jam_masuk',
        'jam_keluar',
        'total_biaya',
        'id_jenis_fk',
        'id_petugas_fk',
    ];

    public function jenisKendaraan()
    {
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_fk', 'id_jenis');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas_fk', 'id');
    }
}